<?php 
include ("delete_modal.php");

if (isset($_GET['deletepost'])) {
    if ($_SESSION['role'] === "Admin") {
    deletePost();
    }
} if (isset($_GET['publishpost'])) {
    if ($_SESSION['role'] === "Admin") {
    publishPost();
    }
} if (isset($_GET['draftpost'])) {
    if ($_SESSION['role'] === "Admin") {
    draftPost();
    }
}

if (isset($_POST['checkBoxArray'])) {

    $idArray = $_POST['checkBoxArray'];

    if ($_POST['action'] == "publish") {
        foreach ($idArray as $pid) {
            $post_id = $pid;
            $query = "UPDATE posts SET post_status='Published' WHERE post_id='{$post_id}'";
            mysqli_query($connection, $query);
        }

        header("Location: posts.php");
    }

    if ($_POST['action'] == "draft") {
        foreach ($idArray as $pid) {
            $post_id = $pid;
            $query = "UPDATE posts SET post_status='Draft' WHERE post_id='{$post_id}'";
            mysqli_query($connection, $query);
        }

        header("Location: posts.php");
    }

    if ($_POST['action'] == "delete") {
        foreach ($idArray as $pid) {
            $post_id = $pid;
            $query = "DELETE FROM posts WHERE post_id='{$post_id}'";
            mysqli_query($connection, $query);
        }

        header("Location: posts.php");
    }
    if ($_POST['action'] == "clone") {
        foreach ($idArray as $pid) {
            $post_id = $pid;
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $cPid = $row['comment_post_id'];
                $cAuthor = $row['comment_author'];
                $cEmail = $row['comment_email'];
                $cContent = $row['comment_content'];
                $cStatus = $row['comment_status'];
                $cDate = $row['comment_date'];

                $query = "INSERT INTO comments VALUES (NULL, '{$cPid}', '{$cAuthor}', '{$cEmail}', '{$cContent}', '{$cStatus}', '{$cDate}')";
                mysqli_query($connection, $query);
            }
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);

            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
            $post_views = $row['post_views'];

            $query = "INSERT INTO posts VALUES (NULL, '{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}', '{$post_views}')";
            mysqli_query($connection, $query);
        
        }

        header("Location: posts.php");
    }

    if ($_POST['action'] == 'resetviewcount') {
        foreach ($idArray as $pid) {
            $post_id = $pid;
            $query = "UPDATE posts SET post_views = 0 WHERE post_id = $post_id";
            mysqli_query($connection, $query);
        }

        header("Location: posts.php");
    }
}




?>

<form action="" method="post">

<table class="table table-bordered table-hover">

        <div class="col-xs-4" id="bulkOptionContainer">

            <select class="form-control" name="action" id="">
            <option value="">Select Options</option>
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
            <option value="resetviewcount">Reset Views</option>

            </select>

        </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>




                        <thead>
                            <tr>
                                <th><input id="selectAllBoxes" type="checkbox"></th>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Total Views</th>
                                <th>View Post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM posts ORDER BY post_id DESC";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_category_id = $row['post_category_id'];
                        $post_tags = $row['post_tags'];
                        $post_status = $row['post_status'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_views = $row['post_views'];
                    
                        echo"<tr>";
                        echo"<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'</td>";
                        echo"<td>$post_id</td>";
                        echo"<td>$post_author</td>";
                        echo"<td>$post_title</td>";

                             $query = "SELECT * FROM category WHERE cat_id = {$post_category_id}";
                             $selectcategory = mysqli_query($connection, $query);
                             while ($catrow = mysqli_fetch_assoc($selectcategory)) {
                             $catTitle = $catrow['cat_title'];

                        echo"<td>{$catTitle}</td>";
                             }




                        echo"<td>$post_status</td>";
                        echo"<td> <img src='../images/$post_image' width='100' height='100'> </td>";
                        echo"<td>$post_tags</td>";
                        echo"<td>$post_comment_count</td>";
                        echo"<td>$post_date</td>";
                        echo"<td>$post_views</td>";
                        echo"<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                        echo"<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                        echo"<td><a rel ='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                        echo"</tr>";
                    }?>
                    </tbody>
                    </table>
                </form>

                    <script>

                    $(document).ready(function(){
                        $(".delete_link").on('click', function() {
                            var id = $(this).attr("rel");
                            var delete_url = "posts.php?deletepost="+ id +" ";
                            $(".modal_delete_link").attr("href", delete_url);
                            $("#deleteModal").modal('show');
                        })
                    });

                    </script>