<?php wp_footer(); ?>

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
                            <td>Online</td><td><a href='#'>Contact form</a></td>
                        </tr>
                        <tr>
                            <td>Email</td><td><a href='mailto:help@uw.edu'>help@uw.edu</a></td>
                        </tr>
                    </table>
                </div>
                <div id='footer_links_mid' class='span4'>
                    <table>
                        <tr>
                            <td>Phone</td><td>206-221-5000</td>
                        </tr>
                        <tr>
                            <td>In-Person</td><td>UW Tower, C-3000 M-F, 9-8</td>
                        </tr>
                    </table>
                </div>
                <div id='footer_links_right' class='span4'>
                    <table>
                        <tr>
                            <td><a href='/uwtscat'>Service Catalog</a></td>
                        </tr>
                        <tr>
                            <td><a href='#'>UW-IT Service Contact List</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id='footer_logo_container' class='span3'>
                <div class='wrapper'>
                    <a id='it_footer_logo' href='/itconnect'></a>
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
