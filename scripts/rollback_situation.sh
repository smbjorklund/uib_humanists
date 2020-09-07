#!/bin/bash

drush migrate:rollback --group=uib_nodes
drush migrate:rollback --group=uib_paragraphs
drush migrate:status --group=uib_nodes,uib_paragraphs
