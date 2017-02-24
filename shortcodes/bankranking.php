<?php
require realpath(dirname(__FILE__)) . "/../widgets/ranking.widget.php";
//[bankranking display="all"]
function bankranking_func($atts)
{
     $a = shortcode_atts( array(
        'display' => 'all',
        'sort' => 'desc'
    ), $atts );

    $posts;
    if($a['display'] == 'all') {
        $posts = new WP_Query(array(
            'post_type' => 'fiche_banque'
         ));
    } else {
        $posts = new WP_Query(array(
            'post_type' => 'fiche_banque',
            'name' => $a['display']
        ));
    }
    $out = "<div class=\"container-fluid\"><div class=\"row\">";

    $widget = new Ranking_Widget();
    $rankings = array();
    global $post;
   if ($posts->have_posts()) {
       while ($posts->have_posts()) {
            $posts->the_post();
            setup_postdata( $post ); 
            $data = $widget->get_ranking_data($post);
            if($data != null) {
                $rankings[$data->mean] = $data; 
            }
            wp_reset_postdata();
       }
   }
    if($a['sort'] == 'desc') {
        krsort($rankings);
    } else {
        ksort($rankings);
    }
    foreach ($rankings as $mean => $data) {
        $out .= "<div class=\"col-md-4\">";
        ob_start();
        include(realpath(dirname(__FILE__)) . "/../widgets/template-1.php");
        $content = ob_get_clean();
        $out .= $content;
        $out .= "</div>";
    }
    $out .= "</div></div>";
    wp_reset_query();
    return $out;
}
add_shortcode('bankranking', 'bankranking_func');

?>