

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}

  ?>


<?php 

$statement = $db->prepare("SELECT * FROM comments WHERE status = 'pending'");
$statement->execute();
$com_rows = $statement->rowCount();

$statement = $db->prepare("SELECT * FROM posts ");
$statement->execute();
$post_rows = $statement->rowCount();


$statement = $db->prepare("SELECT * FROM users ");
$statement->execute();
$users_rows = $statement->rowCount();


$statement = $db->prepare("SELECT * FROM categories ");
$statement->execute();
$cat_rows = $statement->rowCount();

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
      <h1><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <small>Statistics Overview</small></h1><hr>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li>
      </ol>
      <div class="row tag-boxes">
        <div class="col-md-6 col-lg-3">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-comment fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-xs-9">
                  <div class="text-right huge"><?php echo $com_rows; ?></div>
                  <div class="text-right">New Comments</div>
                </div>
              </div>
            </div>
            <a href="comments.php">
              <div class="panel-footer">
                <span class="pull-left">View All Comments</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
              <div class="col-md-6 col-lg-3">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-file-text fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-xs-9">
                  <div class="text-right huge"><?php echo $post_rows; ?></div>
                  <div class="text-right">All Posts</div>
                </div>
              </div>
            </div>
            <a href="posts.php">
              <div class="panel-footer">
                <span class="pull-left">View All Posts</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
              <div class="col-md-6 col-lg-3">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-xs-9">
                  <div class="text-right huge"><?php echo $users_rows; ?></div>
                  <div class="text-right">All Users</div>
                </div>
              </div>
            </div>
            <a href="users.php">
              <div class="panel-footer">
                <span class="pull-left">View All Users</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
              <div class="col-md-6 col-lg-3">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-folder-open fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-xs-9">
                  <div class="text-right huge"><?php echo $cat_rows; ?></div>
                  <div class="text-right">All Categories</div>
                </div>
              </div>
            </div>
            <a href="categories.php">
              <div class="panel-footer">
                <span class="pull-left">View All Categories</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
      </div><hr>

      <?php 

      $statement = $db->prepare("SELECT * FROM users ORDER BY id DESC");
      $statement->execute();
      $result= $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        
      

       ?>

      <h3>New Users</h3>
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Sr #</th>
            <th>Date</th>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
        <?php 

        foreach ($result as $row) {
          $user_id = $row['id'];
          $user_date = getdate($row['date']);
          $user_day = $user_date['mday'];
          $user_month = substr($user_date['month'], 0,3);
          $user_year = $user_date['year'];
          $user_firstname = ucfirst($row['first_name']);
          $user_lastname = ucfirst($row['last_name']);
          $user_fullname = "$user_firstname $user_lastname";
          $user_username = $row['username'];
          $user_role = $row['role'];

        

         ?>
          <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo "$user_day $user_month $user_year"; ?></td>
            <td><?php echo $user_fullname; ?></td>
            <td><?php echo ucfirst($user_username); ?></td>
            <td><?php echo ucfirst($user_role); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <a href="users.php" class="btn btn-primary">View All Users</a><hr>
      <?php } ?>

      <?php 

      $statement = $db->prepare("SELECT * FROM posts ORDER BY id DESC");
      $statement->execute();
      $result= $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        
      

       ?>

      <h3>New Posts</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Sr #</th>
            <th>Date</th>
            <th>Post Title</th>
            <th>Category</th>
            <th>Views</th>
          </tr>
        </thead>
          <tbody>
          <?php 

        foreach ($result as $row) {
          $post_id = $row['id'];
          $post_date = getdate($row['date']);
          $post_day = $post_date['mday'];
          $post_month = substr($post_date['month'], 0,3);
          $post_year = $post_date['year'];
          $post_title = $row['title'];
          $post_categories = $row['categories'];
          $post_views = $row['views'];

        

         ?>
            <tr>
              <td><?php echo $post_id; ?></td>
              <td><?php echo "$post_day $post_month $post_year"; ?></td>
              <td><?php echo $post_title; ?></td>
              <td><?php echo $post_categories; ?></td>
              <td><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $post_views; ?></td>
            </tr>
        </tbody>
        <?php } ?>
      </table>
         <a href="posts.php" class="btn btn-primary">View All Posts</a>
         <?php } ?>
    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>