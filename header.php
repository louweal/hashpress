<?php

/**
 * Template:			header.php
 * Description:			The template for displaying the header
 */


function random_rgb($opacity)
{
    return "rgba(
        " . random_color(225, 255) . ",
        " . random_color(146, 186) . ",
        " . random_color(25, 45) . ", " . $opacity . "
      )";
}

function random_color($min, $max)
{
    return $min + ceil(rand(0, 1) * ($max - $min));
}
?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>" class="no-js">

<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    wp_body_open(); ?>


    <div class="bg">
        <?php for ($i = 0; $i < 50; $i++) {
            $random_x_pos = rand(4, 100) . "%";
            $random_y_pos = rand(2, 98) . "%";
            $random_size = 2 + rand(2, 6) . "px";
            $random_delay = rand(0, 15) . "s";
            $random_gradient = "radial-gradient( circle, " . random_rgb(0.25) . " 0%, " . random_rgb(0.5) . " 100%)";
        ?>
            <div class="sparkle" style="
      background: <?php echo $random_gradient; ?>; left: <?php echo $random_x_pos; ?>; top: <?php echo $random_y_pos; ?>; width: <?php echo $random_size; ?>; height: <?php echo $random_size; ?>; animation-delay: <?php echo $random_delay; ?>;"></div>
        <?php }; //foreach
        ?>

    </div>


    <header id="site-header" class="header">

        <div class="grid grid-cols-12 w-full">
            <div class="col-span-6 lg:col-span-2 flex items-center justify-end lg:justify-start order-2 lg:order-1">
                <div class="header__toggle">
                    <button class="toggle js-toggle-mobile-menu" title="<?php _e('Toggle menu', 'hashpress'); ?>">
                        <span class="toggle__inner">
                            <span></span><span></span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="col-span-6 lg:col-span-8 items-center flex lg:justify-center order-1 lg:order-2">
                <div class="header__logo">
                    <a href="<?php echo home_url(); ?>#top" title="<?php bloginfo('name'); ?>" rel="home" class="js-close-mobile-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="41" fill="none">
                            <path fill="#fff" d="M0 29.901V10.595h2.445v6.307H9.31v-6.307h2.445v19.306H9.31V19.09H2.445v10.811H0Z" />
                            <path fill="#fff" d="m15.156 29.901 8.173-19.95h.043l8.173 19.95h-2.596l-2.274-5.727h-6.757L17.623 29.9h-2.467Zm5.578-7.765h5.126l-1.523-3.818a93.393 93.393 0 0 1-.536-1.437 19.253 19.253 0 0 1-.515-1.695 26.936 26.936 0 0 1-.493 1.695 31.11 31.11 0 0 1-.536 1.437l-1.523 3.818Z" />
                            <path fill="#fff" d="M39.108 30.159c-1.144 0-2.181-.23-3.11-.687-.916-.457-1.645-1.015-2.189-1.673l.708-2.96c.4.8 1.001 1.523 1.802 2.166.8.644 1.759.966 2.874.966 1.016 0 1.852-.322 2.51-.966.672-.643 1.008-1.437 1.008-2.38 0-.687-.164-1.252-.493-1.695a4.064 4.064 0 0 0-1.116-1.051 10.473 10.473 0 0 0-.986-.558l-2.36-1.201c-.372-.2-.837-.48-1.394-.837-.544-.357-1.023-.85-1.437-1.48-.415-.63-.622-1.444-.622-2.446 0-.972.221-1.837.665-2.595a4.815 4.815 0 0 1 1.887-1.78c.815-.43 1.745-.644 2.789-.644 1.03 0 1.938.186 2.724.558.787.357 1.401.73 1.845 1.115l-.708 2.96c-.358-.6-.887-1.165-1.587-1.694a3.85 3.85 0 0 0-2.382-.794c-.858 0-1.544.258-2.059.772-.515.5-.772 1.123-.772 1.867 0 .572.129 1.044.386 1.415.272.372.572.665.901.88.343.214.622.379.837.493l2.402 1.201c.286.143.644.344 1.073.601.443.258.88.6 1.308 1.03.43.415.787.93 1.073 1.544.286.6.429 1.33.429 2.188 0 1.101-.265 2.08-.794 2.939a5.438 5.438 0 0 1-2.124 2.016c-.9.487-1.93.73-3.088.73Z" />
                            <path fill="#fff" d="M49.403 29.901V10.595h2.445v6.307h6.864v-6.307h2.446v19.306h-2.446V19.09h-6.864v10.811h-2.445Z" />
                            <path fill="#fff" d="M120.748 29.901V10.595h4.784c1.273 0 2.345.194 3.218.58.886.386 1.601.893 2.145 1.523a5.82 5.82 0 0 1 1.18 2.016c.257.73.386 1.444.386 2.145 0 .686-.122 1.394-.365 2.124a6.006 6.006 0 0 1-1.18 2.038c-.543.629-1.258 1.136-2.145 1.523-.886.386-1.966.579-3.239.579h-2.338V29.9h-2.446Zm2.446-8.966h2.209c1.159 0 2.074-.2 2.746-.6.672-.416 1.151-.93 1.437-1.545.286-.63.429-1.273.429-1.93 0-.63-.143-1.26-.429-1.889-.271-.629-.743-1.15-1.415-1.566-.658-.414-1.581-.622-2.768-.622h-2.209v8.152Z" />
                            <path fill="#fff" d="M136.566 29.901V10.595h4.848c1.216 0 2.26.243 3.132.73.873.486 1.545 1.13 2.017 1.93.486.787.729 1.652.729 2.596 0 1.058-.3 2.01-.901 2.853-.601.844-1.423 1.466-2.467 1.866l6.478 9.331h-2.853l-6.135-8.88h-2.402v8.88h-2.446Zm2.446-10.94h2.402c.83 0 1.502-.15 2.017-.45.529-.315.915-.708 1.158-1.18.258-.486.386-.98.386-1.48 0-.901-.329-1.638-.987-2.21-.643-.572-1.501-.858-2.574-.858h-2.402v6.178Z" />
                            <path fill="#fff" d="M153.553 29.901V10.595h9.524v2.188h-7.079v4.119h5.577v2.188h-5.577v8.623h7.079v2.188h-9.524Z" />
                            <path fill="#fff" d="M171.537 30.159c-1.144 0-2.181-.23-3.11-.687-.915-.457-1.645-1.015-2.188-1.673l.708-2.96c.4.8 1.001 1.523 1.802 2.166.8.644 1.759.966 2.874.966 1.015 0 1.852-.322 2.51-.966.672-.643 1.008-1.437 1.008-2.38 0-.687-.164-1.252-.493-1.695a4.065 4.065 0 0 0-1.116-1.051 10.395 10.395 0 0 0-.987-.558l-2.359-1.201c-.372-.2-.837-.48-1.394-.837-.544-.357-1.023-.85-1.438-1.48-.414-.63-.622-1.444-.622-2.446 0-.972.222-1.837.665-2.595a4.818 4.818 0 0 1 1.888-1.78c.815-.43 1.745-.644 2.789-.644 1.029 0 1.937.186 2.724.558.786.357 1.401.73 1.845 1.115l-.708 2.96c-.358-.6-.887-1.165-1.588-1.694a3.847 3.847 0 0 0-2.381-.794c-.858 0-1.544.258-2.059.772-.515.5-.772 1.123-.772 1.867 0 .572.128 1.044.386 1.415.272.372.572.665.901.88.343.214.622.379.836.493l2.403 1.201c.286.143.643.344 1.072.601.444.258.88.6 1.309 1.03.429.415.786.93 1.073 1.544.286.6.429 1.33.429 2.188 0 1.101-.265 2.08-.794 2.939a5.44 5.44 0 0 1-2.124 2.016c-.901.487-1.93.73-3.089.73Z" />
                            <path fill="#fff" d="M185.994 30.159c-1.144 0-2.181-.23-3.111-.687-.915-.457-1.644-1.015-2.188-1.673l.708-2.96c.401.8 1.001 1.523 1.802 2.166.801.644 1.759.966 2.875.966 1.015 0 1.851-.322 2.509-.966.672-.643 1.008-1.437 1.008-2.38 0-.687-.164-1.252-.493-1.695a4.075 4.075 0 0 0-1.115-1.051 10.52 10.52 0 0 0-.987-.558l-2.36-1.201c-.372-.2-.836-.48-1.394-.837-.543-.357-1.022-.85-1.437-1.48-.415-.63-.622-1.444-.622-2.446 0-.972.221-1.837.665-2.595a4.815 4.815 0 0 1 1.887-1.78c.816-.43 1.745-.644 2.789-.644 1.03 0 1.938.186 2.724.558.787.357 1.402.73 1.845 1.115l-.708 2.96c-.357-.6-.886-1.165-1.587-1.694a3.852 3.852 0 0 0-2.381-.794c-.858 0-1.545.258-2.06.772-.514.5-.772 1.123-.772 1.867 0 .572.129 1.044.386 1.415.272.372.572.665.901.88.343.214.622.379.837.493l2.402 1.201c.286.143.644.344 1.073.601.443.258.879.6 1.308 1.03.429.415.787.93 1.073 1.544.286.6.429 1.33.429 2.188 0 1.101-.265 2.08-.794 2.939a5.438 5.438 0 0 1-2.123 2.016c-.901.487-1.931.73-3.089.73Z" />
                            <path fill="#F5A623" fill-rule="evenodd" d="M90.606 40.464c11.174 0 20.232-9.058 20.232-20.232S101.78 0 90.606 0 70.374 9.058 70.374 20.232s9.058 20.232 20.232 20.232Zm.006-1.536c10.32 0 18.686-8.366 18.686-18.686S100.932 1.556 90.612 1.556 71.926 9.922 71.926 20.242s8.366 18.686 18.686 18.686Z" clip-rule="evenodd" />
                            <path class="hbar" fill="#F5A623" fill-rule="evenodd" d="M102.717 30.594a15.831 15.831 0 0 0 3.812-10.326 15.83 15.83 0 0 0-3.812-10.326v20.652Zm-3.718 3.19v-7.863H82.632v8.077a15.818 15.818 0 0 0 8.006 2.16c3.067 0 5.932-.868 8.36-2.374Zm-20.085-2.789a15.833 15.833 0 0 1-4.167-10.727c0-4.134 1.58-7.9 4.167-10.727v21.454Zm3.718-24.457v8.026H99V6.752a15.817 15.817 0 0 0-8.361-2.375c-2.92 0-5.655.787-8.006 2.161Zm16.542 16.03H82.808v-4.633h16.366v4.632Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>


            <div class="lg:col-span-2 items-end justify-end hidden lg:flex order-3">
                <a target="_blank" href="/wp-content/uploads/2024/12/PitchHashPressUpdate.mp4" class="btn">Watch demo</a>

            </div>
        </div>
    </header>


    <div class="mobile-menu">
        <?php if (has_nav_menu('menu-main')) { ?>
            <div class="header__navigation" id="header-nav">
                <?php $nav_menu_args = array(
                    'theme_location'        => 'menu-main',
                    'container'             => 'nav',
                    'container_class'       => 'menu menu--main',
                    'menu_class'            => 'menu__list menu__list--main',
                );
                wp_nav_menu($nav_menu_args); ?>
            </div>
        <?php } ?>
    </div>