

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}
else if (isset($_SESSION['username']) && $_SESSION['role']=='author') {
  header('Location:index.php');
}
?>
<?php 

if (isset($_POST['submit'])) {
  $cat_name = strtolower($_POST['cat-name']);

      $statement = $db->prepare("SELECT * FROM categories WHERE category = '$cat_name'");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        $error_message = "Category Is Already Exist";
      }
      else
      {
        if (empty($cat_name)) {
          $error_message = "Must Fill This Field.";
        }
        else
        {
          $statement = $db->prepare("INSERT INTO categories (category) values('$cat_name')");
          $statement->execute();
          if ($statement) {
            $success_message = 'Category Has Been Added Successfully.';
            
          }
          else
          {
            $error_message = 'Category Has Not Been Added';
          }
    
          }
      }

}

 ?>
 <?php 

if (isset($_GET['edit'])) {
  $edit_id = $_GET['edit'];
}

 ?>


 <?php 

if (isset($_POST['update'])) {
  $cat_name = strtolower($_POST['cat-name']);

      $statement = $db->prepare("SELECT * FROM categories WHERE category = '$cat_name'");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        $up_error = "Category Is Already Exist";
      }
      else
      {
        if (empty($cat_name)) {
          $up_error = "Must Fill This Field.";
        }
        else
        {
          $statement = $db->prepare("UPDATE  `cms`.`categories` SET  `category` =  '$cat_name' WHERE  `categories`.`id` = $edit_id");
          $statement->execute();
          if ($statement) {
            $up_message = 'Category Has Been Updated Successfully.';
            
          }
          else
          {
            $up_error = 'Category Has Not Been Updated';
          }
    
          }
      }

}



  ?>

 <?php 

if (isset($_GET['del'])) {
  $del_id = $_GET['del'];
if (isset($_SESSION['username']) && $_SESSION['role']=='admin') {

      $statement = $db->prepare("DELETE FROM categories WHERE id='$del_id'");
      $statement->execute();
      if ($statement) {
        $del_success_message = "Category Has Been Deleted Successfully.";
      }
      else
      {
        $del_error_message = "Category Has Not Been Deleted.";
      }
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
      <h1><i class="fa fa-folder-open" aria-hidden="true"></i> Categories <small>Different Categories</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-folder-open" aria-hidden="true"></i> Categories</li>
      </ol>
      <div class="row">
        <div class="col-md-6">
          <form action="" method="post">
            <div class="form-group">
              <label for="category">Category Name:</label>
                <?php
                      if(isset($error_message)) {echo "<span style='color:red;' class='pull-right'>$error_message</span>";}
                      if(isset($success_message)) {echo "<span style='color:green;' class='pull-right'>$success_message</span>";}
                ?>
              <input type="text" name="cat-name" placeholder="Category Name" class="form-control">
            </div>
            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
          </form>
       
          <?php 

            if (isset($_GET['edit'])) {
              $edit_id = $_GET['edit'];

                  $statement = $db->prepare("SELECT * FROM categories WHERE id = '$edit_id'");
                  $statement->execute();
                  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                  if ($result) {
                    foreach($result as $row){
                      $up_category = $row['category'];
                    }
                

           ?>
              <hr>
        <form action="" method="post">
            <div class="form-group">
              <label for="category">Update Category Name:</label>
                <?php
                      if(isset($up_error)) {echo "<span style='color:red;' class='pull-right'>$up_error</span>";}
                      if(isset($up_message)) {echo "<span style='color:green;' class='pull-right'>$up_message</span>";}
                ?>
              <input type="text" value="<?php echo $up_category;?>" name="cat-name" placeholder="Category Name" class="form-control">
            </div>
            <input type="submit" name="update" value="Update Category" class="btn btn-primary">
        </form>
        <?php   
             }
            }
             ?>
        </div>
        <div class="col-md-6">
        <?php 

              $statement = $db->prepare("SELECT * FROM categories ORDER BY id DESC");
              $statement->execute();
              $result = $statement->fetchAll(PDO::FETCH_ASSOC);
              if ($result) {
              
         ?>
              <?php 


           if(isset($del_error_message)) {echo "<span style='color:red;' class='pull-right'>$del_error_message</span>";}
           if(isset($del_success_message)) {echo "<span style='color:green;' class='pull-right'>$del_success_message</span>";}
                

          ?>

          <table class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr #</th>
                <th>Category Name</th>
                <th>Posts</th>
                <th>Edit</th>
                <th>Del</th>
              </tr>
            </thead>
            <tbody>
            <?php 

              foreach($result as $row){
                $category_id = $row['id'];
                $category_name = $row['category'];
             

             ?>
              <tr>
                <td><?php echo $category_id; ?></td>
                <td><?php echo ucfirst($category_name); ?></td>
                <td>12</td>
                <td><a href="categories.php?edit=<?php echo $category_id;?>"><i class="fa fa-pencil"></i></a></td>
                <td><a href="categories.php?del=<?php echo $category_id;?>"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php  } ?>
            </tbody>
          </table>
          <?php 

                          }
              else
              {
                echo "<center><h3>No Category Available</h3></center>";
              }

           ?>
        </div>
      </div>            
    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>