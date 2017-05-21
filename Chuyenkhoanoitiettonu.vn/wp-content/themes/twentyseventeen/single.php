<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<?php
/* Start the Loop */
while ( have_posts() ) : the_post();
//var_dump(get_post_format());
    get_template_part( 'template-parts/post/content', get_post_format() );

endwhile; // End of the loop.
?>

<?php get_footer();
