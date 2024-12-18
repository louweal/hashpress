<?php

/**
 * Template:			pagebuilder-accordion.php
 * Description:			Accordion Pagebuilder Layout
 */

$$editor = get_sub_field('accordion_editor');
$items = get_sub_field('accordion_repeater') ?: [];

?>

<section class="section section--flex">
    <div class="container">
        <div class="grid lg:grid-cols-12">
            <div class="lg:col-span-8 lg:col-start-3">

                <div class="flex flex-col gap-8">

                    <?php if ($editor) { ?>
                        <div class="editor lg:w-1/3" data-aos="fade-up-10">
                            <?php echo $editor; ?>
                        </div>
                    <?php }; //if
                    ?>

                    <div class="accordion" data-aos="fade-up-10">

                        <?php $i = 0;
                        foreach ($items as $item) {
                            $question = $item['question'];
                            $answer = $item['answer']; ?>
                            <div class="accordion__item" data-aos="fade-up-10" data-aos-delay="<?php echo $i * 100; ?>">
                                <div class="accordion__title">
                                    <h3><?php echo $question; ?></h3>
                                    <svg width="10" height="7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m1 1.52 4 4 4-4" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="accordion__content">
                                    <?php if ($answer) { ?>
                                        <div class="editor lg:w-3/4">
                                            <?php echo $answer; ?>
                                        </div>
                                    <?php }; //if
                                    ?>
                                </div>
                            </div>
                        <?php $i++;
                        }; //foreach
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>