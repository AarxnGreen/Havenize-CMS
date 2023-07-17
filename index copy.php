<?php include 'includes/header.php';?>

 <!-- Navigation -->
<?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if (!isset($_POST['search'])) {
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    } else {
                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    }
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    
                    ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?=$post_id?>"><?=$post_title?></a>
                </h2>
                <p class="lead">
                    by <a href='author_posts.php?author=<?=$post_author?>'><?=$post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post_date?></p>
                <hr>
                <a href="post.php?p_id=<?=$post_id?>"><img class="img-responsive" src="images/<?=$post_image?>" alt=""></a>
                <hr>
                <p><?=$post_content?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?=$post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                  <?php } ?>        
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
