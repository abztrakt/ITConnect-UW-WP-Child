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
      wp_register_style( 'bootstrap',get_bloginfo('template_directory') . '/css/bootstrap.css', array(), '2.0.4' );
      wp_register_style( 'bootstrap-responsive', get_bloginfo('template_directory') . '/css/bootstrap-responsive.css', array('bootstrap'), '2.0.3' );
      wp_register_style( 'google-font-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300' );
      wp_enqueue_style( 'bootstrap' );
      wp_enqueue_style( 'bootstrap-responsive' );
      wp_enqueue_style( 'google-font-open-sans' );
  }

endif;
?>
