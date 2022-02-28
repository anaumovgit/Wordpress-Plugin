<?php declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

function create_word()
{
    if (strlen(trim($_POST['word'])) != 0) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'censorship_blacklisted_words';
        $word = ucfirst(trim(strtolower($_POST['word'])));
        $wpdb->insert($table_name, array('word' => $word));
    }
    $url = admin_url('admin.php?page=censorship_plugin_blacklisted_words');
    header("Location: $url");
    exit;
}

function remove_word()
{
    if (!empty($_POST['ids'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'censorship_blacklisted_words';
        $ids = implode(', ', $_POST['ids']);
        $wpdb->query("DELETE FROM $table_name WHERE ID IN($ids)");
    }
    $url = admin_url('admin.php?page=censorship_plugin_blacklisted_words');
    header("Location: $url");
    exit;
}