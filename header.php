<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<!--begin header-->
<header class="header">
	
	<!--begin site branding-->
	<div class="site-branding">
		<?php if(has_custom_logo()):

			$custom_logo_id = get_theme_mod('custom_logo');
			$logo_img_array = wp_get_attachment_image_src($custom_logo_id, 'full');
			$logo_img_src = esc_url($logo_img_array[0]);?>
			
			<a href="<?php echo esc_url(get_home_url());?>" rel="home" title="<?php echo esc_attr(get_bloginfo('title'));?>"><img class="site-logo" src="<?php echo esc_url($logo_img_src); ?>" alt="<?php echo esc_attr(get_bloginfo('title'));?>"></a>
		<?php else: ?>	
			
			<a href="<?php echo esc_url(get_home_url()); ?>" class="h4 site-title"><?php echo esc_html(get_bloginfo('name'));?></a>
			<p class="site-description"><?php echo esc_html(get_bloginfo('description'));?></p>

		<?php endif;?>
	</div>	
	<!--end site branding-->

	<!--begin navigation-->
	<div class="top-navigation-wrapper">
		<nav id="top-navigation" class="top-navigation" role="navigation">
			
			<?php
				wp_nav_menu( array(
					'container'       => 'ul',
					'theme_location'  => 'menu-1',
					'menu_id'         => '',
					'menu_class'	  => 'nav',	
					'depth'           => 1,
				) );
			?>
			
		</nav>
	</div>
	<!--end navigation-->

</header>
<!--end header-->