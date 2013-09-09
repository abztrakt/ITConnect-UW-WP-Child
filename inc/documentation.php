<?php
// Create the function to output the contents of our Dashboard Widget

function itc_add_documentation_dashboard_widget() {

	global $wp_meta_boxes;
  
	wp_add_dashboard_widget('itc-documentation', 'Documentation and FAQs', 'itc_documentation_html');	

  $wp_meta_boxes['dashboard']['side']['core']['itc-documentation'] =
     $wp_meta_boxes['dashboard']['normal']['core']['itc-documentation'];
  unset($wp_meta_boxes['dashboard']['normal']['core']['itc-documentation']);
  
  remove_meta_box( 'uw-documentation', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  
} 

add_action('wp_dashboard_setup', 'itc_add_documentation_dashboard_widget' ); 

function itc_documentation_html() 
{
  ?>

	<div class="wrap">

    <p>
      <h2>Top Tutorials</h2>
      <ul class="shortcode-blogroll">
        <li>  <a target="_blank" href="http://www.washington.edu/marketing/2013/04/08/embed-video/">Embed video</a>
      </ul>
      Looking for something else? Browse all Web Team <a href="http://www.washington.edu/marketing/web-design/wordpress-theme/documentation/">WordPress documentation</a>.
    </p>

    <p>
      <h2>Documentation</h2>
      <ul>
        <li> <a href="http://www.washington.edu/itconnect/manager/">IT Connect Documentation</a> </li>
      </ul>
    </p>

    <p>
      <h2>Stuck?</h2>
      If you need guidance on something not found in our <a href="http://www.washington.edu/itconnect/manager/">documentation</a> or the <a href="http://codex.wordpress.org/Main_Page">WordPress Codex</a>, please contact <a href="mailto:itconnect@uw.edu">itconnect@uw.edu</a>.
    </p>

	</div>
  
<?php
}
