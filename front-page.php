<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="container clearfix">

			<div class="row">

				<div id="home_main" class="span9">

        			<?php while ( have_posts() ) : the_post(); ?>

        			<span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>

        			<?php uw_breadcrumbs(); ?>

        			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        				<header class="entry-header">
        					<h1 class="entry-title"><?php apply_filters('italics', get_the_title()); ?></h1>
        				</header><!-- .entry-header -->

        				<div class="entry-content hidden-phone">
        					<?php the_content(); ?>
        					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
        				</div><!-- .entry-content -->
        				<footer class="entry-meta">
        					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
        				</footer><!-- .entry-meta -->
        			</article><!-- #post-<?php the_ID(); ?> -->

        			     <div class="hidden-phone">
            			     <p class="date"><?php the_date(); ?></p>
            			     <p><?php comments_template( '', true ); ?></p>
        			     </div>

        			<?php endwhile; // end of the loop. ?>

				</div>

				<div id="home_secondary" class="span3" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>
                      <div class="" id="sidebar">
                      <?php if (is_active_sidebar('homepage-sidebar') && is_front_page()) : dynamic_sidebar('homepage-sidebar'); else: dynamic_sidebar('sidebar'); endif; ?>
                      </div>
				</div>

				<div id="home_tertiary" class="span9" style="background-color:#fff;">
    			     <h2>News</h2>
    			     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam a ipsum lorem, in pulvinar risus. Suspendisse id pretium diam. Praesent suscipit mauris eget dolor laoreet hendrerit. In sit amet lacus in orci interdum gravida. Integer vitae massa massa. In pellentesque faucibus imperdiet. Phasellus justo urna, sagittis non pulvinar ac, sollicitudin at massa. Fusce nec massa dolor, eget blandit ipsum.</p>
    			 </div>

 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
