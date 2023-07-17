<div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Login -->
                <div class="well">
                    <?php 
                    if (!isset($_SESSION['username'])) {
                    echo"<h4>Login</h4>";
                    echo"<form action='includes/login.php' method='post'>";
                        echo"<div class='input-group'>";
                            echo"<input type='text' name='username' class='form-control' placeholder='Enter Username'>";                 
                        echo"</div>";

                        echo"<div class='input-group'>";
                            echo"<input type='password' name='password' class='form-control' placeholder='Enter Password'>";
                        echo"</div>";

                        echo"<br><button class='btn btn-primary' name='login' type='submit' >Login</button>";




                        
                        

                    echo"</form>";
                    } else {
                        echo"<a href='includes/logout.php'><button class='btn btn-primary' name='logout' type='submit' >Logout</button></a>";
                    }?>


                    <!-- <a href="includes/logout.php"><button class="btn btn-primary" name="logout" type="submit" >Logout</button></a> -->
                    <!-- /.input-group -->
                </div>











                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php listCategories();?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>