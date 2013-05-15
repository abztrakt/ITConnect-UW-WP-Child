(function(w){

    var sw = $(window).width(),
        sh = $(window).height(),
        breakpoint = 768,
        speed = 800,
        mobile = true;

	$(document).ready(function() {
		checkMobile();
        fixDropdownOverrun();
	});

	$(w).resize(function(){ //Update dimensions on resize
		sw = $(window).width();
		sh = $(window).height();
		checkMobile();
	});

	//Check if Mobile
	function checkMobile() {
		mobile = (sw >= breakpoint) ? false : true;
        
		if (mobile) { //mobile mode
           removeOpenDropdowns();
		}
        setImageWindowHeight();
		setOffCanvasHeight(mobile);
        checkNavbarWrap();
	}

	function setOffCanvasHeight(mobile) {

    	// set the offcanvas (sidebar) height equal to the content for now... for mobile, might want to do something sweet
    	// like setting it to the height of the viewport (i.e. facebook)
        $("#sidebar").height('auto');
        if (!mobile) {
    	    var contentH = $("#content").height();
    	    $("#sidebar").height(contentH);
        }

	}

    function removeOpenDropdowns() {
        $('.dropdown-menu').removeClass('open');
    }

    function setImageWindowHeight() {
        
        //retooled to work with featured images, wherever they may be
        var imgdiv;
        if ($('.media .pull-left').width()) {
            imgdiv = $('.media .pull-left');
        }
        else {
            imgdiv = $('.featured_container .featured_image');
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
