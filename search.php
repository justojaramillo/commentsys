<?php
require_once "config.php"; 

if (isset($_POST['search'])) {
    $search = $_POST["search"];
    $select = $conn->query("SELECT * FROM posts WHERE title like '{$search}%'");
    $select->execute();
    $rows = $select->fetchAll(pdo::FETCH_OBJ);
    /* foreach ($rows as $row) {
        echo "<h2>$row->title</h2>";
        echo "<h2>$row->body</h2>";
        
    } */
}



?>
<?php foreach($rows as $row): ?>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title"><?= $row->title ?> </h5>
            <p class="card-text"><?= substr($row->body,0,100).'...' ?></p>
            <a href="show.php?id=<?= $row->post_id ?>" class="btn btn-primary">More</a>
        </div>
    </div>
<?php endforeach; ?>