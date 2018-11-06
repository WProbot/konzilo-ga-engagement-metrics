<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt's Engagement Metrics for Google Analytics
 * Plugin URI:        https://github.com/Kntnt/kntnt-ga-engagement-metrics
 * GitHub Plugin URI: https://github.com/Kntnt/kntnt-ga-engagement-metrics
 * Description:       Provides Google Analytics with engagement metrics.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       kntnt-ga-engagement-metrics
 * Domain Path:       /languages
 */

namespace Kntnt\GA_Engagement_Metrics;

defined( 'WPINC' ) || die;

require_once __DIR__ . '/classes/class-abstract-plugin.php';

class Plugin extends Abstract_Plugin {

	public function classes_to_load() {

		return [
			'public' => [
				'init' => [
					'Tracker',
				],
			],
			'admin' => [
				'init' => [
					'Settings',
				],
			],
		];

	}

}

new Plugin();
