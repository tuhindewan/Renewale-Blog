
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

if (isset($_GET['del'])) {
  $del_id = $_GET['del'];

      $statement = $db->prepare("SELECT * FROM users WHERE id= $del_id "); 
      $statement->execute();
      $total = $statement->rowCount();   
      if ($total) {
                 $statement = $db->prepare("DELETE FROM users WHERE id= $del_id ");

      if (isset($_SESSION['username']) && $_SESSION['role']=='admin') {
     
      $statement->execute();
      if ($statement) {
        $success_message = "User Has Been Deleted Successfully.";
      }
      else{
        $error_message = "User Has Not Been Deleted.";
      }
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
        
              $statement = $db->prepare("DELETE FROM users WHERE id= $user_id ");
              $statement->execute();
      }
      else if ($bulk_option == 'admin') {
              $statement = $db->prepare("UPDATE  `cms`.`users` SET  `role` =  'admin' WHERE  `users`.`id` =$user_id");
              $statement->execute();
        
      }
      else if ($bulk_option == 'author') {
             $statement = $db->prepare("UPDATE  `cms`.`users` SET  `role` =  'author' WHERE  `users`.`id` =$user_id");
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
      <h1><i class="fa fa-users" aria-hidden="true"></i> Users <small>View All Users</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-users" aria-hidden="true"></i> Users</li>
      </ol>  

      <?php 

          $statement = $db->prepare("SELECT * FROM users ORDER BY id DESC");
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
                  <option value="author">Change To Author</option>
                  <option value="admin">Change To Admin</option>
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
          <th>Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Image</th>
          <th>Password</th>
          <th>Roll</th>
          <th>Edit</th>
          <th>Del</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($result as $row){

        $id = $row['id'];
        $first_name = ucfirst($row['first_name']);
        $last_name = ucfirst($row['last_name']);
        $email = $row['email'];
        $username = $row['username'];
        $image = $row['image'];
        $role = $row['role'];
        $date = getdate($row['date']);
        $day = $date['mday'];
        $month = substr($date['month'], 0,3);
        $year = $date['year'];
       ?>

        <tr>
          <td><input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $id;?>"></td>
          <td><?php echo $id; ?></td>
          <td><?php echo "$day $month $year"; ?></td>
          <td><?php echo "$first_name $last_name"; ?></td>
          <td><?php echo $username; ?></td>
          <td><?php echo $email; ?></td>
          <td><img src="img/<?php echo $image ?>" width="30px"></td>
          <td>**********</td>
          <td><?php echo ucfirst($role); ?></td>
          <td><a href="edit-user.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
          <td><a href="users.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
        </tr>

          <?php  } ?>
      </tbody>
    </table>
    <?php
          }
          else
          {
            echo "<center><h2>No Users Available Now</h2></center>";
          }     

    ?>
    </form>
    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>