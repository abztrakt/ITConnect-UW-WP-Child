<?php
    $sn_num = get_query_var('ticketID');
    if( $sn_num == '' ) {
        $new_url = site_url() . '/tickets/';
        wp_redirect( $new_url );
    }

    if( isset( $_POST['submitted'] ) && isset( $_POST['comments'] ) ) {
        $comments = $_POST['comments'];
        $comments_json = array(
            'actor' => $_SERVER['REMOTE_USER'],
            'record' => $sn_num,
            'comment' => $comments,
        );
        $comments_json = json_encode( $comments_json );
        $comments_url = SN_URL . '/comment.do';

        // If a POST and have comments - create a comment in SN
        if( defined('SN_USER') && defined('SN_PASS') && defined('SN_URL') ) {
            $args = array(
                'headers' => array(
                    'Authorization' => 'Basic ' . base64_encode( SN_USER . ':' . SN_PASS ),
                ),
                'body' => $comments_json,
            );
        }

        $response = wp_remote_post( $comments_url, $args );
    }
?>

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
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    // prompt the user to log in and leave feedback if appropriate
                    if (is_plugin_active('document-feedback/document-feedback.php') && !is_user_logged_in()): ?>
                    <p id='feedback_prompt'><?php printf(__('<a href="%s">Log in</a> to leave feedback.'), wp_login_url( get_permalink() . '#document-feedback' ) ); ?></p>
                    <?php endif;?>
				</div><!-- .entry-content -->

                <?php
                if( isset( $response ) ) {
                    $status = json_decode($response['body'], true);
                    if( $status['Error']['Status'] !== '200' ) {
                        echo '<div class="alert alert-warning" style="margin-top:2em;">';
                        echo 'Attention! Your comment could not be posted: ' . $status['Error']['Text'] . ' (' . $status['Error']['Status'] . ')';
                        echo '</div>';
                    }
                }
                ?>

                <?php
                    //Only do this work if we have everything we need to get to ServiceNow
                    //TODO: this work is repeated above, this should be refactored so we don't do that
                    if( defined('SN_USER') && defined('SN_PASS') && defined('SN_URL') ) {
                        $args = array(
                            'headers' => array(
                                'Authorization' => 'Basic ' . base64_encode( SN_USER . ':' . SN_PASS ),
                            )
                        );

                        $sn_type = substr($sn_num, 0, 3);
                        if( $sn_type == 'REQ' ) {
                            $url = SN_URL . '/u_simple_requests_list.do?JSONv2&displayvalue=true&sysparm_query=number=' . $sn_num . '^u_caller.user_name=' . $_SERVER['REMOTE_USER'];
                            $sn_type = 'request (REQ)';
                        } else if( $sn_type == 'INC' ) {
                            $url = SN_URL . '/incident.do?JSONv2&displayvalue=true&sysparm_query=number=' . $sn_num . '^caller_id.user_name=' . $_SERVER['REMOTE_USER'];
                            $sn_type = 'incident (INC)';
                        } else {
                            echo "Unrecognized type";
                        }
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $JSON = json_decode( $body );
                        $record = $JSON->records[0];

                        // Get the comments
                        $url = SN_URL . '/sys_journal_field.do?displayvalue=true&JSONv2&sysparm_cation=getRecords&sysparm_query=active=true^element=comments^element_id=' . $record->sys_id;
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $JSON = json_decode( $body );
                        $comments = $JSON->records;

                        if ($sn_num !== $record->number) {
                            echo "I'm sorry this is not one of your $sn_type<br><br>";
                        } else  {
                        echo "<h2>$record->number : $record->short_description <span class='label label-success'>$record->state</span></h2>";
                        echo "<table class='table table-striped table-bordered'>";
                        if( !empty( $record->caller_id ) ) {
                            $caller = $record->caller_id;
                        } else if( !empty( $record->u_caller ) ) {
                            $caller = $record->u_caller;
                        } else {
                            $caller = 'UNKNOWN';
                        }
                        echo "<tr><td>Caller:</td> <td>$caller</td></tr>";
                        echo "<tr><td>Type:</td> <td>$sn_type</td></tr>";
                        echo "<tr><td>Service:</td> <td>$record->cmdb_ci</td></tr>";
                        echo "<tr><td>Short Description:</td> <td>$record->short_description</td></tr>";
                        echo "<tr><td>Description:</td> <td>$record->description</td></tr>";
                        echo "<tr><td>Opened on:</td> <td>$record->opened_at</td></tr>";
                        echo "<tr><td>Last Updated:</td> <td>$record->sys_updated_on</td></tr>";
                        echo "</table>";
                        echo "<h2>Updates to your $sn_type <span style='font-size:12px;font-weight:normal;'>last updated: $record->sys_updated_on</span></h2>";

                        usort( $comments, 'sortByCreatedOnDesc' );
                        foreach( $comments as $comment ) {
                            echo "<div class='media'>";
                            echo "<div class='media-body'>";
                            echo "<p><strong>$comment->sys_created_by</strong> $comment->sys_created_on</p>";
                            echo "<pre>";
                            echo $comment->value;
                            echo "</pre>";
                            echo "</div>";
                            echo "</div>";
                        }

                        echo "<br/><br/><br/>";

                        } //end if else to see if incident/request number doesn't match
                    }
                ?>

                <?php $submit_url = site_url() . '/itsm-detail/' . $sn_num . '/'; ?>
                  <form role='form' action="<?php $submit_url; ?>" method='post'>
                    <div class='form-group' style='margin-bottom:1em;'>
                    <label for='exampleInputPassword1'>Comments</label>
                    <textarea name='comments' class='form-control' rows='3'></textarea>
                    </div>
                    <button type='submit' class='btn btn-default'>Submit</button>
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                  </form>

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
