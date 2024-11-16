<?php

/**
 * Template:			shortcode-demo.php
 * Description:			Shortcode Demo block
 */

// if (isset($block['data']['preview'])) {
//     get_preview($block['data']['preview']);
//     return;
// }

$shortcode = get_field('shortcode');

?>

<div class="block" data-aos="fade-up-10">
    <div class="block__code">&lbrack;<?php echo esc_html($shortcode); ?>&rbrack;</div>

    <h4>Output:</h4>
    <div><?php echo do_shortcode('[' . $shortcode . ']'); ?></div>

    <?php
    if (str_contains($shortcode, 'store')) {
        global $post;
        if ($post) {
            $post_id = $post->ID;
            var_dump(get_post_meta($post_id, '_transaction_ids', true));
        }
    }
    ?>
</div>