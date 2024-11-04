<?php

/**
 * Template:			footer.php
 * Description:			The template for displaying the footer
 */

?>

<div class="sidebar">
    <div class="sidebar__inner">
        <?php get_template_part('./template-parts/socials'); ?>
    </div>
</div>

<footer id="site-footer" class="footer">
    <div class="container">

        <p>HashPress © <?php echo date("Y"); ?></p>

    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>