<?php 

require_once "includes/header.php";

$wellcome = $_SESSION["username"]??"from index";

echo "hello $wellcome<br>";
/* echo $_SERVER["SERVER_NAME"];
echo "<br>".$_SERVER['REQUEST_URI']; */

require_once "includes/footer.php"; 
?>
