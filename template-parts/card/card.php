<?php

/**
 * Template:			card-plugin.php
 * Description:			Plugin card template
 *
 */
$terms = get_the_terms(get_the_ID(), 'post-type-tag') ?: [];
?>

<article class="card card--plugin">
    <a class="card__inner" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="card__body">
            <div class="editor">
                <h3><?php the_title(); ?></h3>

                <div class="card__tags">
                    <?php foreach ($terms as $term) { ?>
                        <span><?php echo $term->name; ?></span>
                    <?php }; //foreach
                    ?>
                </div>

                <p><?php the_excerpt(); ?></p>
            </div>
        </div>
        <!-- <div class="card__footer">
            <button>Learn more</button>
        </div> -->
    </a>
</article>