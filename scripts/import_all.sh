#!/bin/bash

echo "Importing"
drush migrate:import --group=uib_users
drush migrate:import --group=uib_files
drush migrate:import --group=uib_taxonomy
drush migrate:import --group=uib_paragraphs
drush migrate:import --group=uib_nodes
drush migrate:import --group=uib_comments
drush migrate:status --group=uib_nodes,uib_files,uib_taxonomy,uib_comments,uib_users,uib_paragraphs
