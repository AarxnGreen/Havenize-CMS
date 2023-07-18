<?php include 'includes/header.php';?>

 <!-- Navigation -->
<?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    All Posts
                </h1>
                <?php

                if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                $query = "SELECT * FROM posts";
                } else {$query = "SELECT * FROM posts WHERE post_status = 'Published'";}
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);
                if ($count !== 0) {

                    if (!isset($_POST['search'])) {
                        if (isset($_GET['page'])) {
                            $perPage = 5;
                            $pageNum = $_GET['page'];
                        } else {$pageNum = "";}
                        if ($pageNum == "" || $pageNum == 1) {
                            $page = 0;
                            $perPage = 5;
                        } else {
                            $page = ($pageNum * $perPage) - $perPage;
                        }
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'){
                    $postquerycount = "SELECT * FROM posts";
                    } else {$postquerycount = "SELECT * FROM posts WHERE post_status = 'Published'";}
                    $find_count = mysqli_query($connection, $postquerycount);
                    $count = mysqli_num_rows($find_count);
                    $count = $count / $perPage;
                    $count = ceil($count);
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                    $query = "SELECT * FROM posts LIMIT $page, $perPage"; 
                    } else {$query = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $page, $perPage";}
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
                  <?php }} else echo "<h1 class='text-center'>No Posts Available</h1>"; ?>        
                <hr>

                <!-- Pager -->
                <ul class="pager">
                    
                    <li class="previous">
                        <a href=<?php if (isset($_GET['page']) && $_GET['page'] <= $count) {
                            $page = $_GET['page'];
                            $page--;
                            if ($page !== 0) {
                            echo "index.php?page=$page";}
                            else {
                                echo "index.php?";
                            }
                            } else {
                                echo "index.php";
                            }?>>&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href=<?php if (isset($_GET['page']) && $_GET['page'] < $count) {
                            $page = $_GET['page'];
                            $page++;
                            echo "index.php?page=$page";} elseif (!isset($_GET['page'])) {
                                echo "index.php?page=1";
                            }  
                            ?>>Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>
        <!-- /.row -->
        <hr>

        <ul class="pager">
            <?php 
            for ($i = 1; $i <= $count; $i++) {

                echo "<li><a href='index.php?page={$i}'>{$i}</a></li";
            }
            ?>
        </ul>                


    <?php include 'includes/footer.php';?>
