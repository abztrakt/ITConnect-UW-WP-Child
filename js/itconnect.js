(function(w){

    var sw = $(window).width(),
        sh = $(window).height(),
        navbar_width,
        breakpoint = 768,
        speed = 800,
        mobile = true;
        executing_rotation = false;


	$(document).ready(function() { 
        navbar_width = $('.navbar').width(),
        mobile = checkMobile();
		if (mobile) { //mobile mode
            removeOpenDropdowns();
            ie7Oddities();
		}
        else {
            growTertiary();
            checkFrontPage();
        }
        fixDropdownOverrun();
        resetOffcanvasScroll();
        checkNavbarWrap(mobile);
        checkEmptyWidgets();
        $(".sort").tablesorter();
	});

    $(function() {
        $('#atom').tooltip({ 
            position: { my: "left top", at: "left bottom" },  
        }); 
    }); 

	$(w).resize(function(){ //Update dimensions on resize
       var width_resize = (sw != $(window).width());
       var height_resize = (sh != $(window).height());
       if (width_resize || height_resize){
           sw = $(window).width();
           sh = $(window).height();
            clearTertiaryStyles();
            mobile = checkMobile();
            if (mobile) { //mobile mode
                removeOpenDropdowns();
                ie7Oddities();
            }
            else {
                if ($('#home_spotlight .spotlight.active').length == 0) {
                    checkFrontPage();
                }
                growTertiary();
            }
            if (navbar_width != $('.navbar').width()) {
                navbar_width = $('.navbar').width(),
                checkNavbarWrap(mobile);
            }
        }
	});

    //Checks to see if we're on the front page and starts the spotlight rotation if yes
    function checkFrontPage() {
        var spotlighted = $('#home_spotlight').children('.spotlight');
        var paginators = $('#spotlight_paginator').children('li');
        if (spotlighted.length) {
            $(spotlighted[0]).addClass('active');
            $(paginators[0]).addClass('active');
            fixOnelineSpotlightPosts();
        }
        if (spotlighted.length > 1 ){
            setUpPagination(paginators);
            var rotation = setInterval(function(){ rotate(spotlighted, paginators) }, 10000);
            $('#home_spotlight').hover(function(){
                rotation = clearInterval(rotation);
            }, function() {
                rotation = setInterval(function (){ rotate(spotlighted, paginators) }, 10000);
            });
        }
    }

    //rotates to the next spotlighted item in the home_spotlight
    function rotate(spotlighted, paginators) {
        executing_rotation = true;
        var activeindex;
        for (var index = 0; index < spotlighted.length; index++) {
            if ($(spotlighted[index]).hasClass('active')) {
                activeindex = index;
            }
        }
        var nextindex;
        if (activeindex == (spotlighted.length -1)) {
            nextindex = 0;
        }
        else {
            nextindex = activeindex + 1;
        }
        $(paginators[nextindex]).addClass('active');
        $(paginators[activeindex]).removeClass('active');
        $(spotlighted[activeindex]).fadeOut(function(){
            $(spotlighted[activeindex]).removeClass('active');
            $(spotlighted[nextindex]).addClass('active');
            fixOnelineSpotlightPosts();
            $(spotlighted[nextindex]).removeClass('active');
            $(spotlighted[nextindex]).fadeIn(function(){
                $(spotlighted[nextindex]).addClass('active');
                executing_rotation = false;
            });
        });
    }

    //sets up the click event handlers for the spotlight box pagination
    function setUpPagination(paginators) {
        var paginator_target;
        var old_active_spotlight;
        for (var count = 0; count < paginators.length; count++) {
            $(paginators[count]).click(function () {
                if (window.executing_rotation) {
                    return;
                }
                executing_rotation = true;
                paginator_target = $(this).attr('target');
                if (!$(this).hasClass('active')){
                    old_active_spotlight = $('#home_spotlight').find('.spotlight.active');
                    new_active_spotlight = $('#' + paginator_target);
                    $('#spotlight_paginator').find('li.active').removeClass('active');
                    $(this).addClass('active');
                    old_active_spotlight.fadeOut(function () {
                        old_active_spotlight.removeClass('active');
                        new_active_spotlight.addClass('active');
                        fixOnelineSpotlightPosts();
                        new_active_spotlight.removeClass('active');
                        new_active_spotlight.fadeIn(function () {
                            new_active_spotlight.addClass('active');
                            executing_rotation = false;
                        });
                    });
                }
                else {
                    executing_rotation = false;
                }
            });
        }
    }

	//Check if Mobile
	function checkMobile() {
    //Fix for differences in media query and javascript widths in browsers
    //Checks for IE8 lower that does not support matchMedia
      if ($.support.leadingWhitespace && window.matchMedia) {
        mq = window.matchMedia("(min-width: 768px)");
        return !mq.matches;
      } else {
        return (sw >= breakpoint) ? false : true;
      }
	}

    function resetOffcanvasScroll() {
        if (!($('.row-offcanvas-left').hasClass('active'))){
            /*  The click event is for desktop and screen readers, touchstart for touch devices */
            $('.btn-offcanvas').click(function(e) {
                $('.sidebar-offcanvas').scrollTop(0);
            });
            $('.btn-offcanvas').on('touchstart', function() {
                $('.sidebar-offcanvas').scrollTop(0);
            });
        }
    }

    function removeOpenDropdowns() {
        $('.dropdown-menu').removeClass('open');
    }

    function clearTertiaryStyles() {
        $('#tertiary').removeAttr('style');
    }

    function growTertiary() {
        var containerHeight = $('div.row.row-offcanvas').height() + 'px';
        $('#tertiary').css("min-height", containerHeight);
    }

    function checkNavbarWrap() {
        
        $('.navbar.mobile').removeClass('mobile');
        
        /**** TODO: Fix this logic. It's tied to the height of the banner and this is not ideal
        if (($('.navbar').height() > 50 ) && (!mobile)) {
            $('.navbar').addClass('mobile');
        }
        ****/
    }

    function fixDropdownOverrun() {
        var fixCurrentOverrun = function() {
            var theli = $(this).parent('li');
            var dropdown = theli.children('ul');
            var container = $('#menu-main');
            if (dropdown.length != 0) {     //menu items might not have dropdowns
                if ((dropdown.outerWidth() + theli.position().left + dropdown.position().left) > (container.outerWidth() + container.position().left)){
                    dropdown.css('left',  ($(this).outerWidth() - dropdown.outerWidth()) + 'px');
                }
            }
        }
        $('#menu-main > li').children('a').hover(fixCurrentOverrun).focus(fixCurrentOverrun);
    }

    function fixOnelineSpotlightPosts() {
        var posts = $('#home_spotlight .spotlight.active').find('.post_title');
        for (var index = 0, length = posts.length; index < length; index++) {
            if ($(posts[index]).height() == 21){
                $(posts[index]).addClass('oneline');
            }
        }
    }

    function checkEmptyWidgets() {
        var widgets = $('#sidebar .widget'), text_widget;
        for (var count = 0, length = widgets.length; count < length; count++){
            text_widget = $(widgets[count]).find('div');
            if (text_widget.hasClass('textwidget')) {
                lists = $(text_widget).find('ul');
                if (lists.length == 0) {
                    $(widgets[count]).find('h2.widgettitle').hide();
                }
            }
        }
    }

    function ie7Oddities() {
        $('#ie7 .btn-offcanvas').click( function() {
        //offcanvas works, but all text disappears until another animation occurs
        //this kills the sidebar on mobile IE7 so users can't break the site
            return false;
        });
    }
})(this);
