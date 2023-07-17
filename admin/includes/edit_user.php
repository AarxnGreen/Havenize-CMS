<?php 

if(isset($_GET['u_id'])) {
    global $connection;
    $id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE user_id=$id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if (isset($_POST['update_user'])) {
        editUser($id);
        header('Location: users.php');
    }
}?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="username">Username</label>
          <input type="text" class="form-control" name="username" value="<?=$row['username']?>">
      </div>
        
      
      <div class="form-group">
         <label for="password">Password</label>
         <input type="password" class="form-control" name="password" value="<?=$row['user_password']?>">
     </div>
     
    <div class="form-group">
         <label for="email">Email</label>
         <input type="text" class="form-control" name="email" value="<?=$row['user_email']?>">
     </div>
     
    <div class="form-group">
         <label for="firstname">First Name</label>
         <input type="text" class ="form-control" name="firstname" value="<?=$row['user_firstname']?>">
     </div>
   
     <div class="form-group">
         <label for="lastname">Last Name</label>
         <input type="text" class="form-control" name="lastname" value="<?=$row['user_lastname']?>">
     </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="">
                <option value="<?=$row['user_role']?>"><?=$row['user_role']?></option>
                <?php if ($row['user_role'] === 'Admin') {
                    echo "<option value='User'>User</option>";
                    } else {
                        echo "<option value='Admin'>Admin</option>";
                    }?>
                
        </select>
    </div>
      
     <div class="form-group">
         <label for="userimage">Profile Picture</label>
         <img width="100" length="100"src="../userimages/<?=$row['user_image']?>">
         <input type="file" name="image" value="<?=$row['user_image']?>">
     </div>
     
     <div class="form-group">
     
     <input type="submit" class="btn btn-primary" name="update_user" value="Update">
     
     </div>