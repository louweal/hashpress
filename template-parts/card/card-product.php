<?php

/**
 * Template:			card-product.php
 * Description:			Product card template
 *
 */
$post = $args['product'];
global $post;

$product = wc_get_product($post->ID);
// debug($args['link']);
$has_link = $args['link'] == true;
$href = $has_link ? 'a href="' . the_permalink() . '"' : null;
// $component = $has_link ? 'a' : 'div';
?>

<article class="card">
    <div class="card__inner" <?php echo $href; ?> title="<?php the_title(); ?>">
        <div class="card__header">
            <?php if (has_post_thumbnail()) { ?>
                <picture>
                    <source media="(min-width: 30em)" srcset="<?php the_post_thumbnail_url('medium_large'); ?>">
                    <img loading="lazy" class="card__featured" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
                </picture>
            <?php } ?>
        </div>
        <div class="card__body">
            <div class="editor editor--card">
                <h3><?php the_title(); ?></h3>
                <?php the_excerpt(); ?>

            </div>

            <?php echo $product->get_price_html()
            ?>
            <?php if ($has_link) { ?>
                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="button add_to_cart_button" data-product_id="<?php echo esc_attr($post->ID); ?>">
                    <svg width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3.75C12 2.92031 11.3297 2.25 10.5 2.25C9.67031 2.25 9 2.92031 9 3.75V10.5H2.25C1.42031 10.5 0.75 11.1703 0.75 12C0.75 12.8297 1.42031 13.5 2.25 13.5H9V20.25C9 21.0797 9.67031 21.75 10.5 21.75C11.3297 21.75 12 21.0797 12 20.25V13.5H18.75C19.5797 13.5 20.25 12.8297 20.25 12C20.25 11.1703 19.5797 10.5 18.75 10.5H12V3.75Z" fill="black" />
                    </svg>
                </a>
            <?php } else { ?>
                <a href="<?php the_permalink(); ?>" class="button add_to_cart_button" data-product_id="<?php echo esc_attr($post->ID); ?>">
                    >
                </a>
            <?php } ?>
        </div>
    </div>
</article>