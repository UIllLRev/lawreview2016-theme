(function ($, root, undefined) {

    $(function () {

        'use strict';

        var BODY = $('body');
        var PAGE = $('#f100d');
        var HEADER = $('.header');
        var NAV_ITEM = $('.nav-item');




        //
        // Trigger scroll watcher
        // ======================
        //
        // 1. The `<main>` block has an `.intro-transition` class applied
        //    that, when removed, triggers a layout adjustment.
        //
        // 2. Add `.is-inverse` to header on scroll.
        //
        // 3. Remove `.is-inverse` when the window reaches the top of the page.
        //
        // 4. Remove `.content-is-hidden` when each element comes into the
        //    viewport and switch `.is-active` on nav items.
        // --------------------------------------------------------------------

        var watcher = new ScrollWatcher();
        var watching_elements = [
            '#f100d_introduction',
            '#f100d_topics',
            '#f100d_contributors'
        ];

        watcher.on('page:load', function(event) {
            window.setTimeout( () => {
                PAGE.removeClass('intro-transition'); // 1
            }, 400);
        });

        watcher.on('scrolling', function() {
            if ( ! watcher.windowAtTop() ) {
                HEADER.addClass('is-inverse'); // 2
            } else {
                HEADER.removeClass('is-inverse'); // 3
            }
        });

        $.each( watching_elements, function(i, element) { // 4
            watcher.watch(element, { top: 600, bottom: -400 })
                .on('enter', function() {
                    $('.nav-item.is-active').removeClass('is-active');
                    $(element).removeClass('content-is-hidden');
                    $('a[href=' + element + ']').addClass('is-active');
                });
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

        NAV_ITEM.on('click', function() {

            if ( ! $(this).hasClass('is-active') ) { // 1
                NAV_ITEM.removeClass('is-active'); // 2
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
