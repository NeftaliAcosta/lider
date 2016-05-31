var appp_do_swiper = {

	swipers   : {},
	carousels : {},
	options   : {},
	count     : 0,
	total     : 0,
	loopcount : 0,

	allswipers: function() {
		'use strict';

		var _this   = appp_do_swiper;
		// Count swiper/carousel shortcodes
		var s_count = parseFloat( jQuery( '.swiper-slider-sc' ).length );
		var c_count = parseFloat( jQuery( '.swiper-carousel-sc' ).length );
		_this.total = s_count + c_count;

		_this.do_swipers( s_count );
		_this.do_carousels( c_count );
	},

	do_swipers: function( count ) {
		'use strict';

		if ( ! count )
			return;

		this.options = {
			mode: 'horizontal',
			// @todo see if pagination works w/ multiple swipers
			pagination          : '.pagination',
			paginationClickable : true,
			loop                : true,
			calculateHeight     : true,
			updateOnImagesReady : true
		};
		// Loop through our swiper count and init a new swiper object for each
		for ( var i = count; i >= 1; i--) {
			// Add each swiper object to the swipers array (for manipulation elsewhere)
			// this.swipers['#swiper-'+ i] = this.do_swiper( '#swiper-'+ i );
			this.do_swiper( '#swiper-'+ i );
		}
	},

	do_carousels: function( count ) {
		'use strict';

		if ( ! count )
			return;

		this.options = {
			calculateHeight: true,
			slidesPerView: jQuery(window).width() <= 500 ? 2.5 : 3.5,
			freeModeFluid: true
		};

		// Loop through our swiper count and init a new swiper object for each
		for ( var i = count; i >= 1; i--) {
			// Add each swiper object to the carousels array (for manipulation elsewhere)
			this.do_swiper( '#swiper-carousel-'+ i, true );
		}
	},

	do_swiper: function( selector, isCarousel, options ) {
		options = options || this.options;

		// If images aren't loaded, check again in 100ms
		if ( ! jQuery( selector + ' img' ).length ) {
			appp_do_swiper.loopcount++;
			// only check 5 times
			if ( appp_do_swiper.loopcount < 7 ) {
				setTimeout( function(){
					// call picturefill
					window.picturefill();
					// & try again
					appp_do_swiper.do_swiper( selector, isCarousel, options );
				}, 100 );
			}
			return;
		}

		// Make the swiper visible
		var swiperObject = jQuery(selector).animate({'opacity': '1'}, 'slow').swiper(options);
		if ( isCarousel ) {
			this.carousels[selector] = swiperObject;
		} else {
			this.swipers[selector] = swiperObject;
		}
		this.count++;

		if ( this.count === this.total ) {
			jQuery(document).trigger( 'all_apppswipers_loaded', appp_do_swiper );
		}
	}

};
appp_do_swiper.allswipers();

jQuery(document).on( 'load_ajax_content_done', function() {
	// Reset swipers on ajax load
	appp_do_swiper.loopcount = 0;
	setTimeout( appp_do_swiper.allswipers, 16 );
});
