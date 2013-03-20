<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row show-grid">
				<div id="secondary" class="span4 right-bar" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
          <div id="sidebar">
          <?php if (is_active_sidebar('homepage-sidebar')) : dynamic_sidebar('homepage-sidebar'); else: dynamic_sidebar('sidebar'); endif; ?>
          </div>
				</div>
				<div id='tertiary' class="span8">
                <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas">&nbsp;<i class="icon-chevron-left"></i></a></p>
                <?php uw_breadcrumbs(); ?>
                <h1>News</h1>
				<span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>
								
			<?php while ( have_posts() ) : the_post(); ?>

    			     <div class="media">
                        <?php if ( has_post_thumbnail ) : ?>
                        <a class="pull-left" href="#">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <?php endif; ?>
                        <div class="media-body">
                            <span class="home_date"><?php the_date(); ?></span>
                            <h3><?php the_title(); ?></h3>
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
