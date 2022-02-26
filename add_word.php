<?php declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['option'] === 'add_word') {
    global $wpdb;
    $table_name = $wpdb->prefix . 'censorship_blacklisted_words';
    $wpdb->insert($table_name, array('word' => $_POST['word']));
    $url = admin_url('admin.php?page=censorship_plugin_blacklisted_words');
    header("Location: $url");
    exit;
}

