<?php

namespace Kntnt\GA_Engagement_Metrics;

require_once Plugin::plugin_dir( 'classes/class-abstract-settings.php' );

class Settings extends Abstract_Settings {

	/**
	 * Returns the settings menu title.
	 */
	protected function menu_title() {
		return __( 'Engagement Metrics for Google Analytics', 'kntnt-ga-engagement-metrics' );
	}

	/**
	 * Returns the settings page title.
	 */
	protected function page_title() {
		return __( "Kntnt's Engagement Metrics for Google Analytics", 'kntnt-ga-engagement-metrics' );
	}

	/**
	 * Returns all fields used on the settings page.
	 */
	protected function fields() {

		$disabled = ! Plugin::is_kntnt_engagement_metric_active();

		if ( $disabled ) {
			$fields['message'] = [
				'type' => 'html',
				'html' => '<strong style="color: red">' . sprintf( __( 'This plugin requires %s plugin to be installed and activated.', 'kntnt-ga-engagement-metrics' ), '<a  style="color: red" href="https://github.com/Kntnt/kntnt-engagement-metrics">' . __( "Kntnt's Engagement Metrics", 'kntnt-ga-engagement-metrics' ) . '</a>' ) . '</strong>',
			];
		}

		$fields['reading_time_events'] = [
			'type' => 'text',
			'label' => __( 'Reading Time Events', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "Enter a comma separated list of percentages. When the reading ratio has reached or exceeded a given percentage, a reading time event is sent.", 'kntnt-ga-engagement-metrics' ),
			'default' => [ 10, 20, 30, 40, 50, 60, 70, 80, 90, 100 ],
			'filter-before' => [ $this, 'filter_percentages_before' ],
			'filter-after' => [ $this, 'filter_percentages_after' ],
			'disabled' => $disabled,
		];

		$fields['scanning_depth_events'] = [
			'type' => 'text',
			'label' => __( 'Scanning Depth Events', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "Enter a comma separated list of percentages. When the scanning ratio has reached or exceeded a percentage, a reading time event is sent.", 'kntnt-ga-engagement-metrics' ),
			'default' => [ 25, 50, 75, 100 ],
			'filter-before' => [ $this, 'filter_percentages_before' ],
			'filter-after' => [ $this, 'filter_percentages_after' ],
			'disabled' => $disabled,
		];

		$fields['category'] = [
			'type' => 'text',
			'label' => __( 'Google Analytics Category', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "The Google Analytics category name used by both the reading time events and the scanning depth events.", 'kntnt-ga-engagement-metrics' ),
			'default' => __( 'Articles', 'kntnt-ga-engagement-metrics' ),
			'disabled' => $disabled,
		];

		$fields['reading_time_event_name'] = [
			'type' => 'text',
			'label' => __( 'Reading Time Event Name', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "The  Google Analytics action name used by the reading time event. The placeholder {0} is replaced with the highest percentage in gaReadingTimeEvents less than or equal to the current reading ratio.", 'kntnt-ga-engagement-metrics' ),
			'default' => __( 'Reading {0}%', 'kntnt-ga-engagement-metrics' ),
			'disabled' => $disabled,
		];

		$fields['scanning_depth_event_name'] = [
			'type' => 'text',
			'label' => __( 'Scanning Depth Event Name', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "The  Google Analytics action name used by the scanning depth event. The placeholder {0} is replaced with the highest percentage in gaScanningDepthEvents less than or equal to the current scanning ratio.", 'kntnt-ga-engagement-metrics' ),
			'default' => __( 'Scanning {0}%', 'kntnt-ga-engagement-metrics' ),
			'disabled' => $disabled,
		];

		$fields['reading_time_dimension_slot'] = [
			'type' => 'text',
			'label' => __( 'Reading Time Dimension Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When a reading time event is sent to Google Analytic, the customer dimension with this name (e.g. dimension1) is assigned the event's name (see above). Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['scanning_depth_dimension_slot'] = [
			'type' => 'text',
			'label' => __( 'Scanning Depth Dimension Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When a scrolling depth event is sent to Google Analytic, the customer dimension with this name (e.g. dimension2) is assigned the event's name (see above). Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['reading_time_metric_slot'] = [
			'type' => 'text',
			'label' => __( 'Reading Time Metric Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When an event is sent to Google Analytic, the customer metric with this name (e.g. metric1) is assigned the current reading time in seconds. Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['reading_length_metric_slot'] = [
			'type' => 'text',
			'label' => __( 'Reading Length Metric Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When an event is sent to Google Analytic, the customer metric with this name (e.g. metric2) is assigned the current reading length in characters. Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['scanning_depth_metric_slot'] = [
			'type' => 'text',
			'label' => __( 'Scanning Depth Metric Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When an event is sent to Google Analytic, the customer metric with this name (e.g. metric3) is assigned the current scanning depth in pixels. Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['reading_ratio_metric_slot'] = [
			'type' => 'text',
			'label' => __( 'Reading Ratio Metric Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When an event is sent to Google Analytic, the customer metric with this name (e.g. metric4) is assigned the current reading ratio in percentage. Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['scanning_ratio_metric_slot'] = [
			'type' => 'text',
			'label' => __( 'Scanning Ratio Metric Slot', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "When an event is sent to Google Analytic, the customer metric with this name (e.g. metric5) is assigned the current reading time in percentage. Leave empty to disable.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['bounce_limit'] = [
			'type' => 'integer',
			'label' => __( 'Bounce Limit', 'kntnt-ga-engagement-metrics' ),
			'description' => __( "Minimum percentage read for non-bounce. That is, events sent up til but not including this reading ratio (in percent) are non-interactive, and thereafter interactive.", 'kntnt-ga-engagement-metrics' ),
			'default' => '',
			'disabled' => $disabled,
		];

		$fields['submit'] = [
			'type' => 'submit',
			'disabled' => $disabled,
		];

		return $fields;

	}

	// Converts an array of numbers into a comma separated list of numbers.
	public function filter_percentages_before( $percentages ) {
		return implode( ', ', (array) $percentages );
	}

	// Converts a string of comma separated numbers into an ordered array of
	// unique numbers not less than 0 or greater than 100.
	public function filter_percentages_after( $string ) {

		// Convert the string into an array of integers between 0 and 100.
		$percentages = explode( ',', $string );
		$percentages = array_map( function ( $value ) {
			$value = (int) trim( $value );
			$value = min( max( $value, 0 ), 100 );
			return $value;
		}, $percentages );

		// Make sure we have a sorted array of unique integers.
		$percentages = array_keys( array_flip( $percentages ) );
		sort( $percentages );

		return $percentages;

	}

}
