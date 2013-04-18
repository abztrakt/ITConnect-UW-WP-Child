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
                <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a>All</p>
				<div id='tertiary' class="span9">
					<span id="arrow-mark"></span>
						
					<?php while ( have_posts() ) : the_post(); ?>
				
						
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <h5 class="date"><?php echo get_the_date(); ?></h5>

						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						    <p></p>
                        </header><!-- .entry-header -->
					
						<div class="entry-content">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class='featured_container'>
                                    <div class='featured_image'>
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                </div>
                            <?php endif ?>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->
						<footer class="entry-meta">
              <?php the_tags('This article was posted under: ', ', ', '<br />'); ?> 
							<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link pull-right">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
					</article><!-- #post-<?php the_ID(); ?> -->
				
							<?php comments_template( '', true ); ?>
				
					<?php endwhile; // end of the loop. ?>
				</div>
 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_footer(); ?>
