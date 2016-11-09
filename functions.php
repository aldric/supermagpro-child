<?php

class Ranking_Widget extends WP_Widget
{
	function Ranking_Widget() 
	{
		parent::WP_Widget(false, "AGT : Ranking Widget");
	}
 
	function update($new_instance, $old_instance) 
	{  
		return $new_instance;  
	}  
 
	function form($instance)
	{  
		$title = esc_attr($instance["title"]);  
		echo "<br />";
	}
 
	function widget($args, $instance) 
	{
	  $widget_id = "widget_" . $args["widget_id"];
      $bank_name_label = get_field('bank_name_label');
      if(have_rows('evaluation_criteres')) {
        //  $queried_object = get_queried_object();
        $eval_count = 0;
        $eval_sum = 0;
        $eval_data = array();
            while( have_rows('evaluation_criteres') ) {
                the_row();
                $eval_sum += (int) get_sub_field('valeur_note');
                $eval_count++;
                array_push($eval_data, array(
                    "label" => get_sub_field('label_critere'),
                    "description" => get_sub_field('description_critere'),
                    "note" => get_sub_field('valeur_note')
                ));
            }
        $eval_title = get_field("evaluation_title");
        $eval_mean = round($eval_sum / $eval_count);
        //echo("Moyenne générale >>" .$eval_mean."<br/>");
        // I like to put the HTML output for the actual widget in a seperate file
        include(realpath(dirname(__FILE__)) . "/ranking_widget.php");
      }
	}
}
add_action( 'widgets_init', function(){
	register_widget("Ranking_Widget");
});


function suprmagpro_child_enqueue_styles() {

    $template_directory = get_stylesheet_directory_uri();

    wp_register_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, NULL, 'all' );

    wp_register_script('star-rating-js', $template_directory.'/star-rating/js/star-rating.min.js', array('jquery'), NULL, true );
    wp_register_style('star-rating-css', $template_directory.'/star-rating/css/star-rating.min.css', false, NULL, 'all' );

    wp_register_script('json-ld-js', $template_directory.'/main.js', array('jquery'), NULL, true );

    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_script( 'star-rating-js' );
    wp_enqueue_script( 'json-ld-js' );
    
    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'star-rating-css' );
    $parent_style = 'supermagpro-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'supermagpro-child-style', $template_directory. '/style.css', array( $parent_style ));

}

add_action( 'wp_enqueue_scripts', 'suprmagpro_child_enqueue_styles', 15 );