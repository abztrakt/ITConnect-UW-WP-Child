<?php get_header(); ?>


		<div id="primary">
			<div id="content" role="main" class="container">
			
						
			<div class="row show-grid">
				<div class="span8">
					
					
			<?php while ( have_posts() ) : the_post(); ?>

      <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>
				
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
					<h1 class="entry-title"><?php apply_filters('italics', get_the_title()); ?></h1>
				</header><!-- .entry-header -->
			
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->
                <p class="date"><?php the_date(); ?></p>
					<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
				</div>
				<div id="secondary" class="span4 right-bar" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
          <div id="sidebar">
          <?php if (is_active_sidebar('homepage-sidebar') && is_front_page()) : dynamic_sidebar('homepage-sidebar'); else: dynamic_sidebar('sidebar'); endif; ?>
          </div>
				</div>
 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
