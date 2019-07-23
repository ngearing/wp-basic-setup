<?php
/**
 * WP Cleanup class cleans up code that is not needed.
 *
 * @package twofolds
 */

namespace Wp;

/**
 * WP Cleanup
 */
class Cleanup {

	/**
	 * Construct function, basis setup
	 *
	 * @return void
	 */
	public function __construct() {
		/**
		 * Remove emoji support
		 *
		 * @link https://codex.wordpress.org/Emoji
		 */
		add_action(
			'init',
			function() {
				remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
				remove_action( 'wp_print_styles', 'print_emoji_styles' );
				remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
				remove_action( 'admin_print_styles', 'print_emoji_styles' );
				remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
				remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
				remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
				add_filter( 'emoji_svg_url', '__return_false' );
				// Filter to remove TinyMCE emojis.
				add_filter(
					'tiny_mce_plugins',
					function ( $plugins ) {
						if ( is_array( $plugins ) ) {
							return array_diff( $plugins, array( 'wpemoji' ) );
						}
						return array();
					}
				);
			}
		);

		/**
		 * Remove feeds and wordpress-specific content that is generated on the wp_head hook.
		 *
		 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
		 */
		add_action(
			'init',
			function () {
				// Remove the Really Simple Discovery service link.
				remove_action( 'wp_head', 'rsd_link' );
				// Remove the link to the Windows Live Writer manifest.
				remove_action( 'wp_head', 'wlwmanifest_link' );
				// Remove the general feeds.
				remove_action( 'wp_head', 'feed_links', 2 );
				// Remove the extra feeds, such as category feeds.
				remove_action( 'wp_head', 'feed_links_extra', 3 );
				// Remove the displayed XHTML generator.
				remove_action( 'wp_head', 'wp_generator' );
				// Remove the REST API link tag.
				remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
				// Remove oEmbed discovery links.
				remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
			}
		);

		/**
		 * Hide or create new menus and items in the admin bar.
		 *
		 * @link https://codex.wordpress.org/Class_Reference/WP_Admin_Bar/add_menu
		 *
		 * Indentation shows sub-items.
		 */
		add_action(
			'admin_bar_menu',
			function ( $admin_bar ) {
				$admin_bar->remove_menu( 'wp-logo' );          // Remove the WordPress logo.
				$admin_bar->remove_menu( 'about' );            // Remove the about WordPress link.
				$admin_bar->remove_menu( 'wporg' );            // Remove the about WordPress link.
				$admin_bar->remove_menu( 'documentation' );    // Remove the WordPress documentation link.
				$admin_bar->remove_menu( 'support-forums' );   // Remove the support forums link.
				$admin_bar->remove_menu( 'feedback' );         // Remove the feedback link.
				$admin_bar->remove_menu( 'comments' );         // Remove the comments link.
			},
			999
		); // Needs to have low priority.

		/**
		 * Remove left admin footer text
		 *
		 * @link https://developer.wordpress.org/reference/hooks/admin_footer_text/.
		 */
		add_filter(
			'admin_footer_text',
			function () {
				return '';
			},
			999
		);
		/**
		 * Remove right admin footer text (where the WordPress version nr is)
		 *
		 * @link https://developer.wordpress.org/reference/hooks/update_footer/.
		 */
		add_filter(
			'update_footer',
			function () {
				return '';
			},
			999
		);

		/**
		 * Hide admin menu items. Can be both parents and children in dropdowns.
		 * Specify link to parent and link to child.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/remove_menu_page.
		 */
		add_action(
			'admin_menu',
			function () {
				// Remove Dashboard.
				remove_menu_page( 'index.php' );
				// Remove Comments.
				remove_menu_page( 'edit-comments.php' );
				// Remove Appearance -> Customize.
				remove_submenu_page( 'themes.php', 'customize.php?return=' . rawurlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); // WPCS: sanitization ok.
				// Remove Appearance -> Widgets.
				remove_submenu_page( 'themes.php', 'widgets.php' );
				// Remove Appearance -> Editor.
				// remove_submenu_page( 'themes.php', 'theme-editor.php' );
				// Remove Plugins -> Plugin editor.
				// remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
				// Remove Settings -> Writing.
				remove_submenu_page( 'options-general.php', 'options-writing.php' );
				// Remove Settings -> Discussion.
				// remove_submenu_page( 'options-general.php', 'options-discussion.php' );
				// Remove Settings -> Media.
				remove_submenu_page( 'options-general.php', 'options-media.php' );
			},
			999
		);
	}
}
