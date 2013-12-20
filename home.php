<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                        <div id="sidebar">
                            <?php dynamic_sidebar('news-sidebar'); ?>
                        </div>

				    </div>
                    <p id="mobile_image" class="span9 visible-phone" <?php custom_main_image();?>>
                        <span id='overlay'></span>
                        <span class='category'>News</span>
                    </p>
                    <?php include('outages.php'); ?>
                    <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span>All</span></p>
				    <div id='tertiary' class="span9">
                        <?php uw_breadcrumbs(); ?>
                        <h1 class='hidden-phone news-title'>News</h1>
				        <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>
								
                        <?php 
                        $categories = get_categories('exclude=36'); 
                        $cat_ids = array();
                        foreach ($categories as $category) {
                            $cat_ids[] = $category->cat_ID;
                        }
                        
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
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
