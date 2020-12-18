$(function(){

    $('.nav').mouseover(function () {
        $(this).find(".nav-icon").css(
            {
            '-webkit-animation': 'none',
        '-moz-animation': 'none',
        '-o-animation': 'none',
        'animation': 'none'
            }
        )
    })
    $('.nav').mouseleave(function () {
        $(this).find(".nav-icon").css(
            {
                '-webkit-animation': 'infinite-spinning 30s infinite linear',
                '-moz-animation': 'infinite-spinning 30s infinite linear',
                '-o-animation': 'infinite-spinning 30s infinite linear',
                'animation': 'infinite-spinning 30s infinite linear'
            }
        )
    })
});