<?php declare(strict_types=1);

use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Database;
use Drupal\Core\Database\StatementInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\node\Entity\Node;

final class Location
{

  private $database;

  public function __construct(Connection $database, EntityStorageInterface $storage)
  {
    $this->database = $database;
    $this->storage = $storage;
  }

  public function findEntities(): StatementInterface
  {
    $query = $this->database->select('location_instance', 'li')
      ->fields('li', ['nid', 'lid'])
      ->fields('l', ['country'])
      ->fields('lc', ['name']);
    $query->leftJoin('location', 'l', 'li.lid = l.lid');
    $query->leftJoin('location_country', 'lc', 'l.country = lc.code');

    return $query->execute();
  }

  private function load($entity): EntityInterface
  {

    try {
      $node = $this->storage->load($entity->nid);
    } catch (Exception $e) {
    }

    if ($node !== NULL) {

      if ($node->bundle() === 'person') {
        return $node;
      }
    }
  }

  public function updateEntities($entities)
  {
    foreach ($entities as $entity) {
      $node = $this->load($entity);
        print 'Updating ' . $node->label() . ' ' . $node->id() . PHP_EOL;
        $node->field_country->value('us');
      }
    }
  }

$entityTypeToUpdate = new Location(
  Database::getConnection('default', 'migrate'),
  \Drupal::entityTypeManager()->getStorage('node')
);
$results = $entityTypeToUpdate->findEntities();
$entityTypeToUpdate->updateEntities($results);
