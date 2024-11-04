<?php

/**
 * Template:			hero.php
 * Description:			Hero template
 */

$post_id  = get_the_ID();
$post_type = get_post_type();

$title = get_field('hero_title') ?: "<h1>" . get_the_title() . "</h1>";
$buttons = get_field('hero_repeater') ?: [];
$cards = get_field('hero_relationship') ?: [];
$hide = get_field('hero_hide') ?: false;



$col_1_width = has_post_thumbnail() ? 'lg:col-span-4' : 'lg:col-span-6';

$query = array();
if ($post_type == 'service') {
    $args = array(
        'post_type'         => 'service',
        'post_status'       => array('publish'),
        'posts_per_page'    => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );

    $query = new WP_Query($args);
}

if ($post_type == 'plugin') {
    $args = array(
        'post_type'         => 'plugin',
        'post_status'       => array('publish'),
        'posts_per_page'    => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );

    $query = new WP_Query($args);
}

if (!$hide) {
?>
    <header class="hero">
        <div class="container h-full">
            <div class="hero__inner">
                <div class="grid lg:grid-cols-12 w-full gap-5">
                    <div class="lg:col-start-3 <?php echo $col_1_width; ?> flex flex-col items-start self-center">

                        <?php
                        if ($query && $query->have_posts() && 1 == 2) { ?>
                            <div class="hero__nav">

                                <?php
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    $active_class = get_the_ID() == $post_id ? 'is-active' : '';
                                    echo '<a class="hero__nav__item ' . $active_class . '" href="' . get_permalink() . '">' . get_the_title() . '</a>';
                                }
                                wp_reset_postdata();
                                ?>
                            </div>

                        <?php
                        } ?>

                        <div class="flex gap-8 flex-col">
                            <?php if ($title) { ?>
                                <div class="editor">
                                    <?php echo $title; ?>
                                </div>
                            <?php }; //if
                            ?>



                            <?php
                            $num_buttons = count($buttons);
                            if ($num_buttons > 0) {
                            ?>
                                <div class="hero__buttons" data-aos="fade-up-10" data-aos-delay="1000">

                                    <?php
                                    foreach ($buttons as $button) {
                                        $link = $button['link'];
                                    ?>
                                        <?php
                                        the_link($link, 'btn btn--outline');
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </div>

                            <?php
                            }
                            ?>


                        </div>
                    </div>


                    <div class="lg:col-span-4 lg:col-start-8">
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="hero__featured">
                                <picture>
                                    <source media="(min-width: 30em)" srcset="<?php the_post_thumbnail_url('full'); ?>">
                                    <img fetchpriority="high" class="" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_post_thumbnail_alt(); ?>">
                                </picture>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($cards) { ?>
                    <div class="grid grid-cols-1 lg:grid-cols-12">
                        <div class="col-span-1 lg:col-span-8 lg:col-start-3 flex flex-col md:flex-row gap-5">
                            <?php foreach ($cards as $post) { ?>
                                <div class="flex-1">
                                    <?php
                                    get_template_part('template-parts/card/card');
                                    ?>
                                </div>
                            <?php }; //foreach
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php }; //if
                ?>

            </div>
        </div>
    </header>

<?php
} else {
?>
    <div class="hero__spacer"></div>
<?php
}
?>