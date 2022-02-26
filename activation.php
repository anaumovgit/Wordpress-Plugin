<?php declare(strict_types=1);

function manage_activation()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'censorship_blacklisted_words';

    $sql = "CREATE TABLE $table_name (
		id INT AUTO_INCREMENT NOT NULL,
		word VARCHAR(255) NOT NULL,
		PRIMARY KEY(id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function manage_deactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'censorship_blacklisted_words';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}