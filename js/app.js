(function() {
    function handleNavScroll() {
        var navBottomOffset = $('.navbar:last-child').offset().top;
        var fixedNav = $('.navbar.fixed');
        $(window).scroll(function(e) {
            if ($(this).scrollTop() >= navBottomOffset) {
                fixedNav.addClass('navbackground');
            } else if (fixedNav.hasClass('navbackground')) {
                fixedNav.removeClass('navbackground');
            }
        });
    }

    $(function() {
        handleNavScroll();
    });
})();
