<?php declare(strict_types=1);

use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Database;
use Drupal\Core\Database\Query\SelectInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;

final class Result
{
  private $entities = [];

  public function add($item): void
  {
    $this->entities[] = $item;
  }

  public function items(): array
  {
    return $this->entities;
  }
}

final class Location
{
  private $result;
  private $storage;
  private $database;

  public function __construct(Result $result, Connection $database, EntityStorageInterface $storage)
  {
    $this->result = $result;
    $this->database = $database;
    $this->storage = $storage;
  }

  private function query(): SelectInterface
  {
    $query = $this->database->select('location_instance', 'li')
      ->fields('li', ['nid', 'lid'])
      ->fields('l', ['country'])
      ->fields('lc', ['name']);
    $query->distinct();
    $query->leftJoin('location', 'l', 'li.lid = l.lid');
    $query->leftJoin('location_country', 'lc', 'l.country = lc.code');

    return $query;
  }

  public function findEntities(): void
  {
    $query = $this->query();
    $entities = $query->execute();

    foreach ($entities as $entity) {
      $entity->node = $this->loadFullNode($entity);
      $entity->node->field_country->setValue(NULL);
      $this->result->add($entity);
    }
  }

  private function loadFullNode($entity): EntityInterface
  {
    try {
      $node = $this->storage->load($entity->nid);
    } catch (Exception $e) {
      throw new \RuntimeException('Unable to load node ' . $entity->nid);
    }

    if (($node !== NULL) && $node->bundle() === 'person') {
      return $node;
    }
  }

  public function updateEntities(): void
  {
    foreach ($this->result->items() as $entity) {
      $country = strtoupper($entity->country);
      print 'Updating ' . $entity->node->label() . ' ' . $entity->node->id() . ' Country: ' . $country . PHP_EOL;
      $entity->node->field_country->appendItem($country);
      $entity->node->save();
    }
  }

}


$bundle = new Location(
  new Result(),
  Database::getConnection('default', 'migrate'),
  \Drupal::entityTypeManager()->getStorage('node')
);
$bundle->findEntities();
$bundle->updateEntities();
