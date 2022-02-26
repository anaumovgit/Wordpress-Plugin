<?php declare(strict_types=1);

function censorship_filter($array): array
{
    if (!empty($array)) {
        global $wpdb;
        $query = $wpdb->get_results( "SELECT word FROM {$wpdb->prefix}censorship_blacklisted_words", ARRAY_A);
        $blacklisted_words = get_blacklisted_words($query);


        foreach ($array as $comment) {
            $text = trim($comment->comment_content);
            $words = explode(' ', $text);
            $filtered_words = filter_words($words, $blacklisted_words);
            $filtered_text = implode(' ', $filtered_words);

            $comment->comment_content =$filtered_text;
        }
    }
    return $array;
}

function get_blacklisted_words(array $query): array
{
    $blacklisted_words = array();
    foreach ($query as $word) {
        $blacklisted_words[] = strtolower($word['word']);
    }

    return $blacklisted_words;
}

function filter_words(array $words, array $blacklisted_words): array
{
    $filtered_words = array();
    foreach ($words as $word) {
        $format_word = preg_replace('/[^a-zA-ZА-Яа-я0-9]/', '', strtolower($word));
        if (in_array($format_word, $blacklisted_words)) $word = '***';
        $filtered_words[] = $word;
    }
    return $filtered_words;
}