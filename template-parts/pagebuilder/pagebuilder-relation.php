<?php

/**
 * Template:			pagebuilder-relation.php
 * Description:			Relationship Pagebuilder Layout
 */

$anchor = get_sub_field('relation_anchor');
$editor = get_sub_field('relation_editor');
$buttons = get_sub_field('relation_buttons') ?: [];
$items = get_sub_field('relation_relationship') ?: [];
$published_items = array_filter($items, function ($post) {
    return get_post_status($post->ID) === 'publish';
});

?>

<section class="section section--flex" id="<?php echo $anchor; ?>">
    <div class="container">
        <div class="grid lg:grid-cols-12">
            <div class="lg:col-span-8 lg:col-start-3">
                <div class="flex flex-col gap-8 items-start">

                    <?php if ($editor) { ?>
                        <div class="editor lg:w-7/12">
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

                    <div class="grid lg:grid-cols-<?php echo max(2, count($published_items)); ?> gap-5 w-full">
                        <?php foreach ($published_items as $post) {
                            get_template_part('template-parts/card/card');
                        ?>

                        <?php }; //foreach
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>