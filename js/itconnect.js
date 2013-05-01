(function(w){

    var sw = $(window).width(),
        sh = $(window).height(),
        breakpoint = 768,
        speed = 800,
        mobile = true;

	$(document).ready(function() {
		checkMobile();
        checkFrontPage();
	});

	$(w).resize(function(){ //Update dimensions on resize
		sw = $(window).width();
		sh = $(window).height();
		checkMobile();
	});

    //Checks to see if we're on the front page and starts the spotlight rotation if yes
    function checkFrontPage() {
        var spotlighted = $('#home_spotlight').children('.spotlight');
        if (spotlighted.length) {
            $(spotlighted[0]).addClass('active');
        }
        if (spotlighted.length > 1 ){
            var rotation = setInterval(function(){ rotate(spotlighted) }, 10000);
            $('#home_spotlight').hover(function(){
                rotation = clearInterval(rotation);
            }, function() {
                rotation = setInterval(function (){ rotate(spotlighted) }, 10000);
            });
        }
    }

    //rotates to the next spotlighted item in the home_spotlight
    function rotate(spotlighted) {
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
        $(spotlighted[activeindex]).fadeOut(function(){
            $(spotlighted[nextindex]).fadeIn(function(){
                $(spotlighted[nextindex]).addClass('active');
                $(spotlighted[activeindex]).removeClass('active')
            });
        });
    }

	//Check if Mobile
	function checkMobile() {
		mobile = (sw > breakpoint) ? false : true;
        
		if (mobile) { //mobile mode
           removeOpenDropdowns();
		}
        setImageWindowHeight();
		setOffCanvasHeight(mobile);
        checkNavbarWrap(mobile);
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

})(this);
