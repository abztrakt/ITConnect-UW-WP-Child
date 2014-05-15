<?php get_header(); ?>
		<div id="primary">
			<div id="content" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                        <div id="sidebar" role="navigation" aria-label="Sidebar Menu">
                        <?php dynamic_sidebar('news-sidebar'); ?>
                        </div>

				    </div>
                    <p id="mobile_image" class="col-xs-9 visible-xs" <?php custom_main_image();?>>
                        <span id='overlay'></span>
                        <span class='category'>News</span>
                    </p>
                    <?php include('outages.php'); ?>
                    <p class="pull-left visible-xs"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span>All</span></p>
				    <div id='tertiary' class="col-xs-9">
                        <?php uw_breadcrumbs(); ?>
                        <div id="main_content" role="main">
                        <h1 class='hidden-phone news-title'>News
                        <?php
                            $cat_id = get_cat_ID('HuskyBytes');
                            $categories = get_categories('exclude=' . $cat_id);
                            $cat_ids = array();
                            $allcatsxhus = $categories[1]->cat_ID;
                            foreach ($categories as $category) {
                                $cat_ids[] = $category->cat_ID;
                                if ($category != $categories[1]) {
                                    $allcatsxhus = $allcatsxhus . ',' . $category->cat_ID;
                                }
                            }
                            $current_page = get_query_var('paged');
                            if ($current_page == 0) {
                                $current_category = get_query_var('cat');
                                $rsslink = get_category_link($current_category) . 'feed/atom?cat=' . $allcatsxhus;
                        ?>
                        <div id="atom" >
                             <a title="Atom Feed" href="<?= $rsslink ?>">
                                <img alt="feed-icon" src="http://mozorg.cdn.mozilla.net/media/img/trademarks/feed-icon-14x14.png">
                             </a>
                         </div>
                         <?php
                            }
                        ?>
                        </h1>
				        <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>
								
                        <?php
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $args = array(
                            'posts_per_page' => 10,
                            'paged' => $paged,
                            'category__in' => $cat_ids
                        );
                        $query = new WP_Query ( $args );

                        while ( $query->have_posts() ) : $query->the_post(); ?>
                       
			            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    			            <div class="media">
                                <h5 class="home_date"><?php echo get_the_date(); ?></h5>
                                <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                                <?php if ( has_post_thumbnail() ) : ?>
                                <span class="pull-left" href="#">
                                    <?php the_post_thumbnail(); ?>
                                </span>
                                <?php endif; ?>
                                <div class='media-body'>
                                    <?php the_content(); ?>
                                </div>
                            </div>
				
				            <footer class="entry-meta">
					        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				            </footer><!-- .entry-meta -->
			            </article><!-- #post-<?php the_ID(); ?> -->
                        
					    <?php comments_template( '', true ); ?>

			            <?php endwhile; // end of the loop. ?>

                        <?php custom_prev_next_links(); ?>

                        <?php wp_reset_postdata(); ?>

				    </div>
 			    </div>
                </div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
