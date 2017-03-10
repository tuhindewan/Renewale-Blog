

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}

  ?>

  </head>
  <body >
  <div id="wrapper">
<?php require_once('inc/header.php');?>

<div class="container-fluid body-section">
  <div class="row">
    <div class="col-md-3">
    <?php require_once('inc/sidebar.php');?>
    </div>
    <div class="col-md-9">
      <h1><i class="fa fa-user" aria-hidden="true"></i> Profile <small>Personal Details </small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-user" aria-hidden="true"></i> Profile</li>
      </ol>
            <div class="col-xs-12">
                    <center><img src="img/profile.jpg" width="200px" class="img-circle img-thumbnail" id="profile-image"></center><br>
                   <a href="" class="btn btn-primary pull-right">Edit Profile</a><br><br>
                     <center>
                    <h3>Profile Details</h3>
                      </center><br>
                      <table class="table table-bordered">
                        <tr>
                          <td width="20%"><b>User id:</b></td>
                          <td width="30%">12</td>
                          <td width="20%"><b>Signup Date:</b></td>
                          <td width="30%">10 Mar 2017</td>
                        </tr>
                          <tr>
                          <td width="20%"><b>First Name:</b></td>
                          <td width="30%">Saiduzzaman</td>
                          <td width="20%"><b>Last Name:</b></td>
                          <td width="30%">tuhin</td>
                        </tr>
                          <tr>
                          <td width="20%"><b>Username</b></td>
                          <td width="30%">tuhincste</td>
                          <td width="20%"><b>Email:</b></td>
                          <td width="30%">tuhinsshadow@gmail.com</td>
                        </tr>
                        <tr>
                          <td width="20%"><b>Role:</b></td>
                          <td width="30%">Admin</td>
                          <td width="20%"><b></b></td>
                          <td width="30%"></td>
                        </tr>
                      </table>
                      <div class="row">
                        <div class="col-lg-8 col-sm-12">
                          <b>Details</b>
                          <div>Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhinHello I am tuhinsshadow Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin Hello I am tuhin</div>
                        </div>
                      </div>
                      <br>
            </div>
    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>