<?php

/**
 * Template:			pagebuilder-visual-text.php
 * Description:			Visual Text Pagebuilder Layout
 */

$editor = get_sub_field('visual-text_editor');
$buttons = get_sub_field('visual-text_buttons') ?: [];
$visual = get_sub_field('visual-text_visual') ?: [];
?>

<section class="section section--flex">
    <div class="container h-full">
        <div class="grid lg:grid-cols-12 gap-5">
            <div class="lg:col-span-4 lg:col-start-3 flex flex-col items-start justify-center h-full gap-5">
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
            <div class="lg:col-span-5 lg:col-start-8 flex items-center h-full">

                <div class="slider__slide__image">
                    <picture>
                        <img src="<?php echo $visual['sizes']['medium_large']; ?>" alt="<?php echo $visual['alt']; ?>">
                    </picture>
                </div>

            </div>
        </div>
    </div>
</section>