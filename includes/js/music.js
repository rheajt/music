var main = function() {

    $.backstretch('includes/beach.jpg');
    $('#title').click(function() {
        $('.search-content').slideToggle();
    });

    $('#link').click(function() {
        $('#welcome').slideUp();
    });

    $('#addVideo').submit(function() {
        
        $('#welcome').slideUp();
        var link;

        if ($('#link').val().length > 0) {
            link = $('#link').val();
        } else {
            $('.error').slideDown();
        }

        if (link) {
            // set the data
            var data = new Object();
            data.link = link;
            data.voteType = 'up vote';

            var options = new Object();
            options.data = data;
            options.dataType = 'text';
            options.type = 'get';
            options.success = function(response) {
                
                // Worked:
                if (response === 'linked') {
                    // Show a message:
                    $('.error').hide();
                    $('#results').text('Your link was successfully added to the list! Add another or go rate the videos.');
                    $('.box').fadeIn();
                    $('#link-box').slideDown();
                    
                } else {
                    $('.box').fadeOut();
                    $('.error').fadeIn('slow');
                } 
                
            }; // End of success.
            options.url = 'music.php';

            // Perform the request:
            $.ajax(options);


        } 

        return false;
    });
};

$(document).ready(main);