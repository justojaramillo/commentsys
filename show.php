<?php
require_once "includes/header.php";
require_once "config.php";


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user_id = $_SESSION['user_id']??'guest';
    $one_post = $conn->query("SELECT * FROM posts WHERE post_id='$id'");
    $one_post->execute();
    $post = $one_post->fetch(PDO::FETCH_OBJ);
}

$comments = $conn->query("SELECT * FROM comments WHERE post_id='$id'");
$comments->execute();
$comment = $comments->fetchAll(PDO::FETCH_OBJ);

$rating = $conn->query("SELECT * FROM rates WHERE post_id='$id' AND user_id='$user_id'");
$rating->execute();
$rate = $rating->fetch(PDO::FETCH_OBJ);



?>
<main class="form-signin w-90 m-auto mt-5">
    <div id="search_data"></div>
    <div class="row">
        <div class="card mt-5">
            <div class="card-body">
                <p class="card-text"><?= $post->create_at ?></p>
                <h5 class="card-title"><?= $post->title ?> </h5>
                <p class="card-text"><?= substr($post->body,0,100).'...' ?></p>
                <form method="post" id="form-rating">
                    <div class="my-rating"></div>
                    <input type="hidden" id="rating" name="rating" value="">
                    <input type="hidden" id="post_id" name="post_id" value="<?= $post->post_id ?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION["user_id"]??'guest' ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="row ">
        <?php if(isset($_SESSION["username"])) : ?>
        <form method="POST" id="comment_data">
    
            <div class="form-floating mt-3">
            <input value="<?= $post->post_id ?>" name="post_id" type="hidden" class="form-control" id="post_id">
            </div>
        
            <div class="form-floating mt-3">
            <input value="<?= $_SESSION["username"]??'gest' ?>" name="username" type="hidden" class="form-control" id="username">
            </div>    

            <div class="form-floating mt-3">
            <textarea rows="9" name="comment" placeholder="comment" class="form-control" id="comment"></textarea>
            <label for="floatingPassword">Comment</label>
            </div>
        
            <button name="submit" id="submit" class="w-100 btn btn-lg btn-primary mt-5" type="submit">Create comment</button>
            <div id="msg" class="nothing"></div>
            <div id="delete-msg" class="nothing"></div>
        </form>
        <?php endif; ?>
    </div>
    <div class="row">
        <?php foreach ($comment as $comm) : ?>
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-text"><?= $comm->username ?></h5>
                <p class="card-title"><?= $comm->comment ?> </p>
                <?php if ( isset($_SESSION["username"]) && $_SESSION["username"] == $comm->username) :?>
                    <button name="delete_comment"  value="<?= $comm->comments_id ?>"  class="btn btn-danger mt-3" >Delete comment</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        
    </div>
</main>


<?php require_once "includes/footer.php"; ?>

