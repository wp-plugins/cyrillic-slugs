<?php
/*
Plugin Name: Cyrillic Slugs Unicode
Plugin URI: http://petko.bossakov.eu/wordpress-cyrillic-slugs-plugin
Description: Transliterates cyrillic letters in post slugs to their phonetic equivalent in the latin alphabet.
Version: 1.1
Author: Petko Bossakov
Author URI: http://petko.bossakov.eu/
*/

/*
Copyright © 2007-2014 Petko Bossakov

Licensed under the terms of the GPL version 2, see:
http://www.gnu.org/licenses/gpl.txt

Provided without warranty, inluding any implied warrant of merchantability or fitness for purpose.
Based on SEO Slugs by Andrei Mikrukov (http://www.vretoolbar.com).
*/

add_filter('name_save_pre', 'cyr_slugs', 0);

function cyr_slugs($slug) {
    $cyrillic = array('а','б','в','г','д','е','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ь','ю','я');
    $translit = array('a','b','v','g','d','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','ts','ch','sh','sht','a','y','yu','ya');


    // We don't want to change an existing slug
	if ($slug) return $slug;

	global $wpdb;
	$cyr_slug = mb_strtolower(stripslashes($_POST['post_title']));
	$cyr_slug = str_replace($cyrillic, $translit, $cyr_slug);
	$cyr_slug = str_replace(" ", "-", $cyr_slug);

	return $cyr_slug;
}
?>