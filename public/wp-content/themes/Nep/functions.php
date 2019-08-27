<?php

if ( defined('DEV_ENVIRONMENT') && DEV_ENVIRONMENT === true) {
	include_once 'functions_dev.php';
}

include_once 'queries/queries.php';

add_action( 'wp_enqueue_scripts', 'custom_styles' );
function custom_styles() {
	// Register the style first so that WP knows what we are working with:
	wp_register_style( 'core-css', get_template_directory_uri() . '/css/style.css' );

	// Then we need to enqueue them one by one to the theme:
	wp_enqueue_style( 'core-css' );
}

add_action( 'wp_enqueue_scripts', 'custom_scripts' );
function custom_scripts() {
	wp_register_script( 'nep-theme', get_template_directory_uri() . '/js/app.js', [], getAssetsVersion(), true );
	wp_enqueue_script( 'nep-theme' );
}

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus( array(
		'header-menu' => 'Header Menu',
		'footer-sidebar-menu' => 'Footer Sidebar Menu',
	) );
}

function deregisterJQuery() {
	wp_deregister_script('jquery');
}
if (!is_admin()) {
	add_action('wp_enqueue_scripts', 'deregisterJQuery');
}

remove_action('wp_head', 'rsd_link'); // Weblog client legacy support
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer Manifest
remove_action('wp_head', 'wp_generator'); // Built-in Meta generator

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'  =>  'Sidebar Marketing',
		'menu_title'  =>  'Sidebar Marketing',
		'menu_slug'   =>  'sidebar-marketing',
		'capability'  =>  'edit_posts',
		'parent_slug' =>  'themes.php',
		'position'    =>  false,
		'icon_url'    =>  false
	));
	acf_add_options_page(array(
		'page_title'  =>  'Template Options',
		'menu_title'  =>  'Template Options',
		'menu_slug'   =>  'template-options',
		'capability'  =>  'edit_posts',
		'parent_slug' =>  'themes.php',
		'position'    =>  false,
		'icon_url'    =>  false
	));
}

function attachmentSize(int $id): float {
	$size = filesize(get_attached_file($id));
	$size /= 1024;
	$size = round($size, 2);
	return $size;
}

/**
 * @param string $text
 * @param int $words
 * @param bool $ellipsis
 * @return string
 */
function getExcerpt(
	string $text,
	int $words = 7,
	bool $ellipsis = true
): string {
	$text = wp_strip_all_tags($text);
	$text = trim(preg_replace('/\s+/', ' ', $text)); // Remove new lines
	$textArray = explode(' ', $text);
	$text = array_slice($textArray, 0, $words);
	$text = implode(" ", $text);
	if ($ellipsis) { $text .= "…"; }

	return $text;
}

/**
 * @return int
 */
function getAssetsVersion(): int
{
	if (!defined( 'ASSETS_VERSION' )) {
		return 0;
	} elseif (defined('DEV_ENVIRONMENT') && DEV_ENVIRONMENT === true) {
		return rand(1, 10000);
	}

	return ASSETS_VERSION;
}

function addToQueryString(array $values): string
{
	$currentQueryString = '';

	$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
	if (array_key_exists('query', $parsedUrl)) {
		$currentQueryString = $parsedUrl['query'];
	}

	parse_str($currentQueryString, $output);
	$output = array_merge($output, $values);

	return http_build_query($output);
}

function get_formatted_thumbnail(int $postId): ?array
{
	$attachmentId = get_post_thumbnail_id($postId);

	if (empty($attachmentId)) {
		return null;
	}

	return get_formatted_attachment($attachmentId);
}

function get_formatted_attachment(int $attachmentId): ?array
{
	$attachment = acf_get_attachment($attachmentId);

	if (empty($attachment)) {
		return null;
	}

	return $attachment;
}
