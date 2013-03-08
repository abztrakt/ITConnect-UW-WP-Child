(function(w){

    var sw = $(window).width(),
        sh = $(window).height(),
        breakpoint = 650,
        speed = 800,
        mobile = true;

	$(document).ready(function() {
		checkMobile();
		setOffCanvasHeight();
	});

	$(w).resize(function(){ //Update dimensions on resize
		sw = $(window).width(),
		sh = $(window).height(),
		checkMobile();
	});

	//Check if Mobile
	function checkMobile() {
		mobile = (sw > breakpoint) ? false : true;

		if (!mobile) { //Desktop

		} else { //Mobile

		}
	}

	function setOffCanvasHeight() {

    	// set the offcanvas (sidebar) height equal to the content for now... for mobile, might want to do something sweet
    	// like setting it to the height of the viewport (i.e. facebook)
    	var contentH = $("#content").height();
    	$("#sidebar").height(contentH);

	}

})(this);