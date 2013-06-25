<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="it_container">
			
						
			<div class="row row-offcanvas row-offcanvas-left">
				<div id="secondary" class="span3 sidebar-offcanvas" role="complementary">
				    <div class="stripe-top"></div><div class="stripe-bottom"></div>				
                    <div id="sidebar">
                        <?php dynamic_sidebar('search-sidebar');?>
                    </div>
				</div>
                <p id="mobile_image" class="span9 visible-phone" <?php custom_main_image();?>>
                    <span id='overlay'></span>
                    <span class='category'>Search</span>
                </p>
                <?php include('outages.php'); ?>
                <p class="pull-left visible-phone"><a href="#sidebar" class="btn btn-primary btn-offcanvas" data-toggle="offcanvas"></a><span>Results for "<?php the_search_query(); ?>"</span></p>
				<div id='tertiary' class="span9 search">
					<span id="arrow-mark"></span>
					
                    <h1 class='hidden-phone news-title'>Search results for "<?php the_search_query(); ?>"</h1>
                    <article>					
                    <div class="entry-content">
                        <script>
                            (function() {
                                var cx = '010209504661841798438:ftxszmyvenc';
                                var gcse = document.createElement('script');
                                gcse.type = 'text/javascript';
                                gcse.async = true;
                                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//www.google.com/cse/cse.js?cx=' + cx;
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(gcse, s);
                            })();
                        </script>
                        <gcse:search></gcse:search>    
                 
                    </div><!-- .entry-content -->
                    <article>

				</div>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
