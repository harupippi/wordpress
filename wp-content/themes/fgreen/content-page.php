<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage fGreen
 * @author tishonator
 * @since fGreen 1.0.0
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="entry-title">
		<?php echo get_the_title(); ?>
	</h1><!-- .entry-title -->

	<div class="page-content">
		<?php fgreen_the_content_single(); ?>
	</div><!-- .page-content -->
	
	<div class="page-after-content">
		
		<?php if ( ! post_password_required() ) : ?>

			<?php if ('open' == $post->comment_status) : ?>

					<span class="comments-icon">
						<?php comments_popup_link(__( 'No Comments', 'fgreen' ), __( '1 Comment', 'fgreen' ), __( '% Comments', 'fgreen' ), '', __( 'Comments are closed.', 'fgreen' )); ?>
					</span><!-- .comments-icon -->

			<?php endif; ?>
				
			<?php edit_post_link( __( 'Edit', 'fgreen' ), '<span class="edit-icon">', '</span>' ); ?>

		<?php endif; ?>

	</div><!-- .page-after-content -->
	
</article><!-- #post-## -->
