<?php include 'includes/header.php';?>

 <!-- Navigation -->
<?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php

                if (isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];

                    $query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $post_id";
                    mysqli_query($connection, $query);
                
                    $query = "SELECT * FROM posts WHERE post_id=$post_id";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    
                    ?>
                <h1 class="page-header">
                    Post
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?=$post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?=$post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?=$post_image?>" alt="">
                <hr>
                <p><?=$post_content?></p>
                <hr>
                  <?php }} ?>
                <!-- Blog Comments -->
                <?php
                if (isset($_POST['create_comment'])) {

                    $comment_author = $_POST['comment_author'];
                    $comment_post_id = $_GET['p_id'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                    $commentquery = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ('$comment_post_id', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                    $commentresult = mysqli_query($connection, $commentquery);
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $comment_post_id ";
                    mysqli_query($connection, $query);
                } else {
                    echo "<script>alert('Fields cannot be empty')</script>";
                }
            }
                
                
                
                
                ?>




                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="POST" action="" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name ="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name ="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <?php 

                $post_id = $_GET['p_id'];
                $query = "SELECT * FROM comments WHERE comment_status = 'approved' and comment_post_id = $post_id ORDER by comment_id DESC ";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)){
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?=$comment_author?>
                            <small><?=$comment_date?></small>
                        </h4>
                        <?=$comment_content?>
                    </div>
                </div>

              <?php  }?>
                
                <hr>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>
        <!-- /.row -->
        <hr>
    <?php include 'includes/footer.php';?>
