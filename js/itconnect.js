(function(w){

    var sw = $(window).width(),
        sh = $(window).height(),
        breakpoint = 768,
        speed = 800,
        mobile = true;

	$(document).ready(function() {
		checkMobile();
	});

    $(window).load(function() {
        $('.btn-offcanvas').click(function() {
            if ($('.btn-offcanvas').hasClass('glyphicon-chevron-left')) {
                $('.btn-offcanvas').removeClass('glyphicon-chevron-left');
                $('.btn-offcanvas').addClass('glyphicon-remove-circle');
            }
            else {
                $('.btn-offcanvas').addClass('glyphicon-chevron-left');
                $('.btn-offcanvas').removeClass('glyphicon-remove-circle');
            }
        });
    });

	$(w).resize(function(){ //Update dimensions on resize
		sw = $(window).width();
		sh = $(window).height();
		checkMobile();
	});

	//Check if Mobile
	function checkMobile() {
		mobile = (sw > breakpoint) ? false : true;
        
		if (mobile) { //mobile mode
           removeOpenDropdowns();
		}
        setImageWindowHeight(mobile);
		setOffCanvasHeight(mobile);
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

    function setImageWindowHeight(mobile) {
        if (mobile) {
            var width = $('.media .pull-left').width();
            $('.media .pull-left').css({"max-height": width * 3 / 4 + 'px'});
        }
        else {
            $('.media .pull-left').removeAttr('style');
        }
    }

})(this);
