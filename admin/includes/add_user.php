<?php  

if (isset($_POST['create_user'])) {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_role = $_POST['role'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../userimages/$user_image");

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUES ('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$email}', '{$user_image}', '{$user_role}')";
    $result = mysqli_query($connection, $query);
    confirm($result);

    echo"User created: " . "<a href='users.php?'>{$username}</a>";
}

?>




<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="username">Username</label>
          <input type="text" class="form-control" name="username">
      </div>
        
      
      <div class="form-group">
         <label for="password">Password</label>
         <input type="password" class="form-control" name="password">
     </div>
     
    <div class="form-group">
         <label for="email">Email</label>
         <input type="text" class="form-control" name="email">
     </div>
     
    <div class="form-group">
         <label for="firstname">First Name</label>
         <input type="text" class ="form-control" name="firstname">
     </div>
   
     <div class="form-group">
         <label for="lastname">Last Name</label>
         <input type="text" class="form-control" name="lastname">
     </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role">
            <option value='Admin'>Admin</option>
            <option value='User'>User</option>
        </select>
    </div>
      
     <div class="form-group">
         <label for="userimage">Profile Picture</label>
         <input type="file" name="image">
     </div>
     
     <div class="form-group">
     
     <input type="submit" class="btn btn-primary" name="create_user" value="Create">
     
     </div>