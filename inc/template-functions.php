<?php
/*
 * Functions which enhance the theme by hooking into WordPress
 */

/*
//get title 
function sp_get_title() {
	if(is_home()) echo single_post_title();
	if(is_page() || is_single()) the_title();
	if(is_archive()) the_archive_title();
	if(is_search()) echo '<p class="h2 text-center">'.esc_html_e( 'Search Results for: ', 'sp-theme' ).get_search_query().'</p>';
	if(is_404()) echo '<p class="h2 text-center">'.esc_html_e( 'Page not found ', 'sp-theme' ).'</p>';
}

//getting thumbnail
function sp_get_thumbnail($spID, $size){
	$id_img = get_post_thumbnail_id($spID);
	$image = wp_get_attachment_image_src($id_img, $size);

	if($image[0] == '') $result = get_template_directory_uri().'/imgs/none.png';
	else $result = esc_url($image[0]);
	
	return $result;
}	

//get entry meta
function sp_get_entry_meta() { 
	$blog_tax = get_theme_mod('blog_tax');
	$blog_date = get_theme_mod('blog_date');

	if($blog_date != '1' || $blog_tax != '1') echo '<div class="entry-meta">';

	if($blog_date != '1'){
		$archive_year  = get_the_time('Y');
		$archive_month = get_the_time('m');
		$archive_day   = get_the_time('d');

		echo '<span class="posted-on">';
		echo '<a href="'.esc_url(get_day_link( $archive_year, $archive_month, $archive_day)).'" rel="bookmark"> ';
		the_time(get_option( 'date_format'));
		echo '</a></span>';	
	}

	if($blog_tax != '1'){

		echo '<span class="cat_cloud">';
		the_category(' ');
		echo '</span>';

		if(has_tag()){
			echo '<span class="tags_cloud">';
			the_tags('', ' ','');
			echo '</span>';
		}	
	}

	if($blog_date != '1' || $blog_tax != '1') echo '</div>';
}

*/

//pagination 
function sp_get_the_pagination(){
	echo '<div class="pagination col-md-12 m-3 text-center">';	
		$args = array(
			'show_all'     => false,
			'end_size'     => 1,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text'    => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
			'add_args'     => false,
			'add_fragment' => '',
			'screen_reader_text' => __('Posts navigation','sp-theme'),
		);

		if(function_exists('the_posts_pagination')){
			the_posts_pagination($args);
		} else {
			wp_link_pages($args);
		}

	echo '</div>';	
}

//pagination template
function sp_pagination_template($template, $class){
	return '<div class="pagination">%3$s</div>';
}
add_filter('navigation_markup_template', 'sp_pagination_template', 10, 2);

//register required plugins
function sp_register_required_plugins() {
	
	$plugins = array(
		array(
			'name'     => 'WordPress SEO by Yoast',
			'slug'     => 'wordpress-seo',
			'required' => true,
		),
		array(
			'name'     => 'Pods - Custom Content Types and Fields',
			'slug'     => 'pods',
			'required' => true,
		),
		array(
			'name'     => 'Small WP Security - SP SWS',
			'slug'     => 'small-wp-security',
			'required' => true,
		),
		array(
			'name'     => 'Show Current Template - CTI',
			'slug'     => 'current-template-info',
			'required' => true,
		),
		array(
			'name'     => 'SP RTL (RusToLat)',
			'slug'     => 'sp-rtl-rus-to-lat',
			'required' => true,
		),
		array(
			'name'     => 'Hide Widgets (SP Display Widgets)',
			'slug'     => 'sp-display-widgets',
			'required' => true,
		),
		array(
			'name'     => 'UpdraftPlus WordPress Backup Plugin',
			'slug'     => 'updraftplus',
			'required' => true,
		),
	);

	$config = array(
		'id'           => 'tgmpa',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'themes.php',            
		'capability'   => 'edit_theme_options',    
		'has_notices'  => true,
		'dismissable'  => true,                  
		'dismiss_msg'  => '',                    
		'is_automatic' => false,                  
		'message'      => '',                  
	);

	tgmpa( $plugins, $config );

}
add_action('tgmpa_register', 'sp_register_required_plugins');

//remove prefix category
function sp_remove_prefix_category_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter('get_the_archive_title', 'sp_remove_prefix_category_title');