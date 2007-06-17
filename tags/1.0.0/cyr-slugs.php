<?php
/*
Plugin Name: Cyrillic Slugs
Plugin URI: http://petko.bossakov.eu/wordpress-cyrillic-slugs-plugin
Description: Converts Cyrillic letters in post slugs to their Latin phonetic equivalent.
Version: 1.0
Author: Petko Bossakov
Author URI: http://petko.bossakov.eu/
*/

/*
Copyright 2007 Petko Bossakov

Licensed under the terms of the GPL version 2, see:
http://www.gnu.org/licenses/gpl.txt

Provided without warranty, inluding any implied warrant of merchantability or fitness for purpose.
Based on SEO Slugs by Andrei Mikrukov (http://www.vretoolbar.com).
*/

add_filter('name_save_pre', 'cyr_slugs', 0);

function cyr_slugs($slug) {
    $cyrillic = array('à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','÷','ø','ù','ú','ü','û','ý','þ','ÿ');
    $translit = array('a','b','v','g','d','e','zh','z','i','i','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sht','u','y','y','e','yu','ya');


    // We don't want to change an existing slug
	if ($slug) return $slug;

	global $wpdb;
	$cyr_slug = cyr_strtolower(strtolower(stripslashes($_POST['post_title'])));
	$cyr_slug = str_replace($cyrillic, $translit, $cyr_slug);
	$cyr_slug = str_replace(" ", "-", $cyr_slug);

	return $cyr_slug;
}

function cyr_strtolower($a) {
	// Just in case standard strtolower doesn't work
        $offset=32;
        $m=array();
        for($i=192;$i<224;$i++)$m[chr($i)]=chr($i+$offset);
        return strtr($a,$m);
}
?>