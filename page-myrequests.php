<?php define( 'DONOTCACHEPAGE', True ); ?>
<?php get_header(); ?>
    <div id="wrap">
        <div id="primary">
			<div id="content" class="it_container">


			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>
                      <div class="" id="sidebar" role="navigation" aria-label="Sidebar Menu">
                      <?php dynamic_sidebar('servicenow-sidebar'); ?>
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
          if(isset($_SERVER['REMOTE_USER'])) {
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    // prompt the user to log in and leave feedback if appropriate
                    if (is_plugin_active('document-feedback/document-feedback.php') && !is_user_logged_in()): ?>
                    <p id='feedback_prompt'><?php printf(__('<a href="%s">Log in</a> to leave feedback.'), wp_login_url( get_permalink() . '#document-feedback' ) ); ?></p>
                    <?php endif;?>
				</div><!-- .entry-content -->
                <div style="text-align:right; color:#777; margin-bottom:2em;"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SERVER['REMOTE_USER']; ?></div>
                <?php
                    // Only do this work if we have everything we need to get to ServiceNow.
                    if ( defined('SN_USER') && defined('SN_PASS') && defined('SN_URL') ) {
                        $args = array(
                            'headers' => array(
                                'Authorization' => 'Basic ' . base64_encode( SN_USER . ':' . SN_PASS ),
                            )
                        );

                        $states = array(
                            "New" => 'label label-success',
                            "Active" => 'label label-success',
                            "Awaiting User Info" => 'label label-success',
                            "Awaiting Tier 2 Info" => 'label label-success',
                            "Awaiting Vendor Info" => 'label label-success',
                            "Internal Review" => 'label label-success',
                            "Stalled" => 'label label-success',
                            "Delivered" => 'label label-success',
                            "Resolved" => 'label label-default',
                            "Closed" => 'label label-default',
                        );

                        // Requests
                        $url = SN_URL . '/u_simple_requests_list.do?JSONv2&displayvalue=true&sysparm_query=state!=14^u_caller.user_name=' . $_SERVER['REMOTE_USER'];
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $req_json = json_decode( $body );
                        $has_req = FALSE;
                        if( !empty( $req_json->records ) ) {
                            $has_req = TRUE;
                        }

                        // Incidents
                        $url = SN_URL . '/incident.do?JSONv2&displayvalue=true&sysparm_action=getRecords&sysparm_query=active=true^caller_id.user_name=' . $_SERVER['REMOTE_USER'];
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $inc_json = json_decode( $body );
                        $has_inc = FALSE;
                        if( !empty( $inc_json->records ) ) {
                            $has_inc = TRUE;
                        }
                ?>

                    <?php if( $has_req || $has_inc ) { ?>
                    <h2 class="assistive-text">My Requests</h2>
                    <div class="row_underline">
                        <span class="span2 hidden-phone sn_number">Number</span>
                        <span class="span2 hidden-phone sn_service ">Service</span>
                        <span class="span3 sn_desc" id="header_desc">Description</span>
                        <span class="span2 sn_status">Status</span>
                    </div>
                    <?php } ?>

                    <?php if( $has_inc ) { ?>
                    <div class="assistive-text">
                        <span class="hidden-phone sn_number">Number</span>
                        <span class="hidden-phone sn_service">Service</span>
                        <span class="sn_desc">Description</span>
                        <span class="sn_status">Status</span>
                    </div>
                    <ol class="inner_request_list">
                    <?php
                    usort($inc_json->records, 'sortByUpdatedOnDesc');
                    foreach ( $inc_json->records as $record ) {
                        if ($record->state != "Resolved" && $record->state != "Awaiting User Info") {
                            $record->state = "Active";
                        }

                            $detail_url = site_url() . '/myrequest/' . $record->number;
                            if ($record->state == "Resolved" || $record->state == "Closed") {
                                echo "<li class='row_underline inner_row_underline resolved_ticket'>";
                            } else {
                                echo "<li class='row_underline inner_row_underline'><a href='$detail_url'>";
                            }
                    ?>
                            <span class="span2 hidden-phone whole_row_link">
                                <?php
                                    echo "$record->number";
                                ?>
                            </span>
                            <span class="span2 hidden-phone request_service whole_row_link">
                                <?php
                                echo "$record->cmdb_ci";
                                ?>
                            </span>

                            <span class="span3 request_desc whole_row_link">
                                <?php
                                echo "$record->short_description";
                                ?>
                            </span>
                            <span class="span2 incident_status whole_row_link">
                                <?php
                                    if (array_key_exists($record->state, $states)) {
                                        $class = $states[$record->state];
                                        echo "<span class='$class' style='width:auto;display:inline-block;line-height:15px;'>$record->state</span>";
                                    } else {
                                        echo "<span style='width:auto;display:inline-block;line-height:15px;'>$record->state</span>";
                                    }
                                ?>
                            </span>
                        </a></li>
                    <?php
                    }
                    ?>
                    </ol>
                    <?php } ?>

                    <?php if( $has_req ) { ?>
                    <ol class="inner_request_list">
                    <?php
                    
                    usort($req_json->records, 'sortByUpdatedOnDesc');
                    foreach ( $req_json->records as $record ) {

                            if ($record->state != "Resolved" && $record->state != "Awaiting User Info") {
                                $record->state = "Active";
                            }
                            if ($record->state == "Resolved" || $record->state == "Closed") {
                                echo "<li class='row_underline inner_row_underline resolved_ticket'>";
                            } else {
                                $detail_url = site_url() . '/myrequest/' . $record->number;
                                echo "<li class='row_underline inner_row_underline'><a href='$detail_url'>";
                            }
                    ?>
                            <span class="span2 hidden-phone whole_row_link">
                                <?php
                                echo "$record->number";
                                ?>
                            </span>
                            <span class="span2 hidden-phone request_service whole_row_link">
                                <?php
                                echo "$record->cmdb_ci";
                                ?>
                            </span>
                            <span class="span3 request_desc whole_row_link">
                                <?php
                                echo "$record->short_description";
                                ?>
                            </span>
                            <span class="span2 request_status whole_row_link">
                                <?php
                                    if (array_key_exists($record->state, $states)) {
                                        $class = $states[$record->state];
                                        echo "<span class='$class' style='width:auto;display:inline-block;line-height:15px;'>$record->state</span>";
                                    } else {
                                        echo "<span style='width:auto;display:inline-block;line-height:15px;'>$record->state</span>";
                                    }
                                ?>
                            </span>
                        </a></li>
                    <?php
                    }
                    ?>
                    </ol>

                    <?php } ?>

                    <?php if( $has_req || $has_inc ) { ?>
                    <h2 class="assistive-text">My Incidents</h2>
                    <?php } ?>

                    <?php if( !$has_req && !$has_inc ) { ?>
                        <p>You have no current requests with UW-IT.</p>
                    <?php } ?>

                <?php } else {?>
                    <p>Whoops! Something went wrong, if this persists, please contact the Administrator.</p>
                <?php }
                } else {
                    echo "<h3>Status 403: Unauthorized</h3>";
                    echo "<p>Please log into your UW NETID to view your list of Requests and Incidents</p>";
                }
                ?>
                <div style="margin-top:2em;">
                    <p>Not seeing your request?  You may need to login as a different UW NetID.</p>
                </div>
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
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
