<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="container">
    <div class="row">

        <?php if (have_posts()) : ?>

            <?php
            $category = get_the_category();
            $category_id = isset($category[0]->term_id) ? $category[0]->term_id : 0;

            if (is_tag()) {
                get_template_part('template-parts/tag');
            } elseif (is_category() && $category_id !== 4) {
                get_template_part('template-parts/category');
            } else {
                get_template_part('template-parts/list_video');
            }

        // If no content, include the "No posts found" template.
        else :
            get_template_part('template-parts/content', 'none');

        endif;
        ?>
        <?php if ($category_id !== 4) get_sidebar(); ?>
    </div><!-- .content-area -->
</div>
<script language="javascript" type="text/javascript"
        src="/wp-content/themes/twentysixteen/tonka/js/mouseWhell.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/jquery.flexslider-min.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/common.js"></script>

<?php get_footer(); ?>
