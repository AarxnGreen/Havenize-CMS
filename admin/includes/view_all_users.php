<?php 


if (isset($_GET['deletecomments'])) {
    if ($_SESSION['role'] === "Admin") {
    deleteComment();}
}
    
if (isset($_GET['unapprove'])) {
    if ($_SESSION['role'] === "Admin") {
        unapproveComment();
    }
}

if (isset($_GET['approve'])) {
    if ($_SESSION['role'] === "Admin") {
        approveComment();
    }
} 

if (isset($_GET['deleteuser'])) {
    if ($_SESSION['role'] === "Admin") {
    deleteUser();
    }

} if (isset($_GET['changetouser'])) {
    if ($_SESSION['role'] === "Admin") {
    changeToUser();
    }

}if (isset($_GET['changetoadmin'])) {
    if ($_SESSION['role'] === "Admin") {
    changeToAdmin();
    }
}?>

<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>User Image</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_role = $row['user_role'];
                        $user_image = $row['user_image'];
                        $user_password = $row['user_password'];
                    
                        echo"<tr>";
                        echo"<td>$user_id</td>";
                        echo"<td>$username</td>";
                        echo"<td>$user_firstname</td>";
                        echo"<td>$user_lastname</td>";
                        echo"<td>$user_email</td>";
                        echo"<td> <img src='../userimages/$user_image' width='100' height='100'> </td>";
                        echo"<td>$user_role</td>";
                        echo"<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
                        echo"<td><a href='users.php?deleteuser={$user_id}'>Delete</a></td>";
                        echo"</tr>";
                    }?>
                    </tbody>
                    </table>