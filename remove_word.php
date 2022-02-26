<?php declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['option'] === 'remove_word') {
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