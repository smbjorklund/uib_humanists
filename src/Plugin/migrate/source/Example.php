<?php

namespace Drupal\uib_humanists\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * The 'uib_humanists_example' source plugin.
 *
 * @MigrateSource(
 *   id = "uib_humanists_example",
 *   source_module = "uib_humanists"
 * )
 */
class Example extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('example', 'e')
      ->fields('e', ['id', 'name', 'status']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return [
      'id' => $this->t('The record ID.'),
      'name' => $this->t('The record name.'),
      'status' => $this->t('The record status'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['id']['type'] = [
      'type' => 'integer',
      'unsigned' => TRUE,
      'size' => 'big',
    ];
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {

    // @DCG
    // Extend/modify the row here if needed.
    //
    // Example:
    // @code
    // $name = $row->getSourceProperty('name');
    // $row->setSourceProperty('name', Html::escape('$name');
    // @endcode
    return parent::prepareRow($row);
  }

}
