<?php

/**
 * Template:			pagebuilder-contact.php
 * Description:			Contact Pagebuilder Layout
 */

$socials = get_field('socials_repeater', 'options') ?: [];

$editor = get_sub_field('contact_editor') ?: get_field('contact_editor', 'options');
$form_id = get_sub_field('contact_form') ?: get_field('contact_form', 'options');
$field_values = get_sub_field('contact_field-values') ?: get_field('contact_field-values', 'options');

?>

<section class="section section--flex" id="contact">
    <div class="container h-full">
        <div class="grid lg:grid-cols-12 gap-5">
            <div class="lg:col-span-3 lg:col-start-3 flex flex-col justify-center h-full gap-5">
                <?php if ($editor) { ?>
                    <div class="editor" data-aos="fade-up-10">
                        <?php echo $editor; ?>
                    </div>
                <?php }; //if
                ?>

                <ul class="socials-list" data-aos="fade-up-10" data-aos-delay="500">
                    <?php foreach ($socials as $social) {
                        $icon = $social['icon'];
                        $label = $social['label'];
                        $link = $social['link'];
                    ?>
                        <li>
                            <a href="<?php echo $link; ?>" target="_blank">
                                <?php if ($icon) { ?>
                                    <img src="<?php echo $icon['sizes']['thumbnail']; ?>" alt="social icon">
                                <?php }; //if
                                ?>
                                <?php if ($label) { ?>
                                    <span><?php echo $label; ?></span>
                                <?php }; //if
                                ?>
                            </a>
                        </li>
                    <?php }; //foreach
                    ?>
                </ul>
            </div>
            <div class="lg:col-span-4 lg:col-start-7 flex items-center h-full">

                <div class="form" data-aos="fade-up-10" data-aos-delay="300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="ml-1" viewBox="0 0 16 16">
                        <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z" />
                    </svg>
                    <?php echo do_shortcode('[gravityform id="' . $form_id . '" field_values="' . $field_values . '" title="false" description="false" ajax="true"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>