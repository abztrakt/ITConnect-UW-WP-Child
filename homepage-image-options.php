<?php
function homepage_image_options_menu() {
	add_theme_page( 'Homepage Image', 'Homepage Image', 'administrator', 'homepage_image',	'homepage_image_options_html'		);
} 
add_action( 'admin_menu', 'homepage_image_options_menu' );

function homepage_image_initialize_options() {

	// If the theme options don't exist, create them.
	if( get_option( 'homepage_image' ) == false ) {
		add_option( 'homepage_image' );
	} // end if

	// First, we register a section. This is necessary since all future options must belong to a
	add_settings_section(
		'homepage_image_section',			    // ID used to identify this section and register options
		'Change Homepage Image',				// Title for the admin page
		'homepage_image_section_callback',	    // Callback used to render the description of the section
		'homepage_image'		                // Page on which to add this section of options
	);

	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(
		'choose_homepage_image',				// ID used to identify the field throughout the theme
		'Select an image',				            // The label to the left of the option interface element
		'homepage_image_upload_callback',	    // The name of the function responsible for rendering the option interface
		'homepage_image',	                    // The page on which this option will be displayed
		'homepage_image_section'			    // The name of the section to which this field belongs
	);

	// Finally, we register the fields with WordPress
	register_setting( 'homepage_image', 'homepage_image', 'homepage_image_validation' );

} 
add_action('admin_init', 'homepage_image_initialize_options');

function homepage_image_section_callback() {
	echo '<pChoose the homepage image</p>';
}


function homepage_image_validation($input) 
{
  $options = (array) get_option('homepage_image');

  if ( isset($_POST['remove_homepage_image']) &&
        is_numeric($_POST['homepage_image_attachment_id'])) {
          $id = $_POST['homepage_image_attachment_id'];
          wp_delete_attachment($id, true);
  } else {
    $input['homepage_image']['custom'] = $options['homepage_image']['custom'];
  }

  if ( $_FILES['homepage_image'] && $_FILES['homepage_image']['size'] > 0 ) 
  {
      include_once(ABSPATH . '/wp-admin/includes/media.php');
      include_once(ABSPATH . '/wp-admin/includes/file.php');
      include_once(ABSPATH . '/wp-admin/includes/image.php');

      $overrides = array('test_form' => false); 
      $file = wp_handle_upload($_FILES['homepage_image'], $overrides);
      $attachment = array(
                      'post_mime_type' => $file['type'],
                      'post_title' => 'Homepage Image',
                      'post_content' => '',
                      'post_status' => 'inherit'
                  );
      
      $attachment_id = wp_insert_attachment( $attachment, $file['file'] );

      if ( !isset($file['error'])) {
        unset($file['file']); //dont need absolute path
        $file['id'] = $attachment_id;
        $input['homepage_image']['custom'] = $file;
      } 
  }


  return $input;
}

/**** The function for uploading a new image ****/

function homepage_image_upload_callback() {
	$options = (array) get_option('homepage_image');
  if( isset($options['homepage_image']['custom'])) {
    $html = '<input type="hidden" id="homepage_image_upload" name="homepage_image_attachment_id" value="' . $options['homepage_image']['custom']['id'] .'" data-url="'. $options['homepage_image']['custom']['url'] .'"/>';
    submit_button( __( 'Remove current (use default)' ), 'button', 'remove_homepage_image', false );
  } else {
	  $html = '<input type="file" name="homepage_image" /><p class="help">'._('The image should be over 500px tall, but less than 2MB.  A well-compressed 500K image is ideal').'</p>';
  }
	echo $html;
}

function homepage_image_options_html() {
?>
	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>
		<h2>Homepage Image Swapper</h2>
		<?php settings_errors();?>

		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields( 'homepage_image' ); ?>
			<?php do_settings_sections( 'homepage_image' ); ?>
			<?php submit_button(); ?>
		</form>

        <?php
        if (is_custom_homepage_image()) {?>
            <div style="width:70%; margin:auto;">
                <div <?php custom_homepage_image(); ?>>
                    <p style="height:400px; color:white;">Current custom image</p>
                </div>
            </div>
        <?}?>

	</div>
<?php
} 

?>
