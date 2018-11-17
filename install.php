<?php

defined( 'WPINC' ) || die;

add_option( 'konzilo-ga-engagement-metrics', [
	'reading_time_events' => [ 10, 20, 30, 40, 50, 60, 70, 80, 90, 100 ],
	'scanning_depth_events' => [ 25, 50, 75, 100 ],
	'category' => _( 'Articles', 'konzilo-ga-engagement-metrics' ),
	'reading_time_event_name' => __( 'Reading {0}%', 'konzilo-ga-engagement-metrics' ),
	'scanning_depth_event_name' => __( 'Scanning {0}%', 'konzilo-ga-engagement-metrics' ),
	'reading_time_dimension_slot' => '',
	'scanning_depth_dimension_slot' => '',
	'reading_time_metric_slot' => '',
	'reading_length_metric_slot' => '',
	'scanning_depth_metric_slot' => '',
	'reading_ratio_metric_slot' => '',
	'scanning_ratio_metric_slot' => '',
	'bounce_limit' => 10,
] );
