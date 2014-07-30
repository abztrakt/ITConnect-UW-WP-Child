<?php wp_footer(); ?>
<?php $options = get_option('footer_options'); ?>
<div id="footerBG">
    <div id="footer-band"></div>
    <div id="footer" role="navigation" aira-label="Global Footer Menu">
        <div class="it_container">
        <div class='row'>
        <!--<?php uw_footer_menu(); ?>  Will want to use this, but for styling purposes, making flat HTML -->
            <div id='footer_links' class='span9'>
                <div id='footer_links_left' class='span4'>
                    <table>
                        <tr>
                            <td>Online</td><td><a href='<?php echo get_site_url();?>/it-connect-home/question'><?= $options['online'] ?></a></td>
                        </tr>
                        <tr>
                            <td>Email</td><td><a href='mailto:<?= $options['email'] ?>'><?= $options['email'] ?></a></td>
                        </tr>
                    </table>
                </div>
                <div id='footer_links_mid' class='span4'>
                    <table>
                        <tr>
                            <td>Phone</td><td><?= $options['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>In-Person</td><td><?= $options['inperson'] ?></td>
                        </tr>
                    </table>
                </div>
                <div id='footer_links_right' class='span4'>
                    <p><a href='http://depts.washington.edu/uwtscat'>Service Catalog</a></p>
                    <p><a href='http://depts.washington.edu/uwtscat/views/contactlist'>UW-IT Service Contact List</a></p>
                </div>
            </div>
            <div id='footer_logo_container' class='span3'>
                <div class='wrapper'>
                    <a id='it_footer_logo' href='<?php echo get_site_url(); ?>'><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/uwit_logo_la.png'></a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div id="footer-main" role="footer">
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
