<?php

namespace Drupal\thietkeasea_vue_api\Drush\Commands;

use Drupal\thietkeasea_vue_api\Service\DemoContentImporter;
use Drush\Commands\DrushCommands;

class DemoImportCommands extends DrushCommands {

  public function __construct(
    protected DemoContentImporter $demoContentImporter,
  ) {
    parent::__construct();
  }

  /**
   * Imports demo content from the Vue JSON fixtures into Drupal content types.
   *
   * @command qb:import-demo
   * @option reset Delete existing demo bundle content before importing.
   * @usage ddev drush qb:import-demo --reset
   */
  public function importDemo(array $options = ['reset' => FALSE]): void {
    $reset = !empty($options['reset']);
    $result = $this->demoContentImporter->importAll($reset);

    foreach ($result as $label => $count) {
      $this->io()->writeln(sprintf('%s: %d', $label, $count));
    }
  }

}
