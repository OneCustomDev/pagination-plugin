<?php
/**
 * Plugin Name:       Pagination Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       AJAX pagination custom post types
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            One Custom
 */

if (!function_exists('ic_custom_posts_pagination')) :
    function ic_custom_posts_pagination($the_query=NULL, $paged=1){

        global $wp_query;
        $the_query = !empty($the_query) ? $the_query : $wp_query;

        if ($the_query->max_num_pages > 1) {
            $big = 999999999; // need an unlikely integer
            $items = paginate_links(apply_filters('adimans_posts_pagination_paginate_links', array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 
                'format' => '?paged=%#%',
                'prev_next' => TRUE,
                'current' => max(1, $paged),
                'total' => $the_query->max_num_pages,
                'type' => 'array',
                'prev_text' => ' <i class="fas fa-angle-double-left"></i> ',
                'next_text' => ' <i class="fas fa-angle-double-right"></i> ',
                'end_size' => 1,
                'mid_size' => 1
            )));

            $pagination = "<div class=\"col-sm-12 text-center\"><div class=\"ic-pagination\"><ul><li>";
            $pagination .= join("</li><li>", (array)$items);
            $pagination .= "</li></ul></div></div>";

            echo apply_filters('ic_posts_pagination', $pagination, $items, $the_query);
        }
    }
endif;