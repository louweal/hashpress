<?php

/**
 * Template Name: Leaderboard template
 * Template Post Type: post, page
 */

get_header();


$leaderboard_data = get_transient('leaderboard_data') ?: "";
// echo count($accounts);

$leaderboard_fetched_at = get_transient('leaderboard_fetched_at') ?: "";
$fetch_date = new DateTime($leaderboard_fetched_at, new DateTimeZone('UTC'));

$accounts = json_decode($leaderboard_data, true);

// debug($accounts);
?>
<main id="site-main" class="main">
    <?php get_hero(); ?>

    <section class="section" id="accounts">
        <div class="container">
            <div class="grid lg:grid-cols-12">
                <div class="lg:col-start-3 lg:col-span-8">

                    <?php //debug(count($accounts));
                    ?>

                    <div class="block mb-6">
                        <input type="text" class="leaderboard__search" placeholder="Find account">
                        <div class="leaderboard__search-results"></div>
                    </div>

                    <div class="leaderboard" data-fetched-at="<?php echo $leaderboard_fetched_at; ?>">

                        <?php if ($accounts) { ?>
                            <span class="text-sm opacity-50">Last updated: <?php echo $fetch_date->format('Y-m-d H:i:s') . " UTC"; ?></span>
                            <div class="leaderboard__table">
                                <div class="leaderboard__table__tr is-active">
                                    <div></div>
                                    <div>Account</div>
                                    <div>Balance</div>
                                </div>
                                <?php
                                for ($i = 1; $i < count($accounts); $i++) {
                                    $account = $accounts[$i];
                                    $active_class = $i <= 25 ? "is-active" : "";
                                ?>
                                    <div class="leaderboard__table__tr <?php echo $active_class; ?>">
                                        <div><?php echo $i; ?></div>
                                        <div><?php echo $account['account']; ?></div>
                                        <div><?php echo intval($account['balance'] / 1e8); ?></div>
                                    </div>

                                <?php
                                }; //foreach
                                ?>
                                </tbody>
                                </table>

                                <?php if (count($accounts) > 25) { ?>
                                    <div class="btn load-more">Load more</div>
                                <?php }; //if 
                                ?>
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
                </div>

            </div>
    </section>

    <?php get_template_part('/template-parts/pagebuilder/pagebuilder'); ?>

</main>

<?php get_footer(); ?>