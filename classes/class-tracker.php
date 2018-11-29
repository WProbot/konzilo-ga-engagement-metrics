<?php

namespace Konzilo\GA_Engagement_Metrics;

class Tracker {

	private $ns;

	public function __construct() {
		$this->ns = Plugin::ns();
	}

	public function run() {
		if ( ! Plugin::unsatisfied_dependencies() ) {
			add_filter( 'konzilo-engagement-metrics-settings', [ $this, 'engagement_metrics_settings' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_script' ] );
		}
	}

	public function engagement_metrics_settings( $settings ) {
		return $settings + [

				// An array of percentages. When the reading ratio has reached
				// or exceeded a percentage, a reading time event is sent.
				// An empty array disables scanning depth events.
				'gaReadingTimeEvents' => Plugin::option( 'reading_Time_Events', [ 10, 20, 30, 40, 50, 60, 70, 80, 90, 100 ] ),

				// An array of percentages. When the scanning ratio has reached
				// or exceeded a percentage, a reading time event is sent.
				// An empty array disables scanning depth events.
				'gaScanningDepthEvents' => Plugin::option( 'scanning_depth_events', [ 25, 50, 75, 100 ] ),

				// The Google Analytics category name used by both
				// the reading time events and the scanning depth events.
				'gaCategory' => Plugin::option( 'category', __( 'Articles', 'konzilo-ga-engagement-metrics' ) ),

				// The  Google Analytics action name used by the reading time
				// event. The placeholder {0} is replaced with the highest
				// percentage in gaReadingTimeEvents less than or equal
				// to the current reading ratio.
				// translators: {0} is a placeholder for the percentage number.
				'gaReadingTimeEventName' => Plugin::option( 'reading_time_event_name', __( 'Reading {0}%', 'konzilo-ga-engagement-metrics' ) ),

				// The  Google Analytics action name used by the scanning depth
				// event. The placeholder {0} is replaced with the highest
				// percentage in gaScanningDepthEvents less than or equal
				// to the current scanning ratio.
				// translators: {0} is a placeholder for the percentage number.
				'gaScanningDepthEventName' => Plugin::option( 'scanning_depth_event_name', __( 'Scanning {0}%', 'konzilo-ga-engagement-metrics' ) ),

				// When a reading time event is sent to GA, the customer
				// dimension with this name (e.g. dimension1) is assigned
				// the event's name (see above). Leave empty to disable.
				'gaReadingTimeDimensionSlot' => Plugin::option( 'reading_time_dimension_slot', '' ),

				// When a scrolling depth event is sent to GA, the customer
				// dimension with this name (e.g. dimension2) is assigned
				// the event's name (see above). Leave empty to disable.
				'gaScanningDepthDimensionSlot' => Plugin::option( 'scanning_depth_dimension_slot', '' ),

				// When an event is sent to GA, the customer metric with this
				// name (e.g. metric1) is assigned the current reading time in
				// seconds. Leave empty to disable.
				'gaReadingTimeMetricSlot' => Plugin::option( 'reading_time_metric_slot', '' ),

				// When an event is sent to GA, the customer metric with this
				// name (e.g. metric2) is assigned the current reading length
				// in characters. Leave empty to disable.
				'gaReadingLengthMetricSlot' => Plugin::option( 'reading_length_metric_slot', '' ),

				// When an event is sent to GA, the customer metric with this
				// name (e.g. metric3) is assigned the current scanning depth
				// in pixels. Leave empty to disable.
				'gaScanningDepthMetricSlot' => Plugin::option( 'scanning_depth_metric_slot', '' ),

				// When an event is sent to GA, the customer metric with this
				// name (e.g. metric4) is assigned the current reading ratio in
				// percentage. Leave empty to disable.
				'gaReadingRatioMetricSlot' => Plugin::option( 'reading_ratio_metric_slot', '' ),

				// When an event is sent to GA, the customer metric with this
				// name (e.g. metric5) is assigned the current reading time in
				// percentage. Leave empty to disable.
				'gaScanningRatioMetricSlot' => Plugin::option( 'scanning_ratio_metric_slot', '' ),

				// Minimum percentage read for non-bounce. That is, events
				// sent up til but not including this reading ratio (in
				// percent) are non-interactive, and thereafter interactive.
				'gaBounceLimit' => Plugin::option( 'bounce_limit', 10 ),

			];
	}

	public function enqueue_script() {
		wp_enqueue_script( "$this->ns.js", $this->script_url(), [ 'jquery' ], null );
	}

	private function script_url() {
		$cdn = 'https://d1zfh4ebmuaqr4.cloudfront.net';
		$version = Plugin::version();
		$domain = parse_url( site_url(), PHP_URL_HOST );
		$expires = '2147483647';
		$signature = Plugin::option( 'api_key' );
		$id = Plugin::option( 'api_id' );
		return "$cdn/$this->ns/$version/$this->ns.min.js?domain=$domain&Expires=$expires&Signature=$signature&Key-Pair-Id=$id";
	}

}
