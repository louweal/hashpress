<?php

/**
 * Template:			social.php
 * Description:			The template for displaying social links
 */


$socials = get_field('socials_repeater', 'options');
?>

<div class="socials">
    <ul>
        <?php foreach ($socials as $social) {
            $icon = $social['icon'];
            $link = $social['link'];
        ?>
            <li>
                <a href="<?php echo $link; ?>" target="_blank">
                    <?php if ($icon) { ?>
                        <img src="<?php echo $icon['sizes']['thumbnail']; ?>" alt="social icon">
                    <?php }; //if
                    ?>
                </a>
            </li>
        <?php }; //foreach
        ?>
    </ul>
</div>