#!/bin/bash

echo "Importing"
drush migrate:import --group=uib_paragraphs
drush migrate:import uib_node_character
drush migrate:import uib_node_revision_character
drush migrate:import uib_node_machine_vision_situation
drush migrate:import uib_node_revision_machine_vision_situation
drush migrate:status --group=uib_nodes,uib_paragraphs

#echo "Checking database"
#drush sql:query "SELECT * FROM paragraph__field_verbs WHERE bundle = 'technology_actions'; SELECT * FROM paragraph__field_technology;"
