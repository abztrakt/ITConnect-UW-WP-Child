  <nav id="access" role="navigation" aria-label="Main menu">
    <h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3> <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
    <div class="it_container">
        <div id="navbar-menu" class="navbar">
          <a class="btn btn-mini" id="help-button" href="<?php bloginfo('url'); ?>/help">Help &nbsp;?</a>
          <a class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".nav-collapse" title="Open Navigation" href="#menu" tabindex="0" role="button" aria-haspopup="true">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-inner">
            <span class="navbar-caret" style="position:absolute;"></span>
            <h3 class="visible-phone"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('title'); ?></a></h3>
            <?php uw_dropdowns(); ?>
          </div>
        </div>
    </div><!-- .container -->

  </nav><!-- #access -->
</header>
