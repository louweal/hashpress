<?php

/**
 * Template:			pagebuilder-time-machine.php
 * Description:			Time Machine Pagebuilder Layout
 */

$fiats = ["usd", "eur", "jpy", "gbp", "aud", "cad", "chf", "cny", "hkd", "nzd", "sek", "krw", "sgd", "nok", "mxn", "inr", "rub", "zar", "try", "brl", "twd", "dkk", "pln", "thb", "idr", "huf", "czk", "ils", "clp", "php", "aed", "sar", "myr", "ron"];

?>

<section class="section section--flex" id="time-machine">
    <div class="container">
        <div class="grid lg:grid-cols-12 gap-5">
            <div class="lg:col-start-3 lg:col-span-3 order-2 lg:order-1">

                <div class="block">
                    <input type="text" class="time-machine-input" name="account" value="0.0.1874003" placeholder="Account ID or HBAR balance">
                    <input type="date" class="time-machine-date" name="date" value="2024-01-01">
                    <select name="currency" class="time-machine-currency">
                        <!-- <option value="hbar" selected>HBAR</option> -->
                        <?php foreach ($fiats as $fiat) { ?>
                            <option value="<?php echo $fiat; ?>"><?php echo strtoupper($fiat); ?></option>
                        <?php } ?>
                    </select>

                    <!-- <div class="btn">Go back in time</div> -->
                </div>
            </div>
            <div class="lg:col-span-5 order-2 lg:order-1">
                <div class="block time-machine-output">
                    <p>
                        You had <strong id="in-balance">???</strong> <strong>HBAR</strong> on
                        <strong id="date">DATE</strong> which was equal to <strong id="out-balance">???</strong> <strong id="currency">CUR</strong>.
                    </p>

                    <p>
                        HBAR price: <strong id="price">PRICE</strong> <strong id="currency2">CUR</strong>
                    </p>

                </div>
            </div>

        </div>
    </div>
</section>