<?php

/**
 * Template:			shortcode-demo.php
 * Description:			Shortcode Demo block
 */

if (isset($block['data']['preview'])) {
    get_preview($block['data']['preview']);
    return;
}

$shortcode = get_field('demo_pay_shortcode');

?>

<div class="shortcode-demo">
    <div class="shortcode-demo__code">&lbrack;<?php echo esc_html($shortcode); ?>&rbrack;</div>

    <h4>Output:</h4>
    <div><?php echo do_shortcode('[' . $shortcode . ']'); ?></div>
</div>