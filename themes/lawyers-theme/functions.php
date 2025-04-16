<?php

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
function lawyers_setup()
{
	load_theme_textdomain('lawyers', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-header-pc' => esc_html__('Menu Header PC', 'lawyers'),
			'menu-header-mobile' => esc_html__('Menu Header Mobile', 'lawyers'),
			'menu-footer' => esc_html__('Menu Footer', 'lawyers'),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lawyers_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'lawyers_setup');
function lawyers_content_width()
{
	$GLOBALS['content_width'] = apply_filters('lawyers_content_width', 640);
}
add_action('after_setup_theme', 'lawyers_content_width', 0);
function lawyers_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'lawyers'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'lawyers'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'lawyers_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function lawyers_scripts()
{
	wp_enqueue_style('lawyers-style', get_template_directory_uri(), array(), _S_VERSION);
	wp_enqueue_style('lawyers-swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '1.0');
	wp_enqueue_style('lawyers-reset', get_template_directory_uri() . '/assets/css/reset.css', array(), '1.0');
	wp_enqueue_style('lawyers-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');
	wp_enqueue_style('lawyers-addon', get_template_directory_uri() . '/assets/css/addon-style.css', array(), '1.0');

	wp_enqueue_script('lawyers-swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '11.2.6', true);
	wp_enqueue_script('lawyers-script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'lawyers_scripts');

/**
 * Implement the Global Options
 */
require get_template_directory() . '/inc/Global-Options.php';

// walker Header Menu PC
require get_template_directory() . '/inc/class-lawyers-menu-walker.php';
