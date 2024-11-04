<?php

/**
 * Template:			singular.php
 * Description:			The template for displaying single posts and pages.
 *
 */

get_header();

$col_width = is_cart() || is_checkout() || is_account_page() ? '8' : '6';


?>

<main id="site-main" class="main">

    <?php if (have_posts()) {
        while (have_posts()) {
            the_post();

    ?>
            <?php
            // if (!is_cart() && !is_checkout() && !is_account_page()) {
            get_hero();
            // }
            ?>

            <?php if (!empty(get_the_content())) { ?>
                <section class="section">
                    <div class="container">
                        <div class="grid lg:grid-cols-12">
                            <div class="lg:col-span-<?php echo $col_width; ?> lg:col-start-3" id="content">
                                <div class="editor">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="lg:col-span-2 lg:col-start-10 hidden lg:block">
                                <div class="sticky top-24">
                                    <?php
                                    $content = get_the_content();
                                    get_template_part('./template-parts/index', '', array('content' => $content)); ?>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
            <?php } ?>
            <div id="page"></div>

            <?php get_template_part('/template-parts/pagebuilder/pagebuilder', ''); ?>


    <?php }
    } ?>

</main>

<?php get_footer(); ?>