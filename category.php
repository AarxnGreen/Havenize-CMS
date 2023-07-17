<?php include 'includes/header.php';?>

 <!-- Navigation -->
<?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                   if (isset($_GET['category'])) {
                    $post_cat_id = $_GET['category'];
                    if(isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                        $query = "SELECT * FROM posts WHERE post_category_id=$post_cat_id"; 
                    } else {
                        $query = "SELECT * FROM posts WHERE post_status = 'Published' AND post_category_id=$post_cat_id";
                    }
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);
                    if ($count !== 0) {

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

                        if(isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                            $postquerycount = "SELECT * FROM posts WHERE post_category_id=$post_cat_id";
                        } else {$postquerycount = "SELECT * FROM posts WHERE post_category_id=$post_cat_id AND post_status = 'Publushed'";}
                        $find_count = mysqli_query($connection, $postquerycount);
                        $count = mysqli_num_rows($find_count);
                        $count = $count / $perPage;
                        $count = ceil($count);
                        $query = "SELECT * FROM posts WHERE post_category_id=$post_cat_id LIMIT $page, $perPage";
                        $result = mysqli_query($connection, $query);
                    
                        while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                    
                    ?>
                <h1 class="page-header">
                    Category:
                    <?php $query = "SELECT * FROM category WHERE cat_id = $post_cat_id";
                    $result = mysqli_query($connection, $query);
                    $catRow = mysqli_fetch_assoc($result);
                    $catTitle = $catRow['cat_title'];?>
                    <small><?=$catTitle?></small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?=$post_id?>"><?=$post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?=$post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?=$post_image?>" alt="">
                <hr>
                <p><?=$post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                  <?php } } else {echo "<h1 class='text-center'>No Posts Available</h1>";} }?>        
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
        <ul class="pager">
            <?php 
            for ($i = 1; $i <= $count; $i++) {

                echo "<li><a href='category.php?category=$post_cat_id&page={$i}'>{$i}</a></li";
            }
            ?>
        </ul> 
        <hr>
    <?php include 'includes/footer.php';?>
