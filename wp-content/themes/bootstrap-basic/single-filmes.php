<?php
/**
 * Template for displaying single post (read full post page).
 * 
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<?php get_sidebar('left'); ?> 
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="main" class="site-main" role="main">
						<?php 
						while (have_posts()) {
							the_post();

							get_template_part('content', get_post_format());
							echo "\n\n";
							the_post_thumbnail('medium');
							
							echo "\n\n";
							
							bootstrapBasicPagination();

							echo "\n\n";

						} //endwhile;
						?> 
					</main>
				</div>

<?php get_footer(); ?> 
