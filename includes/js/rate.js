var main = function() {
    // pop the bg into the window
    $.backstretch('includes/beach.jpg');

    var playlistLength = $('.video').length;
    var firstVideo = $('.video').first();

    firstVideo.addClass('active-video');
    firstVideo.slideDown('slow');

    // highlight up arrow
    $('.up').hover(function() {
        $(this).addClass('iconcolor');
    }, function() {
        $(this).removeClass('iconcolor');
    });

    // highlight down arrow
    $('.down').hover(function() {
        $(this).addClass('iconcolor');
    }, function() {
        $(this).removeClass('iconcolor');
    });

    // handle the clicks
    $('.up').click(function() {
        upClick();
        

    });
    $('.down').click(function() {
        downClick();
        

    });

};

var upClick = function() {
    var up = $('.active-video .up').text();
    var id = $('.active-video iframe').text();
    var total = $('.active-video .total').text();

    total++;
    up++;

    $('.active-video .up').text(up);
    $('.active-video .total').text(total);

    var data = new Object();
    data.voteType = 'up';
    data.link_id = id;

    var options = new Object();
    options.data = data;
    options.dataType = 'text';
    options.type = 'get';
    options.success = function(response) {
        // what to do next
        if(response === 'worked') {
            nextVideo();
        }
    };

    options.url = 'vote.php';
    $.ajax(options);
};

var downClick = function() {
    var down = $('.active-video .down').text();
    var id = $('.active-video iframe').text();
    var total = $('.active-video .total').text();

    total--;
    down--;

    $('.active-video .down').text(down);
    $('.active-video .total').text(total);

    var data = new Object();
    data.voteType = 'down';
    data.link_id = id;

    var options = new Object();
    options.data = data;
    options.dataType = 'text';
    options.type = 'get';
    options.success = function(response) {
        // what to do next
        if(response === 'worked') {
            nextVideo();
        }
    };

    options.url = 'vote.php';
    $.ajax(options);

};

var nextVideo = function() {
    var currentSlide = $('.active-video');
    var nextSlide = currentSlide.next();

    // stop the video from playing if it is playing
    video = $('.active-video #vidPlaying').attr('src');
    $('.active-video #vidPlaying').attr("src","");
    $('.active-video #vidPlaying').attr("src", video);

    if(nextSlide.length === 0) {
        nextSlide = $('.video').first();
        console.log(nextSlide.length);
    }
    
    currentSlide.fadeOut(600).removeClass('active-video');
    nextSlide.fadeIn(600).addClass('active-video');
};

$(document).ready(main);