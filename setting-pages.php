<?php declare(strict_types=1);

require_once(plugin_dir_path(__FILE__) . 'add_word.php');
require_once(plugin_dir_path(__FILE__) . 'remove_word.php');

function show_all_words_page()
{
    add_menu_page(
        'Blacklisted Words',
        'Censorship Plugin Blacklisted Words',
        'manage_options',
        'censorship_plugin_blacklisted_words',
        'show_all_words'
    );

    add_submenu_page(
        'censorship_plugin_blacklisted_words',
        'All words',
        'All words',
        'manage_options',
        'censorship_plugin_blacklisted_words'
    );

    add_submenu_page(
        'censorship_plugin_blacklisted_words',
        'Add new word',
        'Add new word',
        'manage_options',
        'censorship_plugin_add_new_word',
        'add_new_word'
    );
}

function show_all_words()
{
    global $wpdb;
    $words = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}censorship_blacklisted_words");

    echo '<div class="wrap">';
    echo '<h2>' . get_admin_page_title() . '</h2>';

    echo '<form action="remove_word.php" method="post" id="remove_word_form">';
    foreach ($words as $word) {
        echo '<div>';
        echo sprintf('<input type="checkbox" id="%s" name="ids[%s]" value="%s">', $word->id, $word->id, $word->id);
        echo sprintf('<label for="%s">%s</label>', $word->id, $word->word);
        echo '</div>';
    }
    echo '<input type="hidden" name="option" value="remove_word">';
    submit_button('Remove');
    echo '</form>';


    echo '</div>';
}

function add_new_word()
{
    echo '<div class="wrap">';
    echo '<h2>' . get_admin_page_title() . '</h2>';
    echo '<form method="post" action="add_word.php">';
    echo '<input id="add_word" type="text" name="word" required>';
    echo '<input type="hidden" name="option" value="add_word">';
    submit_button('Add');
    echo '</form>';
    echo '</div>';
}