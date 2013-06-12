<?php get_header(); ?>

    <div id="primary">
	    <div id="content" role="main" class="it_container clearfix">

			<div class="row">

				<div id="home_main" class="span9" <?php custom_main_image();?>>
                    <span id='overlay' class='visible-phone'></span>
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

        			<?php endwhile; // end of the loop.

                    $args = array(
                        'numberposts' => 12,
                        'order' => 'DESC',
                        'orderby' => 'post_date',
                    );
                    $postslist = get_posts( $args );
                    ?>

        			<div id="home_spotlight" class="hidden-phone">
                        <?php
                        $counter = 0;
                        $divcount = 0;
                        foreach ($postslist as $post):
                            if ($counter == 0): 
                            $divcount++;?>
                            <div class='spotlight' id='number<? echo $divcount; ?>'><?php endif;    
                                $counter++;
                                setup_postdata($post); ?>
                                <div class='spotlight_post'>
                                    <h5 class='home_date'><?php echo get_the_date(); ?></h5>
                                    <p class='post_title'><a href=<?php echo get_permalink(); ?>><?php the_title();?></a></p>
                                </div>
                            <?php if ($counter == 3): $counter = 0;?>
                            </div><?php endif;
                        endforeach; ?>
                        <?php if ($divcount > 1): ?>
                        <ul id='spotlight_paginator'>
                            <?php for ($looper = 1; $looper <= $divcount; $looper++): ?>
                            <li target='number<?php echo $looper; ?>'><div><div></div></div></li>
                            <?php endfor; ?>
                        </ul>
                        <?php endif ?>
        			</div>

				</div>
            </div>

            <div id="home_secondary" class="span3" role="complementary">
                <div class="stripe-top"></div><div class="stripe-bottom"></div>
                  <div class="home_sidebar" id="sidebar">
                  <?php if (is_active_sidebar('homepage-sidebar') && is_front_page()) : dynamic_sidebar('homepage-sidebar'); else: dynamic_sidebar('sidebar'); endif; ?>
                  </div>
            </div>

            <div id="home_tertiary" class="span9 visible-phone" style="background-color:#fff;">
                <h2>News</h2>
                <?php foreach ($postslist as $post) : setup_postdata($post); ?>
                <div class="media">
                    <h5 class="home_date"><?php echo get_the_date(); ?></h5>
                    <h3><a href=<?php echo get_permalink(); ?>><?php the_title();?></a></h3>
                </div>
            <?php endforeach; ?>
            </div>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>
