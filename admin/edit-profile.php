

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}

$session_username = $_SESSION['username'];

?>

<?php 

if (isset($_GET['edit'])) {

  $edit_id = $_GET['edit'];

      $statement = $db->prepare("SELECT * FROM users WHERE id = $edit_id");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        foreach($result as $row){
          $e_username = $row['username'];
          if ($e_username == $session_username) {
          $e_first_name = $row['first_name'];
          $e_last_name = $row['last_name'];     
          $e_image = $row['image'];
          $e_details = $row['details'];
          }
          else
          {
            header("Location:index.php");
          }

        }
      }
      else
      {
        header('Location:index.php');
      }
  
}
else
{
  header('Location:index.php');
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
      <h1><i class="fa fa-user" aria-hidden="true"></i> Edit Profile <small>Edit Profile Details</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-user" aria-hidden="true"></i> Edit Profile</li>
      </ol>  

            <?php 

            if (isset($_POST['submit'])) {
              $first_name = $_POST['first-name'];
              $last_name = $_POST['last-name'];
              $password = $_POST['password'];
            
              $image = $_FILES['image']['name'];
              $image_tmp = $_FILES['image']['tmp_name'];
              $details = $_POST['details'];

             if (empty($image)) {
               $image = $e_image;
             }

                


                   $statement = $db->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
                   $statement->execute();
                   $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $row){
                   $salt = $row['salt'];
                  }
                  $insert_password = crypt($password,$salt);
              

                     if (empty($first_name) or empty($last_name) or empty($image)) {
                                
                               $error_message = "All (*) Fields Are Required";
                        }

                        else
                        {
                         $statement = $db->prepare("UPDATE `users` SET  `first_name` =  '$first_name',`last_name` =  '$last_name',`image` =  '$image',`details` =  '$details' WHERE  `users`.`id` =$edit_id");
                         if (isset($password)) {
                           $statement = $db->prepare("UPDATE `users` SET  `first_name` =  '$first_name',`last_name` =  '$last_name',`image` =  '$image',`details` =  '$details',`password` =  '$insert_password' WHERE  `users`.`id` =$edit_id");
                         }
                         $statement->execute();
                         
                         if ($statement) {
                           $success_message = "User Has Been Updated";
                           header("refresh:0;url=edit-profile.php?edit=$edit_id");
                           if (!empty($image)) {
                             move_uploaded_file($image_tmp, "img/$image");
                           }
                         }
                         else
                         {
                          $error_message = "User Has Not Been Updated";
                         }
                        }
                      }




             ?>


          <div class="row">
            <div class="col-md-8">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="first-name">First Name:*</label>
                      <?php
                      if(isset($error_message)) {echo "<span style='color:red;' class='pull-right'>$error_message</span>";}
                      if(isset($success_message)) {echo "<span style='color:green;' class='pull-right'>$success_message</span>";}
                      ?>
                  <input type="text" value="<?php echo $e_first_name;?>" id="first-name" name="first-name" placeholder="First Name" class="form-control">
                </div>
         
                <div class="form-group">
                  <label for="last-name">Last Name:*</label>
                  <input type="text" value="<?php echo $e_last_name;?>" id="last-name" name="last-name" placeholder="Last Name" class="form-control">
                </div>
 
                <div class="form-group">
                  <label for="password">Password:*</label>
                  <input type="password"  id="password" name="password" placeholder="Password" class="form-control">
                </div>
               

                
                <div class="form-group">
                  <label for="image">Profile Picture:*</label>
                  <input type="file" id="image" name="image">
                </div>
                  <div class="form-group">
                  <label for="details">Details:</label>
                  <textarea name="details" id="details" cols="30" rows="10" class="form-control"><?php echo $e_details; ?></textarea>
                </div>
                <input type="submit" value="Update User" name="submit" class="btn btn-primary">
              </form>
            </div>
            <div class="col-md-4">
            <?php echo "<img src='img/$e_image' width='100%' >"; ?>
            

            </div>
          </div>

    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>