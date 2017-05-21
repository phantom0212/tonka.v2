<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="container">

    <?php
    if (get_post_format() === 'video') {
        get_template_part('template-parts/content_video');
    } else {
        get_template_part('template-parts/content_normal');
    }
    ?>
</div>
<?php get_footer(); ?>
