<?php

add_action('acf/init', 'slider_block');
function slider_block() {
	if( function_exists('acf_register_block') ) {
		acf_register_block(array(
			'name' => 'slider',
			'title' => __('Slider'),
			'description' => __('Spawn an interactive slider.'),
			'render_callback' => 'slider_block_render_callback',
			'category' => 'common',
			'icon' => 'admin-page',
			'keywords' => array( 'image', 'slider' ),
			'mode' => 'edit'
		));
	}
}
function slider_block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
	if( file_exists( get_theme_file_path("/editor-blocks/content-{$slug}.php") ) ) {
		include( get_theme_file_path("/editor-blocks/content-{$slug}.php") );
	}
}
