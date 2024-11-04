<?php

/**
 * Template:			demo-hashpress-pay.php
 * Description:			Demo HashPress Pay block
 */

if (isset($block['data']['preview'])) {
    get_preview($block['data']['preview']);
    return;
}

if (!function_exists('parse_shortcode')) {

    function parse_shortcode($shortcode)
    {
        // Extract the shortcode's attributes
        $pattern = '/\[hederapay_transaction_button(.*?)\]/';

        preg_match($pattern, '[' . $shortcode . ']', $matches);

        if (isset($matches[1])) {
            // Use shortcode_parse_atts to get an associative array of attributes
            $attributes = shortcode_parse_atts($matches[1]);

            // Extract each attribute into a variable
            $amount = isset($attributes['amount']) ? $attributes['amount'] : '';
            $currency = isset($attributes['currency']) ? $attributes['currency'] : '';
            $title = isset($attributes['title']) ? $attributes['title'] : '';
            $testnet_account = isset($attributes['testnet_account']) ? $attributes['testnet_account'] : '';
            $previewnet_account = isset($attributes['previewnet_account']) ? $attributes['previewnet_account'] : '';
            $mainnet_account = isset($attributes['mainnet_account']) ? $attributes['mainnet_account'] : '';
            $memo = isset($attributes['memo']) ? $attributes['memo'] : '';

            // Output for debugging (optional)
            // echo "Amount: " . $amount . "<br>";
            // echo "Currency: " . $currency . "<br>";
            // echo "Title: " . $title . "<br>";
            // echo "Testnet Account: " . $testnet_account . "<br>";
            // echo "Memo: " . $memo . "<br>";
        }
        return array(
            $amount,
            $currency,
            $title,
            $testnet_account,
            $previewnet_account,
            $mainnet_account,
            $memo,
        );
    }
}

$shortcode = get_field('demo_pay_shortcode');



?>

<div class="demo-hashpress-pay js-pay-demo">
    <textarea name="shortcode" id="shortcode" class="js-pay-demo-input" disabled>&lbrack;<?php echo esc_html($shortcode); ?>&rbrack;</textarea>

    <?php
    if (str_starts_with($shortcode, 'hederapay_transaction_button')) {
        list($amount, $currency, $title, $testnet_account, $previewnet_account, $mainnet_account, $memo) = parse_shortcode($shortcode);

        $network = '';
        if ($testnet_account != '') {
            $network = 'testnet';
        } elseif ($previewnet_account != '') {
            $network = 'previewnet';
        } elseif ($mainnet_account != '') {
            $network = 'mainnet';
        }

        $account = '';
        if ($testnet_account != '') {
            $account = $testnet_account;
        } elseif ($previewnet_account != '') {
            $account = $previewnet_account;
        } elseif ($mainnet_account != '') {
            $account = $mainnet_account;
        }

        $data = array(
            "currency" => $currency,
            "memo" => $memo,
            "network" => $network,
            "account" => $account,
            "amount" => $amount,
            "store" => false
        );


        $jsonData = json_encode($data);     // Encode to JSON
        $encodedData = base64_encode($jsonData);     // Encode the JSON string using Base64
    ?>

        <div class="js-pay-demo-output">
            <div class="hederapay-transaction-wrapper">
                <div style="display: flex">
                    <?php if ($amount == '') { ?>
                        <input type="number" class="hederapay-transaction-input" placeholder="<?php echo $currency; ?>">
                    <?php } ?>

                    <button type="button" class="btn hederapay-transaction-button" data-attributes="<?php echo $encodedData; ?>">
                        <span class="title"><?php echo $title; ?></span><? if ($testnet_account != '') { ?>
                            <span class="hederapay-transaction-button__badge">testnet</span>
                        <? } elseif ($previewnet_account != '') { ?>
                            <span class="hederapay-transaction-button__badge">previewnet</span>
                        <?php } ?>
                    </button>
                </div>

                <div class="hederapay-transaction-notices"></div>
            </div>
        </div>
    <?php
    }
    ?>
</div>