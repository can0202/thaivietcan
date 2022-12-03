<?php
// Add custom Theme Functions here
define('ROOT_CHILD_URI', get_stylesheet_directory_uri());
define('ROOT_CHILD_DIR', get_stylesheet_directory());

// require lib
require_once('inc/enqueue-script.php');

// Setup theme
if (!function_exists('blog_tvc_theme')) :
  function blog_tvc_theme()
  {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('type-medium', 520, 400, true);
    add_image_size('type-large', 800, 500, true);
    add_image_size('type-fullwidth', 1200, 580, true);

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
      'main_menu' => esc_html__('Main Menu', 'type'),
      'social_menu' => esc_html__('Social Menu', 'type'),
    ));

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption'));

    // Enable support for Post Formats
    add_theme_support('post-formats', array('image', 'video', 'audio', 'gallery', 'quote'));

    // Enable support for custom logo.
    add_theme_support('custom-logo', array(
      'height'      => 400,
      'width'       => 400,
      'flex-width'  => true,
      'flex-height' => true,
    ));

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add AMP support
    add_theme_support('amp');

    // Load regular editor styles into the new block-based editor.
    add_theme_support('editor-styles');

    // return editor to old
    add_filter('use_block_editor_for_post', '__return_false');
  }
endif;
add_action('after_setup_theme', 'blog_tvc_theme');

/**
 * Estimated Reading Time
 *
 * @return void
 */
// Estimated reading time in minutes
function prefix_estimated_reading_time()
{
  global $post;
  // get the content
  $the_content = $post->post_content;
  // count the number of words
  $words = str_word_count(strip_tags($the_content));
  // rounding off and deviding per 200 words per minute
  $minute = floor($words / 200);
  // rounding off to get the seconds
  $second = floor($words % 200 / (200 / 60));
  // calculate the amount of time needed to read
  $estimate = $minute;
  // return the estimate
  return $estimate;
}

//limit excerpt
function getExcerpt($limit)
{
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt) >= $limit) {
    array_pop($excerpt);
    $excerpt = implode(" ", $excerpt) . '...';
  } else {
    $excerpt = implode(" ", $excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
  return $excerpt;
}

// Redirect khi đăng nhập
function my_login_redirect($redirect_to, $request, $user)
{
  //is there a user to check?
  global $user;
  if (isset($user->roles) && is_array($user->roles)) {
    //check for admins
    if (in_array('administrator', $user->roles)) {
      // redirect them to the default place
      return home_url();
    } else {
      return home_url();
    }
  } else {
    return $redirect_to;
  }
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);

// do not allow users to login to the default wp
function redirect_login_page()
{
  $login_url  = home_url('/dang-nhap');
  $url = basename($_SERVER['REQUEST_URI']); // get requested URL
  isset($_REQUEST['redirect_to']) ? ($url   = "wp-login.php") : 0; // if users ssend request to wp-admin
  if ($url  == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_url);
    exit;
  }
}

// redirect if login false
function error_handler_login()
{
  $login_page  = home_url('/dang-nhap');
  global $errors;
  $err_codes = $errors->get_error_codes(); // get WordPress built-in error codes
  $_SESSION["err_codes"] =  $err_codes;
  wp_redirect($login_page); // keep users on the same page
  exit;
}
add_filter('login_errors', 'error_handler_login');
add_action('init', 'redirect_login_page');


// Remove frontend admin bar items
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
  if (current_user_can('subscriber')) {
    show_admin_bar(false);
  }
}

// Support upload image post
add_action('init', 'do_output_buffer');
function do_output_buffer()
{
  ob_start();
}
function insert_attachment($file_handler, $post_id, $setthumb = 'false')
{
  // check to make sure its a successful upload
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');
  $attach_id = media_handle_upload($file_handler, $post_id);

  if ($setthumb) update_post_meta($post_id, '_thumbnail_id', $attach_id);
  return $attach_id;
}

// Custom Scripting to Move JavaScript from the Head to the Footer
function remove_head_scripts()
{
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts', 'remove_head_scripts');
