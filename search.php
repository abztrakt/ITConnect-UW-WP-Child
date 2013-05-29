<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
				    <div class="stripe-top"></div><div class="stripe-bottom"></div>				
                    <div id="sidebar">
                        <?php dynamic_sidebar('sidebar');?>
                    </div>
				</div>
                <p id="mobile_image" class="span9 visible-phone" <?php custom_main_image();?>>
                    <span id='overlay'></span>
                    <span class='category'>News</span>
                </p>
                <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span>All</span></p>
				<div id='tertiary' class="span9 search">
					<span id="arrow-mark"></span>
					
                    <h1>Search results: <?php the_search_query(); ?></h1>
					
                    <?php if (have_posts() ): while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        </header><!-- .entry-header -->
            
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
                        </div><!-- .entry-content -->
                        <footer class="entry-meta">
                            <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                        </footer><!-- .entry-meta -->
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php comments_template( '', true ); ?>

                    <?php endwhile; else : ?>

                    No results found.
              
                    <?php endif; ?>

                    <?php uw_prev_next_links(); ?>

				</div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
