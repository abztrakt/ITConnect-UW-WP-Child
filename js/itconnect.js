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
