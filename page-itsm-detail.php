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
                
                <?php
                    //Only do this work if we have everything we need to get to ServiceNow
                    if( defined('SN_USER') && defined('SN_PASS') && defined('SN_URL') ) {
                        $args = array(
                            'headers' => array(
                                'Authorization' => 'Basic ' . base64_encode( SN_USER . ':' . SN_PASS ),
                            )
                        );

                        $url = 'https://uweval.service-now.com/u_simple_requests_list.do?JSONv2&displayvalue=true&sysparm_query=number=REQ0001836';
                        $url = 'https://uwdev.service-now.com/incident.do?JSONv2&displayvalue=true&sysparm_query=number=INC0010980';
                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $JSON = json_decode( $body );
                        $record = $JSON->records[0];
                        
                        $idnum = get_query_var('ticketID');
                        echo "Ticket ID number: " . $idnum;
    
                        echo "<h2>$record->number : $record->short_description <span class='label label-success'>$record->state</span></h2>";
                                            
                        echo "<ul>";
                        echo "<li>caller: $record->caller_id</li>";
                        echo "<li>type: request (REQ) or incident (INC)</li>";
                        echo "<li>service: $record->cmdb_ci</li>";
                        echo "<li>short desc: $record->short_description</li>";
                        echo "<li>desc: $record->description</li>";
                        
                        echo "<li>opened on: $record->opened_at</li>";
                        echo "<li>last updated: $record->sys_updated_on</li>";
                
                        echo "</ul>";
                        
                        echo "<h2>Updates to your item <span style='font-size:12px;font-weight:normal;'>last updated: $record->sys_updated_on</span></h2>";
                        echo "
                        <div>$record->comments</div>
                        <div class='media' style='font-size:,95em;'>
                                <img class='media-object pull-left' src='http://placehold.it/50x50'>
                              <div class='media-body'>
                                <p><strong>You</strong><br/>
                                i need help with my ticket</p>
                              </div>
                          </div>
                          <div class='media'>
                                <img class='media-object pull-left' src='http://placehold.it/50x50'>
                              <div class='media-body'>
                                <p><strong>Bob Bobberson</strong><br/>
                                we are on it!</p>
                              </div>
                          </div>
                          <div class='media'>
                                <img class='media-object pull-left' src='http://placehold.it/50x50'>
                              <div class='media-body'>
                                <p><strong>You</strong><br/>
                                what is the status? this is taking so long!</p>
                              </div>
                          </div>
                          <div class='media'>
                                <img class='media-object pull-left' src='http://placehold.it/50x50'>
                              <div class='media-body'>
                                <p><strong>Tom Blankerson</strong><br/>
                                there is currently a broader issue. We expect things to be fixed within the hour!</p>
                              </div>
                          </div>
                          <form role='form'>
                            <div class='form-group' style='margin-bottom:1em;'>
                            <label for='exampleInputPassword1'>Comments</label>
                            <textarea class='form-control' rows='3'></textarea>
                            </div>
                          <button type='submit' class='btn btn-default'>Submit</button>
                          </form>
                              ";
                        
                        echo "<br/><br/><br/>";
                  
                        echo "DEBUG: ";
                        echo "<pre>";
                        var_dump($record);
                        echo "</pre>";
                    }
                ?>

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
