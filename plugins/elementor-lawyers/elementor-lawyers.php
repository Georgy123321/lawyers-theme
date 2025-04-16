<?php
/**
 * Plugin Name: Elementor lawyers
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor lawyers
 * Text Domain: elementor-lawyers
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

function register_lawyers_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/main-widget.php' );
	require_once( __DIR__ . '/widgets/services-widget.php' );
	require_once( __DIR__ . '/widgets/about-widget.php' );
	require_once( __DIR__ . '/widgets/lawyers-widget.php' );
	require_once( __DIR__ . '/widgets/reviews-widget.php' );
	require_once( __DIR__ . '/widgets/news-widget.php' );

	$widgets_manager->register( new \Elementor_Main_Widget() );
	$widgets_manager->register( new \Elementor_Services_Widget() );
	$widgets_manager->register( new \Elementor_About_Widget() );
	$widgets_manager->register( new \Elementor_Lawyers_Widget() );
	$widgets_manager->register( new \Elementor_Reviews_Widget() );	
	$widgets_manager->register( new \Elementor_News_Widget() );
}
add_action( 'elementor/widgets/register', 'register_lawyers_widget' );

// new Category
add_action( 'elementor/elements/categories_registered', function($elements_manager) {
	$elements_manager->add_category(
		'lawyers',
		[
			'title' => __('Lawyers', 'elementor-lawyers'),
			'icon' => 'fa fa-legal',
		]
	);
});

