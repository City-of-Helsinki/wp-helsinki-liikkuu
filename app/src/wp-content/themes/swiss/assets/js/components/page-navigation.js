import helpers from './helpers';
import lodashThrottle from 'lodash.throttle';

/**
 * This object handles all interactivity related to the navigation bar and
 * the mobile menu. The site navigation lives in relation to the site header, so
 * some parts of that are also referenced here.
 * @type {Object}
 */
const pageNavigation = {

    init() {
        this.handleNavigation();
        this.scrollEffects();
        this.scrollCheck();
        this.handleClose();
        this.handleMobileToggle();
        this.resizeCheck();
    },

    handleNavigation() {
        $('.js-menu-toggle').on('keypress click', function(e) {
            e.preventDefault();
            // On enter/space or click/tap..
            if (e.which === 13 || e.which === 32 || e.type === 'click') {
                // Mark toggler element itself as active
                helpers.toggleAttr($(this), 'aria-expanded');
                $(this).toggleClass('opened');

                // Mark corresponding submenu as visible
                $(this).next('.js-submenu').toggleClass('is-visible');
            }
        });
    },

    scrollCheck() {
        $(document).on('scroll', lodashThrottle(function() {
            pageNavigation.scrollEffects();
        }, 100));
    },

    /**
     * Scroll effects to be applied when the user scrolls. This is mainly used
     * to handle the logo reveal for the navbar when the user scrolls past the
     * site header where the logo is visible.
     * @return {[type]} [description]
     */
    scrollEffects() {
        var topofDiv = $('.js-site-header').offset().top;
        var height = $('.js-site-header').outerHeight();
        var extra = 60;
        if($(window).scrollTop() > (topofDiv + height + extra)){
            $('.js-navbar').addClass('is-scrolled');
        } else {
            $('.js-navbar').removeClass('is-scrolled');
        }
    },

    /**
     * Handle resize events and apply resizeEffects accordingly.
     * @return {[type]} [description]
     */
    resizeCheck() {
        $(window).on('resize', lodashThrottle(function() {
            pageNavigation.resizeEffects();
        }, 500));
    },

    /**
     * Effects to be applied when the window is resized. This is mainly used to
     * hide the mobile navigation if an user resizes from mobile (sm bp) upwards
     * with the navigation still open.
     * @return {[type]} [description]
     */
    resizeEffects() {
        if ($(window).width() > 768) {
            $('body').removeClass('has-open-navigation');
        }
    },

    handleClose() {
        // on esc press close everything down
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                $('.js-submenu').removeClass('is-visible');
                $('.js-menu-toggle').attr('aria-expanded', 'false');
            }
        });
    },

    handleMobileToggle() {
        $('.c-mobile-toggle').on('click', function() {
            $('body').toggleClass('has-open-navigation');
            return false;
        });
    }

};

// finally boot the beast up
pageNavigation.init();