jQuery(window).load(function(){
  // Declare parallax on layers
   // alert("404 js from child theme is loaded!");
//    var width = $(window).width();
  //  var height = $(window).height(); 
 //   if (width <= 600 || height <= 800) {
    
//        alert("current screen is smartphone size.");
   //     $('#parallax').remove();
    //    $('#parallax').children().remove();
  //      $('<img>', { 'src': 'http://skittles.cac.washington.edu/itconnect/wp-content/themes/UW-Wordpress-Theme/img/404/404.jpg', 'alt': 'Error 404', 'id': 'four04'}).insertBefore('.four-oh-four');

     //   $('#parallax').css('img','http://skittles.cac.washington.edu/itconnect/wp-content/themes/UW-Wordpress-Theme/img/404/404.jpg');

//    }


    jQuery('.parallax-layer').imagesLoaded(function() {
    $(this).parallax(
      {},
      { xparallax: 1, yparallax: 0 },    // background
      { xparallax: 1, yparallax: 0 },    // woof
      { xparallax: .3, yparallax: 0 },    // doghouse
      { xparallax: .3, yparallax: 0 }     // dubs
      )}
  );
});
