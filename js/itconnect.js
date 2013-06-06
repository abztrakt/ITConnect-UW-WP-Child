(function(w){

    var sw = $(window).width(),
        sh = $(window).height(),
        navbar_width,
        breakpoint = 768,
        speed = 800,
        mobile = true;


	$(document).ready(function() {
        navbar_width = $('.navbar').width(),
        mobile = checkMobile();
		if (mobile) { //mobile mode
            removeOpenDropdowns();
		}
        else {
            growTertiary();
            checkFrontPage();
        }
        fixDropdownOverrun();
        resetOffcanvasScroll();
        setImageWindowHeight();
        checkNavbarWrap(mobile);
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
            }
            else {
                growTertiary();
            }
            setImageWindowHeight();
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
        }
        if (spotlighted.length > 1 ){
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
            $(spotlighted[nextindex]).fadeIn(function(){
                $(spotlighted[nextindex]).addClass('active');
                $(spotlighted[activeindex]).removeClass('active');
            });
        });
    }

	//Check if Mobile
	function checkMobile() {
		return (sw >= breakpoint) ? false : true;
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

    function setImageWindowHeight() {
        
        //retooled to work with featured images, wherever they may be
        var imgdiv;
        if ($('.media').find('.pull-left').width()) {
            imgdiv = $('.media').find('.pull-left');
        }
        else {
            imgdiv = $('.featured_container').find('.featured_image');
        }

        var width = imgdiv.width();
        imgdiv.css({"max-height": width * 3 / 4 + 'px'});
    }
    
    function checkNavbarWrap() {
        $('.navbar.mobile').removeClass('mobile');
        if (($('.navbar').height() > 50 ) && (!mobile)) {
            $('.navbar').addClass('mobile');
        }
    }

    function fixDropdownOverrun() {
        $('#menu-main > li').hover(function() {
            var dropdown = $(this).children('ul');
            var container = $('#menu-main');
            if (dropdown.length != 0) {     //menu items might not have dropdowns
                if ((dropdown.outerWidth() + $(this).position().left + dropdown.position().left) > (container.outerWidth() + container.position().left)){
                    dropdown.css('left',  ($(this).outerWidth() - dropdown.outerWidth()) + 'px');
                }
            }
        });
    }

})(this);
