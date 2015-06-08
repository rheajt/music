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

if(isset($play_list)) {
    echo '<div class="container">'; 
    foreach ($play_list as $p) {
        echo '<div class="video">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" id="vidPlaying" src="//www.youtube.com/embed/'.$p['url'].'">'.$p['id'].'</iframe>
                    </div>
                    <span class="arrows"><span class="fa fa-arrow-up fa-4x up">'.$p['up'].'</span><span class="fa fa-arrow-down fa-4x down">'.$p['down'].'</span></span>
                    <div class="votes">
                        <h1>Score: <span class="total">'.$p['total'].'</span></h1>
                    </div>
              </div>';
    }
    echo '</div>';
}


include('includes/footer.html');
 ?>