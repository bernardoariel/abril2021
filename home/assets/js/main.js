!(function($) {
  "use strict";

  //PRELOADER
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });

  //PARALAX
  $( document ).mousemove( function( e ) {
      $( '.background' ).parallax( -300, e );
      $( '.portada1' )    .parallax( 30  , e );
      $( '.portada2' )    .parallax( 50  , e );
      $( '.portada3' )    .parallax( 10  , e );

      $( '.portada1-2' )    .parallax( 70  , e );
      $( '.portada2-2' )    .parallax( 10  , e );
      $( '.portada3-2' )    .parallax( 25  , e );
  });




})(jQuery);