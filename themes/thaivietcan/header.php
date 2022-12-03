<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="main">
    <!-- Start Header -->
    <header class="header">
      <div class="container">
        <!-- Header Top -->
        <div class="header__top d-flex align-items-center justify-between">
          <div class="header__social pc">
            <ul>
              <li>
                <a href="https://www.facebook.com/profile.php?id=100077554684246" target="_blank">
                  <i class="ion-social-facebook"></i>
                </a>
              </li>
              <li>
                <a href="mailto:vietcanthai1996@gmail.com">
                  <i class="ion-ios-email"></i>
                </a>
              </li>
              <li>
                <a href="tel:0396393483">
                  <i class="ion-android-call"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="ion-social-skype"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="header__logo">
            <a href="<?php echo get_home_url(); ?>" class="d-flex align-items-center">
              <div class="logo__icon d-flex align-items-center">
                <span> </span>
                <span> </span>
                <span> </span>
                <span> </span>
                <i class="ion-code-working pointer-effect"></i>
              </div>
              <div class="logo__text">
                <span>Thaivietcan</span>
              </div>
            </a>
          </div>
          <div class="header__login" id="header__login">
            <?php
            $current_user = wp_get_current_user();
            ?>
            <?php if (is_user_logged_in()) : ?>
              <a href="#" class="logged d-flex align-items-center" id="logged" title="Logged">
                <i class="ion-person"></i>
                <span><?= $current_user->display_name; ?></span>
              </a>
              <ul class="profile__user" id="profile__user">
                <!-- <li>
                  <a href="<?php echo get_home_url(); ?>/profile/">
                    Thông tin tài khoản
                  </a>
                </li> -->
                <!-- <li><a href="<?php echo get_home_url(); ?>/dang-bai/">Đăng bài</a></li> -->
                <li><a href="<?php echo get_home_url(); ?>/wishlist/">Danh sách yêu thích</a></li>
                <li><a href="<?php echo esc_url(wp_logout_url()); ?>">Đăng xuất</a></li>
              </ul>
            <?php else : ?>
              <a class="login__button" href="<?php echo get_home_url(); ?>/dang-nhap/" title="Login">Đăng nhập</a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Header Middle -->
        <div class="header__middle">
          <h1 class="title__main">Nothing is too small to know, and nothing too big to attempt.</h1>
        </div>

        <!-- Header Bottom -->
        <div class="header__bottom ">
          <ul class="menus d-flex align-items-center justify-center">
            <?php wp_nav_menu(array(
              'theme_location' => 'main_menu',
              'menu_class' => '',
              'container' => false,
              'items_wrap' => '%3$s'
            )); ?>
          </ul>
        </div>
      </div>
    </header>
    <!-- End Header -->