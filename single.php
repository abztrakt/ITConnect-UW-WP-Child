<?php get_header(); ?>
    <div id="wrap"> 
		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                    <div id="sidebar">
					    <?php dynamic_sidebar('news-sidebar'); ?>
                    </div>
                </div>

				<?php while ( have_posts() ) : the_post(); ?>
				
                <p id="mobile_image" class="span9 visible-phone" <?php custom_main_image();?>>
                    <span id='overlay'></span>
                    <span class='category'>
                    <?php $categories = get_the_category();
                    echo $categories[0]->cat_name;
                    ?>
                    </span>
                </p>
                <?php include('outages.php'); ?>
                <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span>All News</span></p>
				<div id='tertiary' class="span9">
					<span id="arrow-mark"></span>
						
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <h5 class="date"><?php echo get_the_date(); ?></h5>

						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
                        </header><!-- .entry-header -->
					
						<div class="media">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <span class='pull-left'>
                                <?php the_post_thumbnail(); ?>
                            </span>
                            <?php endif ?>
                            <div class='media-body'>
							    <?php the_content(); ?>
                            </div>
                        </div>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
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
        <div class="push"></div>
    </div><!-- #wrap -->
<?php get_footer(); ?>
