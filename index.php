<?php
/*
 * Plugin Name: Term CPT
 * Version: 1.0.0
 * Author: Prometheus
 * License: MIT
 * Text Domain: term-cpt
 * Domain Path: /lang
 */

use RusAggression\TermCPT\Plugin;

if ( defined( 'ABSPATH' ) ) {
	$autoload_path = 'vendor/autoload.php';

	if ( file_exists( __DIR__ . '/' . $autoload_path ) ) {
		require_once __DIR__ . '/' . $autoload_path;
	} elseif ( file_exists( ABSPATH . $autoload_path ) ) {
		require_once ABSPATH . $autoload_path;
	}

	Plugin::get_instance();
}
