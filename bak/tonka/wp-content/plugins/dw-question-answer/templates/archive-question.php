<?php
/**
 * The template for displaying question archive pages
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.3
 */
?>
<div class="dwqa-questions-archive">


    <?php do_action('dwqa_before_questions_list') ?>
    <?php if (dwqa_has_question()) : ?>
        <?php while (dwqa_has_question()) : dwqa_the_question(); ?>
            <?php if (get_post_status() == 'publish' || (get_post_status() == 'private' && dwqa_current_user_can('edit_question', get_the_ID()))) : ?>
                <?php dwqa_load_template('content', 'question') ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php dwqa_load_template('content', 'none') ?>
    <?php endif; ?>
    <?php do_action('dwqa_after_questions_list') ?>


    <?php do_action('dwqa_after_questions_archive'); ?>
</div>
