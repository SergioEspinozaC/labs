<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>
		<?php
		astra_primary_content_top();

		$paged = get_query_var('pg');

		$args = [
			'post_type' => 'post',
			'post_per_page' => 10,
			'paged' => 1
		];

		$query = new WP_Query($args);
		?>
		<div>
			<ul>
				<?php 
					while( $query-> have_posts() ){
						$query->the_post();
						global $post;
						?>
						<li class=card>
							<a href="<?php echo get_the_permalink(); ?>">
								<?php 
									echo get_the_post_thumbnail( $post->ID );
								?>
								<div>
									<h2><?php echo get_the_title() ?></h2>
								</div>
							</a>
						</li>
						<?php
					}
					?>
					<div>
						<ul>
							<?php 
							echo paginate_links(
								array(
								'total' => $query->max_num_pages, 
								'current' => $paged,
								'format' => '?pg=%#%',
								)
							)
								?>
						</ul>
					</div>
					<?php
					wp_reset_postdata()
				?>
			</ul>
			
		</div>
		<?php
		astra_primary_content_bottom();
		?>
	</div><!-- #primary -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :

	get_sidebar();

endif;

get_footer();
