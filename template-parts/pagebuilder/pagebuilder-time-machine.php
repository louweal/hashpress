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
                    <input type="text" class="time-machine-input" name="account" value="0.0.1234567" placeholder="Account ID or HBAR balance">
                    <input type="date" class="time-machine-date" name="date" value="2024-01-01">
                    <select name="currency" class="time-machine-currency">
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
                        HBAR price: <strong id="price"></strong> <strong class="currency">USD</strong>

                    </p>


                    <p>
                        You had <strong id="in-balance">???</strong> <strong>HBAR</strong> on
                        <strong id="date">Mon Jan 01 2024</strong> <strong>00:00 UTC</strong> which was equal to <strong id="out-balance">???</strong> <strong class="currency">USD</strong>.
                    </p>

                    <p>
                        Lowest price on <strong id="date2">Mon Jan 01 2024</strong> in timezone <strong id="timezone">UTC</strong>: <strong id="lowest-price"></strong> <strong class="currency">USD</strong>.
                        The lowest balance you had this day was <strong id="lowest-out-balance"></strong> <strong class="currency">USD</strong>.</p>
                </div>
            </div>

        </div>
    </div>
</section>