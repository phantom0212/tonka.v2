<?php
/**
 * The template for displaying question content
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.3
 */

?>
<?php
global $post;
$user_id = get_post_field('post_author', get_the_ID()) ? get_post_field('post_author', get_the_ID()) : false;

$time = human_time_diff(get_post_time('U', true));
$text = __('asked', 'dwqa');

$latest_answer = get_comments([
    'post_id' => get_the_ID()]);

?>
<div class="item_tuvan width_common">
    <div class="user_tuvan"><i class="fa fa-question-circle-o" aria-hidden="true"></i> <strong
                class="txt_666"><?php the_title(); //echo dwqa_the_author(''); ?></strong> <span
                class="txt_aaa"><?php //the_title(); ?></span></div>
    <div class="block_question" style="position: relative;">
        <div class="more"><?php the_content(); ?></div>
    </div>
    <?php if (!empty($latest_answer)) : ?>
        <?php
        $i = 1;
        foreach ($latest_answer as $item) :?>
            <div class="block_answear" style="position: relative;">
                <i class="fa fa-caret-up"></i>
                <i class="more"> <?php echo($item->comment_content) ?> </i>
                <?php
                $author = get_the_author_meta('nickname' , 1);
                ?>
                <div class="author_answear"><?php //echo($author) ?></div>
            </div>
            <?php
            if ($i == 1) break;
        endforeach; ?>

    <?php endif; ?>
</div>

