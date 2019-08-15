<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title('');?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<?php get_template_part('headers'); ?>
</head>
<body>

<header id="header">
    <nav id="header-menu">
        <ul>
            <li><a href="" title="">Početna</a></li>
            <li><a href="">O Nama</a></li>
            <li><a href="">Program</a></li>
            <li><a href="">Vesti</a></li>
            <li><a href="">Predavači i Mentori</a></li>
            <li><a href="">Alumni</a></li>
            <li><a href="">Biblioteka</a></li>
            <li><a href="">Galerija</a></li>
        </ul>
    </nav>
</header>
