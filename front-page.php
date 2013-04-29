<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="it_container clearfix">

			<div class="row">

				<div id="home_main" class="span9" <?php custom_homepage_image();?>>

        			<?php while ( have_posts() ) : the_post(); ?>

        			<span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>

        			<?php uw_breadcrumbs(); ?>

        			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        				<header class="entry-header hidden-desktop hidden-tablet">
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

        			     <div class="hide">
            			     <p class="date"><?php the_date(); ?></p>
            			     <p><?php comments_template( '', true ); ?></p>
        			     </div>

        			<?php endwhile; // end of the loop. ?>


        			<div id="home_spotlight" class="hidden-phone">
                        <h6>SPOTLIGHT</h6>
                        <?php
                        $array = array(
                            'numberposts' => 3,
                            'order' => 'ASC',
                            'orderby' => 'post_date',
                        );
                        $spotlightposts = get_posts( $array );
                        foreach ($spotlightposts as $spotlightpost):
                            setup_postdata($spotlightpost);
                            ?>
        			        <div class='spotlight'>
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endforeach; ?>
        			</div>

				</div>

				<div id="home_secondary" class="span3" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>
                      <div class="home_sidebar" id="sidebar">
                      <?php if (is_active_sidebar('homepage-sidebar') && is_front_page()) : dynamic_sidebar('homepage-sidebar'); else: dynamic_sidebar('sidebar'); endif; ?>
                      </div>
				</div>

				<div id="home_tertiary" class="span9" style="background-color:#fff;">
                <?php
                /* from http://codex.wordpress.org/Template_Tags/get_posts */
                $args = array ( 'numberposts' => 3, 'order' => 'ASC', 'orderby' => 'post_date');
                $postslist = get_posts( $args ); ?>
    			     <h2>News</h2>
                <?php foreach ($postslist as $post) : setup_postdata($post); ?>
    			     <div class="media">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <a class="pull-left" href="#">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <?php endif; ?>
                        <div class="media-body">
                            <h5 class="home_date"><?php echo get_the_date(); ?></h5>
                            <h3><?php the_title(); ?></h3>
                            <?php the_excerpt(); ?>
                        </div>
                     </div>
                <?php endforeach; ?>
   			    </div>

 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
