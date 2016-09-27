(function() {

    /**
     * Dynamically changes the background color of the nav according to its
     *  position y on the screen.
     */
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
