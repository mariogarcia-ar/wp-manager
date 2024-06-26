<?php
/**
 * Plugin Name: PW WP Importer
 * Plugin URI: https://github.com/mariogarcia-ar/pw_wp_importer
 * Description: This is a WP CLI command to import data from a CSV file.
 * Version: 1.0.1
 * Author: Mario Garcia <mariogarcia.ar@gmail.com>
 * Author URI: https://github.com/mariogarcia-ar
 */

if (!class_exists('PW_WP_Importer')) {
    require_once __DIR__.'/class/PW_WP_Importer.php';
}

if (defined('WP_CLI') && WP_CLI) {
    class PW_WP_Importer_Command {
        /**
         * Import taxonomy terms from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer category /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function category($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importTaxonomyBulk('category');
        }

        /**
         * Import tags from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer tag /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function tag($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importTaxonomyBulk('post_tag');
        }

        /**
         * Import taxonomy terms from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * <taxonomy>
         * : The taxonomy to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer taxonomy /path/to/file.csv category
         *
         * @when after_wp_load
         */
        public function taxonomy($args, $assoc_args) {
            $file = $args[0];
            $taxonomy = $args[1];
            $importer = new PW_WP_Importer($file);
            $importer->importTaxonomyBulk($taxonomy);
        }

        /**
         * Import users from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer user /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function user($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importUserBulk();
        }

        // add import attachment using importAttachmentBulk 
        /**
         * Import attachments from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer attachment /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function attachment($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importAttachmentBulk();
        }


        /**
         * Import posts from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer post /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function post($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importPostBulk();
        }

        /**
         * Import post meta from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer post_meta /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function post_meta($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importPostMetaBulk();
        }

        /**
         * Import thumbnails from a CSV file.
         *
         * ## OPTIONS
         *
         * <file>
         * : The CSV file to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer thumbnail /path/to/file.csv
         *
         * @when after_wp_load
         */
        public function thumbnail($args, $assoc_args) {
            $file = $args[0];
            $importer = new PW_WP_Importer($file);
            $importer->importThumbnailBulk();
        }

        /**
         * Import uploads from a backup folder.
         *
         * ## OPTIONS
         *
         * <backup_folder>
         * : The  backup_folder to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer restore_backup /path/to/backup/folder
         *
         * @when after_wp_load
         */
        public function restore_backup($args, $assoc_args) {
            $backup_folder = $args[0];
            $importer = new PW_WP_Importer();
            $importer->restoreBackup($backup_folder);
        }

        /**
         * Import plugins from a backup folder.
         *
         * ## OPTIONS
         *
         * <backup_folder>
         * : The  backup_folder to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer restore_plugins /path/to/backup/folder
         *
         * @when after_wp_load
         */
        public function restore_plugins($args, $assoc_args) {
            $backup_folder = $args[0];
            $importer = new PW_WP_Importer();
            $importer->restorePlugins($backup_folder);
        }

        /**
         * Import themes from a backup folder.
         *
         * ## OPTIONS
         *
         * <backup_folder>
         * : The  backup_folder to import.
         *
         * ## EXAMPLES
         *
         *     wp pw_importer restore_themes /path/to/backup/folder
         *
         * @when after_wp_load
         */
        public function restore_themes($args, $assoc_args) {
            $backup_folder = $args[0];
            $importer = new PW_WP_Importer();
            $importer->restoreThemes($backup_folder);
        }

    }

    WP_CLI::add_command('pw_importer', 'PW_WP_Importer_Command');
}