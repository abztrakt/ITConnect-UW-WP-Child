<?
if ( ! function_exists( 'uw_enqueue_default_styles' ) ):
/**
 * This is where all the CSS files are registered
 *
 * bloginfo('template_directory')  gives you the url to the parent theme
 * bloginfo('stylesheet_directory')  gives you the url to the child theme
 */
  function uw_enqueue_default_styles() {
      global $current_blog;
      $is_child_theme = get_bloginfo('template_directory') != get_bloginfo('stylesheet_directory');
      wp_register_style( 'bootstrap',get_bloginfo('stylesheet_directory') . '/css/bootstrap.css', array(), '3.0.0' );
      /*wp_register_style( 'bootstrap-responsive', get_bloginfo('template_directory') . '/css/bootstrap-responsive.css', array('bootstrap'), '2.0.3' );*/
      wp_register_style( 'bootstrap-offcanvas',get_bloginfo('stylesheet_directory') . '/css/bootstrap-offcanvas.css', array(), '1.0.0' );

      wp_register_style( 'google-font-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300' );
      wp_register_style( 'itconnect-master', get_bloginfo('stylesheet_directory') . '/style.css', array(), '1.0' );
      wp_enqueue_style( 'bootstrap' );
      wp_enqueue_style( 'bootstrap-offcanvas' );
      /* wp_enqueue_style( 'bootstrap-responsive' ); */
      wp_enqueue_style( 'google-font-open-sans' );
      wp_enqueue_style( 'itconnect-master' );
  }

endif;

if ( ! function_exists( 'uw_enqueue_default_scripts' ) ):
/**
 * This is where all the JS files are registered
 *
 * bloginfo('template_directory')  gives you the url to the parent theme
 * bloginfo('stylesheet_directory')  gives you the url to the child theme
 */
  function uw_enqueue_default_scripts() {
    wp_deregister_script('jquery'); //we use googles CDN below
    wp_deregister_script('header'); //we use our own below
    wp_register_script( 'jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array(), '1.7.2' );
    wp_register_script( 'header', get_bloginfo('stylesheet_directory') . '/js/header.js', array('jquery'), '1.2.8' );
    wp_register_script( 'jquery.firenze', get_bloginfo('template_directory') . '/js/jquery.firenze.js', array('jquery'), '1.0.1' );
    wp_register_script( 'jquery.weather', get_bloginfo('template_directory') . '/js/jquery.weather.js', array('jquery'), '1.1' );
    wp_register_script( 'jquery.placeholder', get_bloginfo('template_directory') . '/js/jquery.placeholder.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.imageexpander', get_bloginfo('template_directory') . '/js/jquery.imageexpander.js', array('jquery'), '1.0.5' );
    wp_register_script( 'jquery.waypoints', get_bloginfo('template_directory') . '/js/jquery.waypoints.min.js', array('jquery'), '1.1.7' );
    wp_register_script( 'jquery.imagesloaded', get_bloginfo('template_directory') . '/js/jquery.imagesloaded.min.js', array('jquery'), '2.1.1' );
    wp_register_script( 'jquery.parallax', get_bloginfo('template_directory') . '/js/jquery.parallax.min.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.404', get_bloginfo('template_directory') . '/js/404.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.masonry', get_bloginfo('template_directory') . '/js/jquery.masonry.min.js', array('jquery') );
    wp_register_script( 'offcanvas', get_bloginfo('stylesheet_directory') . '/js/bootstrap-offcanvas.js', array('jquery') );
    wp_register_script( 'itconnect', get_bloginfo('stylesheet_directory') . '/js/itconnect.js', array('jquery') );

    wp_register_script( 'widget-youtube-playlist', get_bloginfo('template_directory') . '/js/widget-youtube-playlist.js', array('jquery','swfobject','jquery.imagesloaded') );
    wp_register_script( 'uw-gallery', get_bloginfo('template_directory') . '/js/gallery.js', array('jquery','jquery.imagesloaded'), '1.1' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'header' );
    wp_enqueue_script( 'jquery.firenze' );
    wp_enqueue_script( 'jquery.placeholder' );
    wp_enqueue_script( 'jquery.imageexpander' );

    wp_enqueue_script( 'offcanvas' );
    wp_enqueue_script( 'itconnect' );

    wp_enqueue_script('uw-gallery');


    if( is_404() ) {

      wp_enqueue_script( 'jquery.imagesloaded' );
      wp_enqueue_script( 'jquery.parallax' );
      wp_enqueue_script( 'jquery.404' );

    }
  }

endif;

if (! function_exists ( 'it_widgets_init' )):

  function it_widgets_init()
  {
    $args = array(
      'name' => 'News Sidebar',
      'id' => 'news-sidebar',
      'description' => 'Widgets for the left column of the archives page on ITConnect',
      'before_widget' => '<div id="%1$s class="widget %2$s">',
      'after_widget' => '</div>'
    );

    register_sidebar($args);
  }
endif;

add_action( 'widgets_init', 'it_widgets_init' );

require('homepage-image-options.php' );

if ( ! function_exists( 'is_custom_hompage_image' ) ):  
  function is_custom_homepage_image()
  {
    $option = get_option('homepage_image'); 

    if ( ! is_array( $option) )
      return false;

    $homepage_image = (array) $option['homepage_image'];
    if ( isset($homepage_image['custom'] ))  
      return true;

    return false;
  }
endif;

if ( ! function_exists( 'custom_homepage_image' ) ):  
  function custom_homepage_image() 
  {
    $option = get_option('homepage_image');

    if ( ! is_array( $option) )
      return;

    $homepage_image = (array) $option['homepage_image'];
    if ( isset($homepage_image['custom'] )) {
      echo ' style="background:url('.$homepage_image['custom']['url'].') no-repeat; background-size:cover;" ' ;
    }   
  }
endif;

?>
