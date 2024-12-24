<?php 
require_once "includes/header.php";
require_once "config.php"; 

$select = $conn->query("SELECT * FROM posts");
$select->execute();
$rows = $select->fetchAll(PDO::FETCH_OBJ);

?>

<main class="form-signin w-50 m-auto mt-5">
    <?php foreach($rows as $row): ?>
    <div class="card mt-3">

        <div class="card-body">
            <h5 class="card-title"><?= $row->title ?> </h5>
            <p class="card-text"><?= substr($row->body,0,100).'...' ?></p>
            <a href="show.php?id=<?= $row->post_id ?>" class="btn btn-primary">More</a>
        </div>
    </div>
    <?php endforeach; ?>
</main>
<?php require_once "includes/footer.php"; ?>
