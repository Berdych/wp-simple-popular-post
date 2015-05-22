<?php
/*
Plugin Name: Popular Posts WP
Description: Подсчет и отображение постов по количеству просмотров.
Author: aka Berdych <bizdirect@ya.ru>
Author URI: http://berdov.blogpost.ru/
Version: 1.0
*/

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


function trackPostViews ($postId) {
    if ( !is_single() ) return;
    if ( empty ( $postId) ) {
        global $post;
        $postId = $post->ID;    
    }
    setPostViews($postId);
}
add_action( 'wp_head', 'trackPostViews');
?>
