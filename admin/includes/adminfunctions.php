<?php


function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));

}

function addCategory() {
    global $connection;
    if(isset($_POST['cat_title'])) {
        $category_title = $_POST['cat_title'];
        $query = "INSERT INTO category VALUES (NULL, '$category_title')";
        $result = mysqli_query($connection, $query); 
        }
    }

function deleteCategory() {
    if (isset($_GET['delete'])) {
        global $connection;
        $id = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id='$id'";
        $result = mysqli_query($connection, $query);
        header("Location: categories.php");
        }
}

function updateCategory() {
    global $connection;
    $newTitle = $_POST['edit'];
    $query = "UPDATE category SET cat_title='$newTitle' WHERE cat_id=$editId";
    mysqli_query($connection, $query);
    header('Location: categories.php');
}

function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM category";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo"<td>{$id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$id}'>Delete</a></td>"; 
    echo "<td><a href='categories.php?edit={$id}'>Edit</a></td>";
    echo "</tr>";
    } 
}

function selectAndUpdateCategories() {
    global $connection;
    if (isset($_GET['edit'])) {
        $editId = $_GET['edit'];
        $query = "SELECT * FROM category WHERE cat_id = $editId";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        $catTitle = $row['cat_title'];
        $catId = $row['cat_id'];
        ?> <?php
        echo"<input class='form-control' type='text' name='edit' value='$catTitle'>";
        echo"</div>";
        echo"<div class='form-group'>";
        echo"<input class='btn btn-primary' type='submit' name='submit' value='Edit Category'>";
        echo"<?php }}?>"; ?>
        <?php 

        if (isset($_POST['edit'])) {
        $newTitle = $_POST['edit'];
        $query = "UPDATE category SET cat_title='$newTitle' WHERE cat_id=$editId";
        mysqli_query($connection, $query);
        header("Location: categories.php?edit='{$editId}'"); } ?>
        
<?php }}} ?>

<?php

function confirm($result) {
    global $connection;
    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
};

function deletePost() {
    global $connection;
    $id = $_GET['deletepost'];
    $query = "DELETE FROM comments WHERE comment_post_id={$id}";
    $result = mysqli_query($connection, $query);
    $query = "DELETE FROM posts WHERE post_id={$id}";
    $result = mysqli_query($connection, $query);
    confirm($result);
    header('Location: posts.php');        
}

