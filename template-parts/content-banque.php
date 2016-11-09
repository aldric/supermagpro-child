<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */
global $supermag_customizer_all_values;
$avis_resume = get_field('avis_resume');
$avis_title = get_field('avis_title');
$point_forts = array();
$point_faibles = array();
//point_faibles
while( have_rows('points_forts') ) {
	the_row();
	array_push($point_forts, get_sub_field('point_fort'));
}
while( have_rows('points_faibles') ) {
	the_row();
	array_push($point_faibles, get_sub_field('point_faible'));
}

$services_title = get_field('services_bancaires_title');
$services_content = get_field('services_bancaires_content');
$available_services = array();

while(have_rows('services_bancaires_proposes')) {
    the_row();
    $service = get_sub_field('available_service');
    array_push($available_services, array(
        "label" => get_sub_field('service_description'),
        "link_label" => get_sub_field('service_link_label'),
        "link"  => get_permalink($service),
        "image_tag" => get_the_post_thumbnail( $service, 'thumbnail' )
    ));
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->
    <?php
	$supermag_hide_single_featured_image = supermag_featured_image_display( get_the_ID() );
	if( 1 != $supermag_hide_single_featured_image ){
    ?>
    <div class="single-feat clearfix">
        <?php
        $supermag_no_image_large = $supermag_customizer_all_values['supermag-no-image-large'];
        $thumbnail = 'large';
        $video_width = 840;
        $video_height = 480;
        $single_thumb = 'single-thumb-full';
        $single_no_image = $supermag_no_image_large;
        ?>
        <figure class="single-thumb <?php echo esc_attr( $single_thumb )?>">
            <?php
        $supermag_video_url = get_post_meta( get_the_ID(), 'supermag_video_url', true );
        $supermag_replace_featured_image = get_post_meta( get_the_ID(), 'supermag_replace_featured_image', true );
        $supermag_video_autoplay = get_post_meta( get_the_ID(), 'supermag_video_autoplay', true );
        if( !empty( $supermag_video_url ) && 1 == $supermag_replace_featured_image ){
            $supermag_video_final_url = $supermag_video_url."?autoplay=".$supermag_video_autoplay;
            ?>
            <iframe src="<?php echo esc_url( $supermag_video_final_url ); ?>" style="overflow:hidden;max-height:100%;max-width:100%" width="<?php echo esc_attr( $video_width );?>" height="<?php echo esc_attr( $video_height );?>" frameborder="0" allowfullscreen></iframe>
            <?php
        }
        else{
            if( has_post_thumbnail() ):
                $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbnail );
            else:
                $img_url[0] = $single_no_image;
            endif;
            ?>
            <img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
            <?php
        }
            ?>
        </figure>
    </div>
    <?php
	}
    ?>
    <div class="entry-content">
        <?php the_content(); ?>

        <div>
            <?php echo $avis_title; ?>
            <div>
                <ul>
                    <?php
                    foreach($point_faibles as $pf) {
                        echo "<li>".$pf."</li>";
                    }
                    ?>
                </ul>
                <ul>
                    <?php
                    foreach($point_forts as $pf) {
                        echo "<li>".$pf."</li>";
                    }
                    ?>
                </ul>
            </div>
            <div>
                <div>
                    <?php echo $services_title; ?>
                    <?php echo $services_content; ?>
                </div>
				<?php foreach($available_services as $service) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="hovereffect">
                        <?php echo $service['image_tag']; ?>
                        <div class="overlay">
                            <h2>
                                <?php echo $service['label']; ?>
                            </h2>
                            <a class="info" href="<?php echo $service['link']; ?>">
                                <?php echo $service['link_label']; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supermag' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php edit_post_link( esc_html__( 'Edit', 'supermag' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

