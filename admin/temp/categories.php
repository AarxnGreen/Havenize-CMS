<?php include 'includes/admin_header.php' ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">
                        <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                        </form>
                        <form action="" method="post">
                        <div class="form-group">
                            <label for="edit">Edit Category</label>
                            <?php

                            if (isset($_GET['edit'])) {
                            $editId = $_GET['edit'];
                            $query = "SELECT * FROM category WHERE cat_id = $editId";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            $catTitle = $row['cat_title'];

                                ?>
                                <input class="form-control" type="text" name="edit" value="<?php echo $catTitle ?>">
                                </div>
                                <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Edit Category">
                           <?php }}?> 
                           <?php 
                           if (isset($_POST['edit'])) {
                            $newTitle = $_POST['edit'];
                            $query = "UPDATE category SET cat_title='$newTitle' WHERE cat_id=$editId";
                            mysqli_query($connection, $query);
                            header('Location: categories.php');
                           }
                           
                           
                           
                           
                           ?>                                                      
                        </div>
                        </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php $query = "SELECT * FROM category";
                             $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['cat_id'];
                                $cat_title = $row['cat_title'];?>
                                    <tr>
                                        <td><?=$id?></td>
                                        <td><?=$cat_title?></td>
                                        <td><a href='categories.php?delete=<?=$id?>'>Delete</a></td>
                                        <td><a href='categories.php?edit=<?=$id?>'>Edit</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?php include 'includes/admin_footer.php' ?>
