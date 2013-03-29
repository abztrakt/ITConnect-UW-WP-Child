<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                        <div id="sidebar">
                        <?php dynamic_sidebar('sidebar'); ?>
                        </div>
				    </div>
                    <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas glyphicon glyphicon-chevron-left glyphicon-white" data-toggle="offcanvas"></a>sample text</p>
				    <div id='tertiary' class="span9">
                        <?php uw_breadcrumbs(); ?>
                        <h1>News</h1>
				        <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>
								
			            <?php while ( have_posts() ) : the_post(); ?>
			            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    			            <div class="media">
                                <?php if ( has_post_thumbnail ) : ?>
                                <a class="pull-left" href="#">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <?php endif; ?>
                                <div class="media-body">
                                    <h5 class="home_date"><?php echo get_the_date(); ?></h5>
                                    <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                                    <?php the_content(); ?>
                                </div>
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
