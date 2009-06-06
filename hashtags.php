<?php
/*
Plugin Name: twitt_hash
Version: 0.1
Plugin URI: http://bloggs.be/
Description: Viser lenke til twitter hash (#) tagger søk
Author: Rune Gulbrandsøy
Author URI: http://bloggs.be/rune/

  Copyright 2009 Rune (http://bloggs.be/rune/)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Hvordan bruke dette innstikket

Det er ikke laget en admin meny, da dette egentlig ikke trenger en admin meny...
Som vanlig laster du opp innstikket til /wp-content/plugins og går til admin siden din og
aktiverer innstikket.

Du kan bruke innstikket på to måter;

1) Du kan aktivere filteret nederst ved å fjerne de to // før add_filter kommandoen.

2) Du kan legge til <?php if (function_exists('showhash')) { showhash($data);}?> der du
ønsker at det skal vises.

Lykke til! Bruk http://norsk.bloggs.be til spørsmål
*/

function showhash($data){
global $post;
include_once(ABSPATH . WPINC . '/rss.php');
$post_id = $post->ID;
$twitt_hash = get_post_meta( $post_id, 'twitt_hash' );

if ( ! empty( $twitt_hash ) ){
 echo '<strong>Søk etter Twitter Hash Tags (#)&nbsp;</strong>: ';
    $value_rss ='';
    for (reset($twitt_hash); list($key, $value) = each($twitt_hash);) {
 		$value_rss .= $value;
 		$value_rss .='+OR+';
 		echo  '<a href="http://search.twitter.com/search?q=%23'.$value . '">#'.$value.'</a>&nbsp; - &nbsp; ';
		}
	echo "<br/><br/>Eller sjekk ut hva andre sier om dette...<br/>";
	wp_rss('http://search.twitter.com/search.atom?q=%23'.$value_rss.'', 5);
	}else{
	echo "Denne posten har ingen registrerte Twitter hash tags";
	}
}
    
     
 

//Hvis du ønsker å vise dette over kommentarene dine, tar du vekk de to // under.
//add_filter('comments_template', 'showhash',10,1);//Vises på single.php (enkel post visning)
?>