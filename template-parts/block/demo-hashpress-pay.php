<?php

/**
 * Template:			demo-hashpress-pay.php
 * Description:			Demo HashPress Pay block
 */

if (isset($block['data']['preview'])) {
    get_preview($block['data']['preview']);
    return;
}

$shortcode = get_field('demo_pay_shortcode');

?>

<div class="demo-hashpress-pay js-pay-demo">
    <textarea name="shortcode" id="shortcode" class="js-pay-demo-input" disabled>&lbrack;<?php echo esc_html($shortcode); ?>&rbrack;</textarea>

    <div>
        <?php echo do_shortcode('[' . $shortcode . ']'); ?>
    </div>
</div>