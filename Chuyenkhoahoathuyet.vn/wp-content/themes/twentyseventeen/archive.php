<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<?php
if (get_the_archive_title() == null) {
    if (have_posts()) : ?>
        <?php
        /* Start the Loop */
        while (have_posts()) : the_post();

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('template-parts/post/content', get_post_format());

        endwhile;

        the_posts_pagination(array(
            'prev_text' => twentyseventeen_get_svg(array('icon' => 'arrow-left')) . '<span class="screen-reader-text">' . __('Previous page', 'twentyseventeen') . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __('Next page', 'twentyseventeen') . '</span>' . twentyseventeen_get_svg(array('icon' => 'arrow-right')),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyseventeen') . ' </span>',
        ));

    else :
        get_template_part('template-parts/post/content', 'none');
    endif;
} else {
    get_template_part('template-parts/post/category', 'none');
} ?>
<?php get_footer();
