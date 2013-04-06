<?php wp_footer(); ?>

<div id="footerBG">
    <div id="footer" role="navigation" aira-label="Global Footer Menu">
        <div class="it_container">
        <div class='row'>
        <!--<?php uw_footer_menu(); ?>  Will want to use this, but for styling purposes, making flat HTML -->
            <div class='hidden-phone span3'>
                <div id='footer_logo_wrapper'>
                    <a id='it_footer_logo' href='/itconnect'></a>
                </div>
            </div>
            <div id='footer_links' class='row span9'>
                <h4>Need Help?</h4>
                <div id='footer_links_left' class='span6'>
                    <h5>General Questions</h5>
                    <table>
                        <tr>
                            <td>Online</td><td><a href='#'>Fill out a form</a></td>
                        </tr>
                        <tr>
                            <td>Email</td><td><a href='mailto:help@uw.edu'>help@uw.edu</a></td>
                        </tr>
                        <tr>
                            <td>Phone</td><td>206-221-5000</td>
                        </tr>
                        <tr>
                            <td>In-Person</td><td>UW-IT Service Center is at C-3000 in the UW Tower</td>
                        </tr>
                    </table>
                </div>
                <div id='footer_links_right' class='span6'>
                    <h5>Specific IT Services</h5>
                    <table>
                        <tr>
                            <td>Contact list</td><td><a href='#'>Contact Information for all UW-IT services</a></td>
                        </tr>
                        <tr>
                            <td>Service Catalog</td><td><a href='/uwtscat'>Descriptions of all UW-IT services, categorized and sorted</a></td>
                        </tr>
                    </table>
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
        <a href="http://www.washington.edu/">&copy; <?php echo date('Y'); ?> University of Washington. All rights reserved</a>
    </div>
  </div>

</div>


</body>
</html>
