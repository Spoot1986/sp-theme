<?php
/*
 * The template for displaying all single posts
 */

get_header();

while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post');?>>
		
		<div class="entry-header">
			<h1><?php sp_get_title();?></h1>
		</div>

		<div class="entry-content">
			<?php the_content();?>
		</div>

	</article>

	<?php 
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; 

get_sidebar(); 
get_footer();