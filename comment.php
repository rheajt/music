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

    $stmt = $mysqli->prepare("SELECT link_id, comment FROM comments");
    $stmt->execute();
    $stmt->bind_result($id, $com);

    while($stmt->fetch()) {
        $comments[] = array('id'=>$id, 'comment'=>$com);
    }

    echo json_encode($comments);
}


 ?>