<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<?php get_template_part('headers'); ?>
</head>
<body <?php body_class(); ?>>

<header id="header">
    <nav id="header-menu">
        <div id="mobile-menu-button">
            <span></span>
            <span></span>
        </div>
	    <?php if (has_nav_menu('header-menu')) : ?>
		    <?php wp_nav_menu(['theme_location' => 'header-menu']); ?>
	    <?php endif; ?>
    </nav>
</header>
