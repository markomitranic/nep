<?php

/**
 * Just a humble box that appears in top right corner.
 */
function devModePixel() {
	echo '<div id="devModePixel" style="position:fixed;top:0;left:0;z-index:999999999;background:red;">IN_DEV</div>';
}
if (defined('DEV_ENVIRONMENT') && DEV_ENVIRONMENT === true) {
	add_action('wp_footer', 'devModePixel');
	add_action('admin_footer', 'devModePixel');
}

/**
 * @param mixed $data
 * @param bool $varDump
 * @param bool $die
 */
function dump($data, $varDump = false, $die = false) {
	if (defined('DEV_ENVIRONMENT') && DEV_ENVIRONMENT === true) {
		echo '<pre style="display: block; color: greenyellow; background:black; overflow:scroll;">';
		print_r($data);
		echo '</pre>';

		if ($varDump) {
			var_dump($data);
		}

		if ($die) {
			die;
		}
	}
}

/**
 * @param $phpmailer
 */
function mailtrap($phpmailer) {
	$phpmailer->isSMTP();
	$phpmailer->Host = 'smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = 2525;
	$phpmailer->Username = '4d21a3a0333360';
	$phpmailer->Password = '387d0a6349f85c';
}
if (defined('DEV_ENVIRONMENT') && DEV_ENVIRONMENT === true) {
	add_action('phpmailer_init', 'mailtrap');
}
