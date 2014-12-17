jQuery(document).ready(function($){

  // footer links
  $("[href='http://#']").click(function() {
    return false; 
  })
  //prevent ios nav bar from popping down
  $('[href=#]').removeAttr('href'); 
  $('table').addClass('table') //for bootstrap 

    /*
     * UW Alert Banner
     */
    var data = {
      number:1,
      type:'post',
      status:'publish'
    }

    var alert_url =  window.location.hash.indexOf('alert') === -1 ? 
          'https://www.washington.edu/static/UW-Alert-Banner/alert/?c=?' :
          'https://www.washington.edu/static/UW-Alert-Banner/alert/?test=true&c=?';

    $.getJSON(alert_url, data,
        function(res){
          if ( !res || res.found < 1)
            return;
          
          var post  = res.posts[0]
            , cats  = post.categories
            , slugs = []
            , css   = ''

          var colors = ['red', 'orange', 'blue', 'steel'];

          $.each(cats, function(i,val) {
            slugs += '|'+val.slug
          })
          for (var i = 0; i < colors.length; i += 1) {
            if(slugs.indexOf(colors[i]) != -1 ) {
              css = 'uwalert-'+colors[i].toLowerCase();
            }
          };

          if ( window.location.hash.indexOf('alert') != -1 )
            css = window.location.hash.replace('#','')

          if( css.length === 0 ){
            return false;
          }

          var anchor  = $('<a/>').attr({'href': 'http://emergency.uw.edu', 'title':post.title}).html('More info')
            , excerpt = $(post.excerpt.replace(' [...]','')).append( ' ' ).append( anchor.prop('outerHTML') ).prop('outerHTML')
            , html    = $('<div id="uwalert-alert-message" class="'+css+'" />')
                          .html('<div><h1>'+post.title+'</h1>'+excerpt+'</div>')
            , adjust  = $('body').hasClass('admin-bar') ? $('#wpadminbar').height() : 0;

          $('body')
            .prepend(html)
            .data('alert-height', $('#uwalert-alert-message').outerHeight() + adjust )

          var mini = $('<a id="alert-mini" class="hidden-phone"/>')
                        .attr({href:'#',title:post.title})
                        .click(function() {
                          $('body').data('scrolling',true).animate({scrollTop:0}, {duration:500, easing:'swing', complete:function() {$('body').data('scrolling',false)}})
                          $(this).slideUp()
                          return false;
                        }).html('Campus Alert: '+post.title).addClass(css)

          $('body').append(mini)
            .addClass('uw-alert')

        }
      );


    /**
     * Header weather widget
     
      var data = {
        q:'http://www.atmos.washington.edu/rss/home.rss',
        v:'2.0'
      }
      $.ajax({
        url: 'https://ajax.googleapis.com/ajax/services/feed/load?callback=?',
        dataType: 'jsonp',
        data: data,
        success: function(json) { 
          var icon = $.trim(json.responseData.feed.entries[2].title.split('|')[1]);
          var weat = $.trim(json.responseData.feed.entries[1].title.split('|')[1]);
          var temp = $.trim(json.responseData.feed.entries[0].title.split('|')[1]);
          var html = '<li class="header-weather"><a href="http://www.atmos.washington.edu/weather/forecast/" title="Forecast is '+weat+'">';
          html += '<img src="//uw.edu/news/wp-content/themes/uw/img/weather/top-nav/'+icon+'.png" alt="Forecast is '+weat+'"/>';
          html += '</a></li>';
          html += '<li class="header-forcast"><a href="http://www.atmos.washington.edu/weather/forecast/">';
          html += 'Seattle '+temp;
          html += '</a></li>';
          $('#thin-strip').find('ul').append(html)
        }
      });
    */



  var lip = $('#lip'),
      linkRotator = $('#linkRotator'),
      ul = linkRotator.find('ul').first(),
      linkImage = $('#linkArrowIcon'),
      topnav = $('#thin-strip'),
      search = $('#search form'),
      links = linkImage.attr('src'),
      closeImage = $('#menuClose');

	ul.hide();
	linkImage.click(function(){
	    ul.show();
		var height = (linkRotator.height() != 0) ? 0 : ul.outerHeight();
		linkImage.addClass('hideLinkAnchor').one('webkitTransitionEnd', function() {
			  linkRotator.toggleClass('rotateLip').css('height', height);
		});
		return false;
	});
	
	closeImage.click(function(){
		if (linkRotator.height() != 0){
			linkRotator.css('height', 0).one('webkitTransitionEnd', function() {				
				ul.hide();
				linkImage.removeClass('hideLinkAnchor');
			});
		} 
		return false;
	});


  $('#q').on('focus', function() {
    window.scrollTo(0,0)
  })

  if ( $(window).width() < 768 ) {
    search.css('visibility','hidden')
    topnav.css('visibility','hidden')
  }

  $('body').on('touchstart click', '#searchicon-wrapper, #listicon-wrapper', function() {
    var $this = $(this)
      , $nav  = [search, topnav]
      , ismenu = $this.is('#listicon-wrapper') 

    if ( ismenu ) {
      $nav.reverse();
    }
    else {
      if ($('#search').css('height') == '0px'){
        $('#search').css('height', 'auto');
      }
      else {                                        // else statement added by Jon S
        $('#ie7 #search').css('height', '0px');     // fixes IE7 mobile search bar height
      }
    }

    search.find('input.wTextInput').blur()

    var height = $nav[0].data('open') ? 0 : 
                 ismenu ? 340 : 45;

    $nav[0]
      .css('visibility', 'visible')
      .height(height)
      .data('open',!$nav[0].data('open'))

    $nav[1]
      .height(0)
      .data('open', false )

    // Toggle title Show/Hide text 
    $this.attr('title', $this.attr('title').indexOf('Show') ===  -1 ? 
                          $this.attr('title').replace('Hide', 'Show') :
                          $this.attr('title').replace('Show', 'Hide') )

    // if search is clicked
    if ( !ismenu && search.data('open')) {
     // search.find('input.wTextInput').focus()
      window.scrollTo(0,0)
    }

    return false; 

  }).on('transitionend webkitTransitionEnd mozTransitionEnd oTransitionEnd', '#thin-strip, form.main-search', function(e) {

    var $this = $(this)

    //if ( !$this.data('open') && !$this.height() && $this.not('.thin-fixed'))
      //$this.css('visibility','hidden')

  })

});

