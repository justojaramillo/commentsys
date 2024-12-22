<?php 

require_once "includes/header.php";

$wellcome = $_SESSION["username"]??"from index";

echo "hello $wellcome";

require_once "includes/footer.php"; 
?>
