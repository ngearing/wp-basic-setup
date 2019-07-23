<?php

namespace Wp;

class Theme {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function after_setup_theme() {

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', '_s' ),
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
			)
		);

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
	}


	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		$assets_folder = 'dist';

		wp_enqueue_style( 'theme-style', get_theme_file_uri( "$assets_folder/styles/main.css" ) );

		wp_enqueue_script( 'theme-script', get_theme_file_uri( "$assets_folder/scripts/main.js" ), [], '', true );
	}
}
