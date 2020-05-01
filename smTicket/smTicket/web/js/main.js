(function ($) {
    "use strict";

    var $devicewidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    var $deviceheight = (window.innerHeight > 0) ? window.innerHeight : screen.height;
    var $bodyel = jQuery("body");
    var $navbarel = jQuery(".navbar");
    var $htmlel = jQuery("html");

    var $lgWidth = 1199;
    var $mdWidth = 991;
    var $smWidth = 767;
    var $xsWidth = 479;

    /* ========================== */
    /* ==== HELPER FUNCTIONS ==== */

    function validatedata($attr, $defaultValue) {
        "use strict";
        if ($attr !== undefined) {
            return $attr
        }
        return $defaultValue;
    }

    function parseBoolean(str, $defaultValue) {
        "use strict";
        if (str == 'true') {
            return true;
        } else if (str == "false") {
            return false;
        }
        return $defaultValue;
    }

    //if(document.getElementById('ct-js-wrapper')){
    //    var snapper = new Snap({
    //        element: document.getElementById('ct-js-wrapper')
    //    });
    //
    //    snapper.settings({
    //        easing: 'ease',
    //        addBodyClasses: true,
    //        slideIntent: 20,
    //        disable: "right"
    //    });
    //}
    $(document).ready(function () {

        //menu active
        var url;
        url = window.location;

        $('.navbar-nav, .side-nav').find('a').filter(function() {
            return this.href === url.href;
        }).closest('.navbar-item').addClass('active');

        /*******************/

        if (jQuery.browser.mozilla){$htmlel.addClass('browser-mozilla') }
        if (jQuery.browser.webkit){$htmlel.addClass('browser-webkit') }
        if (jQuery.browser.msie){$htmlel.addClass('browser-msie') }
        if (jQuery.browser.safari){$htmlel.addClass('browser-safari') }

        $(".navbar, .ct-topBar").wrapAll("<div class='navbar-wrapper'></div>");

        $(".ct-mediaSection").mediaSection();

        //Modal

        $(".ct-js-listing--withModal").each(function(){
           $(this).on("click", function(){
               $('.ct-js-modal').each(function(){
                   $(this).modal({
                       show: true
                   })
               });
           })
        });

        //Position IMG

        if ($devicewidth >= 1200 && document.getElementById('ct-js-wrapper')) {
            $(".ct-js-imageOffset").each(function(){
                $(this).css("position", "absolute");
                $(this).css("top", $(this).attr("data-top")+'px');
                $(this).css("bottom", $(this).attr("data-bottom")+'px');
                $(this).css("left", $(this).attr("data-left")+'px');
                $(this).css("right", $(this).attr("data-right")+'px');
            });
        }

        // Add Color // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $(".ct-js-color").each(function(){
            $(this).css("color", '#' + $(this).attr("data-color"))
        });

        // Snap Navigation in Mobile // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        //if ($devicewidth > 767 && document.getElementById('ct-js-wrapper')) {
        //    snapper.disable();
        //}

        //$(".navbar-toggle").click(function () {
        //    if($bodyel.hasClass('snapjs-left')){
        //        snapper.close();
        //    } else{
        //        snapper.open('left');
        //    }
        //});

        $(".navbar-toggle").click(function () {
            $("#ct-js-wrapper").toggleClass("ct-wrapper-open");
            $(".ct-navbarMobile").toggleClass("ct-wrapper-open");
        });

        //$(".ct-navbarCart--mobileIcon").on("click", function () {
        //    if($bodyel.hasClass('snapjs-right')){
        //        snapper.close();
        //    } else{
        //        snapper.open('right');
        //    }
        //});

        //$('.ct-js-slick').attr('data-snap-ignore', 'true'); // Ignore Slick

        //Slick custom navigation

        if($(".ct-slick--arrowsCustom").length !=0){
            $(".ct-slick--arrowsCustom .slick-next").on("click", function(){
                $(".ct-js-slick-googleMaps").slick("slickNext");

            });
            $(".ct-slick--arrowsCustom .slick-prev").on("click", function(){
                $(".ct-js-slick-googleMaps").slick("slickPrev");
            });
        }

        $('.ct-menuMobile .ct-menuMobile-navbar .dropdown > a').click(function(e) {
            return false; // iOS SUCKS
        });
        $('.ct-menuMobile .ct-menuMobile-navbar .dropdown > a').click(function(e){
            var $this = $(this);
            if($this.parent().hasClass('open')){
                $(this).parent().removeClass('open');
            } else{
                $('.ct-menuMobile .ct-menuMobile-navbar .dropdown.open').toggleClass('open');
                $(this).parent().addClass('open');
            }
        });

        $('.ct-sidebar .dropdown > a').click(function(e) {
            return false; // iOS SUCKS
        });
        $('.ct-sidebar .dropdown > a').click(function(e){
            var $this = $(this);
            if($this.parent().hasClass('open')){
                $(this).parent().removeClass('open');
            } else{
                $('.ct-menuMobile .ct-menuMobile-navbar .dropdown.open').toggleClass('open');
                $(this).parent().addClass('open');
            }
        });

        //$('.ct-sidebar .dropdown > a').click(function(e) {
        //    return false; // iOS SUCKS
        //});
        //$('.ct-sidebar .dropdown > a').click(function(e){
        //    var $this = $(this);
        //    if($this.parent().hasClass('open')){
        //        $(this).parent().removeClass('open');
        //    } else{
        //        $('.ct-progressPath .dropdown.open').toggleClass('open');
        //        $(this).parent().addClass('open').siblings().removeClass('open');
        //    }
        //});


        if (!($('html').is('.ie8'))){
            // Selectize.js // ----------------------------------------------------------------
            var $selectize = $('.ct-js-selectize');
            if ($selectize.length > 0){
                $selectize.each(function(){$(this).selectize(
                );})
            }
        }

        //$('.ct-menuMobile .ct-menuMobile-navbar .onepage > a').click(function(e) {
        //    snapper.close();
        //});
        // Tooltips and Popovers // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $("[data-toggle='tooltip']").tooltip();

        $("[data-toggle='popover']").popover({trigger: "hover", html: true});


        // Link Scroll to Section // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        function goToByScroll(id) {
            $('html,body').animate({scrollTop: $(id).offset().top - 70}, 'slow');
        }

        $('body .ct-js-btnScroll').click(function () {
            goToByScroll($(this).attr('href'));
            return false;
        });

        $('.ct-js-btnScrollUp').click(function (e) {
            e.preventDefault();
            $("body,html").animate({scrollTop: 0}, 1200);
            console.log($navbarel);
            $navbarel.find('.onepage').removeClass('active');
            $navbarel.find('.onepage:first-child').addClass('active');
            return false;
        });

        //Reserve Ticket

        if (device.mobile() || device.tablet()) {
            $(".ct-reserveTicket").hide();
        }else{
            $(".ct-reserveTicket .ct-reserveTicket-icon").on("click", function(event){
                $(".ct-reserveTicket").toggleClass("active");
            });

            $("#ct-js-wrapper").on("click", function(){
                if($(".ct-reserveTicket").hasClass("active")){
                    $(".ct-reserveTicket").removeClass("active");
                }
            });
        }

        // Placeholder Fallback // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        if ($().placeholder) {
            $("input[placeholder],textarea[placeholder]").placeholder();
        }

        // Animations Init // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        if ($().appear) {
            if (device.mobile() || device.tablet()) {
                $bodyel.removeClass("cssAnimate");
            } else {

                $('.cssAnimate .animated').appear(function () {
                    var $this = $(this);

                    $this.each(function () {
                        if ($this.data('time') != undefined) {
                            setTimeout(function () {
                                $this.addClass('activate');
                                $this.addClass($this.data('fx'));
                            }, $this.data('time'));
                        } else {
                            $this.addClass('activate');
                            $this.addClass($this.data('fx'));
                        }
                    });
                }, {accX: 50, accY: -350});
            }
        }
        var lightGallery = $('.lightGallery');
        if(lightGallery.length != 0){
            lightGallery.lightGallery({
                showThumbByDefault:false,
                addClass:'showThumbByDefault',
                enableTouch: true,
                enableDrag: true,
                loop:true
            });
        }

        // Video Embet Click // -----------------------------------------------------------

        $('.ct-embed').each(function(){
            var $this = $(this);
            $this.find('.ct-play-button').on('click', function(){
                $(this).addClass('hide');
                $this.find('img').addClass('hide');
                $this.find('.ct-embed-content').addClass('hide');
                $this.find('video').get(0).play();
            })
        });
    });
    //$(window).on('resize', function() {
    //    if ($(window).width() < 768) {
    //        snapper.enable();
    //    } else{
    //        snapper.disable();
    //    }
    //});

    $(window).on("load", function(){
        var $preloader = $('.ct-preloader');
        var $content = $('.ct-preloader-content');

        var $timeout = setTimeout(function(){
            $($preloader).addClass('animated').addClass('fadeOut');
            $($content).addClass('animated').addClass('fadeOut');
        }, 0);
        var $timeout2 = setTimeout(function(){
            $($preloader).css('display', 'none').css('z-index', '-9999');
        }, 500);
        if (!device.mobile() && !device.tablet()) {
            $(window).stellar({
                horizontalScrolling   : false,
                verticalScrolling     : true,
                responsive            : true,
                horizontalOffset      : 0,
                verticalOffset        : 0,
                parallaxBackgrounds   : true,
                parallaxElements      : true,
                scrollProperty        : 'scroll',
                positionProperty      : 'position',
                hideDistantElements   : true
            });
        }
    });
})(jQuery);