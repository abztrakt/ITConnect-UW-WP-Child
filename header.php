<!doctype html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if ( has_post_thumbnail() ): ?>
  <meta property="og:image" content="<?php $ogthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); echo $ogthumb[0]; ?>" /> 
  <?php endif; ?>
  <title>
    <?php
      /*
       * Print the <title> tag based on what is being viewed.
       */
      global $page, $paged;

      wp_title( '|', true, 'right' );

      // Add the blog name.
      bloginfo( 'name' );

      // Add the blog description for the home/front page.
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

      // Add a page number if necessary:
      if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
    ?>
  </title>

  <?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/print.css" type="text/css" media="print" />

<!--[if lt IE 9]>
  <script src="<?php bloginfo("template_directory"); ?>/js/html5shiv.js" type="text/javascript"></script>
  <script src="<?php bloginfo("template_directory"); ?>/js/respond.min.js" type="text/javascript"></script>
<![endif]-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#sort").tablesorter(); 
        }
     );
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!--
<script src="//code.jquery.com/jquery-1.9.1.js"></script>  -->
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
   $(function() {
     var path = "<?php bloginfo('stylesheet_directory'); ?>/keywords.txt";
     $.get(path, function(data) {
        var availableTags = data.split('\n');
     
        $( "#q" ).autocomplete({
            source: availableTags,
            minLength: 1
        });
     });
   });
</script>

</head>

<body <?php body_class(); ?>>


<?php get_template_part('banner'); ?>
<?php get_template_part('dropdowns'); ?>
