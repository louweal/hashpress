<?php

/**
 * Template:			pagebuilder-services.php
 * Description:			Services Pagebuilder Layout
 */


$editor = get_sub_field('services_editor');

$args = array(
    'post_type'         => 'service',
    'post_status'       => array('publish'),
    'posts_per_page'    => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
);

$service_query = new WP_Query($args);
?>

<section class="section section--flex" id="services">
    <div class="container">
        <div class="grid lg:grid-cols-12">
            <div class="lg:col-span-8 lg:col-start-3">
                <div class="flex flex-col gap-8">
                    <?php if ($editor) { ?>
                        <div class="editor lg:w-1/2">
                            <?php echo $editor; ?>
                        </div>
                    <?php }; //if
                    ?>

                    <div class="grid lg:grid-cols-3 gap-5">
                        <?php if ($service_query->have_posts()) {
                            while ($service_query->have_posts()) {
                                $service_query->the_post();
                                get_template_part('template-parts/card/card');
                            }
                            wp_reset_postdata();
                        }; //if
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>