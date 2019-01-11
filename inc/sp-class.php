<?php

/**
* 
*/

class SpClass{
	
	public function get_title() {
		if(is_home()) echo single_post_title();
		if(is_page() || is_single()) the_title();
		if(is_archive()) the_archive_title();
		if(is_search()) echo '<p class="h2 text-center">'.esc_html_e( 'Search Results for: ', 'sp-theme' ).get_search_query().'</p>';
		if(is_404()) echo '<p class="h2 text-center">'.esc_html_e( 'Page not found ', 'sp-theme' ).'</p>';
	}

	public function get_thumbnail($spID, $size){
		$id_img = get_post_thumbnail_id($spID);
		$image = wp_get_attachment_image_src($id_img, $size);

		if($image[0] == '') $result = get_template_directory_uri().'/imgs/none.png';
		else $result = esc_url($image[0]);
		
		return $result;
	}

	public function get_entry_meta() { 
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

}