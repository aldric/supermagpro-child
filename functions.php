<?php

define('__STYLE__', 'bs3');

//Dequeue JavaScripts
function project_dequeue_unnecessary_scripts()
{
    wp_dequeue_script('supermag-custom');
    wp_dequeue_style('fontawesome');
    wp_deregister_script('supermag-custom');
}

add_action('wp_enqueue_scripts', 'project_dequeue_unnecessary_scripts', 100);

function suprmagpro_child_enqueue_styles()
{
    $template_directory = get_stylesheet_directory_uri();

    wp_register_script('custom-agt-js', $template_directory . '/assets/js/supermag-custom.js', array('jquery'), '4.0', 1);
    wp_register_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);
    wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, null, 'all');
    wp_register_script('fontawesome-async', '//use.fontawesome.com/f93bfa54b2.js', null, '4.7.0');

    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        wp_register_script('vue-js', $template_directory . '/assets/js/vue.js', array(), null, true);
    } else {
        wp_register_script('vue-js', $template_directory . '/assets/js/vue.min.js', array(), null, true);
    }
    wp_register_script('main-js', $template_directory.'/main.js', array('jquery'), null, true);

    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('fontawesome-async');
    wp_enqueue_script('vue-js');
    wp_enqueue_script('main-js');
    wp_enqueue_script('custom-agt-js');
    wp_enqueue_style('bootstrap-css');
    $parent_style = 'supermagpro-parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('supermagpro-child-style', $template_directory. '/style.css', array( $parent_style ));
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
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
