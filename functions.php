<?php

include(realpath(dirname(__FILE__)) . "/widgets/ranking.widget.php");
include(realpath(dirname(__FILE__)) . "/widgets/bankbanner.widget.php");
include(realpath(dirname(__FILE__)) . "/widgets/BankHierarchy.widget.php");
include(realpath(dirname(__FILE__)) . "/shortcodes/bankranking.php");
include(realpath(dirname(__FILE__)) ."/class/BankReviewJson.php");

function suprmagpro_child_enqueue_styles()
{
    $template_directory = get_stylesheet_directory_uri();

    wp_register_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);
    wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, null, 'all');

    wp_register_script('star-rating-js', $template_directory.'/star-rating/js/star-rating.min.js', array('jquery'), null, true);
    wp_register_style('star-rating-css', $template_directory.'/star-rating/css/star-rating.min.css', false, null, 'all');

    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('star-rating-js');
    wp_enqueue_script('json-ld-js');

    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('star-rating-css');
    $parent_style = 'supermagpro-parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('supermagpro-child-style', $template_directory. '/style.css', array( $parent_style ));
}

add_action('wp_enqueue_scripts', 'suprmagpro_child_enqueue_styles', 15);

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'AGT : Top banner',
        'id' => 'sidebar-99',
        'description' => 'Display automatic bank banner',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
