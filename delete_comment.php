<?php
require_once "config.php";

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $conn->prepare("DELETE FROM comments WHERE comments_id='$id'");
    $delete->execute();
}

?>