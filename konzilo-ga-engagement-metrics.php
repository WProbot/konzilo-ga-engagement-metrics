<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Konzilo Engagement Metrics for Google Analytics
 * Plugin URI:        https://github.com/kntnt/konzilo-ga-engagement-metrics
 * GitHub Plugin URI: https://github.com/kntnt/konzilo-ga-engagement-metrics
 * Description:       Provides Google Analytics with engagement metrics.
 * Version:           1.0.1
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       konzilo-ga-engagement-metrics
 * Domain Path:       /languages
 */

namespace Konzilo\GA_Engagement_Metrics;

defined( 'WPINC' ) || die;
// define( 'KONZILO_GA_ENGAGEMENT_METRICS', true );

spl_autoload_register( function ( $class ) {
	$ns_len = strlen( __NAMESPACE__ );
	if ( 0 == substr_compare( $class, __NAMESPACE__, 0, $ns_len ) ) {
		require_once __DIR__ . '/classes/' . strtr( strtolower( substr( $class, $ns_len + 1 ) ), '_', '-' ) . '.php';
	}
} );

new Plugin();
