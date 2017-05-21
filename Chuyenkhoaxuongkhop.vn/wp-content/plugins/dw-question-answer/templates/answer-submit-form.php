<?php
/**
 * The template for displaying single answers
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.3
 */
?>
<?php if (dwqa_current_user_can('post_question')) : ?>
    <?php do_action('dwqa_before_question_submit_form'); ?>
    <form method="post" class="dwqa-content-edit-form">
        <?php if (dwqa_current_user_can('post_question') && !is_user_logged_in()) : ?>
            <p>
                <?php $email = isset($_POST['_dwqa_anonymous_email']) ? sanitize_email($_POST['_dwqa_anonymous_email']) : ''; ?>
                <input type="email" class="form-control" name="_dwqa_anonymous_email" value="<?php echo $email ?>"
                       placeholder="Email">
            </p>
            <p>
                <?php $name = isset($_POST['_dwqa_anonymous_name']) ? sanitize_text_field($_POST['_dwqa_anonymous_name']) : ''; ?>
                <input type="text" class="form-control" name="_dwqa_anonymous_name" value="<?php echo $name ?>"
                       placeholder="Họ tên *">
            </p>
            <p>
                <?php $phone = isset($_POST['_dwqa_anonymous_phone']) ? sanitize_text_field($_POST['_dwqa_anonymous_phone']) : ''; ?>
                <input type="text" class="form-control" name="_dwqa_anonymous_phone" value="<?php echo $phone ?>"
                       placeholder="Số điện thoại">
            </p>
        <?php endif; ?>
        <p class="">
            <?php $title = isset($_POST['question-title']) ? sanitize_title($_POST['question-title']) : ''; ?>
            <input type="text" class="form-control" data-nonce="<?php echo wp_create_nonce('_dwqa_filter_nonce') ?>"
                   id="question-title" placeholder="Tiêu đề *" name="question-title" value="<?php echo $title ?>"
                   tabindex="1">
        </p>
        <?php $content = isset($_POST['question-content']) ? sanitize_text_field($_POST['question-content']) : ''; ?>
        <p>
            <textarea class="form-control input_noidung" placeholder="Nội dung" id="question-content"
                      name="question-content"><?php echo $content; ?></textarea>
        </p>
        <?php global $dwqa_general_settings; ?>
        <?php wp_nonce_field('_dwqa_submit_question') ?>
        <?php dwqa_load_template('captcha', 'form'); ?>
        <?php do_action('dwqa_before_question_submit_button'); ?>
        <input type="submit" class="btn btn_site" name="dwqa-question-submit" value="<?php _e('Gửi', 'dwqa') ?>">
    </form>
    <?php do_action('dwqa_after_question_submit_form'); ?>
<?php else : ?>
    <div class="alert"><?php _e('You do not have permission to submit a question', 'dwqa') ?></div>
<?php endif; ?>