function addPost() {
    global $connection;
    if (isset($_POST['create_post'])) {
        $title = $_POST['title'];
        $cat_id = $_POST['post_category'];
        $author = $_POST['author'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $tags = $_POST['post_tags'];
        $content = $_POST['post_content'];
        $date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
        VALUES ({$cat_id}, '{$title}', '{$author}', now(), '{$post_image}', '{$content}', '{$tags}', 'Draft' )";
        mysqli_query($connection, $query);

        $query = "SELECT * FROM posts WHERE post_title = '{$title}'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $pid = $row['post_id'];

        echo "Post created: " . "<a href='../post.php?p_id={$pid}'>View Post</a>";
    }
}

function editPost($id) {
    global $connection;
    $title = $_POST['title'];
    $cat_id = $_POST['post_category'];
    $author = $_POST['author'];
    $status = $_POST['status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    if(empty($post_image)) {
        $querySelectImage = "SELECT * FROM posts WHERE post_id= $id ";
        $selectimage = mysqli_query($connection, $querySelectImage);
        while ($row = mysqli_fetch_array($selectimage)) {
            $post_image = $row['post_image'];
        }
    }
    $tags = $_POST['post_tags'];
    $content = $_POST['post_content'];
    $query = "SELECT * FROM posts WHERE post_id={$id}";
    $result = mysqli_query($connection, $query);
    $fetchRow = mysqli_fetch_assoc($result);
    $comment_count = $fetchRow['post_comment_count'];
    

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "UPDATE posts SET post_category_id={$cat_id}, post_title='{$title}', post_author='{$author}', post_date=now(), post_image='{$post_image}', post_content='{$content}',
         post_tags='{$tags}', post_comment_count={$comment_count}, post_status='{$status}' WHERE post_id={$id}";
        mysqli_query($connection, $query);

        echo"Post updated: " . "<a href='../post.php?p_id={$id}'>View Post</a>";
    }

    function deleteComment() {
        global $connection;
        $id = $_GET['deletecomments'];
        $query = "SELECT * FROM comments WHERE comment_id = {$id}";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $cpid = $row['comment_post_id'];
        $query = "UPDATE posts SET post_comment_count = post_comment_count-1 WHERE post_id = {$cpid}";
        $result = mysqli_query($connection, $query);
        $query = "DELETE FROM comments WHERE comment_id={$id}";
        $result = mysqli_query($connection, $query);
        confirm($result);
        header('Location: comments.php');        
    }

    function approveComment() {
        global $connection;
        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id= '$comment_id' ";
        mysqli_query($connection, $query);
    }

    function unapproveComment() {
        global $connection;
        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id= '$comment_id' ";
        mysqli_query($connection, $query);
    }
    function deleteUser() {
        global $connection;
        $id = $_GET['deleteuser'];
        $query = "DELETE FROM users WHERE user_id={$id}";
        $result = mysqli_query($connection, $query);
        confirm($result);
        header('Location: users.php');        
    }

    function changeToAdmin() {
        global $connection;
        $user_id = $_GET['changetoadmin'];
        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = '$user_id' ";
        mysqli_query($connection, $query);
    }

    function changeToUser() {
        global $connection;
        $user_id = $_GET['changetouser'];
        $query = "UPDATE users SET user_role = 'User' WHERE user_id = '$user_id' ";
        mysqli_query($connection, $query);
    }

    function editUser($id) {
        global $connection;

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $user_role = $_POST['role'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            move_uploaded_file($user_image_temp, "../userimages/$user_image");

            if(empty($user_image)) {
            $querySelectImage = "SELECT * FROM users WHERE user_id = $id ";
            $selectimage = mysqli_query($connection, $querySelectImage);
            while ($row = mysqli_fetch_array($selectimage)) {
                $user_image = $row['user_image'];
            }
        }
            move_uploaded_file($user_image_temp, "../images/$user_image");
    
            $query = "UPDATE users SET username='{$username}', user_password='{$password}', user_firstname='{$firstname}', user_lastname='{$lastname}', user_image='{$user_image}', user_role='{$user_role}' WHERE user_id={$id}";
            mysqli_query($connection, $query);
        } else {

        move_uploaded_file($user_image_temp, "../userimages/$user_image");
        if(empty($user_image)) {
            $querySelectImage = "SELECT * FROM users WHERE user_id = $id ";
            $selectimage = mysqli_query($connection, $querySelectImage);
            while ($row = mysqli_fetch_array($selectimage)) {
                $user_image = $row['user_image'];
            }
        }
            move_uploaded_file($user_image_temp, "../images/$user_image");
    
            $query = "UPDATE users SET username='{$username}', user_firstname='{$firstname}', user_lastname='{$lastname}', user_image='{$user_image}', user_role='{$user_role}' WHERE user_id={$id}";
            mysqli_query($connection, $query);

        }}

        function updateUser($id) {
            global $connection;
    
            $username = $_POST['username'];
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];

            move_uploaded_file($user_image_temp, "../userimages/$user_image");
            if(empty($user_image)) {
                $querySelectImage = "SELECT * FROM users WHERE user_id = $id ";
                $selectimage = mysqli_query($connection, $querySelectImage);
                while ($row = mysqli_fetch_array($selectimage)) {
                    $user_image = $row['user_image'];
                }
            }
                move_uploaded_file($user_image_temp, "../images/$user_image");
        
                $query = "UPDATE users SET username='{$username}', user_firstname='{$firstname}', user_lastname='{$lastname}', user_email='{$email}', user_image='{$user_image}' WHERE user_id={$id}";
                mysqli_query($connection, $query);
    
            }


            function displayPosts() {
                global $connection;
                $query = "SELECT * FROM posts ";
                $result = mysqli_query($connection, $query);
                $postcount = mysqli_num_rows($result);
                echo $postcount;
            }

            function displayUsers() {
                global $connection;
                $query = "SELECT * FROM users ";
                $result = mysqli_query($connection, $query);
                $usercount = mysqli_num_rows($result);
                echo $usercount;
            }

            function displayComments() {
                global $connection;
                $query = "SELECT * FROM comments ";
                $result = mysqli_query($connection, $query);
                $commentcount = mysqli_num_rows($result);
                echo $commentcount;
            }
            
            function displayCategories() {
                global $connection;
                $query = "SELECT * FROM category ";
                $result = mysqli_query($connection, $query);
                $categorycount = mysqli_num_rows($result);
                echo $categorycount;
            }

function users_online() {
    if (isset($_GET['onlineusers'])) {

    
    session_start();
    //$connection = mysqli_connect('localhost', 'root', '', 'cms');
    include("../../includes/db.php");
    // global $connection;
    

    
    $session = session_id();
    $time = time(); 
    $timeOutInSeconds = 60; 
    $timeOut = $time - $timeOutInSeconds; 
                
    $query = "SELECT * FROM users_online WHERE session = '$session'"; 
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result); 
                
    if ($count == NULL) { 
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time') ");
    }else {
                
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'"); 
    }
                
    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$timeOut'"); 
    echo $countUsers = mysqli_num_rows($users_online_query); 
     }                                                                                         
}

function recordCount($table) {
    global $connection;
    $query = "SELECT * FROM " . $table;
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

function postStatusCount($table, $status) {
    global $connection;
    $query = "SELECT * FROM $table WHERE post_status = '$status' ";
    $selectdraftposts = mysqli_query($connection, $query);
    return mysqli_num_rows($selectdraftposts);
}

function commentStatusCount($table, $status) {
    global $connection;
    $query = "SELECT * FROM $table WHERE comment_status = '$status' ";
    $selectdraftcomments = mysqli_query($connection, $query);
    return mysqli_num_rows($selectdraftcomments);
}

function userCount($table, $role) {
    global $connection;
    $query = "SELECT * FROM $table WHERE user_role = '$role' ";
    $numusers = mysqli_query($connection, $query);
    return mysqli_num_rows($numusers); 
}

function login($username, $password) {

    global $connection;

    $username = trim(mysqli_real_escape_string($connection, $username));
    $password = trim(mysqli_real_escape_string($connection, $password));

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
    }


    if (password_verify($password, $db_user_password)) {

        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['role'] = $db_user_role;

        header('Location: ../admin');

    } else {
        header("Location: ../index.php");
    }
}

users_online(); 



?>

