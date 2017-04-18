<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */

get_header(); ?>

	<div id="" class="content-area">
		<main id="main" class="site-main">
			<?php
            $banks_query = new WP_Query(array( 'post_type' => 'banque_en_ligne', 'p' => 372 ));
            while ($banks_query->have_posts()) : $banks_query->the_post();
            ?>
				<?php get_template_part('template-parts/content', 'banque_comparatif'); ?>

				<?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                ?>

			<?php endwhile; // End of the loop.
            wp_reset_postdata();
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
