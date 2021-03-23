#!/bin/bash
drush config-delete migrate_plus.migration.uib_user
drush config-delete migrate_plus.migration.uib_user_role
drush config-delete migrate_plus.migration_group.uib_files
drush config-delete migrate_plus.migration_group.uib_taxonomy
drush config-delete migrate_plus.migration_group.uib_users
drush config-delete migrate_plus.migration.uib_taxonomy_term_language
drush config-delete migrate_plus.migration.uib_taxonomy_term_gender
drush config-delete migrate_plus.migration.uib_taxonomy_term_event_type
drush config-delete migrate_plus.migration.uib_taxonomy_term_critical_writing_type

drush config-delete migrate_plus.migration.uib_file
#drush config-delete migrate_plus.migration.uib_node_machine_vision_situation
#drush config-delete migrate_plus.migration.uib_node_person
#drush config-delete migrate_plus.migration.uib_node_work
#drush config-delete migrate_plus.migration.uib_taxonomy_term_age
#drush config-delete migrate_plus.migration.uib_taxonomy_term_colours
#drush config-delete migrate_plus.migration.uib_taxonomy_term_creative_work_publication_type
#drush config-delete migrate_plus.migration.uib_taxonomy_term_gender
#drush config-delete migrate_plus.migration.uib_taxonomy_term_generic_entities
#drush config-delete migrate_plus.migration.uib_taxonomy_term_individual_or_group
#drush config-delete migrate_plus.migration.uib_taxonomy_term_race
#drush config-delete migrate_plus.migration.uib_taxonomy_term_record_status
#drush config-delete migrate_plus.migration.uib_taxonomy_term_sentiment
#drush config-delete upgrade_d7_taxonomy_term_sexuality
#drush config-delete migrate_plus.migration.uib_comment

#migrate_plus.migration.uib_file, migrate_plus.migration.uib_user, migrate_plus.migration.uib_user_role, migrate_plus.migration_group.uib_files, migrate_plus.migra
#  tion_group.uib_taxonomy, migrate_plus.migration_group.uib_users
