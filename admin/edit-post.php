

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}
$session_username = $_SESSION['username'];
$session_role = $_SESSION['role'];
$session_author_image = $_SESSION['author_image'];
?>


<?php 

if (isset($_GET['edit'])) {
  $edit_id = $_GET['edit'];

  if ($session_role == 'admin') {
    $statement = $db->prepare("SELECT * FROM posts WHERE id = '$edit_id'");
  }
  else if ($session_role == 'author') {
    $statement = $db->prepare("SELECT * FROM posts WHERE id = '$edit_id' AND author = '$session_username'");
  }
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  if ($result) { 
    foreach($result as $row){

      $title = $row['title'];
      $post_data = $row['post_data'];
      $image = $row['image'];
      $categories = $row['categories'];
      $tags = $row['tags'];
      $status = $row['status'];

    }
    
  }
  else{
    header('location:posts.php');
  }
}

?>

  </head>
  <body>
  <div id="wrapper">
<?php require_once('inc/header.php');?>

<div class="container-fluid body-section">
  <div class="row">
    <div class="col-md-3">
    <?php require_once('inc/sidebar.php');?>
    </div>
    <div class="col-md-9">
      <h1><i class="fa fa-pencil" aria-hidden="true"></i> Edit Post <small>Edit Post Details</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Post</li>
      </ol>
        <?php 

        if (isset($_POST['update'])) {
          $up_title = $_POST['title'];
          $up_post_data = $_POST['post-data'];
          $up_categories = $_POST['categories'];
          $up_tags = $_POST['tags'];
          $up_status = $_POST['status'];
          $up_post_image = $_FILES['image']['name'];
          $up_tmp_name = $_FILES['image']['tmp_name'];

          if (empty($up_post_image)) {
            $up_post_image = $image;
          }

          if (empty($title) or empty($post_data) or empty($tags) or empty($up_post_image)) {
            $error_message = "All (*) Fields Are Required.";
          }
          else
          {
            $statement = $db->prepare("UPDATE posts SET title = '$up_title',image = '$up_post_image',categories = '$up_categories', tags = '$up_tags',post_data = '$up_post_data',status = '$up_status' WHERE id = '$edit_id'");
            $statement->execute();
            if ($statement) {
              $success_message = "Post Has Been Updated Successfully.";
              header("Location:edit-post.php?edit=$edit_id");
              $path = "img/$up_post_image";
              if (!empty($up_post_image)) {
                 if(move_uploaded_file($up_tmp_name, $path)){
                  copy($path,"../$path");
              }
              }

            }
            else
            {
              $error_message = "Post has Not Been Updated.";
            }

          }
        }

         ?>
      <div class="row">
        <div class="col-xs-12">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Title:*</label>
                <?php
                      if(isset($error_message)) {echo "<span style='color:red;' class='pull-right'>$error_message</span>";}
                      if(isset($success_message)) {echo "<span style='color:green;' class='pull-right'>$success_message</span>";}
                ?>
              <input type="text" name="title" value="<?php if(isset($title)){echo $title;} ?>" placeholder="Type Post Title Here" class="form-control">
            </div>
            <div class="form-group">
              <a href="media.php" class="btn btn-primary">Add Media</a>
            </div>
            <div class="form-group">
            
            <textarea name="post-data" id="textarea" rows="10" class="form-control"><?php if(isset($post_data)){echo $post_data;} ?></textarea>     

            </div>

            <div class="row">
              <div class="col-sm-6">
                            <div class="form-group">
                              <label for="file">Post Image:*</label>
                              <input type="file" name="image" >
                            </div>
              </div>
              <div class="col-sm-6">
                            <div class="form-group">
                              <label for="categories">Categories:*</label>
                              <select class="form-control" name="categories" id="categories">
                              <?php 

                              $statement = $db->prepare("SELECT * FROM categories ORDER BY id DESC");
                              $statement->execute();
                              $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                              if ($result) {
                                foreach($result as $row){
                                  $cat_name = $row['category'];
                                  echo "<option value='".$cat_name."' ".((isset($categories) && $categories == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";
                                }
                              }
                              else
                              {
                                echo "<center><h6>No Category Available</h6></center>";
                              }
                               ?>
                              }
                              </select>
                            </div>
              </div>
            </div>

                          <div class="row">
                            <div class="col-sm-6">
                                          <div class="form-group">
                                            <label for="tags">Tags:*</label>
                                            <input value="<?php if(isset($tags)){echo $tags;} ?>" class="form-control" placeholder="Your Tags Here" type="text" name="tags" >
                                          </div>
                            </div>
                            <div class="col-sm-6">
                                          <div class="form-group">
                                            <label for="status">Status:*</label>
                                            <select class="form-control" name="status" id="status">
                                              <option value="publish" <?php if(isset($status) && $status == "publish"){echo "selected";}?> >publish</option>
                                              <option value="draft" <?php if(isset($status) && $status == "draft"){echo "selected";}?> >draft</option>
                                            </select>
                                          </div>
                            </div>
                          </div>
                          <input type="submit" name="update" class="btn btn-primary" value="Update Post">

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>