<?php wp_footer(); ?>
<?php $options = get_option('footer_options'); ?>
<div id="footerBG">
    <div id="footer-band"></div>
    <div id="footer" role="navigation" aria-label="Global Footer Menu">
        <div class="it_container">
        <div class='row'>
        <!--<?php uw_footer_menu(); ?>  Will want to use this, but for styling purposes, making flat HTML -->
            <div id='footer_links' class='col-xs-12 col-sm-12 col-md-8 col-lg-9'>
                <div id='footer_links_left' class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                    <table>
		      <tbody>
                        <tr>
                            <td>Online</td><td><a href='<?php echo $options['online'] ?>'>Contact form</a></td>
                        </tr>
                        <tr>
                            <td>Email</td><td><a href='mailto:<?= $options['email'] ?>'><?php echo $options['email']?></a></td>
                        </tr>
			<tr>
      <td>Phone</td><td><?php echo $options['phone']?></td>
			</tr>
		      </tbody>
                    </table>
                </div>
                <div id='footer_links_mid' class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                    <table>
		      <tbody>                                        
                        <tr>
                            <td>In-Person</td><td><a href='<?php echo $options['inperson_url'] ?>'><?php echo $options['inperson_text']?></a><br><p><?php echo $options['inperson_hours']?></p></td>
                        </tr>
			<tr>
			   <td>Services</td><td><a href='<?php echo $options['services_url'] ?>'>UW-IT Service Catalog</a></td>
			</tr>
		      </tbody>
                    </table>
                </div>
                <div id='footer_links_right' class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
		  <table class="table">
		   <tbody>		   
                      <td>Connect With Us</td>
		       <td><a href='<?php echo $options['twitter']?>'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/twitter25.png' class="footer-logo-link"> Twitter </a><br />
		         <a href='<?php echo $options['youtube']?>'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/youtube25.png' class="footer-logo-link"> YouTube </a>
			 </td> 
		   </tbody>
		  </table>
                </div>
            </div>
            <div id='footer_logo_container' class='col-xs-12 col-sm-12 col-md-4 col-lg-3'>
                <div class='wrapper'>
                    <a id='it_footer_logo' href='<?php echo get_site_url(); ?>'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/uwit_logo_la.png'></a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div id="footer-main" role="contentinfo">
  <div class="it_container">
      <div id="footer-right">
          <ul role="footer">
            <li><a href="http://www.washington.edu/home/siteinfo/form">Contact Us</a></li>
            <li><a href="http://www.washington.edu/jobs">Jobs</a></li>
            <li><a href="http://myuw.washington.edu/">My UW</a></li>
            <li><a href="http://bothell.washington.edu/">UW Bothell</a></li>
            <li><a href="http://tacoma.uw.edu/">UW Tacoma</a></li>
            <li><a href="http://www.washington.edu/admin/rules/wac/rulesindex.html">Rules Docket</a></li>
            <li><a href="http://www.washington.edu/online/privacy">Privacy</a></li>
            <li><a href="http://www.washington.edu/online/terms">Terms</a></li>
          </ul>
  </div> <!-- .container -->

  <div id="footer-left">

    <div class="it_container">
        <a href="http://www.washington.edu/">&copy; Copyright <?php echo date('Y'); ?> University of Washington. All rights reserved</a>
    </div>
  </div>

</div>

</body>
</html>