jQuery(window).load(function() {

  // hide mobile safari url bar unless the url has a hash/anchor
  if ( ! window.location.hash.length ) {
    setTimeout(function(){
        window.scrollTo(0,0);
    }, 0);
  }
  /**
   * Header Strip
   */
  var $thin    = $('#thin-strip')
      , strip  = $thin.clone().removeAttr('style').addClass('thin-fixed').removeClass('top-fixed')
      , search = $('#search form')
      , win    = $(window)
      , bod    = $('body')
      

    bod.append(strip.hide())
    strip.data('otop',bod.hasClass('top'))
    win.bind('scroll', function() {

      var top    = $(this).scrollTop()
        , pos = bod.hasClass('admin-bar') ? 28 : 0
        , adjust = bod.data('alert-height') || pos
        , $mini = $('#alert-mini')

      if ( $(this).width() < 768 )
        return false

      if ( top < 180 + adjust){
        strip.css('top',-28).hide().data('showing',false)
        $mini.hide()
      }

      if ( top > 220 + adjust && !strip.data('showing') ) {
        strip.show().animate({top:strip.data('otop')+pos},{duration:300, easing:'swing'}).data('showing',true)
      }

      if ( $mini.length != 0 && !bod.data('scrolling') )
      {
        if ( top < 300 + adjust)
          $mini.slideUp()

        if ( top > 330 + adjust)
          $mini.slideDown()
      }
    });

/*
 * On-page links
 */

    window.onhashchange = function() {
        if( $('body').hasClass('admin-bar')) {
            window.scrollBy(0, -60);
        } else {
            window.scrollBy(0, -30);
        }
    }
/*
 * Dropdowns
 */

  var calculate_dropdowns = function() {
    $('.dropdown-menu').each(function() {
      var $this  = $(this) 
        , $items = $this.find('li')
        //, width  = height = 0 unnecessary local variables

      /* set number of columns based on number of items in menu */
      if (($items.length > 7) && ($items.length <= 14)) {
        $this.addClass('twocolumn');
      }
      else if ($items.length > 14) {
        $this.addClass('threecolumn');
      }

      /*  with the removal of local var width from executed code, we must also remove this, which isn't used
      $this.find('.menu-block').filter(function() {
        return width += $(this).outerWidth()
      }) */

      /* left postition shift handled on a per-class (one for each number of columns) basis in the css
      var shift  = $this.parent().position().left + width - 980
         , height = $items.length < 7 ?  $this.height() : 240  no need to define height here

      $this.css({
        width: width+1, +1 for IE...
        left: shift > 0 ? -1*shift : 0
      }).data('height',height)  no need to set height here  */
    })
  }
  calculate_dropdowns();

  //$('div.nav-collapse').children('.nav').attr('role','menubar')

/* disable the submenu clicks so links actually work.
    Brought this back and made it so none of the code runs under our 768px mobile breakpoint  -Jon */
  $('.dropdown')
    .mouseenter(function(e) {
    
      if ($(window).width() >= 768) {
        /*if ( e.type === 'mouseenter' && $(window).width() < 979 ) 
          return false;  blocks dropdowns below 979 (but not mobile somehow) */
         
        var $this   = $(this)
          , $ul     = $this.children('.dropdown-menu')

          $ul.addClass('open').attr('aria-hidden','false')
          $ul.parent('li').addClass('child_open');          //by Jon: add psuedo hover class
            //.height($ul.data('height'))  unnecessary reset to 'height'

        $('span.navbar-caret').css('left', $this.position().left + 20 ).hide().fadeIn(100);
      }

    }).mouseleave(function() {

      if ($(window).width() >= 768) {
        /*if ( $(window).width() < 979 ) 
          return false; */
         
        var $this   = $(this)
          , $ul     = $this.children('.dropdown-menu')

          $ul.removeClass('open').attr('aria-hidden','true')
          $ul.parent('li').removeClass('child_open');       //by Jon: remove psuedo hover class
            //.height(0) no need to set height back to 0, removing open should do it.

        $('span.navbar-caret').stop().hide()
      }

    }).click(function(e) {

      if ($(window).width() >= 768) {
        if ( $(window).width() < 979 )  {

          var $this   = $(this)
            , $ul     = $this.children('.dropdown-menu')
            , $a      = $this.children('a')
            , height  = $ul.data('height') == 0 ? $ul.find('li').length * 35 : $ul.data('height')

        if ( $ul.hasClass('open') ) {
          document.location.href = $(e.target).attr('href')
        } else {
          window.scrollTo(0,0)
            $('.dropdown-menu').removeClass('open')//.height(0) another unnecessary reset to 0
            $('#menu-main > li').removeClass('child_open');     //by Jon: remove psuedo hover class
            $ul.addClass('open').attr('aria-hidden','false')
            $ul.parent('li').addClass('child_open');            //by Jon: add psuedo hover class
              //.height(height) unnecessary
        }

          return false;
        }
      }
    
    })


  $('body').on('keydown.dropdown', 'ul.dropdown-menu a', function(e) {
    
      if (e.altKey || e.ctrlKey)
        return true;

      var keys     = {enter:13, esc:27, tab:9, left:37, up:38, right:39, down:40, spacebar:32 }
        , $this    = $(this)
        , $anchors = $this.closest('ul').find('a')
        , clearMenus = function() { 
          $('.dropdown-menu').removeClass('open').attr('aria-hidden','true');
          $('#menu-main > li').removeClass('child_open');     //by Jon: remove psuedo hover class
          $('span.navbar-caret').hide();
        }

      switch(e.keyCode) {

        case keys.spacebar:
          document.location.href = $this.attr('href');
          return false;

        case keys.tab:
          clearMenus();
          return true;

        case keys.esc:
          $this.blur().closest('ul').siblings('a').focus();
          clearMenus();
          return true;

        case keys.down:
          var index = $anchors.index($this)
          //fix last anchor to circle focus back to first anchor
          index = index === $anchors.length-1 ? -1 : index; 
          $anchors.eq(index+1).focus();
          return false;

        case keys.up:
          var index = $anchors.index($this)
          $anchors.eq(index-1).focus();
          return false;

        case keys.left:
          $this.blur().closest('ul').siblings('a').focus();
          clearMenus();
          return false;

        case keys.right:
          $this.blur().closest('ul').parent().next('li').children('a').focus();
          clearMenus();
          return false;

        default:
          var chr = String.fromCharCode(e.which)
            , exists = false;
          $anchors.filter(function() {
            exists = this.innerHTML.charAt(0) === chr
            return exists;
          }).first().focus();
          return !exists;
    
      }
    
    }).on('keydown.dropdown', 'a.dropdown-toggle', function(e) {

      if (e.altKey || e.ctrlKey)
        return true;

      var keys     = {enter:13, esc:27, tab:9, left:37, up:38, right:39, down:40, spacebar:32 }
        , $this = $(this)
        , $ul   = $this.siblings('ul')
        , $anchors = $('a.dropdown-toggle')
        , clearMenus = function() { 
          $('.dropdown-menu').removeClass('open').attr('aria-hidden','true');
          $('#menu-main > li').removeClass('child_open');     //by Jon: remove psuedo hover class
          $('span.navbar-caret').hide();
        }

      switch(e.keyCode) {
        case keys.enter:
          $ul.addClass('open').attr('aria-hidden','false')
              .find('a').first().focus()
          $ul.parent('li').addClass('child_open');            //by Jon: add psuedo hover class to parent
          $('span.navbar-caret').css('left', $this.parent().position().left + 20 ).show();
          return true;

        case keys.spacebar:
        case keys.up:
        case keys.down:
          var fake_event = jQuery.Event( 'keydown', { keyCode: keys.enter } );
          $this.trigger(fake_event);
          return false;

        case keys.esc:
          clearMenus();
          return false;

        case keys.tab:
          clearMenus();
          return true;
        
        case keys.left:
          var index = $anchors.index($this)
          $anchors.eq(index-1).focus()
          return false;

        case keys.right:
          var index = $anchors.index($this)
          //fix last anchor to circle focus back to first anchor
          index = index === $anchors.length-1 ? -1 : index; 
          $anchors.eq(index+1).focus()
          return false;

        default:
          return true;
      }
  
    });


    $('[data-toggle=collapse]').click(function() {

      var $this   = $(this)
        , $target = $($this.data('target'))

      $target.stop().slideToggle().toggleClass('open');

      return false;
    })

    /*
     * Sidebar menu setup
     */
      $('#sidebar').find('.menu').children('li').each(function() {
      
        var $this = $(this)
          , $lis  = $this.find('li')
          , width = Math.ceil($lis.length/10)


        if (  width > 0 ) {
          $this.children('ul').first().width(width* 200)
          for ( var i =0; i < $lis.length; i+=10 ) {
            $lis.slice(i,i+10).wrapAll('<ul class="pull-left" style="width:200px"/>')
          };
        }
      }).end().end()
      .on('click', 'a', function() {
        var $this = $(this)
          , width = $(window).width() 
        
        if ( width > 767 || 
             !$this.siblings('ul').length ||
             $this.siblings('ul').hasClass('open') )
          return true;


        $this.closest('ul').find('ul.sub-menu').removeClass('open').end().end()
          .siblings('ul').toggleClass('open')


        return false;

      })


  /*
   * Responsive
   */
  $(window).resize(function() {
    var w = $(this).width();
    /*if ( w > 979 ) {
      $('div.nav-collapse').show().find('.dropdown-menu').removeClass('open')
      calculate_dropdowns()
    } else if ( w > 767 ) {*/
    if (w > 767) {
      search.removeAttr('style'); 
      $thin.removeAttr('style');
      strip.css('visibility','visible');
      $('div.nav-collapse').removeAttr('style').find('.dropdown-menu').removeClass('open').removeAttr('style');
      $('#search').removeAttr('style');
    }
  })

});

