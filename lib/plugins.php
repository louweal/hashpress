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
            'name'              => 'hashpress-pay',
            'title'             => __('Shortcode demo', 'hashpress'),
            'render_template'   => 'template-parts/block/shortcode-demo.php',
            'mode'              => 'edit',
            // 'category'          => 'om-brand-portal',
            'icon'              => 'download',
            'keywords'          => array('hashpress', 'shortcode', 'demo'),
            // 'example'           => array(
            //     'attributes' => array(
            //         'mode' => 'preview',
            //         'data' => array(
            //             'preview' => '/wp-content/uploads/2024/10/downloads-preview.png'
            //         ),
            //     ),
            // ),
        ));
        acf_register_block_type(array(
            'name'              => 'products',
            'title'             => __('Products', 'hashpress'),
            'render_template'   => 'template-parts/block/products.php',
            'mode'              => 'edit',
            // 'category'          => 'om-brand-portal',
            'icon'              => 'download',
            'keywords'          => array('hashpress'),
            // 'example'           => array(
            //     'attributes' => array(
            //         'mode' => 'preview',
            //         'data' => array(
            //             'preview' => '/wp-content/uploads/2024/10/downloads-preview.png'
            //         ),
            //     ),
            // ),
        ));
    }
}
