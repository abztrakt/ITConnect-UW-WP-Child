<?php get_header(); ?>

		<div id="primary">
			<div id="content" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                        <div id="sidebar" role="navigation" aria-label="Sidebar Menu">
                        <?php dynamic_sidebar('news-sidebar'); ?>
                        </div>
				    </div>
                    <p id="mobile_image" class="span9 visible-phone" <?php custom_main_image();?>>
                        <span id='overlay'></span>
                        <span class='category'>News Archives</span>
                    </p>
                    <?php include('outages.php'); ?>
                    <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span><?php single_month_title(' '); single_cat_title(); ?></span></p>
				<div id='tertiary' class="span9">
                    <?php uw_breadcrumbs(); ?>
                    <div id="main_content" role="main">
                    <h1 class='news-title hidden-phone'><?php single_month_title(' '); single_cat_title(); ?>
		<?php
                     $current_page = get_query_var('paged');
                     if ($current_page == 0) {
                         $current_category = get_query_var('cat');
                         $rsslink = get_category_link($current_category) . 'feed/atom';
                ?>
		<div id="atom" >
                        <a title="Atom Feed" href="<?= $rsslink ?>">
                                <img alt="feed-icon" src="http://mozorg.cdn.mozilla.net/media/img/trademarks/feed-icon-14x14.png">       
                        </a>
                </div>
                <?php
                    }
                ?>
		</h1>
		   <span id="arrow-mark" <?php the_blogroll_banner_style(); ?> ></span>								
                    <?php while ( have_posts() ) : the_post(); ?>
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
            
                        <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                        </footer><!-- .entry-meta -->
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php comments_template( '', true ); ?>

			        <?php endwhile; // end of the loop. ?>

                    <?php uw_prev_next_links(); ?>

				</div>
                </div>
 			 </div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
