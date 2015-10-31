/**
 * Created by giang on 9/27/15.
 */
$(function(){ // document ready

    var stickyTop = $('.sticky').offset().top; // returns number

    $(window).scroll(function(){ // scroll event

        var windowTop = $(window).scrollTop(); // returns number

        if (stickyTop < windowTop) {
            $('.sticky').css({ position: 'fixed', top: 80 });
        }
        else {
            $('.sticky').css('position','static');
        }

    });

});
