<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Konzilo Engagement Metrics for Google Analytics
 * Plugin URI:        https://github.com/kntnt/konzilo-ga-engagement-metrics
 * GitHub Plugin URI: https://github.com/kntnt/konzilo-ga-engagement-metrics
 * Description:       Provides Google Analytics with engagement metrics.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       konzilo-ga-engagement-metrics
 * Domain Path:       /languages
 */

namespace Konzilo\GA_Engagement_Metrics;

class Plugin extends Abstract_Plugin {

    static protected function dependencies() {
        return [
            'konzilo-engagement-metrics/konzilo-engagement-metrics.php' => __( 'Konzilo Engagement Metrics', 'konzilo-ga-engagement-metrics' ),
        ];
    }

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
