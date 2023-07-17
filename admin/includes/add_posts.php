<?php addPost(); ?>




<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>

      <div class="form-group">
          
      <label for="post_category">Post Category</label>
          <select name="post_category">
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($connection, $query);
            while ($record = mysqli_fetch_assoc($result)) {
            $catId = $record['cat_id'];
            $catTitle = $record['cat_title'];
            echo "<option value='$catId'>$catTitle</option>";
            ?> <?php } ?>
          </select>
          
      </div>
      
     <div class="form-group">
         <label for="title">Post Author</label>
         <input type="text" class="form-control" name="author">
     </div>
        
    <div class="form-group">
         <label for="post_image">Post Image</label>
         <input type="file" name="image">
     </div>

     <div class="form-group">
        <select name="status" id="">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
        </select>
     </div>
        
      <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea name="post_content" id="summernote" cols="30" rows="10" class="form-control"></textarea>
     </div>
     <div class="form-group">
         <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags">
     </div>
     
     <div class="form-group">
     
     <input type="submit" class="btn btn-primary" name="create_post" value="Upload">
     
     </div>