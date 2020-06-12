#!/bin/bash

echo "Rolling back"
drush migrate:rollback --group=uib_comments
drush migrate:rollback --group=uib_nodes
drush migrate:rollback --group=uib_paragraphs
drush migrate:rollback --group=uib_taxonomy
drush migrate:rollback --group=uib_files
drush migrate:rollback --group=uib_users
drush migrate:status --group=uib_nodes,uib_files,uib_taxonomy,uib_comments,uib_users,uib_paragraphs
