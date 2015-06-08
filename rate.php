<?php 
$page_title = "Rate the music!";
$custom_js = "includes/js/rate.js";

include('includes/header.html');
include('music_conn.php');
$stmt = $mysqli->prepare("SELECT * FROM links");
$stmt->execute();
$stmt->bind_result($id, $url, $up, $down);

while($stmt->fetch()) {
    $total = $up - $down;
    $play_list[] = array("id"=> $id,
                        "url" => $url,
                        "up" => $up,
                        "down" => $down,
                        "total" => $total);
}
 ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6"> 
<?php
if(isset($play_list)) {
    foreach ($play_list as $p) {
        echo '<div class="video">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" id="vidPlaying" src="//www.youtube.com/embed/'.$p['url'].'">'.$p['id'].'</iframe>
                    </div>
                    <span class="arrows"><span class="fa fa-arrow-up fa-4x up">'.$p['up'].'</span><span class="fa fa-arrow-down fa-4x down">'.$p['down'].'</span></span>
                    <div class="comments">
                        <h1>Comments?</h1>
                    </div>
              </div>';
    }
}
 ?>
        </div>
        <div class="col-md-6">
            <div class="msg-box">
                <div class="type-msg">
                    <textarea id="msg"></textarea>
                    <p id="characterCount"></p><button class="btn btn-primary btn-sm" id="msgButton" type="button">Comment</button>
                </div>
                <div class="oldMessages">
                </div>
            </div>
        </div>
    </div>
</div>






<?php
include('includes/footer.html');
 ?>