<?php declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['option'] === 'add_word') {
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

