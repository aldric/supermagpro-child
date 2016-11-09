<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */
global $supermag_customizer_all_values;

get_header();


// echo "<br/>count ::".count($grade_groups) . " ?? ".$grade_groups[0];
// foreach( $grade_groups as $gg) {
//     echo "::" ;
//     printr($gg);
// }
// $grades = array();

//     for($i = 0; $i < count($grade_groups); $i++) {
//         $grade_group = $grade_groups[i];
//         echo ("GG : " .$grade_group->ID);
//         $part = $parts[i];
//         $title = get_the_title($grade_group);
//         $fields = array();
//         foreach($subs as $sub) {
// 		    $key = $part . "-" . $sub;
//             $values = types_render_field( $key );
//             array_push($fields, array($sub => $values)); 
// 	    }
//         array_push($grades, array(
//             'title' => $title,
//             'data' => $fields
//         ));
//     }
// print_r($grades);
// echo("gg<<".count($groups).">>gg");
// $custom_fields = get_post_custom();
//     foreach ( $custom_fields as $key => $value ) {
//     echo $key . " => " . $value . "<br />";
//   }

// echo "plop >> " .count($custom_fields);
//   for($i = 0; $i < count($custom_fields); $i++) {
//       print_r($custom_fields[$i]);
//     $my_custom_field = $custom_fields[$i];
//   foreach ( $my_custom_field as $key => $value ) {
//     echo $key . " => " . $value . "<br />";
//   }
// }
// echo "plop2";
// echo "<hr />";
// foreach($parts as $part) {
// 	//echo $part."<br/>";
// 	foreach($subs as $sub) {
// 		$key = $part . "-" . $sub;
//         $values = types_render_field( $key );
//         print_r($values);
// 	}
// 	echo "<hr />";
// }

// $custom_field_keys = get_post_custom_keys();
// foreach ( $custom_field_keys as $key => $value ) {
//     $valuet = trim($value);
//     if ( '_' == $valuet{0} )
//         continue;
//     echo $key . " => " . $value . "<br />";
// }
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php while ( have_posts() ) :
                  the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'banque' ); ?>
        <?php
                  if ( isset( $supermag_customizer_all_values['supermag-single-navigation-options'] ) && !empty( $supermag_customizer_all_values['supermag-single-navigation-options'] ) ) {
                      if( 'title-image' == $supermag_customizer_all_values['supermag-single-navigation-options'] ){
                          supermag_single_navigation( get_the_ID(), 'title-image');
                      }
                      elseif( 'image-only' == $supermag_customizer_all_values['supermag-single-navigation-options'] ){
                          supermag_single_navigation( get_the_ID(), 'image-only');
                      }
                      else{
                          the_post_navigation();
                      }
                  }
                  else{
                      the_post_navigation();
                  }
                  $supermag_related_posts_data = supermag_related_posts_data( get_the_ID() );
                  $supermag_related_posts_display = $supermag_related_posts_data['supermag-related-posts-display'];
                  if( 'default-related-posts' == $supermag_related_posts_display ){
                      $supermag_related_posts_display = esc_attr( $supermag_customizer_all_values['supermag-related-posts-display'] );
                  }
                  if( !empty( $supermag_related_posts_display ) && 'below-related-posts' == $supermag_related_posts_display ) {
                      supermag_related_posts(get_the_ID());
                  }
        ?>

        <?php
                  // If comments are open or we have at least one comment, load up the comment template.
                  if ( comments_open() || get_comments_number() ) :
                      comments_template();
                  endif;
        ?>

        <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->
<?php
//get_sidebar( 'left' );
?>
<?php
//get_sidebar();
?>

<?php get_footer(); ?>