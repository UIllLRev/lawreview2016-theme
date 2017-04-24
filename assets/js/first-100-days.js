(function ($, root, undefined) {

    $(function () {

        'use strict';

        var BODY = $('body');
        var PAGE = $('#f100d');



        //
        // Trigger page-load animation
        // ===========================
        //
        // The `<main>` block has an `.intro` class applied that, when removed,
        // triggers a layout adjustment for a smooth page-load animation.
        // --------------------------------------------------------------------

        setTimeout(function() {
            PAGE.removeClass('intro-transition');
        }, 400);




        //
        // Trigger scroll animations
        // =========================
        //
        // 1. Add `.is-inverse` to header on scroll.
        //
        // 2. Remove `.is-inverse` when the window reaches the top of the page.
        //
        // 3. Remove `.content-is-hidden` when elements come into the viewport.
        // --------------------------------------------------------------------

        var scroll = new ScrollWatcher();

        scroll.on('scrolling', function() {
            if ( ! scroll.windowAtTop() ) {
                $('.header').addClass('is-inverse'); // 1
            } else {
                $('.header').removeClass('is-inverse'); // 2
            }
        });

        scroll.watch('#f100d_topics', 400)
          .on('enter', function() {
            $('#f100d_topics').removeClass('content-is-hidden'); // 3
          });

        scroll.watch('#f100d_contributors', 400)
          .on('enter', function() {
            $('#f100d_contributors').removeClass('content-is-hidden'); // 3
          });




        //
        // Change active nav links
        // =======================
        //
        // 1. Only execute if the clicked item doesn't have `.is-active` class.
        //
        // 2. Remove `.is-active` from any nav items that have it.
        //
        // 3. Add `.is-active` to the clicked item.
        // --------------------------------------------------------------------

        $('.nav-item').on('click', function() {

            if ( ! $(this).hasClass('is-active') ) { // 1
                $('.nav-item').removeClass('is-active'); // 2
                $(this).addClass('is-active'); // 3
            }
        });




        //
        // Full-screen menu
        // ================

        var navToggle = $('.nav-toggle');
        var fullScreenMenu = $('.full-screen-menu');
        var fullScreenBackground = $('.full-screen-background');

        $(document).ready(function() {

            navToggle.on('click', function(event) {
                toggleMenu();
                event.preventDefault();
            });

            $(window).resize(resizeMenu);

            resizeMenu();
        });

        function toggleMenu() {
            if ( ! BODY.hasClass('menu-is-open') ) {
                BODY.addClass('menu-is-open');
                navToggle.addClass('is-active');
            } else {
                BODY.removeClass('menu-is-open');
                navToggle.removeClass('is-active');
            }
        }

        function resizeMenu() {
            var windowHeight = window.innerHeight - 30;

            // Set the menu height to fill the window
            fullScreenMenu.css({'height': windowHeight});

            // Set the circle radius to the length of the window diagonal,
            // which makes the circle only as big as it needs to be.
            var radius = Math.sqrt(Math.pow(windowHeight, 2) + Math.pow(window.innerWidth, 2));
            var diameter = radius * 2;
            fullScreenBackground.width(diameter);
            fullScreenBackground.height(diameter);
            fullScreenBackground.css({'margin-top': -radius, 'margin-right': -radius});
        }

    });

})(jQuery, this);
