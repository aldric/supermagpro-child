<?php

include(realpath(dirname(__FILE__)) . "/widgets/ranking.widget.php");

function suprmagpro_child_enqueue_styles()
{
    $template_directory = get_stylesheet_directory_uri();

    wp_register_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);
    wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, null, 'all');

    wp_register_script('star-rating-js', $template_directory.'/star-rating/js/star-rating.min.js', array('jquery'), null, true);
    wp_register_style('star-rating-css', $template_directory.'/star-rating/css/star-rating.min.css', false, null, 'all');

    wp_register_script('json-ld-js', $template_directory.'/main.js', array('jquery'), null, true);

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
add_action('widgets_init', function () {
    register_widget("Ranking_Widget");
});

//[comparatif-banques]
function banks_func($atts)
{
    $posts = new WP_Query(array( 'post_type' => 'fiche_banque'));
    $out = '';
    //print_r($posts);
   if ($posts->have_posts()) {
       while ($posts->have_posts()) {
           $posts->the_post();
           $out .= get_field('bank_name_label');
           $out .= '<br/>';
          /*  $out = '<div class="film_box">
               <h4>'. get_field('bank_name_label');.'</h4>';
            $out .='</div>';*/
       }
   } else {
       $out = "nothing to display";
   } // no posts found

    wp_reset_query();
    return $out;
}
add_shortcode('comparatif-banques', 'banks_func');
