<?php

/**
 * Template:			pagebuilder-text-slider.php
 * Description:			Text Slider Pagebuilder Layout
 */

$editor = get_sub_field('text-slider_editor');
$buttons = get_sub_field('text-slider_buttons') ?: [];
$slides = get_sub_field('text-slider_slider') ?: [];

// return;
?>

<section class="section section--flex">
    <div class="container h-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 gap-y-8 ">
            <div class="col-span-1 lg:col-span-3 lg:col-start-3 flex flex-col items-start justify-center h-full gap-5 order-2 lg:order-1">
                <?php if ($editor) { ?>
                    <div class="editor">
                        <?php echo $editor; ?>
                    </div>
                <?php }; //if
                ?>

                <?php
                foreach ($buttons as $button) {
                    $link = $button['link'];
                    the_link($link, 'btn');
                }
                ?>
            </div>
            <?php if ($slides) { ?>
                <div class="col-span-1 lg:col-span-8 lg:col-start-6 flex items-center order-1 lg:order-2">
                    <div class="slider slider--portfolio swiper js-slider" data-slider="portfolio">
                        <div class="slider__wrapper swiper-wrapper">
                            <?php
                            $i = 0;
                            foreach ($slides as $slide) {
                                $image = $slide['image'];
                                $link = $slide['link'];
                                if ($link) {
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                }
                                $next_i = ($i + 1) % count($slides);
                                $next_image = $slides[$next_i]['image'];

                                $component = $link ? 'a' : 'div';
                                $href = $link ? 'href="' . $link['url'] . '" target="' . $link_target . '"' : '';
                            ?>
                                <div class="slider__slide swiper-slide">
                                    <<?php echo $component; ?> <?php echo $href; ?> class="slider__slide__inner">
                                        <picture>
                                            <img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>">
                                        </picture>
                                    </<?php echo $component; ?>>
                                </div>
                            <?php
                                $i++;
                            }; //foreach
                            ?>
                        </div>
                    </div>
                </div>
            <?php }; ?>
        </div>
    </div>
</section>