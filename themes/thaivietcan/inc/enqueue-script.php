<?php

function setup_script_theme()
{
  wp_enqueue_style('icons-css', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
  wp_enqueue_style('style-css', ROOT_CHILD_URI . '/assets/css/style.css', array());
  wp_enqueue_style('responsive-css', ROOT_CHILD_URI . '/assets/css/responsive.css', array());

  // wp_deregister_script('jquery-core');
  // wp_register_script('jquery-core', ROOT_CHILD_URI . '/js/jquery.min.js', array());
  wp_enqueue_script('main-js', ROOT_CHILD_URI . '/assets/js/main.js', array());
}
add_action('wp_enqueue_scripts', 'setup_script_theme', 30, 3);
