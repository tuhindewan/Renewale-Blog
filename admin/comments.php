
<?php require_once('inc/top.php');?>
<?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
}
else if (isset($_SESSION['username']) && $_SESSION['role']=='author') {
  header('Location:index.php');
}

$session_username = $_SESSION['username'];

?>
<?php 

if (isset($_GET['del'])) {
  $del_id = $_GET['del'];

      $statement = $db->prepare("SELECT * FROM comments WHERE id= $del_id "); 
      $statement->execute();
      $total = $statement->rowCount();   
      if ($total) {
                 $statement = $db->prepare("DELETE FROM comments WHERE id= $del_id ");

      if (isset($_SESSION['username']) && $_SESSION['role']=='admin') {
     
      $statement->execute();
      if ($statement) {
        $success_message = "Comment Has Been Deleted Successfully.";
      }
      else{
        $error_message = "Comment Has Not Been Deleted.";
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

if (isset($_GET['unapprove'])) {
  $unapprove_id = $_GET['unapprove'];

      $statement = $db->prepare("SELECT * FROM comments WHERE id= $unapprove_id "); 
      $statement->execute();
      $total = $statement->rowCount();   
      if ($total) {
                 $statement = $db->prepare("UPDATE  `cms`.`comments` SET  `status` =  'pending' WHERE  `comments`.`id` =$unapprove_id");

      if (isset($_SESSION['username']) && $_SESSION['role']=='admin') {
     
      $statement->execute();
      if ($statement) {
        $success_message = "Comment Has Been Unapproved.";
      }
      else{
        $error_message = "Comment Has Not Been Unapproved.";
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

if (isset($_GET['approve'])) {
  $approve_id = $_GET['approve'];

      $statement = $db->prepare("SELECT * FROM comments WHERE id= $approve_id "); 
      $statement->execute();
      $total = $statement->rowCount();   
      if ($total) {
                 $statement = $db->prepare("UPDATE  `cms`.`comments` SET  `status` =  'approve' WHERE  `comments`.`id` =$approve_id");

      if (isset($_SESSION['username']) && $_SESSION['role']=='admin') {
     
      $statement->execute();
      if ($statement) {
        $success_message = "Comment Has Been Approved.";
      }
      else{
        $error_message = "Comment Has Not Been Approved.";
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
        
              $statement = $db->prepare("DELETE FROM comments WHERE id= $user_id ");
              $statement->execute();
      }
      else if ($bulk_option == 'approve') {
              $statement = $db->prepare("UPDATE  `cms`.`comments` SET  `status` =  'approve' WHERE  `comments`.`id` =$user_id");
              $statement->execute();
        
      }
      else if ($bulk_option == 'pending') {
             $statement = $db->prepare("UPDATE  `cms`.`comments` SET  `status` =  'pending' WHERE  `comments`.`id` =$user_id");
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
      <h1><i class="fa fa-comments" aria-hidden="true"></i> Comments <small>View All Comments</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-comments" aria-hidden="true"></i> Comments</li>
      </ol>  

      <?php 

      if (isset($_GET['reply'])) {
        $reply_id = $_GET['reply'];

        $statement = $db->prepare("SELECT * FROM comments WHERE post_id='$reply_id'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
          if (isset($_POST['reply'])) {
            $comment_data = $_POST['comment'];

            if (empty($comment_data)) {
              $comment_error = "Must Fill This Field";
            }
            else
            {
              $statement = $db->prepare("SELECT * FROM users WHERE username = '$session_username'");
              $statement->execute();
              $result = $statement->fetchAll(PDO::FETCH_ASSOC);
              foreach($result as $row){
                $date = time();
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $full_name = "$first_name $last_name";
                $email = $row['email'];
                $image = $row['image'];
              }
              $statement = $db->prepare("INSERT INTO comments (date,name,username,post_id,email,image,comment,status) VALUES ('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve')");
               $statement->execute();
               if ($statement) {
                 $comment_message = "Comment Has Been Submitted";
                 header('Location:comments.php');
               }
               else
               {
                $comment_error = "Comment Has Not Been Submitted";
               }
            }
          }
        
            ?>

      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
         <form action="" method="post">
           <div class="form-group">
             <label for="comment">Comments:*</label>
                       <?php
                      if(isset($comment_error)) {echo "<span style='color:red;' class='pull-right'>$comment_error</span>";}
                      if(isset($comment_message)) {echo "<span style='color:green;' class='pull-right'>$comment_message</span>";}
                      ?>
             <textarea name="comment" id="comment" placeholder="Your Comment Here" cols="30" rows="10" class="form-control"></textarea>
           </div>
           <input type="submit" name="reply" value="Submit Reply" class="btn btn-primary">
         </form>
        </div>
      </div>
      <hr>
      <?php
                }
      }
       ?>

      <?php 

          $statement = $db->prepare("SELECT * FROM comments ORDER BY id DESC");
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
                  <option value="approve">Approve</option>
                  <option value="pending">Unapprove</option>
                </select>
              </div>
            </div>
            <div class="col-xs-8">
              <input type="submit" name="" value="Apply" class="btn btn-success">
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
          <th>Username</th>
          <th>Comment</th>
          <th>Status</th>
          <th>Approve</th>
          <th>Unapprove</th>
          <th>Repley</th>
          <th>Del</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($result as $row){

        $id = $row['id'];
        $username = $row['username'];
        $comment = $row['comment'];
        $status = $row['status'];
        $post_id = $row['post_id'];
        $date = getdate($row['date']);
        $day = $date['mday'];
        $month = substr($date['month'], 0,3);
        $year = $date['year'];
       ?>

        <tr>
          <td><input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $id;?>"></td>
          <td><?php echo $id; ?></td>
          <td><?php echo "$day $month $year"; ?></td>
          <td><?php echo $username; ?></td>
          <td><?php echo $comment; ?></td>
          <td><?php echo ucfirst($status); ?></td>
          <td><a href="comments.php?approve=<?php echo $id; ?>">Approve</a></td>
          <td><a href="comments.php?unapprove=<?php echo $id; ?>">Unapprove</a></td>
          <td><a href="comments.php?reply=<?php echo $post_id;?>"<i class="fa fa-reply"></i></a></td>
          <td><a href="comments.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
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