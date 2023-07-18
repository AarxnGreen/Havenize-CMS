<?php



function listCategories() {
    global $connection;
    $query = "SELECT * FROM category";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo"<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
        
       
    }
}


function userExists($username) {
    global $connection;

    $query = "SELECT username FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function emailExists($email) {
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email='$email'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function redirect($location) {
    return header("Location: " . $location);
}





function registerUser($username, $password, $email) {

    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $email = mysqli_real_escape_string($connection, $email);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

    $query = "INSERT INTO users (username, user_password, user_email, user_role) VALUES ('{$username}', '{$password}', '{$email}', 'User')";
    $registerUserQuery = mysqli_query($connection, $query);
    if (!$registerUserQuery) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
    
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
    
            header('Location: index.php');
        } else {
            header("Location: ../index.php");
        }
    }


