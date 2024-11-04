<?php

/**
 * Template:			card-article.php
 * Description:			Article card template
 *
 */


?>

<article class="card card--article">
    <a class="card__inner" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="card__body">
            <div class="editor">
                <h3><?php the_title(); ?></h3>

                <p><?php the_excerpt(); ?></p>
            </div>
        </div>
        <div class="card__footer">
            <button>Learn more</button>
        </div>
    </a>
</article>