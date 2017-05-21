<?php
/**
 * The template for displaying captcha form
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.3
 */
?>

<?php
$number_1 = mt_rand(0, 20);
$number_2 = mt_rand(0, 20);
?>
<p>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-tn-6" style="font-size: 20px;">
    <span class="dwqa-number-one"><?php echo esc_attr($number_1) ?></span>
    <span class="dwqa-plus">&#43;</span>
    <span class="dwqa-number-one"><?php echo esc_attr($number_2) ?></span>
    <span class="dwqa-plus">&#61;</span>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-tn-6" style="padding-right: 0px;padding-left:0px;margin-bottom: 10px;">
    <input type="text" name="dwqa-captcha-result" class="form-control" id="dwqa-captcha-result" value=""
           placeholder="<?php _e('Enter the result', 'dwqa') ?>">
    <input type="hidden" name="dwqa-captcha-number-1" id="dwqa-captcha-number-1"
           value="<?php echo esc_attr($number_1) ?>">
    <input type="hidden" name="dwqa-captcha-number-2" id="dwqa-captcha-number-2"
           value="<?php echo esc_attr($number_2) ?>">
</div>

</p>