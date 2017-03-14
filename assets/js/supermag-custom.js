/*slick nav start*/

/*!

 SlickNav Responsive Mobile Menu v1.0.1

 (c) 2014 Josh Cope

 licensed under MIT

 */

;
(function($, document, window) {

    var

        // default settings object.

        defaults = {

            label: 'MENU',

            duplicate: true,

            duration: 200,

            easingOpen: 'swing',

            easingClose: 'swing',

            closedSymbol: '&#9658;',

            openedSymbol: '&#9660;',

            prependTo: 'body',

            parentTag: 'a',

            closeOnClick: false,

            allowParentLinks: false,

            nestedParentLinks: true,

            showChildren: false,

            init: function() {},

            open: function() {},

            close: function() {}

        },

        mobileMenu = 'slicknav',

        prefix = 'slicknav';



    function Plugin(element, options) {

        this.element = element;



        // jQuery has an extend method which merges the contents of two or

        // more objects, storing the result in the first object. The first object

        // is generally empty as we don't want to alter the default options for

        // future instances of the plugin

        this.settings = $.extend({}, defaults, options);



        this._defaults = defaults;

        this._name = mobileMenu;



        this.init();

    }



    Plugin.prototype.init = function() {

        var $this = this,

            menu = $(this.element),

            settings = this.settings,

            iconClass,

            menuBar;



        // clone menu if needed

        if (settings.duplicate) {

            $this.mobileNav = menu.clone();

            //remove ids from clone to prevent css issues

            $this.mobileNav.removeAttr('id');

            $this.mobileNav.find('*').each(function(i, e) {

                $(e).removeAttr('id');

            });

        } else {

            $this.mobileNav = menu;

        }



        // styling class for the button

        iconClass = prefix + '_icon';



        if (settings.label === '') {

            iconClass += ' ' + prefix + '_no-text';

        }



        if (settings.parentTag == 'a') {

            settings.parentTag = 'a href="#"';

        }



        // create menu bar

        $this.mobileNav.attr('class', prefix + '_nav');

        menuBar = $('<div class="' + prefix + '_menu"></div>');

        $this.btn = $(

            ['<' + settings.parentTag + ' aria-haspopup="true" tabindex="0" class="' + prefix + '_btn ' + prefix + '_collapsed">',

                '<span class="' + prefix + '_menutxt">' + settings.label + '</span>',

                '<span class="' + iconClass + '">',

                '<span class="' + prefix + '_icon-bar"></span>',

                '<span class="' + prefix + '_icon-bar"></span>',

                '<span class="' + prefix + '_icon-bar"></span>',

                '</span>',

                '</' + settings.parentTag + '>'

            ].join('')

        );

        $(menuBar).append($this.btn);

        $(settings.prependTo).prepend(menuBar);

        menuBar.append($this.mobileNav);



        // iterate over structure adding additional structure

        var items = $this.mobileNav.find('li');

        $(items).each(function() {

            var item = $(this),

                data = {};

            data.children = item.children('ul').attr('role', 'menu');

            item.data('menu', data);



            // if a list item has a nested menu

            if (data.children.length > 0) {



                // select all text before the child menu

                // check for anchors



                var a = item.contents(),

                    containsAnchor = false;

                nodes = [];



                $(a).each(function() {

                    if (!$(this).is('ul')) {

                        nodes.push(this);

                    } else {

                        return false;

                    }



                    if ($(this).is("a")) {

                        containsAnchor = true;

                    }

                });



                var wrapElement = $(

                    '<' + settings.parentTag + ' role="menuitem" aria-haspopup="true" tabindex="-1" class="' + prefix + '_item"/>'

                );



                // wrap item text with tag and add classes unless we are separating parent links

                if ((!settings.allowParentLinks || settings.nestedParentLinks) || !containsAnchor) {

                    var $wrap = $(nodes).wrapAll(wrapElement).parent();

                    $wrap.addClass(prefix + '_row');

                } else

                    $(nodes).wrapAll('<span class="' + prefix + '_parent-link ' + prefix + '_row"/>').parent();



                item.addClass(prefix + '_collapsed');

                item.addClass(prefix + '_parent');



                // create parent arrow. wrap with link if parent links and separating

                var arrowElement = $('<span class="' + prefix + '_arrow">' + settings.closedSymbol + '</span>');



                if (settings.allowParentLinks && !settings.nestedParentLinks && containsAnchor)

                    arrowElement = arrowElement.wrap(wrapElement).parent();



                //append arrow

                $(nodes).last().after(arrowElement);





            } else if (item.children().length === 0) {

                item.addClass(prefix + '_txtnode');

            }



            // accessibility for links

            item.children('a').attr('role', 'menuitem').click(function(event) {

                //Ensure that it's not a parent

                if (settings.closeOnClick && !$(event.target).parent().closest('li').hasClass(prefix + '_parent')) {

                    //Emulate menu close if set

                    $($this.btn).click();

                }

            });



            //also close on click if parent links are set

            if (settings.closeOnClick && settings.allowParentLinks) {

                item.children('a').children('a').click(function(event) {

                    //Emulate menu close

                    $($this.btn).click();

                });



                item.find('.' + prefix + '_parent-link a:not(.' + prefix + '_item)').click(function(event) {

                    //Emulate menu close

                    $($this.btn).click();

                });

            }

        });



        // structure is in place, now hide appropriate items

        $(items).each(function() {

            var data = $(this).data('menu');

            if (!settings.showChildren) {

                $this._visibilityToggle(data.children, null, false, null, true);

            }

        });



        // finally toggle entire menu

        $this._visibilityToggle($this.mobileNav, null, false, 'init', true);



        // accessibility for menu button

        $this.mobileNav.attr('role', 'menu');



        // outline prevention when using mouse

        $(document).mousedown(function() {

            $this._outlines(false);

        });



        $(document).keyup(function() {

            $this._outlines(true);

        });



        // menu button click

        $($this.btn).click(function(e) {

            e.preventDefault();

            $this._menuToggle();

        });



        // click on menu parent

        $this.mobileNav.on('click', '.' + prefix + '_item', function(e) {

            e.preventDefault();

            $this._itemClick($(this));

        });



        // check for enter key on menu button and menu parents

        $($this.btn).keydown(function(e) {

            var ev = e || event;

            if (ev.keyCode == 13) {

                e.preventDefault();

                $this._menuToggle();

            }

        });



        $this.mobileNav.on('keydown', '.' + prefix + '_item', function(e) {

            var ev = e || event;

            if (ev.keyCode == 13) {

                e.preventDefault();

                $this._itemClick($(e.target));

            }

        });



        // allow links clickable within parent tags if set

        if (settings.allowParentLinks && settings.nestedParentLinks) {

            $('.' + prefix + '_item a').click(function(e) {

                e.stopImmediatePropagation();

            });

        }

    };



    //toggle menu

    Plugin.prototype._menuToggle = function(el) {

        var $this = this;

        var btn = $this.btn;

        var mobileNav = $this.mobileNav;



        if (btn.hasClass(prefix + '_collapsed')) {

            btn.removeClass(prefix + '_collapsed');

            btn.addClass(prefix + '_open');

        } else {

            btn.removeClass(prefix + '_open');

            btn.addClass(prefix + '_collapsed');

        }

        btn.addClass(prefix + '_animating');

        $this._visibilityToggle(mobileNav, btn.parent(), true, btn);

    };



    // toggle clicked items

    Plugin.prototype._itemClick = function(el) {

        var $this = this;

        var settings = $this.settings;

        var data = el.data('menu');

        if (!data) {

            data = {};

            data.arrow = el.children('.' + prefix + '_arrow');

            data.ul = el.next('ul');

            data.parent = el.parent();

            //Separated parent link structure

            if (data.parent.hasClass(prefix + '_parent-link')) {

                data.parent = el.parent().parent();

                data.ul = el.parent().next('ul');

            }

            el.data('menu', data);

        }

        if (data.parent.hasClass(prefix + '_collapsed')) {

            data.arrow.html(settings.openedSymbol);

            data.parent.removeClass(prefix + '_collapsed');

            data.parent.addClass(prefix + '_open');

            data.parent.addClass(prefix + '_animating');

            $this._visibilityToggle(data.ul, data.parent, true, el);

        } else {

            data.arrow.html(settings.closedSymbol);

            data.parent.addClass(prefix + '_collapsed');

            data.parent.removeClass(prefix + '_open');

            data.parent.addClass(prefix + '_animating');

            $this._visibilityToggle(data.ul, data.parent, true, el);

        }

    };



    // toggle actual visibility and accessibility tags

    Plugin.prototype._visibilityToggle = function(el, parent, animate, trigger, init) {

        var $this = this;

        var settings = $this.settings;

        var items = $this._getActionItems(el);

        var duration = 0;

        if (animate) {

            duration = settings.duration;

        }



        if (el.hasClass(prefix + '_hidden')) {

            el.removeClass(prefix + '_hidden');

            el.slideDown(duration, settings.easingOpen, function() {



                $(trigger).removeClass(prefix + '_animating');

                $(parent).removeClass(prefix + '_animating');



                //Fire open callback

                if (!init) {

                    settings.open(trigger);

                }

            });

            el.attr('aria-hidden', 'false');

            items.attr('tabindex', '0');

            $this._setVisAttr(el, false);

        } else {

            el.addClass(prefix + '_hidden');

            el.slideUp(duration, this.settings.easingClose, function() {

                el.attr('aria-hidden', 'true');

                items.attr('tabindex', '-1');

                $this._setVisAttr(el, true);

                el.hide(); //jQuery 1.7 bug fix



                $(trigger).removeClass(prefix + '_animating');

                $(parent).removeClass(prefix + '_animating');



                //Fire init or close callback

                if (!init) {

                    settings.close(trigger);

                } else if (trigger == 'init') {

                    settings.init();

                }

            });

        }

    };



    // set attributes of element and children based on visibility

    Plugin.prototype._setVisAttr = function(el, hidden) {

        var $this = this;



        // select all parents that aren't hidden

        var nonHidden = el.children('li').children('ul').not('.' + prefix + '_hidden');



        // iterate over all items setting appropriate tags

        if (!hidden) {

            nonHidden.each(function() {

                var ul = $(this);

                ul.attr('aria-hidden', 'false');

                var items = $this._getActionItems(ul);

                items.attr('tabindex', '0');

                $this._setVisAttr(ul, hidden);

            });

        } else {

            nonHidden.each(function() {

                var ul = $(this);

                ul.attr('aria-hidden', 'true');

                var items = $this._getActionItems(ul);

                items.attr('tabindex', '-1');

                $this._setVisAttr(ul, hidden);

            });

        }

    };



    // get all 1st level items that are clickable

    Plugin.prototype._getActionItems = function(el) {

        var data = el.data("menu");

        if (!data) {

            data = {};

            var items = el.children('li');

            var anchors = items.find('a');

            data.links = anchors.add(items.find('.' + prefix + '_item'));

            el.data('menu', data);

        }

        return data.links;

    };



    Plugin.prototype._outlines = function(state) {

        if (!state) {

            $('.' + prefix + '_item, .' + prefix + '_btn').css('outline', 'none');

        } else {

            $('.' + prefix + '_item, .' + prefix + '_btn').css('outline', '');

        }

    };



    Plugin.prototype.toggle = function() {

        var $this = this;

        $this._menuToggle();

    };



    Plugin.prototype.open = function() {

        var $this = this;

        if ($this.btn.hasClass(prefix + '_collapsed')) {

            $this._menuToggle();

        }

    };



    Plugin.prototype.close = function() {

        var $this = this;

        if ($this.btn.hasClass(prefix + '_open')) {

            $this._menuToggle();

        }

    };



    $.fn[mobileMenu] = function(options) {

        var args = arguments;

        // Is the first parameter an object (options), or was omitted, instantiate a new instance
        if (options === undefined || typeof options === 'object') {
            return this.each(function() {
                // Only allow the plugin to be instantiated once due to methods
                if (!$.data(this, 'plugin_' + mobileMenu)) {
                    // if it has no instance, create a new one, pass options to our plugin constructor,
                    // and store the plugin instance in the elements jQuery data object.
                    $.data(this, 'plugin_' + mobileMenu, new Plugin(this, options));
                }
            });

            // If is a string and doesn't start with an underscore or 'init' function, treat this as a call to a public method.
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            // Cache the method call to make it possible to return a value
            var returns;
            this.each(function() {
                var instance = $.data(this, 'plugin_' + mobileMenu);
                // Tests that there's already a plugin-instance and checks that the requested public method exists
                if (instance instanceof Plugin && typeof instance[options] === 'function') {
                    // Call the method of our plugin instance, and pass it the supplied arguments.
                    returns = instance[options].apply(instance, Array.prototype.slice.call(args, 1));
                }
            });
            // If the earlier cached method gives a value back return the value, otherwise return this to preserve chainability.
            return returns !== undefined ? returns : this;
        }
    };
}(jQuery, document, window));

