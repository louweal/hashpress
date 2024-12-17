<?php

/**
 * Template:			plugins.php
 * Description:			plugins options and settings
 */


add_action('acf/init', 'custom_acf_blocks_init');
function custom_acf_blocks_init()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'shortcode-demo',
            'title'             => __('Shortcode demo', 'hashpress'),
            'render_template'   => 'template-parts/block/shortcode-demo.php',
            'mode'              => 'edit',
            'icon'              => 'shortcode',
            'keywords'          => array('hashpress', 'shortcode', 'demo'),
        ));
        acf_register_block_type(array(
            'name'              => 'products',
            'title'             => __('Products - With add to cart', 'hashpress'),
            'render_template'   => 'template-parts/block/products-add.php',
            'mode'              => 'edit',
            'icon'              => 'store',
            'keywords'          => array('hashpress', 'products', 'woocommerce', 'add to cart'),
        ));
        acf_register_block_type(array(
            'name'              => 'products-view',
            'title'             => __('Products - View', 'hashpress'),
            'render_template'   => 'template-parts/block/products-view.php',
            'mode'              => 'edit',
            'icon'              => 'store',
            'keywords'          => array('hashpress', 'products', 'woocommerce', 'view'),
        ));
    }
}
