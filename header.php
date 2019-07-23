<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>
	<div id="page" class="site">

		<header id="masthead" class="site-header">

			<nav class="top-navigation">
				<ul>
					<li>
						<a href="phone:+61 999 999" class="site-phone">
							<span class="sr-only">+61 999 999</span>
							<i class="fas fa-phone"></i>
						</a>
					</li>
					<li><a href=""><span class="sr-only">facebook</span><i class="fab fa-facebook"></i></a></li>
					<li><a href=""><span class="sr-only">twitter</span><i class="fab fa-twitter"></i></a></li>
				</ul>
			</nav><!-- #top-navigation -->

			<div class="site-branding">
				<?php
				$logo = get_custom_logo();
				if ( ! $logo && file_exists( get_theme_file_path( 'dist/images/logo.png' ) ) ) {
					$logo = '<img alt="' . get_bloginfo() . '" src="' . get_theme_file_uri( 'dist/images/logo.png' ) . '"/>';
				} else {
					$logo = get_bloginfo();
				}

				printf(
					'<%s class="site-title">
						<a href="%s" rel="home">%s</a>
					</%1$s>',
					is_front_page() || is_home() ? 'h1' : 'p',
					esc_url( home_url( '/' ) ),
					$logo
				);
				?>
			</div>

			<nav id="site-navigation" class="primary-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => 'none',
					)
				);
				?>
			</nav><!-- #site-navigation -->

	</header>

	<main id="content" class="site-content">