/** 'enhanced'-search (dev) **/
$(document).ready(function() {
  var $inputs  = $('#search ').find('input[type=radio]')
    , soptions = $('.search-options')
    , $toggle  = $('.search-toggle')
    , $flash   = $('.search-flash')
    , $q = $('#q')
    , ie = $.browser.msie //$('[id^=ie]')

  $inputs.removeAttr('checked').first().attr('checked', true)
  
  $q.addClass('gcsb');

  $q.change(function() {
    if ( $q.val() == "" ) {
        if ( $inputs.filter(':checked').val() != "directory" ) {
            $q.addClass('gcsb');
        }
    } else {
        $q.removeClass('gcsb');
    }
  });

  $inputs.change(function() {
    var str = 'Search ' + $(this).data('placeholder')
    if ( $(this).data('placeholder') == 'the Directory' ) {
        $q.prop('placeholder', str).attr('placeholder', str);
        $q.removeClass('gcsb');
    } else {
        $q.prop('placeholder', '');
        if ( $q.val() == "" ) {
            $q.addClass('gcsb');
        }
    }

    if ( ie ) $q.val(str)
    if ( typeof _gaq !== 'undefined' ) _gaq.push(['_trackEvent', 'Enhanced Search', 'Options',  str ]);
  })

  $toggle.click(function() {
    if ( typeof _gaq !== 'undefined' ) _gaq.push(['_trackEvent', 'Enhanced Search', 'Toggle',  soptions.is(':hidden') ? 'Open' : 'Close' ]);

    if ( !ie ) $q.css('width', soptions.is(':hidden') ?  '225px' : '' )
    $(this).toggleClass('close-toggle')
    soptions.fadeToggle()
  })

  $('#search form').submit(function() {
    var $this  = $(this)
      , $input = $inputs.filter(':checked')
      , method = $input.val()

    if ( typeof _gaq !== 'undefined' ) _gaq.push(['_trackEvent', 'Enhanced Search', 'Search',  method.charAt(0).toUpperCase() + method.slice(1) ]);

    if ( method === 'main' )
      return true;

    if ( method === 'directory') {
      window.location.href = 'http://www.washington.edu/home/peopledir/?method=name&whichdir=both&term=' + $q.val()
      return false;
    }

    if ( method === 'site') {
      window.location.href = $input.data('site') + '?s=' + $q.val()
      return false;
    }
    return true; //all else fails, just go to the normal search
  })

  $('#q').one('focus', function() {
    $toggle.fadeIn();
    //$flash.fadeIn().delay(2000).fadeOut()
    //soptions.fadeIn();
    if ( typeof _gaq !== 'undefined' ) _gaq.push(['_trackEvent', 'Enhanced Search','Focus',$(this).attr('placeholder')]);
  })

})
