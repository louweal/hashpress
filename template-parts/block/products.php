<?php

/**
 * Template:			demo-hashpress-pay.php
 * Description:			Demo HashPress Pay block
 */

if (isset($block['data']['preview'])) {
    get_preview($block['data']['preview']);
    return;
}

$items = get_field('products_relationship') ?: [];
?>


<div class="grid lg:grid-cols-3 gap-5 w-full">
    <?php foreach ($items as $product) {
        get_template_part('template-parts/card/card', 'product', array('product' => $product));
    ?>

    <?php }; //foreach
    wp_reset_postdata();

    ?>
</div>