<?php 
$page_title = "Rate the music!";
$custom_js = "includes/js/rate.js";

include('includes/header.html');

include('music_conn.php');
$stmt = $mysqli->prepare("SELECT link_id, url FROM links ORDER BY upvotes ASC");
$stmt->execute();
$stmt->bind_result($id, $url);

while($stmt->fetch()) {
    $play_list[] = array("id"=> $id, "url" => $url);
}

foreach ($play_list as $p) {
    echo '
        <div class="col-md-4"
            <div class="link-well">
                <a href="https://www.youtube.com/watch?v='.$p['url'].'">https://www.youtube.com/watch?v='.$p['url'].'</a>
            </div>
        </div>';
}


include('includes/footer.html');
 ?>