<?php
function sanitize_output($buf) {
    preg_match_all('#<(?:pre|textarea|script)[^>]*>.*?<\/(?:pre|textarea|script)>#is', $buf, $blocks);
    $placeholders = [];
    foreach (array_keys($blocks[0]) as $i) {
        $placeholders[$i] = "@@BLOCK{$i}@@";
    }
    $without = str_replace($blocks[0], $placeholders, $buf);

    $without = preg_replace('/<!--(?!\[if).*?-->/is', '', $without);

    $without = preg_replace(
        ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'],
        ['>', '<', '\\1'],
        $without
    );

    return str_replace($placeholders, $blocks[0], $without);
}
ob_start('sanitize_output');
?>
