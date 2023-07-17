<?php include 'includes/admin_header.php' ?>
    <div id="wrapper">

<?php 
?>                                                                                                     

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            

                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
 
                    </div>
                </div>

                <!-- /.row -->
                                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                     <div class='huge'><?=$postcount=recordCount('posts')?></div>
                      
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?=$commentcount=recordCount('comments')?></div>
                      
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                     
                     <div class='huge'><?=$usercount=recordCount('users')?></div>
                      
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                     
                     <div class='huge'><?=$catcount=recordCount('category')?></div>
                     
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

                    <?php 
                    $draftcount = postStatusCount('posts', 'Draft');
                    $pubcount = postStatusCount('posts', 'Published');
                    $draftcomments = commentStatusCount('comments', 'unapproved');
                    $appcomments = commentStatusCount('comments', 'Approved');  
                    $selectedusers = userCount('users', 'User'); 
                    ?>
                <!-- /.row -->

                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['data', 'Count'],

            <?php 
            
            $element_text = ['Published Posts','Draft Posts', 'Active Comments','Pending Comments', 'Users','User count', 'Categories'];
            $element_count = [$pubcount, $draftcount, $appcomments, $draftcomments, $usercount, $selectedusers, $catcount];

            for($i = 0; $i < 7; $i++) {
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
            
            ?>
            
            


          //['2014', 1000]

        ]); 
        
        

        var options = {
          chart: {
            title: 'Site Activity',
            subtitle: 'Users, Posts, and Comments: 2021-2023',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>











            </div>
            <!-- /.container-fluid -->

        </div>
        <?php include 'includes/admin_footer.php' ?>
