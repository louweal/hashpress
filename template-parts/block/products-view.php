<?php

/**
 * Template:			products-view.php
 * Description:			Products View Gutenberg block
 */

// if (isset($block['data']['preview'])) {
//     get_preview($block['data']['preview']);
//     return;
// }

$items = get_field('products_relationship') ?: [];
?>


<div class="grid grid-cols-2 lg:grid-cols-3 gap-5 w-full">
    <?php foreach ($items as $product) {
        get_template_part('template-parts/card/card', 'product', array('product' => $product, 'link' => true));
    ?>

    <?php }; //foreach
    wp_reset_postdata();

    ?>
</div>