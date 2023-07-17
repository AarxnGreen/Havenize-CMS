<?php 


if (isset($_GET['deletecomments'])) {
    if ($_SESSION['role'] === "Admin") {
    deleteComment();
    }}
    
if (isset($_GET['unapprove'])) {
    if ($_SESSION['role'] === "Admin") {
        unapproveComment();
    }}

if (isset($_GET['approve'])) {
    if ($_SESSION['role'] === "Admin") {
        approveComment();
        }} ?>

<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>In Response To</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Decline</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM comments";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $comment_id = $row['comment_id'];
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_post_id = $row['comment_post_id'];
                        $comment_email = $row['comment_email'];
                        $comment_status = $row['comment_status'];
                        $comment_content = $row['comment_content'];
                    
                        echo"<tr>";
                        echo"<td>$comment_id</td>";
                        echo"<td>$comment_author</td>";
                        echo"<td>$comment_content</td>";
                        echo"<td>$comment_email</td>";
                        $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
                        $selectpostidquery = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($selectpostidquery)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            echo"<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                        }
                        
                        echo"<td>$comment_status</td>";
                        echo"<td>$comment_date</td>";
                        echo"<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                        echo"<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                        echo"<td><a href='comments.php?deletecomments={$comment_id}'>Delete</a></td>";
                        echo"</tr>";
                    }?>
                    </tbody>
                    </table>