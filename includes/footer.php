</div>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="http://commentsys.test/star_rating/dist/jquery.star-rating-svg.js"></script>
<link rel="stylesheet" type="text/css" href="http://commentsys.test/star_rating/src/css/star-rating-svg.css">
<script>
    $(document).ready(function() {
        
        $(document).on('submit',function(e){
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
                    fetch_me();
                }
            });
        });


        $("[name='delete_comment']").on('click',function(e){
            e.preventDefault();
            var id = $(this).val();           
            
            $.ajax({
                type: 'post',
                url: 'http://commentsys.test/delete_comment.php',
                data: {
                    delete: 'delete',
                    id: id
                },
                success: function (){
                    $("#delete-msg").html("Deleted successfully.").toggleClass("alert alert-success bg-success text-white mt-3");
                    fetch_me();
                }
            });
        });

        function fetch_me(){

            setInterval(() => {
                $("body").load("show.php?id=<?= $_GET["id"]??'gest'; ?>")
            }, 4000);
        }

        $(".my-rating").starRating({
            initialRating: "<?php if (isset($rate->ratings) && isset($rate->user_id) && $rate->user_id == $_SESSION["user_id"]) { echo $rate->ratings;} else {echo "0";}?>",
            strokeColor: '#894A00',
            strokeWidth: 10,
            starSize: 25,
            callback: function(currentRating, $el){
                $("#rating").val(currentRating);
                $(".my-rating").click((e)=>{
                    e.preventDefault();
                    form_rating = $("#form-rating").serialize()+'&insert=insert';
                    alert(form_rating);
                    $.ajax({
                        type: "POST",
                        url: 'insert_rating.php',
                        data: form_rating
                    });
                });
            }
        });

        //live search

        

        $("#search").keyup(function(){
            let search = $(this).val();
            if (search !== '') {
                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data: {
                        search: search
                    },
                    success: function(data){
                        $("#search_data").css('display','block');
                        $("#search_data").html(data);
                    }
                });
                
            }else{
                $("#search_data").css('display','none');
            }
        });

    });
</script>
</body>
</html>