  <nav id="access" class="navbar navbar-default" role="navigation" aria-label="Main menu">
    <h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3> <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
    <div class="it_container">
        <div id="navbar-menu">
          <a class="btn btn-xs" id="help-button" href="<?php bloginfo('url'); ?>/help">Need Help?</a>
          
          <a class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".nav-collapse" title="Open Navigation" href="#menu" tabindex="0" role="button" aria-haspopup="true">
          <!--TODO: THIS IS IN THE NEW SYTAX NOW
          <a class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" title="Open Navigation" href="#menu" tabindex="0" role="button" aria-haspopup="true">-->
          
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
        </div>
        
        
          <div class="navbar-inner">
            <span class="navbar-caret" style="position:absolute;"></span>
            <h3 class="visible-xs"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('title'); ?></a></h3>
            
          </div>
          
          <?php uw_dropdowns(); ?>
          
          
    </div><!-- .container -->

  </nav><!-- #access -->
  

    <!-- FOR THE uw_dropdowns() function -->
    <!-- TODO: PUT THE UW DROPDOWN NAVIGATION IN THE NEW BOOTSTRAP SYNTAX 
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    </div>--->
    
    

    
</header>
