<?php

add_filter( 'feed_links_show_comments_feed', '__return_false' ); 

if ( !function_exists( 'mypace_remove_single_comments_feed' ) ){
	function mypace_remove_single_comments_feed(){
		return;
	}
	add_filter( 'post_comments_feed_link', 'mypace_remove_single_comments_feed' );
}

if( !function_exists( 'mypace_comments_feed_404' ) ){
	function mypace_comments_feed_404( $object ) {
		if ( $object->is_comment_feed ) {
			wp_die( 'Page not found.', '', array(
				'response'  => 404,
				'back_link' => true,
			));
		}
	}
	add_action( 'parse_query', 'mypace_comments_feed_404' );
}

function mypace_load_textdomain() {
	load_plugin_textdomain( 'mypace-remove-comments-feed-link' ); 
}
add_action( 'plugins_loaded', 'mypace_load_textdomain' );


//Dequeue JavaScripts
function project_dequeue_unnecessary_scripts()
{
    wp_dequeue_script('supermag-custom');
    wp_deregister_script('supermag-custom');

    wp_dequeue_style('fontawesome');
    wp_deregister_style('fontawesome');

    wp_dequeue_style('supermag-style');
    wp_deregister_style('supermag-style');
}

add_action('wp_enqueue_scripts', 'project_dequeue_unnecessary_scripts', 100);

function suprmagpro_child_enqueue_styles()
{
    $template_directory = get_stylesheet_directory_uri();

    wp_register_script('custom-agt-js', $template_directory . '/assets/js/supermag-custom.js', array('jquery'), '4.0', 1);
    wp_register_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);
    wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, null, 'all');
    wp_register_script('fontawesome-async', '//use.fontawesome.com/f93bfa54b2.js', null, '4.7.0');

    wp_register_style( 'supermagpro-parent-style', get_template_directory_uri() . '/style.css', null, '1.0.2');
    wp_register_style( 'supermagpro-child-style',$template_directory. '/style.css',null, "1.1.2");

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
    wp_enqueue_style('supermagpro-parent-style');
    wp_enqueue_style('supermagpro-child-style');
     $supermag_hooks_dynamic_css_file_path = supermag_file_directory('acmethemes/hooks/dynamic-css.php');
     require $supermag_hooks_dynamic_css_file_path;
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
add_filter( 'emoji_svg_url', '__return_false' );

function disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }

function disable_wp_emojicons() {
    
      // all actions related to emojis
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
      remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
      remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    
      // filter to remove TinyMCE emojis
      add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    }
    add_action( 'init', 'disable_wp_emojicons' );
