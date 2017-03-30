(function ($, root, undefined) {

	$(function () {

		'use strict';

		// Hide Header on on scroll down
        var didScroll = null;
        var lastScrollTop = 0;
        var delta = 5;
        var header = $('.header');
        /* var headerHeight = header.outerHeight(); */

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 150);

        function hasScrolled() {
            var st = $(window).scrollTop();

            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta){
                return;
            }

            // If scrolled down, hide and inverse the header
            if ( st > lastScrollTop ){
                header.addClass('is-hidden');
            } else if ( st + $(window).height() < $(document).height() ) {
                    header.removeClass('is-hidden').addClass('is-inverse');
            }

            // If scrolled up past 150px, remove inverse class from header
            if ( st < 150) {
                header.removeClass('is-inverse');
            }

            lastScrollTop = st;
        }

        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') || location.hostname === this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                   if (target.length) {
                     $('html,body').animate({
                         scrollTop: target.offset().top -120
                    }, 1000);
                    return false;
                }
            }
        });

        $('.nav-toggle').click(function() {
            var navMenu = $('.nav-menu');
            var mainSection = $('.main');

            if( $(this).hasClass('is-active') ) {
                $(this).removeClass('is-active');
                navMenu.removeClass('is-active');
                mainSection.removeClass('nav-menu-is-active');
            } else {
                $(this).addClass('is-active');
                navMenu.addClass('is-active');
                mainSection.addClass('nav-menu-is-active');
            }
        });

	});

})(jQuery, this);
