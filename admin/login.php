
<?php 

ob_start();
session_start();
require_once('../connection.php');

 ?>

<?php 

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

      $statement = $db->prepare("SELECT * FROM users WHERE username = '$username'");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {

        foreach($result as $row){
          $db_username = $row['username'];
          $db_password = $row['password'];
          $db_role = $row['role'];
          $password = crypt($password,$db_password);

        }
        if ($username == $db_username && $password == $db_password) {
          header('Location:index.php');
          $_SESSION['username'] = $db_username;
          $_SESSION['role']     = $db_role;
        }
        else
        {
          $error_message = "Wrong Useername or Password";
        }
        
      }
      else
      {
        $error_message = "Wrong Useername or Password";
      }
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.jpg">

    <title>Login | Renewale Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin animated shake" action="" method="post">
        <h2 class="form-signin-heading">Renewale Login</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
                      <?php
                      if(isset($error_message)) {echo "<span>$error_message</span>";}
                      if(isset($success_message)) {echo "<span style='color:green;' class='pull-right'>$success_message</span>";}
                      ?>
          </label>
        </div>
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Sign In">
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
