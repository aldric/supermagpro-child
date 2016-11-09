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
$general_note = (get_post_custom_values("wpcf-note-generale")[0]);
$general_information = get_post_custom_values("wpcf-informations-generales")[0];
$parts = array("ouverture-de-compte", "securite", "service-client","offre-bienvenue" ,"tarifs", "application-mobile", "website");
$subs = array("note", "explications", "informations");

$args = new WP_Query(array(
	'post_type'        => 'wp-types-group',
    'post_name__in'        => array('service-client', 'offre-bienvenue', 'tarifs', 'application-mobile', 'sites-web', 'ouverture-de-compte', 'securite')
));

$grades = array();
while($args->have_posts()) {
    $args->the_post();
    $title = get_the_title();
    $grades = array_merge($grades, array(get_post_field( 'post_name', get_post()) => $title));
}
wp_reset_query();
$data = array();
foreach($grades as $grade => $val ) {
    $fields = array();
    foreach($subs as $sub) {
        $key = $grade . "-" . $sub;
        $values = types_render_field( $key );
        $fields = array_merge($fields, array($sub => $values ));
        array_push($fields, array($grade => $values));
    }
    array_push($data, array(
        "title" => $val,
        "fields" => $fields
    ));
}

$supermag_hide_single_featured_image = supermag_featured_image_display( get_the_ID() );
if( 1 != $supermag_hide_single_featured_image ){
    $supermag_no_image_large = $supermag_customizer_all_values['supermag-no-image-large'];
    $thumbnail = 'large';
    $video_width = 840;
    $video_height = 480;
    $single_thumb = 'single-thumb-full';
    $single_no_image = $supermag_no_image_large;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="row">
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header><!-- .entry-header -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <?php
    if( has_post_thumbnail() ):
        $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbnail );
    else:
        $img_url[0] = $single_no_image;
    endif;
                        ?>
                        <img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-8">
                        <?php echo  $general_information ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php foreach($data as $row) : ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h2>
                                <?php echo $row['title']; ?>
                            </h2>
                            <p>
                                <?php echo $row['fields']['informations']; ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="row">
                    <div id="secondary-right" role="complementary">
                        <div class="widget-area">
                            <aside class="widget">
                                <h3 class="widget-title">
                                    <span>Notre avis</span>
                                </h3>

                                <div class="pricing animated swing">
                                    <div>
                                        <div class="c100 p<?php echo $general_note; ?> center green">
                                            <span>
                                                <?php echo $general_note."%"; ?>
                                            </span>
                                            <div class="slice">
                                                <div class="bar"></div>
                                                <div class="fill"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='title'>
                                        <?php echo get_the_title(); ?>
                                    </div>
                                    <div class='content'>
                                        <div class='sub-title'>
                                            $69
                                            <i>per year</i>
                                        </div>
                                        <ul>
                                            <?php foreach($data as $row) : ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-8">
                                                        <div>
                                                            <strong>
                                                                <?php echo $row['title']; ?>
                                                            </strong>
                                                        </div>
                                                        <div>
                                                            <small>
                                                                <?php echo $row['fields']['explications']; ?>
                                                            </small>
                                                        </div>

                                                    </div>
                                                    <div class="col-xs-6 col-md-4">
                                                        <input value="<?php echo $row['fields']['note']; ?>" class="rating-loading" data-rating />
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <a href='https://www.elegantthemes.com/cgi-bin/members/register.cgi?sub=16'>
                                            Visiter le site
                                        </a>
                                    </div>
                                </div>
                            </aside>
                            <aside class="widget">
                                <h3 class="widget-title">
                                    <span>Services propos&eacute;s</span>
                                </h3>
                                <?php
                                    $child_posts = types_child_posts("service");
                                    foreach ($child_posts as $child_post) {
                                        echo $child_post->post_title;
                                        echo $child_post->fields['description'];
                                    }
                                ?>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $child_posts = types_child_posts("service");
            foreach($child_posts as $child_post) :
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="hovereffect">
                    <?php
                        if(has_post_thumbnail($child_post)) {
                            echo get_the_post_thumbnail($child_post, 'full', array('class' => 'img-responsive'));
                        }
                    ?>
                    <div class="overlay">
                        <h2>
                            <?php echo $child_post->post_title; ?>
                        </h2>
                        <a class="info" href="<?php echo get_permalink($child_post) ?>">Visiter</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="entry-footer">
        <?php edit_post_link( esc_html__( 'Edit', 'supermag' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
<script>
    jQuery(document).on('ready', function () {
        jQuery('#input-note-general').rating({ displayOnly: true, step: 1, min: 0, max: 100 });
    });
    jQuery(document).on('ready', function () {
        jQuery('input[data-rating]').rating({ displayOnly: true, step: 1, min: 0, max: 100, size: 'xxs' });
    });
</script>
