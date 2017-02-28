<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */
global $supermag_customizer_all_values;
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
			$supermag_no_image_medium = $supermag_customizer_all_values['supermag-no-image-medium'];
			$supermag_no_image_large = $supermag_customizer_all_values['supermag-no-image-large'];

			$supermag_related_posts_data = supermag_related_posts_data( get_the_ID() );
			$supermag_related_posts_display = $supermag_related_posts_data['supermag-related-posts-display'];
			if( 'default-related-posts' == $supermag_related_posts_display ){
				$supermag_related_posts_display = esc_attr( $supermag_customizer_all_values['supermag-related-posts-display'] );
			}

			if( 'left-related-posts' == $supermag_related_posts_display || 'right-related-posts' == $supermag_related_posts_display ){
				$single_thumb = 'single-thumb';
				if( 'left-related-posts' == $supermag_related_posts_display ){
					$left_related_posts = 'related-post-left';
					$thumbnail = 'medium';
					$video_width = 660;
					$video_height = 365;
					$single_no_image = $supermag_no_image_medium;
				}
				else{
					$left_related_posts = '';
					$thumbnail = 'large';
					$video_width = 840;
					$video_height = 480;
					$single_no_image = $supermag_no_image_large;
				}
				?>
				<div class="related-post <?php echo esc_attr( $left_related_posts ); ?>">
					<h2 class="widget-title">
						<?php echo esc_html($supermag_related_posts_data['supermag-related-title']); ?>
					</h2>
					<?php supermag_related_posts( get_the_ID() ); ?>
				</div>
				<?php
			}
			else{
				$thumbnail = 'large';
				$video_width = 840;
				$video_height = 480;
				$single_thumb = 'single-thumb-full';
				$single_no_image = $supermag_no_image_large;
			}
		/*	?>
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
	<?php */
	}
	?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supermag' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php supermag_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
	/*author bio*/
	$supermag_show_author_info = $supermag_customizer_all_values['supermag-show-author-info'];
	if( 1 == $supermag_show_author_info ){
		get_template_part( 'template-parts/content', 'author' );
	}
	?>
</article><!-- #post-## -->