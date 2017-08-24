(function ( $ ) {

	"use strict";

	$( 'a[href*=\\#toppage]' ).on( 'click', function ( event ) {
		event.preventDefault();
		$( 'html, body' ).animate( {
			scrollTop: 0
		}, 500 );
		return false;
	} );

	$( document ).ready( function () {

		$( '.swipebox' ).swipebox();

		$( 'iframe' ).wrap( '<figure></figure>' );

		$( 'a[href*=".png"], a[href*=".gif"], a[href*=".jpg"], a[href*=".jpeg"]' ).addClass( 'swipebox' );

		$( '.gall-img' ).matchHeight( false );

		$( 'table' ).addClass( 'table table-hover' );
		$( 'table' ).wrap('<div class="table-responsive"></div>');

		$( 'img' ).addClass( 'img-responsive' );

		$( 'input:submit' ).addClass( 'btn btn-primary' );

		$( 'input:text' ).addClass( 'form-control' );

		$( 'input:text' ).wrap( '<div class="form-group"></div>' );

		$( 'textarea' ).addClass( 'form-control' );
	} );

	$( function () {

		var $allVideos = $( "iframe[src*='//player.vimeo.com'], iframe[src*='//www.youtube.com'], object, embed" ),
			$fluidEl = $( "figure" );

		$allVideos.each( function () {

			$( this )
				.attr( 'data-aspectRatio', this.height / this.width )
				.removeAttr( 'height' )
				.removeAttr( 'width' );

		} );

		$( window ).resize( function () {

			$allVideos.each( function () {

				var $el = $( this );
				var newWidth = $el.parents( 'figure' ).width();
				$el
					.width( newWidth )
					.height( newWidth * $el.attr( 'data-aspectRatio' ) );

			} );

		} ).resize();
	} );

}( jQuery ));