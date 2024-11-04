<?php

/**
 * Template:			woocommerce.php
 * Description:
 */

get_header();

?>

<main id="site-main" class="main">

    <?php if (is_singular('product')) { ?>

        <section class="section woocommerce woocommerce--product">
            <div class="container">
                <div class="woocommerce__content">
                    <div class="grid lg:grid-cols-12">
                        <div class="lg:col-span-8 lg:col-start-3">
                            <?php woocommerce_content(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php } else { ?>
        <section class="section section--woocommerce woocommerce">
            <div class="container">
                <div class="woocommerce__content">
                    <div class="grid lg:grid-cols-12">
                        <div class="lg:col-span-8 lg:col-start-3">
                            <?php woocommerce_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

</main>

<?php get_footer(); ?>