<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


<?php
// Start the loop.
while (have_posts()) : the_post();

    // Include the page content template.
    if (get_the_ID() === 49) {
        get_template_part('template-parts/lien-he');
    }elseif(get_the_ID() === 54){
        get_template_part('template-parts/question');
    } else {
        get_template_part('template-parts/content', 'page');
        get_sidebar();
    }
endwhile;
?>


<?php get_footer(); ?>
