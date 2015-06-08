<?php 
$page_title = "Welcome to my playlist maker";
$custom_js = "includes/js/music.js";

include('includes/header.html');
 ?>
<div class="container-fluid">
    <div class="search">
        <h1 id="title">Summer Jams</h1>
        <div class="search-content">
            <p id="welcome">Soon we will be on a boat, bidding our friends a fond farewell. It seems crazy that
            we don't have a playlist for them. We are going to need to carefully select tunes for such
            a momentous occaision. So, since it is election day anyways, here is a voting system. Just copy and
            paste your youtube links into the search bar below.</p>
            <br>
            <div class="error alert alert-danger">
                <p>Something is wrong with your link.</p>
            </div>
            <form action="music.php" method="post" id="addVideo">
                <div class="input-group">
                    <input type="text" class="form-control" id="link" name="link" placeholder="Youtube link...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Add to playlist</button>
                    </span>
                </div>
            </form>
        </div>
        <div id="link-box">
            <h1 id="results"></h1><br>
            <a href="rate.php"><span class="fa fa-youtube-play fa-4x" id="rate-link"> Rate the videos</span></a>
        </div>
    </div>
    
</div>
<?php 
include('includes/footer.html');
 ?>
