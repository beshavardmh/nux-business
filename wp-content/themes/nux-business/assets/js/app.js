jQuery(document).ready(function ($) {
    // functions name
    let headerBg,
        toggleMenu,
        blogItemsHeight,
        processBtn;
    // ------------------------------------------------------------
    headerBg = () => {
        if ($('nav.is-transparent').length) {
            $(window).on('scroll', function () {
                if ($(document).scrollTop() > 100) {
                    $('nav.is-transparent').css('animation', 'headerBg .6s ease-in-out forwards');
                } else {
                    $('nav.is-transparent').css('animation', 'headerBg .6s ease-in-out forwards reverse');
                }
            });

            if ($(document).scrollTop() > 100) {
                $('nav.is-transparent').css('animation', 'headerBg .6s ease-in-out forwards');
            } else {
                $('nav.is-transparent').css('animation', 'headerBg .6s ease-in-out forwards reverse');
            }
        }
    }
    headerBg();
    // ------------------------------------------------------------
    blogItemsHeight = () => {
        if ($('.blog .item').length) {
            let maxHeight = -1;
            $('.blog .item').each(function () {
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            });

            $('.blog .item').each(function () {
                $(this).height(maxHeight);
            });
        }
    }
    blogItemsHeight();
    // ------------------------------------------------------------
    toggleMenu = () => {
        $('#nav-icon').click(function () {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $('header .main-menu-mobile').removeClass('open');
            } else {
                $(this).addClass('open');
                $('header .main-menu-mobile').addClass('open');
            }
        });
    }
    toggleMenu();
    // ------------------------------------------------------------
    $('[data-toggle="tooltip"]').tooltip();

    AOS.init({
        disable: function() {
            var maxWidth = 991.98;
            return window.innerWidth < maxWidth;
        },
        once: true,
    });

    // ------------------------------------------------------------
    processBtn = (btn, status = 'deactive') => {
        if (status == 'active') {
            $(btn).prop('disabled', true);
            $(btn).find('.process-animation').fadeIn();
        } else {
            $(btn).prop('disabled', false);
            $(btn).find('.process-animation').fadeOut();
        }

    }
    // ------------------------------------------------------------

});