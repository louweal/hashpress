<?php
$leaderboard_data = get_transient('leaderboard_data') ?: "";

$leaderboard_fetched_at = get_transient('leaderboard_fetched_at') ?: "";
$fetch_date = new DateTime($leaderboard_fetched_at, new DateTimeZone('UTC'));

$accounts = json_decode($leaderboard_data, true);

// $path = '/api/v1/balances';
// $data = fetch_balances($path);

// echo "<pre>";
// print_r($data); // Print the fetched balance data
// echo "</pre>";
?>

<section class="section" id="accounts">
    <div class="container">
        <div class="grid lg:grid-cols-12 gap-5">
            <div class="lg:col-start-3 lg:col-span-5 order-2 lg:order-1">


                <div class="leaderboard" data-fetched-at="<?php echo $leaderboard_fetched_at; ?>">

                    <?php if ($accounts) { ?>
                        <h3><?php _e('Leaderboard', 'control'); ?></h3>

                        <div class="leaderboard__table">
                            <div class="leaderboard__table__tr thead is-active">
                                <div></div>
                                <div>Account</div>
                                <div>Balance (ℏ)</div>
                            </div>
                            <?php
                            for ($i = 0; $i < 25; $i++) {
                                $account = $accounts[$i];
                            ?>
                                <div class="leaderboard__table__tr is-active">
                                    <div><?php echo $i + 1; ?></div>
                                    <div><?php echo $account['account']; ?></div>
                                    <div><?php echo intval($account['balance'] / 1e8); ?></div>
                                </div>

                            <?php
                            }; //foreach
                            ?>
                        </div>

                        <?php if (count($accounts) > 25) { ?>
                            <div class="w-full text-center">
                                <div class="btn load-more" data-start="25">Load more</div>
                            </div>
                        <?php }; //if
                        ?>
                        <span class="text-sm opacity-50">Last fetched: <?php echo $fetch_date->format('Y-m-d H:i:s') . " UTC"; ?></span>

                    <?php } else {
                    ?>
                        <div class="leaderboard__progress">
                            <div class="bar"></div>
                        </div>
                    <?php
                        echo "Fetching data...";
                    } ?>

                </div>
            </div>

            <div class="lg:col-span-3 order-1 lg:order-2">
                <div class="block sticky top-20">
                    <h3 class="mb-5"><?php _e('Find account', 'hashpress'); ?></h3>
                    <form autocomplete="on" class="leaderboard__search-form w-full">
                        <input type="text" class="leaderboard__search" name="account" placeholder="Find account">
                    </form>
                    <div class="leaderboard__search-results"></div>
                </div>
            </div>
        </div>
    </div>
</section>