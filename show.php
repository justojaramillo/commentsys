<?php
require_once "includes/header.php";
require_once "config.php";


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $one_post = $conn->query("SELECT * FROM posts WHERE post_id='$id'");
    $one_post->execute();
    $post = $one_post->fetch(PDO::FETCH_OBJ);
}

$comments = $conn->query("SELECT * FROM comments WHERE post_id='$id'");
$comments->execute();
$comment = $comments->fetchAll(PDO::FETCH_OBJ);

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

    <div class="row ">
        <form method="POST" id="comment_data">
    
            <div class="form-floating mt-3">
            <input value="<?= $post->post_id ?>" name="post_id" type="hidden" class="form-control" id="post_id">
            </div>
        
            <div class="form-floating mt-3">
            <input value="<?= $_SESSION["username"] ?>" name="username" type="hidden" class="form-control" id="username">
            </div>    

            <div class="form-floating mt-3">
            <textarea rows="9" name="comment" placeholder="comment" class="form-control" id="comment"></textarea>
            <label for="floatingPassword">Comment</label>
            </div>
        
            <button name="submit" id="submit" class="w-100 btn btn-lg btn-primary mt-5" type="submit">Create comment</button>
        <div id="msg" class="nothing"></div>
    
      </form>
    </div>
    <div class="row">
        <?php foreach ($comment as $comm) : ?>
        <div class="card mt-5">
            <div class="card-body">
                <p class="card-text"><?= $comm->username ?></p>
                <h5 class="card-title"><?= $comm->comment ?> </h5>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- AQUI QUEDE MINUTO 6:52 -->
    </div>
</main>


<?php require_once "includes/footer.php"; ?>

<script>
    $( document ).ready(function() {
        
        

        $(document).on('submit',function(e){
            console.log("submitted");
            e.preventDefault();
            
            var form_data = $('#comment_data').serialize()+'&submit=submit';
            
            $.ajax({
                type: 'post',
                url: 'http://commentsys.test/insert_comment.php',
                data: form_data,
                success: function (){
                    $('#comment').val('');
                    $('#username').val('');
                    $('#post_id').val('');
                    $("#msg").html("Added successfully.").toggleClass("alert alert-success bg-success text-white mt-3");
                }
            });
        });
    });
</script>