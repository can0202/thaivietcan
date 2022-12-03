<?php get_header(); ?>
<div class="content page__user" id="content">
  <div class="site__content">
    <div class="container">
      <div class="login__page">
        <div class="form__login">
          <?php if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $current_user = wp_get_current_user();
            $profile_url = get_author_posts_url($user_id);
            $edit_profile_url  = get_edit_profile_url($user_id); ?>
            <div class="regted">
              Bạn đã đăng nhập với tên tài khoản <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Bạn có muốn <a href="<?php echo esc_url(wp_logout_url()); ?>">Thoát</a> không ?
            </div>
          <?php } else { ?>
            <div class="formdangnhap">
              <h3>Đăng nhập</h3>
              <small>Hey, Hãy nhập đầy đủ thông tin để đăng nhập tài khoản nhé !</small>
              <?php wp_login_form(); ?>
              <p class="register__text">Bạn chưa có tài khoản. <a href="<?php echo get_home_url(); ?>/dang-ky/">Đăng ký ngay !</a></p>
            </div>
          <?php } ?>
        </div>
        <div class="image__login" style="background-image: url('<?php echo  get_template_directory_uri(); ?>/assets/images/bg_login.jpg')">

        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>