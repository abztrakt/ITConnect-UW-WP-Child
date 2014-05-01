<?php get_header(); ?>
    <div id="wrap">
        <div id="primary">
			<div id="content" class="it_container">


			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>
                      <div class="" id="sidebar" role="navigation" aria-label="Sidebar Menu">
                      <?php if (is_active_sidebar('homepage-sidebar') && is_front_page()) : dynamic_sidebar('homepage-sidebar'); else: dynamic_sidebar('sidebar'); endif; ?>
                      </div>
				</div>
			    <?php while ( have_posts() ) : the_post(); ?>
				<p id="mobile_image" class="span9 visible-phone" <?php custom_main_image();?>>
                    <span id='overlay'></span>
                    <span class='category'>
                    <?php $ancestor_list = array_reverse(get_post_ancestors($post->ID));
                    $is_top = false;
                    if (sizeof($ancestor_list) > 0) {
                        $top_parent = get_page($ancestor_list[0]);
                        echo get_the_title($top_parent);
                    }
                    else {
                        echo get_the_title();
                        $is_top = true;
                    }?>
                    </span>
                </p>
                <?php include('outages.php'); ?>
                <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span><?php if(!$is_top) { echo get_the_title(); }?></span></p>
				<div id='tertiary' class="span9">

      <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>

      <?php uw_breadcrumbs(); ?>
            <div id="main_content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title hidden-phone"><?php apply_filters('italics', get_the_title()); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) );
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    // prompt the user to log in and leave feedback if appropriate
                    if (is_plugin_active('document-feedback/document-feedback.php') && !is_user_logged_in()): ?>
                    <p id='feedback_prompt'><?php printf(__('<a href="%s">Log in</a> to leave feedback.'), wp_login_url( get_permalink() . '#document-feedback' ) ); ?></p>
                    <?php endif;?>
				</div><!-- .entry-content -->
                <div style="color:red; text-align:right;">Welcome to the gateway... <?php echo $_SERVER['REMOTE_USER']; ?>&nbsp;<span class="glyphicon glyphicon-user"></span></div>
                <?php
                    // Only do this work if we have everything we need to get to ServiceNow.
                    if ( defined('SN_USER') && defined('SN_PASS') && defined('SN_URL') ) {
                        $args = array(
                            'headers' => array(
                                'Authorization' => 'Basic ' . base64_encode( SN_USER . ':' . SN_PASS ),
                            )
                        );

                        $states = array(
                            "New" => 'class="label label-success"',
                            "Active" => 'class="label label-success"',
                            "Awaiting User Info" => 'class="label label-success"',
                            "Awaiting Tier 2 Info" => 'class="label label-success"',
                            "Awaiting Vendor Info" => 'class="label label-success"',
                            "Internal Review" => 'class="label label-success"',
                            "Stalled" => 'class="label label-success"',
                            "Delivered" => 'class="label label-success"',
                            "Resolved" => 'class="label label-default"',
                            "Closed" => 'class="label label-default"',
                        );
                        
                // Requests
                        $url = SN_URL . '/u_simple_requests_list.do?JSONv2&displayvalue=true&sysparm_query=state!=14^u_caller.user_name=' . $_SERVER['REMOTE_USER'];
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $JSON = json_decode( $body );
                        $ticketID = '5558958';
                        $paramurl = get_site_url() . "/itsm-detail";
                ?>
                    <a href="http://reeses.cac.washington.edu/itconnect/index.php?pagename=itsm-detail&ticketID=54893">Ticket Time</a>
                    <h2 style="margin-top:0;">My Requests</h2>
                    
                    <table class="table" style="font-size:.95em;">
                        <thead>
                        <tr>
                            <th style="width:80px;">Number</th>
                            <th style="width:160px;">Service</th>
                            <th>Description</th>
                            <th style="width:80px;">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                    foreach ( $JSON->records as $record ) {
                            
                            if ($record->state == "Resolved" || $record->state == "Closed") {
                                echo "<tr class='resolved_ticket'>";
                            } else {
                                echo "<tr>";
                            }
                    ?>
                            <td>
                                <?php
                                echo "<a href='asdklf'>$record->number</a>";
                                ?>
                            </td>
                            <td>
                                <?php
                                echo "$record->cmdb_ci";
                                ?>
                            </td>
                            <td>
                                <?php
                                echo "$record->short_description";
                                ?>
                            </td>
                            <td class="request_status">
                                <?php
                                    if (array_key_exists($record->state, $states)) {
                                        $class = $states[$record->state];
                                        echo "<span $class>$record->state</span>";
                                    } else {
                                        echo "<span>$record->state</span>";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                        </tbody>
                    </table>

                <?php

                // Incidents
                        $url = SN_URL . '/incident.do?JSONv2&displayvalue=true&sysparm_action=getRecords&sysparm_query=active=true^caller_id.user_name=' . $_SERVER['REMOTE_USER'];
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $JSON = json_decode( $body );
                ?>
                    <h2>My Incidents</h2>
                    
                    <table class="table" style="font-size:.95em;">
                        <thead>
                        <tr>
                            <th style="width:80px;">Number</th>
                            <th style="width:160px;">Service</th>
                            <th>Description</th>
                            <th style="width:80px;">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                    foreach ( $JSON->records as $record ) {
                        
                            if ($record->state == "Resolved" || $record->state == "Closed") {
                                echo "<tr class='resolved_ticket'>";
                            } else {
                                echo "<tr>";
                            }
                    ?>
                            <td>
                                <?php
                                echo "<a href='asdklf'>$record->number</a>";
                                ?>
                            </td>
                            <td>
                                <?php
                                echo "$record->cmdb_ci";
                                ?>
                            </td>

                            <td>
                                <?php
                                echo "$record->short_description";
                                ?>
                            </td>
                            <td class="incident_status">
                                <?php
                                    if (array_key_exists($record->state, $states)) {
                                        $class = $states[$record->state];
                                        echo "<span $class>$record->state</span>";
                                    } else {
                                        echo "<span>$record->state</span>";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                        </tbody>
                    </table>
                <?php } else {?>
                    <p>Whoops! Something went wrong, if this persists, please contact the Administrator.</p>
                <?php } ?>

				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			    <p id="last-modified-date">Last modified: <?php the_modified_date(); ?></p>
            </article><!-- #post-<?php the_ID(); ?> -->
          </div>
                

			<?php endwhile; // end of the loop. ?>
            
				</div>
 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->
        <div class="push"></div>
   </div><!-- #wrap -->
<?php get_footer(); ?>
