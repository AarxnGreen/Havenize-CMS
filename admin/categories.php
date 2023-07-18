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
                            Categories
                        </h1>
                        <div class="col-xs-6">
                        <?php
                        // Adds a category to the DB 
                        addCategory(); ?>
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
                            // Selects + Updates categories
                            selectAndUpdateCategories();?>                                                      
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
                         
                            <?php//find all categories?>
                            <?php findAllCategories(); ?>
                            <?php//deletes categories?>
                            <?php deleteCategory(); ?>
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
