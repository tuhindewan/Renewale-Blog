<?php
require_once('inc/top.php');
?>

  </head>
  <body>

<?php
require_once('inc/header.php');
?>

<?php 
if (isset($_GET['post_id'])) {
  $post_id = $_GET['post_id'];


        $statement = $db->prepare("UPDATE  `cms`.`posts` SET  `views` =  views + 1 WHERE  `posts`.`id` =$post_id;");
        $statement->execute();  
              

      $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' AND id = $post_id");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
            foreach($result as $row){
        $id         = $row['id'];
      $date         = getdate($row['date']);
      $day          = $date['mday']; 
      $month        = $date['month'];
      $year         = $date['year'];
        $title      = $row['title'];
        $author     = $row['author'];
        $author_image = $row['author_image'];
        $image      = $row['image'];
        $categories = $row['categories'];
        $post_data  = $row['post_data'];

       }
      }

      else
      {
        header('Location:index.php');
      }
   
 
      
}


 ?>


<?php

if(isset($_POST['submit'])) 
{
  $cs_name = $_POST['name'];
  $cs_email = $_POST['email'];
  $cs_website = $_POST['website'];
  $cs_comment = $_POST['comment'];
  $cs_date = date();
  
  try {
  
    if (empty($cs_name) or empty($cs_email) or empty($cs_comment)) {
      throw new Exception("All (*) Fields Are Required");  
    }

  $statement = $db->prepare("INSERT INTO `cms`.`comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'profile.jpg', '$cs_comment', 'pending')");
  $statement->execute();
  
  if ($statement) {
      $success_message = 'Comment Submitted And Waiting For Approval.'; 
      $cs_name = "";
      $cs_email = "";
      $cs_website = "";
      $cs_comment = ""; 
  }else
  {
     $error_message = 'Comment Has Not Be Submitted.'; 
  }
  
  }
  
  catch(Exception $e) {
    $error_message = $e->getMessage();
  }
  
}

?>
<div class="jumbotron">
  <div class="container">
    <div id="details" class="animated fadeInLeft">
      <h1>Custom<span> Post</span></h1>
      <p>Feel Free to Share Your Thoughts.</p>
    </div>
  </div>
  <img src="img/top.jpg" alt="top image">
</div>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
          <div class="post">
<div class="row">
  <div class="col-md-2 post-date">
    <div class="day"><?php echo $day; ?></div> 
    <div class="month"><?php echo $month; ?></div>
    <div class="year"><?php echo $year; ?></div>
  </div>
  <div class="col-md-8 post-title">
    <a href="post.php?post_id=<?php echo $id; ?>"><h2><?php echo $title; ?></h2></a>
    <p>Written by: <span><?php echo ucfirst($author);?></span></p>
  </div>
  <div class="col-md-2 profile-picture">
    <img src="img/<?php echo $author_image; ?>" alt="profile-picture" class="img-circle">
  </div>
</div>
<a href="img/<?php echo $image; ?>"><img src="img/<?php echo $image; ?>" alt="post-image"></a>
<p class="description">
  <?php echo $post_data; ?>
</p>
<div class="bottom">
<span class="first"><i class="fa fa-folder" aria-hidden="true"></i> <a href=""><?php echo ucfirst($categories); ?> </a></span> |
<span class="second"><i class="fa fa-comment" aria-hidden="true"></i><a href=""> Comment</a></span>
</div>
</div>

<div class="related-posts">
  <h3>Related Posts</h3><hr>
  <div class="row">
  <?php 


      $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' AND title LIKE '%$title%' LIMIT 3");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row){
        $r_id = $row['id'];
        $r_title = $row['title'];
        $r_image = $row['image'];
      }


   ?>
    <div class="col-sm-4">
      <a href="post.php?post_id=<?php echo $r_id; ?>">
        <img src="img/<?php echo $r_image; ?>" alt="slider one">
        <h4><?php echo $r_title;?></h4>
      </a>
    </div>

  </div>
</div>
<div class="author">
  <div class="row">
    <div class="col-sm-3">
      <img src="img/<?php echo $author_image; ?>" alt="profile-picture" class="img-circle" style="height: 150px; width: 150px; ">
    </div>
    <div class="col-sm-9">
      <h4><?php echo ucfirst($author); ?></h4>
      <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
      </p>
    </div>
  </div>
</div>

<?php 

      $statement = $db->prepare("SELECT * FROM comments WHERE status = 'approve' AND post_id = '$post_id' ORDER BY id DESC");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      

 ?>

          <div class="comment">
              <h3>Comments</h3>
              <hr>
              <?php foreach($result as $row){
                $c_id = $row['id'];
                $c_name = $row['name'];
                $c_username = $row['username'];
                $c_image = $row['image'];
                $c_comment = $row['comment'];
               ?>
              <div class="row single-comment">
                <div class="col-sm-2">
                  <img src="img/<?php echo $c_image; ?>" alt="unknown" class="img-circle" style="height: 100px; width: 100px;">
                </div>
                <div class="col-sm-10">
                  <h4><?php echo ucfirst($c_name); ?></h4>
                  <p><?php echo $c_comment; ?></p>
                </div>
              </div>
              <?php } ?>
          </div>
        
      


 

<div class="comment-box">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal" action="" method="post">
      <div class="form-group">
    <label for="full name" class="col-sm-2 control-label">Full Name* :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php if (isset($cs_name)) {
        echo $cs_name;}?>" id="full-name" name="name" placeholder="Full Name">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email* :</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" value="<?php if (isset($cs_email)) {
        echo $cs_email;}?>" name="email" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="website" class="col-sm-2 control-label">Website :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php if (isset($cs_website)) {
        echo $cs_website;}?>" name="website" id="website" placeholder="Website URL">
    </div>
  </div>
  <div class="form-group">
    <label for="comment" class="col-sm-2 control-label">Comment* :</label>
    <div class="col-sm-10">
     <textarea class="form-control" rows="10" cols="30" name="comment" placeholder="Your Comment Should be Here"><?php if (isset($cs_comment)) {
        echo $cs_comment;}?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Submit Comment</button><?php
if(isset($error_message)) {echo "<span style='color:red;' class='pull-right'>$error_message</span>";}
if(isset($success_message)) {echo "<span style='color:green;' class='pull-right'>$success_message</span>";}
?>
    </div>
  </div>
</form>
    </div>
  </div>
</div>

      </div>
      <div class="col-md-4">
      <?php require_once('inc/sidebar.php');?>
    </div>
  </div>
  </div>
</section>
<?php require_once('inc/footer.php');?>