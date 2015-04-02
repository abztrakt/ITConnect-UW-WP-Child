<?php get_header(); ?>
		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="col-xs-3 col-sm-3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                        <div id="sidebar">
                            <?php dynamic_sidebar('huskybytes-sidebar'); ?>
                        </div>
				    </div>
                    <p id="mobile_image" class="hidden-lg hidden-md hidden-sm" <?php custom_main_image();?>>
                        <span id='overlay'></span>
                        <span class='category'>HuskyBytes News</span>
                    </p>
                    <?php include('outages.php'); ?>
                    <p class="sidebar-menu hidden-lg hidden-md hidden-sm col-xs-3"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span><?php single_month_title(' '); ?></span></p>
				<div id='tertiary' class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <?php uw_breadcrumbs(); ?>
                    <h1 class='news-title hidden-phone'>HuskyBytes News
                    <?php 
                        $huskyCatID = get_cat_ID('HuskyBytes');
                        $rsslink = get_category_link($huskyCatID) . 'feed/atom';
                    ?>
                    <div id="atom">
                        <a title="Atom Feed" href="<?= $rsslink ?>">
                            <img alt="feed-icon" src="http://mozorg.cdn.mozilla.net/media/img/trademarks/feed-icon-14x14.png" />
                        </a>
                    </div>
                    </h1>
                    <h1 class='news-title hidden-xs'><?php single_month_title(' '); ?></h1>
				    <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>
								
                    <?php while ( have_posts() ) : the_post(); ?>
                   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="media">
                            <h5 class="home_date"><?php echo get_the_date(); ?>
                              <?php if( has_category('huskybytes')) {
                              ?>
                           <a href="<?php
                                $category = get_category_by_slug('huskybytes');
                                $the_id = $category -> cat_ID;
                                echo get_category_link($the_id);
                            ?>">
                            <?php 
                            $categories = wp_get_post_categories($post->ID);
                            if ( count($categories) == 1) { ?>
                                <span class="huskybytes">HuskyBytes</span></a>
                            <?php } 
                            }
                            ?>
                            </h5>
                            <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                            <?php if ( has_post_thumbnail() ) : ?>
                            <span class="pull-left" href="#">
                                <?php the_post_thumbnail(); ?>
                            </span>
                            <?php endif; ?>
                                <div class='media-body'>
                            <?php the_content(); ?>
                        </div>
            
                        <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                        </footer><!-- .entry-meta -->
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php comments_template( '', true ); ?>

			        <?php endwhile; // end of the loop. ?>

                    <?php uw_prev_next_links(); ?>

				</div>
 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
