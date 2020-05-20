<?php

final class CleanUp
{
  private $entityType;
  private $storage;

  public function __construct(string $entityType)
  {
    $this->entityType = $entityType;
    $this->storage = \Drupal::entityTypeManager()->getStorage($this->entityType);
  }

  public function findEntities(): array
  {
    return \Drupal::entityQuery($this->entityType)
      ->execute();
  }

  private function load(): array
  {
    $fids = $this->findEntities();
    return $this->storage->loadMultiple($fids);
  }

  public function removeEntities()
  {
    $entities = $this->load();

    try {
      $this->storage->delete($entities);
    } catch (\Drupal\Core\Entity\EntityStorageException $e) {
      print 'Unable to delete ' . count($entities) . PHP_EOL;
    }
    print 'Deleted ' . count($entities) . ' of type ' . $this->entityType . PHP_EOL;
  }

}

final class Utils
{
  private function __construct() {}

  static function summarise()
  {
    foreach (\Drupal::entityTypeManager()->getDefinitions() as $entityType) {
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
//Danger zone! $entityTypeToClean->removeEntities();
