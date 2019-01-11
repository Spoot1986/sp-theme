<?php
/*
 * The main template file
 */

get_header(); 
$sp_obj = new SpClass();?>

<h1><?php $sp_obj->get_title();?><h1>

<?php if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post(); ?>

		<div <?php post_class('one-post');?>>
			
			<div class="entry-thumbnail">
				<a href="<?php echo esc_url(get_the_permalink());?>">

					<?php $post_medium_img = $sp_obj->get_thumbnail(get_the_ID(), 'medium'); 
					$post_full_img = $sp_obj->get_thumbnail(get_the_ID(), 'full');?>

					<img src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="sp_lazyload" alt="<?php the_title_attribute();?>">
					
				</a>
			</div>
			
			<div class="entry-title">
				<a href="<?php echo esc_url(get_the_permalink());?>" class="h3"><?php the_title();?></a>
			</div>	
			
			<div class="entry-summary"><?php
			
				if(has_excerpt()){ 
					echo wp_kses_post(get_the_excerpt());
				} else {
					echo wp_kses_post(wp_trim_words(get_the_content(), 30, ' ...' ));
				}	
			
			?></div>
			
			<?php $sp_obj->get_entry_meta();?>

		</div>	

	<?php endwhile;

	sp_get_the_pagination();

endif; 

get_footer();