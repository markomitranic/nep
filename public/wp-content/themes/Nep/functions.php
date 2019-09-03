<?php

if ( defined('DEV_ENVIRONMENT') && DEV_ENVIRONMENT === true) {
	include_once 'functions_dev.php';
}

require_once 'editor-blocks/content-slider-hook.php';

add_action( 'wp_enqueue_scripts', 'custom_styles' );
function custom_styles() {
	// Register the style first so that WP knows what we are working with:
	wp_register_style( 'core-css', get_template_directory_uri() . '/css/style.css', [], getAssetsVersion() );

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

add_action('wp_head', 'addFaviconMetaTags');
function addFaviconMetaTags()
{
	echo '
	<link rel="apple-touch-icon" sizes="57x57" href="' . get_template_directory_uri() . '/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="' . get_template_directory_uri() . '/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="' . get_template_directory_uri() . '/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="' . get_template_directory_uri() . '/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="' . get_template_directory_uri() . '/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="' . get_template_directory_uri() . '/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="' . get_template_directory_uri() . '/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="' . get_template_directory_uri() . '/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="' . get_template_directory_uri() . '/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="' . get_template_directory_uri() . '/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="' . get_template_directory_uri() . '/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="' . get_template_directory_uri() . '/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="' . get_template_directory_uri() . '/favicon/favicon-16x16.png">
	<link rel="manifest" href="' . get_template_directory_uri() . '/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="' . get_template_directory_uri() . '/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	';
}

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

add_action('acf/init', 'googleMapsApiKey');
function googleMapsApiKey() {
	acf_update_setting('google_api_key', GOOGLE_MAPS_API);
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

function isParticipationType(int $participantId, string $typeSlug): bool
{
	/** @var WP_Term[] $categories */
	$participationTypes = get_the_terms( $participantId, 'tip_participacije' );

	if ($participationTypes) {
		foreach ($participationTypes as $participationType) {
			if ($participationType->slug === $typeSlug) {
				return true;
			}
		}
	}

	return false;
}

