<?php

/**
 * Template:			filters.php
 * Description:			Filters to modify theme
 */

/**
 * Custom excerpt length.
 *
 * @since	1.0
 * @link	https://developer.wordpress.org/reference/hooks/excerpt_length/
 * @param	integer $length Length of the excerpt
 * @return 	integer
 */
add_filter('excerpt_length', 'custom_excerpt_length', 10, 1);
function custom_excerpt_length($length)
{
    return 18;
}

/**
 * Custom excerpt more string.
 *
 * @since	1.0
 * @link	https://developer.wordpress.org/reference/hooks/excerpt_more/
 * @return 	string
 */
add_filter('excerpt_more', 'custom_excerpt_more', 10, 1);
function custom_excerpt_more($excerpt)
{
    return '...';
}

/**
 * Add svg support
 *
 */

add_filter('upload_mimes', 'add_svg_support_to_uploads', 10, 1);
function add_svg_support_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

// Redirect to checkout after adding to cart
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');

function redirect_to_checkout($url)
{
    // return wc_get_checkout_url(); // Redirect to the checkout page

    return wc_get_cart_url(); // Redirect to the cart page
}


// Remove address fields from WooCommerce checkout page
add_filter('woocommerce_checkout_fields', 'custom_remove_checkout_fields');

function custom_remove_checkout_fields($fields)
{
    // Remove individual billing fields (keep the array structure)
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);

    // Optionally, you may want to remove the billing phone field
    unset($fields['billing']['billing_phone']);

    // If you want to keep the billing email field uncomment the following line
    // unset( $fields['billing']['billing_email'] ); // Uncomment to remove email

    return $fields;
}
