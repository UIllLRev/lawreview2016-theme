!function(e,s,a){e(function(){"use strict";var s=null,a=0,i=5,t=e(".header");e(window).scroll(function(e){s=!0}),setInterval(function(){s&&(!function(){if(e(window).width()>=768){var s=e(window).scrollTop();if(Math.abs(a-s)<=i)return;s>a&&s>i?t.addClass("is-hidden"):s+e(window).height()<e(document).height()&&t.removeClass("is-hidden").addClass("is-inverse"),s<=150&&t.removeClass("is-inverse"),a=s}}(),s=!1)},250),e("a[href*='#']:not([href='#'])").click(function(){if(location.pathname.replace(/^\//,"")===this.pathname.replace(/^\//,"")||location.hostname===this.hostname){var s=e(this.hash);if((s=s.length?s:e("[name="+this.hash.slice(1)+"]")).length)return e("html,body").animate({scrollTop:s.offset().top-120},1e3),!1}}),e(".nav-toggle").click(function(){var s=e(".nav-menu"),a=e(".main");e(this).hasClass("is-active")?(e(this).removeClass("is-active"),s.removeClass("is-active"),a.removeClass("nav-menu-is-active")):(e(this).addClass("is-active"),s.addClass("is-active"),a.addClass("nav-menu-is-active"))})})}(jQuery);