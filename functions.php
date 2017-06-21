<?php
add_post_type_support( 'page', 'excerpt' );
add_theme_support('menus');
add_theme_support('post-thumbnails');

function reizen_scripts() {
  wp_enqueue_script("jquery");
  wp_enqueue_script('reizen_scripts', get_bloginfo('template_directory').'/js/scripts.js', array( 'jquery' ), '1.0', true);
  wp_enqueue_style( 'shadows', 'https://fonts.googleapis.com/css?family=Shadows+Into+Light', true );
  wp_enqueue_style( 'hammersmith', 'https://fonts.googleapis.com/css?family=Hammersmith+One', true );
  wp_enqueue_style( 'hind', 'https://fonts.googleapis.com/css?family=Hind:400,300,500,600,700', true );
  wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', true );
}
add_action('wp_enqueue_scripts', 'reizen_scripts');

/* BOOKING WIDGET */
if (function_exists('register_sidebar')) {
 register_sidebar(array(
  'name' => 'Booking',
  'id' => 'booking',
  'before_widget' => '<div class="sidebarBlock">',
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
 ));
 register_sidebar(array(
  'name' => 'Bol.com',
  'id' => 'bol',
  'before_widget' => '<div class="sidebarBlock">',
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
 ));
}

/* IMAGE SIZE */
if (function_exists('add_image_size')) { 
	//add_image_size( 'blog', 600, 400, true ); //(cropped)
}

/* OPTIONS PAGE */
if( function_exists('acf_add_options_page') ) {
  $args = array(
    'page_title' => 'Thema opties',
    'menu_title' => 'Thema opties',
    //'menu_slug' => '',
    'position' => 2,
  );
  acf_add_options_page($args);
}

function my_custom_login_logo() {
    echo '<style type="text/css">
        .login-action-login {background-image:url(https://www.reizen-en-reistips.nl/wp-content/uploads/2014/08/tanzania.jpg) !important;}
        h1 a { background-image:url(https://www.reizen-en-reistips.nl/wp-content/uploads/2016/02/reizen-en-reistips-logo.png) !important;  background-size: 205px !important; width: 205px !important; height: 60px !important;}
    </style>';
}
add_action('login_head', 'my_custom_login_logo');