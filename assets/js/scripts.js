(function ($, root, undefined) {

    $(function () {

        'use strict';

        // Hide Header on on scroll down
        var didScroll = null;
        var lastScrollTop = 0;
        var delta = 5;
        var header = $('.header.has-transition');
        // var headerHeight = header.outerHeight();

        $(window).scroll(function(){
            didScroll = true;
        });

        setInterval(function() {
            if ( didScroll ) {
                elemHasScrolled(header, 150);
                didScroll = false;
            }
        }, 250);

        function elemHasScrolled(elem, scrollVal) {
            if ( $(window).width() >= 768 ) {
                var st = $(window).scrollTop();

                // Make sure they scroll more than delta
                if( Math.abs(lastScrollTop - st) <= delta ){
                    return;
                }

                // If scrolled down enough, hide and inverse the header
                if ( st > lastScrollTop && st > delta ){
                    elem.addClass('is-hidden');
                } else if ( st + $(window).height() < $(document).height() ) {
                        elem.removeClass('is-hidden').addClass('is-inverse');
                }

                // If scrolled past the `scrollVal`, remove inverse class
                if ( st < scrollVal ) {
                    elem.removeClass('is-inverse');
                }

                lastScrollTop = st;
            }
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
