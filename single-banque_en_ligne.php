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

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('template-parts/content', 'bel'); ?>
				<?php
                if (isset($supermag_customizer_all_values['supermag-single-navigation-options']) && !empty($supermag_customizer_all_values['supermag-single-navigation-options'])) {
                    if ('title-image' == $supermag_customizer_all_values['supermag-single-navigation-options']) {
                        supermag_single_navigation(get_the_ID(), 'title-image');
                    } elseif ('image-only' == $supermag_customizer_all_values['supermag-single-navigation-options']) {
                        supermag_single_navigation(get_the_ID(), 'image-only');
                    } else {
                        the_post_navigation();
                    }
                } else {
                    the_post_navigation();
                }
                $supermag_related_posts_data = supermag_related_posts_data(get_the_ID());
                $supermag_related_posts_display = $supermag_related_posts_data['supermag-related-posts-display'];
                if ('default-related-posts' == $supermag_related_posts_display) {
                    $supermag_related_posts_display = esc_attr($supermag_customizer_all_values['supermag-related-posts-display']);
                }
                if (!empty($supermag_related_posts_display) && 'below-related-posts' == $supermag_related_posts_display) {
                    supermag_related_posts(get_the_ID());
                }
                ?>

				<?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

			<?php endwhile; // End of the loop.?>

		</main><!-- #main -->
	</div><!-- #primary -->
		<?php get_sidebar('left'); ?>
		<?php get_sidebar(); ?>
    <?php get_footer(); ?>
