<?php
/*
   Plugin Name: Token based Voting
   Plugin URI: http://asanka-abeyweera.blogspot.com
   Description: A voting plugin that can be used with tokens
   Author: Asanka Abeyweera
   Version: 1.0
   Author URI: http://asanka-abeyweera.blogspot.com
*/

function tvote_install () {
   global $wpdb;
   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

   $table_name = $wpdb->prefix . "tvote_tokens";
   $sql = "CREATE TABLE $table_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  token varchar(16) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY token (token)
);";
   dbDelta( $sql );

   $table_name = $wpdb->prefix . "tvote_awards";
   $sql = "CREATE TABLE $table_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  descryption text,
  PRIMARY KEY  (id)
);";
   dbDelta( $sql );

   $table_name = $wpdb->prefix . "tvote_nominees";
   $sql = "CREATE TABLE $table_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  award_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(50) NOT NULL,
  PRIMARY KEY  (id)
);";
   dbDelta( $sql );

   $table_name = $wpdb->prefix . "tvote_votes";
   $sql = "CREATE TABLE $table_name (
  token_id int(11) NOT NULL,
  award_id int(11) NOT NULL,
  nominee_id int(11) NOT NULL,
  PRIMARY KEY  (token_id, award_id)
);";
   dbDelta( $sql );


}

// TODO Change this to the correct way
register_activation_hook( WP_PLUGIN_DIR . '/token_voter/token_voter.php', 'tvote_install');

add_action('admin_menu', 'tvote_admin_actions');

function tvote_add_token() {
    include('tvote_import_add_token.php');
}

function tvote_admin_actions() {
    add_menu_page("Add Tokens", "Token Vote", "manage_options", "token_voter_settings", "tvote_add_token");
    add_submenu_page("token_voter_settings", "Add Tokens", "Tokens", "manage_options", "token_voter_token_settings", "tvote_add_token");
}

?>
