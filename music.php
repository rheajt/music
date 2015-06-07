<?php 
$regex ='/(?:https:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?/';

if(isset($_GET['link'])) {
    if(preg_match($regex, $_GET['link'])) {
        include('music_conn.php');

        $lk = $_GET['link'];
        // strip the video id from the link

        $vid_id = preg_replace($regex, '', $lk);
        $vid_id = explode('&', $vid_id);
        $stmt = $mysqli->prepare("INSERT INTO links (url) VALUES (?)");
        $stmt->bind_param("s", $vid_id[0]);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();


        echo 'linked';

    } else {
        echo 'fail';
    }
} else {
    echo 'fail';
}
 ?>
