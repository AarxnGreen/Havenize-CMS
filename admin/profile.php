<?php include 'includes/admin_header.php' ?>

<?php if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}' ";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
}    
 
if (isset($_POST['update_profile'])) {
    updateUser($user_id);
    header('Location: profile.php');
}


?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Update Profile
                            <small></small>
                            </h1>
                            <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="username">Username</label>
          <input type="text" class="form-control" name="username" value="<?=$username?>">
      </div>
        
      
     
    <div class="form-group">
         <label for="email">Email</label>
         <input type="text" class="form-control" name="email" value="<?=$user_email?>">
     </div>
     
    <div class="form-group">
         <label for="firstname">First Name</label>
         <input type="text" class ="form-control" name="firstname" value="<?=$user_firstname?>">
     </div>
   
     <div class="form-group">
         <label for="lastname">Last Name</label>
         <input type="text" class="form-control" name="lastname" value="<?=$user_lastname?>">
     </div>
      
     <div class="form-group">
         <label for="userimage">Profile Picture</label>
         <img width="100" length="100"src="../userimages/<?=$user_image?>">
         <input type="file" name="image" value="<?=$user_image?>">
     </div>
     
     <div class="form-group">
     
     <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
     
     </div>
                    
                
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?php include 'includes/admin_footer.php' ?>
