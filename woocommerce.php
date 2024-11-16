<?php

/**
 * Template:			woocommerce.php
 * Description:
 */

get_header();

?>

<main id="site-main" class="main">

    <div class="hero__spacer"></div>

    <section class="section woocommerce section--flex">
        <div class="container">
            <div class="woocommerce__content">
                <div class="grid lg:grid-cols-12">
                    <div class="lg:col-span-8 lg:col-start-3">

                        <?php if (is_shop()) { ?>
                            <div class="flex justify-between w-full items-center">
                                <h1>Shop</h1>

                                <a href="<?php echo wc_get_cart_url(); ?>" class="btn">Cart</a>
                            </div>
                        <?php }; //if
                        ?>
                        <?php woocommerce_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>