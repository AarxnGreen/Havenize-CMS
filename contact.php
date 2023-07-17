<?php  include "includes/header.php"; ?>
<?php

if(isset($_POST['submit'])) {
    
    $to = "support@havenize.co";
    $subject = htmlspecialchars($_POST['subject']);
    $body = $_POST['content'];
    $header = "From: " .$_POST['email'];
    
    mail($to, $subject, $body, $header);
        
    
}




?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="contact-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="youremail@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                         <div class="form-group">
                            <label for="Content" class="sr-only">Content</label>
                            <textarea type="textarea" name="content" id="key" class="form-control" placeholder="Your message..." cols='50' rows='12'></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Contact">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
