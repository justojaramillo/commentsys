<?php
require_once "config.php";

if (isset($_POST["insert"])) {
    $post_id = $_POST["post_id"];
    $rating = $_POST["rating"];
    $delete = $conn->prepare("DELETE FROM WHERE post_id='$post_id'");
    $delete->execute();
    $insert = $conn->prepare("INSERT INTO rates(post_id, ratings) VALUES (:post_id, :ratings)");
    $insert->execute([":post_id"=> $post_id, ":ratings"=>$rating]);
}



?>