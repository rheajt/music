var main = function() {
    // pop the bg into the window
    $.backstretch('includes/beach.jpg');

    var playlistLength = $('.video').length;
    var firstVideo = $('.video').first();

    firstVideo.addClass('active-video');
    firstVideo.slideDown('slow');

    getComments();

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
    $('.up').click(upClick);
    $('.down').click(downClick);
    $('#msgButton').click(newMessage);
    $('.comments').click(function() {
        $('.msg-box').fadeToggle('slow');
    });

};

var upClick = function() {
    var up = $('.active-video .up').text();
    var id = $('.active-video iframe').text();

    up++;

    $('.active-video .up').text(up);

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

    down++;

    $('.active-video .down').text(down);

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
    }
    
    currentSlide.fadeOut(600, function() {
        nextSlide.fadeIn(600).addClass('active-video');        
    }).removeClass('active-video');

    getComments();
};

var newMessage = function() {
    // message function
    var msg = $('#msg').val();
    var id = $('.active-video iframe').text();

    if (msg.length > 0 && msg.length <=140) {

        //prepare data/options for newmessage ajax
        var data = new Object();
        data.msg = msg;
        data.link_id = id;

        var options = new Object();
        options.data = data;
        options.dataType = 'text';
        options.type = 'get';
        options.success = function(response) {
            // what to do next
            if(response === 'worked') {
                $('<h4>'+msg+'</h4><hr>').appendTo('.oldMessages');
                $('#msg').val('');
            } else {
                alert(response);
            }
        };
        options.url = 'comment.php';

        // run the ajax for a new comment
        $.ajax(options);
    }
};

var getComments = function() {

    $('.oldMessages').empty();

    var id = $('.active-video iframe').text();

    var data = new Object();
    data.id = id;

    var options = new Object();
    options.data = data;
    options.dataType = 'json';
    options.success = function(response) {
        if(response == 'fail') {
            console.log('problem with php');
        } else {
            comments = response;

            for(i=0; i < comments.length; i++) {
                $('<h4>'+comments[i]+'</h4><hr>').appendTo('.oldMessages');
            }
            
            console.log('worked');
            
        }
    };
    options.error = function(response) {
        console.log(response);
    }

    options.url = "comment.php";

    $.ajax(options);

};

$(document).ready(main);