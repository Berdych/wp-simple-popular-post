<?php
/*
Plugin Name: Popular Posts WP
Description: Подсчет и отображение постов по количеству просмотров.
Author: Berdych <webbizdirect@gmail.com>
Author URI: http://bizdirect.pro/
Version: 1.0.1
*/

function getPostViews( $postID ){
    $count = get_post_meta( $postID, 'post_views_count', true );
    if( $count == '' || $count == false ){
        add_post_meta($postID, 'post_views_count', '0');
        return "0";
    }
    return $count;
}

function setPostViews( $postID ) {
    $count = (int) get_post_meta( $postID, 'post_views_count', true );
	$count++;
	update_post_meta( $postID, 'post_views_count', $count );
}

function trackPostViews ( $postId ) {
    if ( !is_single() ) return;
	
    if ( empty ( $postId) ) {
        global $post;
        $postId = $post->ID;    
    }
	
    setPostViews($postId);
}
add_action( 'wp_head', 'trackPostViews');
