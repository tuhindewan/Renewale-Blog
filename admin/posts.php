
<?php require_once('inc/top.php');?>
<?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}
$session_username = $_SESSION['username'];
?>
<?php 

if (isset($_GET['del'])) {
  $del_id = $_GET['del'];

      if ($_SESSION['role']== 'admin') {
        $statement = $db->prepare("SELECT * FROM posts WHERE id= $del_id "); 
      }
      else if ($_SESSION['role']=='author') {
         $statement = $db->prepare("SELECT * FROM posts WHERE id= $del_id && author = '$session_username' "); 
      }

      $statement->execute();
      $total = $statement->rowCount();   
      if ($total) {
                 $statement = $db->prepare("DELETE FROM posts WHERE id= $del_id ");
                  $statement->execute();
                  if ($statement) {
                    $success_message = "Post Has Been Deleted Successfully.";
                  }
                  else{
                    $error_message = "Post Has Not Been Deleted.";
                  }
                     }   
        else
          {
              header('Location:index.php');
         }
            }

 ?>
 <?php 

if (isset($_POST['checkboxes'])) {
  
    foreach ($_POST['checkboxes'] as  $user_id) {
      
      $bulk_option = $_POST['bulk-options'];

      if ($bulk_option == 'delete') {
        
              $statement = $db->prepare("DELETE FROM posts WHERE id= $user_id ");
              $statement->execute();
      }
      else if ($bulk_option == 'publish') {
              $statement = $db->prepare("UPDATE  `cms`.`posts` SET  `status` =  'publish' WHERE  `posts`.`id` =$user_id");
              $statement->execute();
        
      }
      else if ($bulk_option == 'draft') {
             $statement = $db->prepare("UPDATE  `cms`.`posts` SET  `status` =  'draft' WHERE  `posts`.`id` =$user_id");
              $statement->execute();
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
      <h1><i class="fa fa-file" aria-hidden="true"></i> Posts <small>View All Posts</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-file" aria-hidden="true"></i> Posts</li>
      </ol>  

      <?php 
          if ($_SESSION['role']=='admin') {
            $statement = $db->prepare("SELECT * FROM posts ORDER BY id DESC");
          }
          else if ($_SESSION['role']=='author') {
            $statement = $db->prepare("SELECT * FROM posts WHERE author = '$session_username' ORDER BY id DESC");
          }
          $statement->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);
          if ($result) {
           
       ?>          
 <form action="" method="post">
    <div class="row">
      <div class="col-sm-8">
         <div class="row">
            <div class="col-xs-4">
              <div class="form-group">
                <select id="" name="bulk-options" class="form-control">
                  <option value="delete">Delete</option>
                  <option value="publish">Publish</option>
                  <option value="draft">Draft</option>
                </select>
              </div>
            </div>
            <div class="col-xs-8">
              <input type="submit" name="" value="Apply" class="btn btn-success">
              <a href="users.php" class="btn btn-primary">Add New</a>
            </div>
          </div>
      </div>
    </div>
                      <?php
                      if(isset($error_message)) {echo "<span style='color:red;' class='pull-right'>$error_message</span>";}
                      if(isset($success_message)) {echo "<span style='color:green;' class='pull-right'>$success_message</span>";}
                      ?>
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectallboxes" name=""></th>
          <th>Sr #</th>
          <th>Date</th>
          <th>Title</th>
          <th>Author</th>
          <th>Image</th>
          <th>Categories</th>
          <th>Views</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Del</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($result as $row){

        $id = $row['id'];
        $title = $row['title'];
        $author = $row['author'];
        $image = $row['image'];
        $categories = $row['categories'];
        $views = $row['views'];
        $status = $row['status'];
        $date = getdate($row['date']);
        $day = $date['mday'];
        $month = substr($date['month'], 0,3);
        $year = $date['year'];
       ?>

        <tr>
          <td><input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $id;?>"></td>
          <td><?php echo $id; ?></td>
          <td><?php echo "$day $month $year"; ?></td>
          <td><?php echo $title; ?></td>
          <td><?php echo $author; ?></td>
          <td><img src="img/<?php echo $image ?>" width="30px"></td>
          <td><?php echo $categories; ?></td>
          <td><?php echo $views; ?></td>
          <td style=" color:<?php if ($status == 'publish') { echo 'green';}else if( $status == 'draft'){echo 'red';}?>"><?php echo ucfirst($status); ?></td>
          <td><a href="edit-post.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
          <td><a href="posts.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
        </tr>

          <?php  } ?>
      </tbody>
    </table>
    <?php
          }
          else
          {
            echo "<center><h2>No Posts Available Now</h2></center>";
          }     

    ?>
    </form>
    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>