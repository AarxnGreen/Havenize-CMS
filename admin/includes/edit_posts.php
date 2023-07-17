<?php 

if(isset($_GET['p_id'])) {
    global $connection;
    $id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id=$id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if (isset($_POST['edit_post'])) {
        editPost($id);
    }
}?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title" value="<?=$row['post_title']?>">
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

          </select>
          
      </div>
      
     <div class="form-group">
         <label for="title">Post Author</label>
         <input type="text" class="form-control" name="author" value="<?=$row['post_author']?>">
     </div>
        
    <div class="form-group">
         <label for="post_image">Post Image</label>
         <img width="100" length="100"src="../images/<?=$row['post_image']?>">
         <input type="file" name="image" value="<?=$row['post_image']?>">
     </div>

     <div class="form-group">
        <select name="status" id="">
                <option value="<?=$row['post_status']?>"><?=$row['post_status']?></option>
                <?php if ($row['post_status'] === 'Published') {
                    echo "<option value='Draft'>Draft</option>";
                    } else {
                        echo "<option value='Published'>Published</option>";
                    }?>
                
        </select>
     </div>

      <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea name="post_content" id="summernote" cols="30" rows="10" class="form-control" ><?=$row['post_content']?></textarea>
     </div>

     <div class="form-group">
         <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags" value="<?=$row['post_tags']?>">
     </div>
     
     <div class="form-group">
     
     <input type="submit" class="btn btn-primary" name="edit_post" value="Publish">
     
     </div>