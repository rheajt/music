<?php 

if($_GET['voteType'] == 'up') {
    $id = $_GET['link_id'];

    include 'music_conn.php';
    $stmt = $mysqli->prepare('UPDATE links SET upvotes=upvotes+1 WHERE link_id='.$id);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    echo 'worked';
} elseif ($_GET['voteType'] == 'down') {
    $id = $_GET['link_id'];

    include 'music_conn.php';
    $stmt = $mysqli->prepare('UPDATE links SET downvotes=downvotes+1 WHERE link_id='.$id);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    echo 'worked';
} else {
    echo 'failed';
}

 ?>