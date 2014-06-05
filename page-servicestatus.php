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
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    // prompt the user to log in and leave feedback if appropriate
                    if (is_plugin_active('document-feedback/document-feedback.php') && !is_user_logged_in()): ?>
                    <p id='feedback_prompt'><?php printf(__('<a href="%s">Log in</a> to leave feedback.'), wp_login_url( get_permalink() . '#document-feedback' ) ); ?></p>
                    <?php endif;?>
				</div><!-- .entry-content -->

				<?php
                    // Only do this work if we have everything we need to get to ServiceNow.
                    if ( defined('SN_USER') && defined('SN_PASS') && defined('SN_URL') ) {
                        $args = array(
                            'headers' => array(
                                'Authorization' => 'Basic ' . base64_encode( SN_USER . ':' . SN_PASS ),
                            ),
                            'timeout' => 15,
                        );
                        // All active, Medium and High Impacted Incidents
                        $url = SN_URL . '/incident_list.do?JSONv2&sysparm_query=active=true%5Eimpact%3D2%5EORimpact%3D1%5EORDERBYcmdb_ci&displayvalue=true';

                        $response = wp_remote_get( $url, $args );
                        $body = wp_remote_retrieve_body( $response );
                        $JSON = json_decode( $body );
                ?>
                    
                            

                <?php 
                if(!$body) {
                    echo "<div class='alert alert-warning' style='margin-top:2em;'>We are currently experiencing problems retrieving the status of our services. Please try again in a few minutes.</div>";
                }
                elseif(empty($JSON->records)) { 
                    echo "<div class='alert alert-warning' style='margin-top:2em;'>All services are operational.</div>";
                } ?>
                
                 
                    <?php
                        $sn_data = array();
                        foreach( $JSON->records as $record ) {
                            if( !isset( $sn_data[$record->cmdb_ci] ) ) {
                                $sn_data[$record->cmdb_ci] = array();
                            }
                            $sn_data[$record->cmdb_ci][] = $record;
                        }
                    ?>

                    <?php
                        
                        echo "<h2 class='assistive-text' id='impact_headeing'>Impacted Services</h2>";
                    
                    $ci_cats = array();
                    foreach( $JSON->records as $record ) {
                        array_push($ci_cats, $record->u_cmdb_ci_class_category);
                    }
                    $unique_ci_cats = array_unique($ci_cats);
                    foreach ( $unique_ci_cats as $ci_cat ) {
                        echo "<h3>$ci_cat</h3>";
                        echo "<ol style='list-style:none;padding-left:0;margin-left:0;' aria-labelledby='impact_heading'>";
                        foreach( $sn_data as $ci) {
                            $service = array_search($ci, $sn_data);
                            if ( end($ci)->u_cmdb_ci_class_category == $ci_cat ) {
                                // handle the case of blank services
                                if ($service !== '' ) {
                                    echo "<li>$service</li>";
                                }
                            }
                        }
                        echo "</ol>";
                    } 
                        echo "<p class='alert alert-info' style='margin-top: 2em;'>Experiencing problems not listed on this page? Need more information about a service impact? <a href='/itconnect/help'>Get help.</a></p>";
                        
                        //echo "DEBUG: ";
                        //echo "<pre>";
                        //var_dump($sn_data);
                        //echo "</pre>";
                }
                    ?>
                
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
