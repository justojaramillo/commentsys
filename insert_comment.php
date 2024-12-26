<?php 
require_once "config.php"; 

if (isset($_POST["submit"])) {

    $post_id = $_POST["post_id"];
    $username = $_POST["username"];
    $comment = $_POST["comment"];

    $insert = $conn->prepare("INSERT INTO comments(post_id, username, comment) VALUES (:post_id, :username, :comment)");
    $insert->execute([":post_id"=>$post_id, ":username"=>$username, ":comment"=>$comment]);
}


?>