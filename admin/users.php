<?php require_once('inc/top.php');?>
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
        <li><a href="index.html"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-users" aria-hidden="true"></i> Users</li>
      </ol>            
    </div>
    <div class="row">
      <div class="col-sm-8">
        <form action="" method="">
          <div class="row">
            <div class="col-xs-4">
              <div class="form-group">
                <select id="" name="" class="form-control">
                  <option value="delete">Delete</option>
                  <option value="author">Change To Author</option>
                  <option value="admin">Change To Admin</option>
                </select>
              </div>
            </div>
            <div class="col-xs-8">
              <input type="submit" name="" value="Apply" class="btn btn-success">
              <a href="" class="btn btn-primary">Add New</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><input type="checkbox" name=""></th>
          <th>Sr #</th>
          <th>Date</th>
          <th>Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Image</th>
          <th>Password</th>
          <th>Roll</th>
          <th>Post</th>
          <th>Edit</th>
          <th>Del</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th><input type="checkbox" name=""></th>
          <th>1</th>
          <th>25 Jan 2016</th>
          <th>Md. Saiduzzaman</th>
          <th>tuhin</th>
          <th>tuhinsshadow@gmail.com</th>
          <th><img src="img/unknown-profile.png" width="30px"></th>
          <th>12345</th>
          <th>Admin</th>
          <th>11</th>
          <th><a href=""><i class="fa fa-pencil"></i></a></th>
          <th><a href=""><i class="fa fa-times"></i></a></th>
        </tr>
         <tr>
          <th><input type="checkbox" name=""></th>
          <th>1</th>
          <th>25 Jan 2016</th>
          <th>Md. Saiduzzaman</th>
          <th>tuhin</th>
          <th>tuhinsshadow@gmail.com</th>
          <th><img src="img/unknown-profile.png" width="30px"></th>
          <th>12345</th>
          <th>Admin</th>
          <th>11</th>
          <th><a href=""><i class="fa fa-pencil"></i></a></th>
          <th><a href=""><i class="fa fa-times"></i></a></th>
        </tr>
         <tr>
          <th><input type="checkbox" name=""></th>
          <th>1</th>
          <th>25 Jan 2016</th>
          <th>Md. Saiduzzaman</th>
          <th>tuhin</th>
          <th>tuhinsshadow@gmail.com</th>
          <th><img src="img/unknown-profile.png" width="30px"></th>
          <th>12345</th>
          <th>Admin</th>
          <th>11</th>
          <th><a href=""><i class="fa fa-pencil"></i></a></th>
          <th><a href=""><i class="fa fa-times"></i></a></th>
        </tr>
        
      </tbody>
    </table>
  </div>
</div>
<?php require_once('inc/footer.php');?>