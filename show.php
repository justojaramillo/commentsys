<?php
require_once "includes/header.php";
require_once "config.php";


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $one_post = $conn->query("SELECT * FROM posts WHERE post_id='$id'");
    $one_post->execute();
    $post = $one_post->fetch(PDO::FETCH_OBJ);
}

?>
<main class="form-signin w-90 m-auto mt-5">
    <div class="row">
        <div class="card mt-5">
            <div class="card-body">
                <p class="card-text"><?= $post->create_at ?></p>
                <h5 class="card-title"><?= $post->title ?> </h5>
                <p class="card-text"><?= substr($post->body,0,100).'...' ?></p>
            </div>
        </div>
    </div>
</main>

<?php require_once "includes/footer.php"; ?>