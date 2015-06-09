<?php 
include 'music_conn.php';

if(isset($_GET['link_id'], $_GET['msg'])) {

    $id = (int) $_GET['link_id'];
    $msg = $mysqli->real_escape_string(trim($_GET['msg']));

    $stmt = $mysqli->prepare("INSERT INTO comments (link_id, comment) VALUES (?, ?)");
    if(!($stmt->bind_param('is', $id, $msg))) {
        echo 'failed';
    }
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    echo 'worked';
} else {

    // you should put all ajax calls into the same ajax request. so call ajax from rate.js
    // when the server calls vote.php
    $id = (int) $_GET['id'];

    if($stmt = $mysqli->prepare("SELECT comment FROM comments WHERE link_id=?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($com);

        if($stmt->num_rows > 0) {
            while($stmt->fetch()) {
                $comments[] = $com;
            }
            echo json_encode($comments);
        } else {
            echo $id;
        }
    } else {
        echo "failed to prepare";
    }
}


 ?>