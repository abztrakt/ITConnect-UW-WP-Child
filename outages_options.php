<?php
function outages_options_menu() {
  add_theme_page('Outages', 'Outages', 'administrator', 'outages', 'outages_options_html');
}
add_action('admin_menu', 'outages_options_menu');

function outages_initialize_options() {

    if( get_option('outages') == false ) {
        add_option('outages');
    }

    add_settings_section(
        'outages_section',
        '',
        'outages_section_callback',
        'outages'
    );

    add_settings_field(
        'choose_outages',
        'Display outages alert?',
        'choose_outages_callback',
        'outages',
        'outages_section'
    );

    register_setting('outages', 'outages');
}

add_action('admin_init', 'outages_initialize_options');

function outages_section_callback() {
    return;
}

function choose_outages_callback() {
    $options = get_option('outages');

    if ($options == 'yes') {
        $html = '<input type="radio" name="outages" value="yes" checked> Yes <br><input type="radio" name="outages" value="no"> No <br>';
    } else {
        $html = '<input type="radio" name="outages" value="yes"> Yes <br><input type="radio" name="outages" value="no" checked> No <br>';
    }

    echo $html;
}

function outages_options_html() {
?>
	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>
		<h2>Outages Alert Display</h2>
		<?php
        if ( function_exists( 'wp_cache_clear_cache' ) ) {
            $settings_message = settings_errors();
            if($settings_message = "Settings saved.") {
                wp_cache_clear_cache();
            }
        }
        settings_errors();
        ?>

        <p>The outages alert simply links to the outages page at this time. It should not be displayed unless there are outages in effect</p>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields( 'outages' ); ?>
			<?php do_settings_sections( 'outages' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
} 

?>
