  <div id="search">
    <form role="search" class="main-search" action="http://www.washington.edu/search" id="searchbox_008816504494047979142:bpbdkw8tbqc" name="form1">
      <span class="wfield">
        <input value="008816504494047979142:bpbdkw8tbqc" name="cx" type="hidden">
        <input value="FORID:0" name="cof" type="hidden">
        <label for="q" class="hide">Search the UW</label>
        <input id="q" class="wTextInput" title="Search ITConnect" name="q" type="text" autocomplete="off">
        <input id="search-go" value="Go" name="sa" class="formbutton" type="submit">  
        </span>
    </form>	

    <span class="search-toggle"></span>
    <div class="search-options">
      <?php if ( strpos( home_url(),'search') == false ): ?>
      <label class="radio">
        <input type="radio" name="search-toggle" value="site" data-site="<?php echo home_url('/'); ?>" data-placeholder="<?php bloginfo() ?>" checked="checked"/>
        This site
      </label>
      <?php endif; ?>
      <label class="radio">
        <input type="radio" name="search-toggle" value="main" data-placeholder="the UW">
        UW.edu
      </label>
      <label class="radio">
        <input type="radio" name="search-toggle" value="directory" data-placeholder="the Directory"/>
        UW Directory
      </label>

      <span class="search-options-notch"></span>
    </div>

    <!--div class="search-flash">
      <h6>Tip: Click the notch for search options</h6>
      <span class="search-options-notch"></span>
    </div-->
