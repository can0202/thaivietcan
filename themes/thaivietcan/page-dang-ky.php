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
            $edit_profile_url = get_edit_profile_url($user_id); ?>
            <div class="regted">
              Bạn đã đăng nhập với tên nick <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Bạn có muốn <a href="<?php echo esc_url(wp_logout_url()); ?>">Thoát</a> không ?
            </div>
          <?php } else { ?>
            <div class="dangkytaikhoan">
              <?php $err = '';
              $success = '';
              global $wpdb, $PasswordHash, $current_user, $user_ID;
              if (isset($_POST['task']) && $_POST['task'] == 'register') {
                $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
                $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
                $email = $wpdb->escape(trim($_POST['email']));
                $username = $wpdb->escape(trim($_POST['username']));

                if ($email == "" || $pwd1 == "" || $pwd2 == "" || $username == "") {
                  $err = 'Vui lòng không bỏ trống những thông tin bắt buộc!';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $err = 'Địa chỉ Email không hợp lệ!.';
                } else if (email_exists($email)) {
                  $err = 'Địa chỉ Email đã tồn tại!.';
                } else if ($pwd1 <> $pwd2) {
                  $err = '2 Password không giống nhau!.';
                } else {
                  $user_id = wp_insert_user(array('user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber'));
                  if (is_wp_error($user_id)) {
                    $err = 'Error on user creation.';
                  } else {
                    do_action('user_register', $user_id);
                    $success = '<p class="success">Bạn đã đăng ký thành công!</p>';
                  }
                }
              }
              ?>
              <!--display error/success message-->
              <div id="message">
                <?php
                if (!empty($err)) :
                  echo '' . $err . '';
                endif;
                ?>
                <?php
                if (!empty($success)) :
                  $login_page  = home_url('/dang-nhap');
                  echo '' . $success . '<a href=' . $login_page . '> Đăng nhập</a>' . '';
                endif;
                ?>
              </div>
              <form class="form-horizontal" method="post" role="form">
                <p class="username">
                  <label for="username">Tên đăng nhập</label>
                  <input type="text" class="input" name="username" id="username" size="20" placeholder="Tên Đăng nhập">
                </p>
                <p class="email">
                  <label for="email">Email</label>
                  <input type="email" class="input" name="email" id="email" size="20" placeholder="Email">
                </p>
                <p class="pwd1">
                  <label for="pwd1">Password</label>
                  <input type="password" class="input" name="pwd1" id="pwd1" size="20" placeholder="Nhập password">
                </p>
                <p class="pwd2">
                  <label for="pwd2">Nhập lại Password</label>
                  <input type="password" class="input" name="pwd2" id="pwd2" placeholder="Nhập lại password">
                </p>
                <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
                <p class="register-submit">
                  <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Đăng ký">
                  <input type="hidden" name="task" value="register" />
                </p>
                <p class="register__text">Bạn đã có tài khoản. <a href="<?php echo get_home_url(); ?>/dang-nhap/">Đăng nhập ngay !</a></p>
              </form>
            </div>
            <div class="thongbaologin">
              <?php
              $login  = (isset($_GET['login'])) ? $_GET['login'] : 0;
              if ($login === "failed") {
                echo '<strong>ERROR:</strong> Sai username hoặc mật khẩu.!';
              } elseif ($login === "empty") {
                echo '<strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.';
              } elseif ($login === "false") {
                echo '<strong>ERROR:</strong> Bạn đã thoát ra.';
              }
              ?>
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