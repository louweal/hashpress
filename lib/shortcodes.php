<?php

add_shortcode('stored_transactions', 'stored_transactions_function');
function stored_transactions_function($atts)
{
    $output = '';

    global $post;
    if ($post) {
        $post_id = $post->ID;

        $transactions = get_post_meta($post_id, 'hashpress_transaction_history', true);
        // $output .= print_r($transactions, true);
        if (!empty($transactions)) {
            // $output .= $post_id;
            $output .= '<ul>';
            foreach ($transactions as $transaction) {
                // todo, right network
                $output .= '<li><a href="https://hashscan.io/testnet/transaction/' . $transaction . '" target="_blank">'  . $transaction . '</a></li>';
            }
            $output .= '</ul>';
        }
    }

    return '<div class="block__code">' . $output . '</div>';
}

function custom_code_after_product_title()
{
    echo "<div class='block'> <h3>Stored transactions</h3>";
    echo do_shortcode('[stored_transactions]');
    echo '</div>';
}
add_action('woocommerce_after_single_product_summary', 'custom_code_after_product_title', 20);
