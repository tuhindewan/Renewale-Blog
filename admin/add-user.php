

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}
else if (isset($_SESSION['username']) && $_SESSION['role']=='author') {
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
      <h1><i class="fa fa-user-plus" aria-hidden="true"></i> Add User <small>Add New User</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-user-plusAdd New User" aria-hidden="true"></i> Add New User</li>
      </ol>  

            <?php 

            if (isset($_POST['submit'])) {
              $date = time();
              $first_name = $_POST['first-name'];
              $last_name = $_POST['last-name'];
              $username = strtolower($_POST['username']);
              $username_trim = preg_replace('/\s+/', '', $username);
              $email = strtolower($_POST['email']);
              $password = $_POST['password'];
              $role = $_POST['role'];
              $image = $_FILES['image']['name'];
              $image_tmp = $_FILES['image']['tmp_name'];

                try{

                   $statement = $db->prepare("SELECT * FROM users WHERE username = '$username' or email ='$email'");
                    $statement->execute();
                    $check = $statement->fetchAll(PDO::FETCH_ASSOC);

                   $statement = $db->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
                   $statement->execute();
                   $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $row){
                   $salt = $row['salt'];
                  }
                  $password = crypt($password,$salt);
              

                     if (empty($first_name) or empty($last_name) or empty($username) or empty($email) or empty($password) or empty($image)) {
                                
                                throw new Exception("All (*) Fields Are Required");
                                
                        }
                        else if($username!=$username_trim){
                          throw new Exception("Don't Use Spaces In Username");
                          
                        }
                        else if($check) {
                          throw new Exception("Username Or Email Already Exist", 1);
                          
                        }
                        else{
                            $statement = $db->prepare("INSERT INTO `users` (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `image`, `password`, `role`) VALUES (NULL, '$date', '$first_name', '$last_name', '$username', '$email', '$image', '$password', '$role')");
                            $statement->execute();  

                              if ($statement) {
                                        $success_message = 'User Has Been Added Successfully.';

                                         $first_name = "";
                                         $last_name = "";
                                         $username = "";
                                         $email = "";

                                         move_uploaded_file( $image_tmp, "img/$image");
                                            

                                    }

                                    else
                                    {
                                       $error_message = 'User Has Not Been Added.'; 
                                    }
                                                          }

                }


                  catch(Exception $e) {
                              $error_message = $e->getMessage();
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
                  <input type="text" value="<?php if(isset($first_name)){echo $first_name;}?>" id="first-name" name="first-name" placeholder="First Name" class="form-control">
                </div>
         
                <div class="form-group">
                  <label for="last-name">Last Name:*</label>
                  <input type="text" value="<?php if(isset($last_name)){echo $last_name;}?>" id="last-name" name="last-name" placeholder="Last Name" class="form-control">
                </div>
                
                <div class="form-group">
                  <label for="username">Username:*</label>
                  <input type="text" value="<?php if(isset($username)){echo $username;}?>" id="username" name="username" placeholder="Username" class="form-control">
                </div>
                
                <div class="form-group">
                  <label for="email">Email:*</label>
                  <input type="text" id="email" value="<?php if(isset($email)){echo $email;}?>" name="email" placeholder="Email Address" class="form-control">
                </div>
                
                <div class="form-group">
                  <label for="password">Password:*</label>
                  <input type="password"  id="password" name="password" placeholder="Password" class="form-control">
                </div>
               
                <div class="form-group">
                  <label for="role">Role:*</label>
                  <select name="role" id="role" class="form-control">
                    <option value="author">Author</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="image">Profile Picture:*</label>
                  <input type="file" id="image" name="image">
                </div>
                <input type="submit" value="Add User" name="submit" class="btn btn-primary">
              </form>
            </div>
            <div class="col-md-4">

            
            </div>
          </div>

    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>