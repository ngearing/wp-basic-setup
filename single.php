<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'templates/content', get_post_type() );

	the_post_navigation();

endwhile; // End of the loop.
?>

<?php
get_sidebar();
get_footer();
