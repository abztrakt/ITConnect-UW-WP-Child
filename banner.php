<?php
  // Check to see if the header image has been removed
  $header_image = get_header_image();
  if ( ! empty( $header_image ) ) :
?>
<header style="background-image:url(<?php echo apply_filters('remove_cms', $header_image); ?>); <?php header_background_color(); ?>" id="branding" role="banner" <?php banner_class(); ?>>
<?php else: ?>
<header id="branding" role="banner" <?php banner_class(); ?>>
<?php endif; ?>
<div id='banner-container' class='hidden-phone'>
    <div id="banner-image" class='it_container'></div>
</div>

<div id="header" class="it_container">
		<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
		<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to sidebar content', 'twentyeleven' ); ?>"><?php _e( 'Skip to sidebar content', 'twentyeleven' ); ?></a></div>

		<a class="patch hidden-phone" href="http://www.uw.edu" title="University of Washington"></a>
		<a class="wordmark hidden-phone" <?php custom_wordmark(); ?> href="<?php echo site_url(); ?>">IT Connect</a>
		<a class="wordmark visible-phone" <?php custom_wordmark(); ?> href="<?php echo is_custom_wordmark() ? home_url('/') : '//www.washington.edu'; ?>">University of Washington</a>
        <p id="header_description" class="hidden-phone">Information technology tools and resources at the UW</p>
        <a title="Show search" role="button" href="#searchicon-wrapper" id="searchicon-wrapper" aria-haspopup="true">Search</a>

      <?php get_template_part('uw-search'); ?>

		</div>
		<a title="Show menu" role="button" href="#listicon-wrapper" id="listicon-wrapper" aria-haspopup="true">Menu</a>
</div>

<div id="thin-strip" class='top-fixed'>
	<div class='it_container'>
        <ul role="navigation">
			<li><a href="http://www.washington.edu/">UW Home</a></li>
			<li><a href="http://www.washington.edu/home/directories.html">Directories</a></li>
			<li><a href="http://www.washington.edu/discover/visit/uw-events">Calendar</a></li>
			<li><a href="http://www.lib.washington.edu/">Libraries</a></li>
			<li><a href="http://www.washington.edu/maps">Maps</a></li>
			<li><a href="http://myuw.washington.edu/">My UW</a></li>
         <!--   <li class="visible-desktop"><a href="http://www.bothell.washington.edu/">UW Bothell</a></li>
            <li class="visible-desktop"><a href="http://www.tacoma.uw.edu/">UW Tacoma</a></li>  -->
            <li class="visible-phone"><a href="http://www.uw.edu/news">News</a></li>
			<li class="visible-phone"><a href="http://www.gohuskies.com/">UW Athletics</a></li>
		</ul>
	</div>
</div>
