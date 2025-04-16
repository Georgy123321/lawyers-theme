<?php
/*
Plugin Name: 	lawyers
Text Domain: 	lawyers
Domain Path:	/languages
License: 		GPLv2 or later
License URI:	http://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 5.8
Requires PHP: 	7.4
*/

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Lawyers {

	function __construct() {
		// hook init
		add_action('init', array($this, 'register_post_types'));
		add_action('init', array($this, 'create_taxonomy'));
	}

	function register_post_types() {
		register_post_type('services', [
			'label' => null,
			'labels' => [
				'name' => 'Services',
				'singular_name' => 'Services', 
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Item',
				'edit_item' => 'Edit',
				'new_item' => 'Add New Item',
				'view_item' => 'View Item',
				'search_items' => 'Search Items',
				'not_found' => 'Not Found',
				'not_found_in_trash' => 'Not Found in Trash',
				'parent_item_colon' => '',
				'menu_name' => 'Services',
			],
			'public' => true,
			'show_in_menu' => true,
			'rest_base' => 'services',
			'menu_position' => 6,
			'menu_icon' => 'dashicons-admin-tools',
			'hierarchical' => false,
			'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes', 'revisions'],
			'taxonomies' => ['service_category'],
			'has_archive' => true,
			'rewrite' => true,
			'query_var' => true,
		]);

        register_post_type('news', [
			'label' => null,
			'labels' => [
				'name' => 'News',
				'singular_name' => 'News',
				'add_new' => 'Add New News',
				'add_new_item' => 'Add New Item',
				'edit_item' => 'Edit',
				'new_item' => 'Add New Item',
				'view_item' => 'View Item',
				'search_items' => 'Search Items',
				'not_found' => 'Not Found',
				'not_found_in_trash' => 'Not Found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'News',
			],
			'public' => true,
			'show_in_menu' => true,
			'rest_base' => 'news',
			'menu_position' => 5,
			'menu_icon' => 'dashicons-format-aside',
			'hierarchical' => false,
			'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes', 'revisions'],
			'taxonomies' => ['news_category'],
			'has_archive' => true,
			'rewrite' => true,
			'query_var' => true,
		]);
	}

	function create_taxonomy() {
		register_taxonomy('service_category', ['services'], [
			'labels' => [
				'name' => 'Service Categories',
				'singular_name' => 'Service Category',
				'search_items' => 'Search Categories',
				'all_items' => 'All Categories',
				'view_item' => 'View Category',
				'parent_item' => 'Parent Category',
				'parent_item_colon' => 'Parent Category:',
				'edit_item' => 'Edit Category',
				'update_item' => 'Update Category',
				'add_new_item' => 'Add New Category',
				'new_item_name' => 'New Category Name',
				'menu_name' => 'Service Categories', // Изменено с 'Hidden Block'
				'back_to_items' => '← Back to Categories',
			],
			'public' => true,
			'hierarchical' => true,
			'rewrite' => [
				'slug' => 'service-category',
				'with_front' => true
			],
			'show_admin_column' => true,
			'show_in_rest' => true,
			'show_in_nav_menus' => true,
		]);

        register_taxonomy('news_category', ['news'], [
			'labels' => [
				'name' => 'News Categories',
				'singular_name' => 'News Category',
				'search_items' => 'Search Categories',
				'all_items' => 'All Categories',
				'view_item' => 'View Category',
				'parent_item' => 'Parent Category',
				'parent_item_colon' => 'Parent Category:',
				'edit_item' => 'Edit Category',
				'update_item' => 'Update Category',
				'add_new_item' => 'Add New Category',
				'new_item_name' => 'New Category Name',
				'menu_name' => 'News Categories', // Изменено с 'Hidden Block'
				'back_to_items' => '← Back to Categories',
			],
			'public' => true,
			'hierarchical' => true,
			'rewrite' => [
				'slug' => 'news-category',
				'with_front' => true
			],
			'show_admin_column' => true,
			'show_in_rest' => true,
			'show_in_nav_menus' => true,
		]);
	}
}

if (class_exists('Lawyers')) {
	new Lawyers();
}