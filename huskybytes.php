<?php
/*
Template Name Posts: HuskyBytes
*/
?>

<?php get_header(); ?>
    <div id="wrap"> 
		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="col-sm-3 col-xs-3 sidebar-offcanvas" role="complementary">
					<div class="stripe-top"></div><div class="stripe-bottom"></div>				
                    <div id="sidebar">
					    <?php dynamic_sidebar('huskybytes-sidebar'); ?>
                    </div>
                </div>

				<?php while ( have_posts() ) : the_post(); ?>
				
                <p id="mobile_image" class="hidden-lg hidden-md hidden-sm" <?php custom_main_image();?>>
                    <span id='overlay'></span>
                    <span class='category'>
                    <?php $categories = get_the_category();
                    echo $categories[0]->cat_name;
                    ?>
                    </span>
                </p>
                <?php include('outages.php'); ?>
                <p class="sidebar-menu hidden-lg hidden-md hidden-sm col-xs-3"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span>All News</span></p>
				<div id='tertiary' class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<span id="arrow-mark"></span>
						
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <h5 class="date"><?php echo get_the_date(); ?>
                        <?php if( has_category('HuskyBytes')) { ?>
                           <a href="<?php
                                $the_id = get_cat_ID('HuskyBytes');
                                echo get_category_link($the_id);
                            ?>"> <span class="huskybytes">HuskyBytes</span></a>
                            <?php } ?>
  
                        </h5>
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
