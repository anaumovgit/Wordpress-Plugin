<?php declare(strict_types=1);
/*
Plugin Name: Comments censorship - Plugin
Description: Plugin for comments censorship
Author: Artem Naumov
Version: 1.0.0
*/

register_activation_hook(__FILE__, 'manage_activation');
register_deactivation_hook(__FILE__, 'manage_deactivation');

require_once(plugin_dir_path(__FILE__) . 'setting-pages.php');
require_once(plugin_dir_path(__FILE__) . 'activation.php');
require_once(plugin_dir_path(__FILE__) . 'filter_comments.php');
require_once(plugin_dir_path(__FILE__) . 'manage_words.php');

add_action('admin_menu', 'show_all_words_page');
add_filter('comments_array', 'censorship_filter');

add_action('admin_post_add_word', 'create_word');
add_action('admin_post_remove_word', 'remove_word');