<?php

use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\Entity\EntityStorageInterface;

final class CleanUp
{
  private string $entityType;
  private EntityStorageInterface $storage;

  public function __construct(string $entityType)
  {
    $this->entityType = $entityType;
    try {
      $this->storage = Drupal::entityTypeManager()
        ->getStorage($this->entityType);
    } catch (InvalidPluginDefinitionException | PluginNotFoundException $e) {
    }
  }

  public function findEntities(): array
  {
    return Drupal::entityQuery($this->entityType)
      ->execute();
  }

  private function load(): array
  {
    $fids = $this->findEntities();
    return $this->storage->loadMultiple($fids);
  }

  public function removeEntities(): void {
    $entities = $this->load();

    try {
      $this->storage->delete($entities);
    } catch (EntityStorageException $e) {
      print 'Unable to delete ' . count($entities) . PHP_EOL;
    }
    print 'Deleted ' . count($entities) . ' of type ' . $this->entityType . PHP_EOL;
  }

}

final class Utils
{
  private function __construct() {}

  public static function summarise(): void {
    foreach (Drupal::entityTypeManager()->getDefinitions() as $entityType) {
      $entityTypeToClean = new CleanUp($entityType->id());
      print count($entityTypeToClean->findEntities()) . "\t" . $entityType->id() . PHP_EOL;
    }
  }
}

// Example use.
Utils::summarise();
$entityType = 'file';
$entityTypeToClean = new CleanUp($entityType);
print 'Found ' . count($entityTypeToClean->findEntities()) .  ' ' . $entityType . '(s)' . PHP_EOL;
//$entityTypeToClean->removeEntities();