/*slick nav end*/

jQuery(document).ready(function($) {
    /*header clock*/
    function updateClock() {
        var currentTime = new Date();
        var currentHours = currentTime.getHours();
        var currentMinutes = currentTime.getMinutes();
        var currentSeconds = currentTime.getSeconds();
        // Pad the minutes and seconds with leading zeros, if required
        currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
        currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
        var timeOfDay = (currentHours < 12) ? "AM" : "PM";
        currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
        currentHours = (currentHours == 0) ? 12 : currentHours;
        var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
        $(".supermag-clock").html(currentTimeString);
    }
    setInterval(updateClock, 1000);
    /*clock*/

    $('.header-wrapper .menu').slicknav({
        allowParentLinks: true,
        duration: 200,
        prependTo: '.header-wrapper .responsive-slick-menu',
        'closedSymbol': '<i class="fa fa-angle-down"></i>',
        'openedSymbol': '<i class="fa fa-angle-up"></i>'
    });

    $('.search-icon-menu').click(function() {
        $('.menu-search-toggle').fadeToggle();
    });

    var menu_sticky_height = $('#masthead').height() - $('#site-navigation').height();
    var main_navigation_width = $('#page').width();
    $(window).scroll(function() {
        if ($(this).width() > 991) {
            if ($(this).scrollTop() > menu_sticky_height) {
                $('.supermag-enable-sticky-menu').css({
                    "position": "fixed",
                    "top": "0",
                    "width": "100%",
                    "z-index": '999',
                    'left': '0'
                });
                $('.supermag-enable-sticky-menu .header-main-menu').width(main_navigation_width);
                $('.supermag-enable-sticky-menu .header-main-menu').css('margin', '0 auto');
                $('.sm-up-container').show();
            } else {
                $('.supermag-enable-sticky-menu').removeAttr('style');
                $('.supermag-enable-sticky-menu .header-main-menu').removeAttr('style');
                $('.sm-up-container').hide();
            }
        }
    });
    /*scroll function*/
    $('.sm-up-container').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    });
    /*featured slider*/

    $('.home-bxslider').each(function() {
        home_bxslider = $(this);
        home_bxslider.show().bxSlider({
            speed: home_bxslider.data('speed'),
            pause: home_bxslider.data('pause'),
            auto: home_bxslider.data('auto'),
            autoHover: true,
            controls: home_bxslider.data('controls'),
            pager: false,
            nextText: '<i class="fa fa-angle-right"></i>',
            prevText: '<i class="fa fa-angle-left"></i>'
        });
    });
    // ticker
    $('.ticker,.bn').each(function() {
        $(this).show().bxSlider({
            minSlides: $(this).data('column'),
            maxSlides: $(this).data('column'),
            speed: $(this).data('speed'),
            mode: $(this).data('mode'),
            slideWidth: $(this).parent().width(),
            slideMargin: 10,
            ticker: true,
            tickerHover: true
        });
    });

    $('.gallery-bx-slides').each(function() {
        $(this).show().bxSlider({
            pagerCustom: '#' + $(this).data('pager'),
            speed: $(this).data('speed'),
            auto: $(this).data('auto'),
            controls: false,
            mode: $(this).data('mode')
        });
    });
    /*gallery gallery-carousel*/
    function gallery_carousel_height_fixed() {
        $('.supermag-home .gallery-carousel').each(function() {
            $(this).css('height', $(this).prev().height())
        })
    }

    gallery_carousel_height_fixed();

    $('.header-wrapper #site-navigation .menu-main-menu-container').addClass('clearfix');

    jQuery('.menu-item-has-children > a').click(function() {
        var at_this = jQuery(this);
        if (at_this.hasClass('at-clicked')) {
            return true;
        };
        var at_width = jQuery(window).width();
        if (at_width > 992 && at_width <= 1230) {
            at_this.addClass('at-clicked');
            return false;
        }
    });

    $(window).on('load', function() {
        //Sickey Sidebar
        if ($('body').hasClass('at-sticky-sidebar')) {
            if ($('body').hasClass('both-sidebar')) {
                $('#secondary-right, #primary-wrap').theiaStickySidebar();
            } else {
                $('.secondary-sidebar, #primary').theiaStickySidebar();
            }
        }
        $(".gallery-carousel").css('visibility', 'visible');
        $('.supermag-home .gallery-carousel').mCustomScrollbar({
            axis: "y",
            mouseWheelPixels: "235",
            horizontalScroll: false,
            autoDraggerLength: true,
            /*autoHideScrollbar: true,*/
            advanced: {
                autoExpandHorizontalScroll: false,
                autoScrollOnFocus: false,
                updateOnContentResize: true,
                updateOnBrowserResize: true
            }
        });

        $(".supermag-sidebar .gallery-carousel").mCustomScrollbar({
            axis: "x",
            mouseWheelPixels: "235",
            horizontalScroll: true,
            autoDraggerLength: true,
            /*autoHideScrollbar: true,*/
            advanced: {
                autoExpandHorizontalScroll: true,
                autoScrollOnFocus: false,
                updateOnContentResize: true,
                updateOnBrowserResize: true
            }
        });
        /*intro start*/
        $("#supermag-intro-loader").fadeOut();
        /*intro end*/
    });

    /*gallery*/
    $('.fullPreview').click(function() {
        var fullImage = $(this).data('imageFull');
        var title = $(this).attr('alt');
        var caption = $(this).data('caption');
        var link = $(this).data('link');
        var previewHolder = $(this).closest('.featured-gallery').children('.gallery-slider');
        previewHolder.find('.previewHolder').attr('src', fullImage);
        previewHolder.find('a').attr('href', link);
        previewHolder.find('.title').html(title);
        previewHolder.find('.caption').html(caption);
    });

    /*video*/
    $('.videofullPreview').click(function() {
        var fullImage = $(this).data('imageFull');
        var title = $(this).attr('alt');
        var caption = $(this).data('caption');
        var link = $(this).data('link');
        var video_url = $(this).data('video-url');
        var previewHolder = $(this).closest('.featured-gallery').children('.gallery-slider');
        if (video_url) {
            previewHolder.find('.img-holder').hide();
            previewHolder.find('.video-holder').show();
            console.log(video_url);
            previewHolder.find('iframe').attr('src', video_url);
        } else {
            previewHolder.find('iframe').attr('src', '');
            previewHolder.find('.video-holder').hide();
            previewHolder.find('.img-holder').show();
            previewHolder.find('.previewHolder').attr('src', fullImage);
        }
        previewHolder.find('.title').html(title);
        previewHolder.find('a').attr('href', link);
        previewHolder.find('.caption').html(caption);
    });

    /*tab*/
    $(document).on('click', '.sm-tabs-title .single-tab-title', function() {
        var data_active = $(this).data('active');
        $(this).siblings('li').removeClass('opened');
        $(this).addClass('opened');
        var sm_tabs_content = $(this).closest('.sm-tabs-title').next('.sm-tabs-content');
        sm_tabs_content.children('.featured-entries-col').hide();
        sm_tabs_content.children('#' + data_active).fadeIn(600);
    });

    /*mega menu*/
    $(window).load(function() {
        // Hide the first cat-content
        $('#site-navigation .supermag-mega-menu-con-wrap  .cat-con-section:not(:first-child)').hide();
        $('#site-navigation .supermag-mega-menu-cat-wrap  div:first-child a').addClass('mega-active-cat');
        // Toggle On Hover of cat menu
        $('#site-navigation a.mega-cat-menu').hover(function() {
            $(this).parents('.menu-item-inner-mega').find('a').removeClass('mega-active-cat');
            $(this).addClass('mega-active-cat');
            var cat_id = $(this).attr('data-cat-id');
            $(this).parents('.menu-item-inner-mega').find('.cat-con-section').hide();
            $('#cat-con-id-' + cat_id).show();
        });

        $(window).resize(function() {
            var minHeight = $('.supermag-mega-menu-con-wrap').outerHeight();
            if ($('.supermag-mega-menu-cat-wrap').outerHeight() <= minHeight) {
                $('.supermag-mega-menu-cat-wrap').height(minHeight);
            }
            gallery_carousel_height_fixed()
        }).resize();
    });
});
