<?php
require_once('inc/top.php');
?>
  
  </head>
  <body>

<?php
require_once('inc/header.php');
?>
      <?php
      $number_of_posts = 3; 
      if (isset($_GET['page'])) {
        $page_id = $_GET['page'];
      }
      else
      {
        $page_id = 1;
      }
      if (isset($_POST['search'])) {
        $search = $_POST['search-title'];
         $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' AND tags LIKE '%$search%'");
                $statement->execute();       
              $result = $statement->fetchAll(PDO::FETCH_ASSOC);
              $total = $statement->rowCount();
              $number_of_pages = ceil($total / $number_of_posts);
              $posts_start_from = ($page_id -1) * $number_of_posts;    
      }
      else{
      if (isset($cat_name)) {
        $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' AND categories = '$cat_name'");
                          $statement->execute();       
              $result = $statement->fetchAll(PDO::FETCH_ASSOC);
              $total = $statement->rowCount();
              $number_of_pages = ceil($total / $number_of_posts);
              $posts_start_from = ($page_id -1) * $number_of_posts;   
      }
      else
      {
         $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish'");
            
              $statement->execute();
              $result = $statement->fetchAll(PDO::FETCH_ASSOC);
              $total = $statement->rowCount();
              $number_of_pages = ceil($total / $number_of_posts);
              $posts_start_from = ($page_id -1) * $number_of_posts; 
      }
    }
            
  
 ?>
 <?php 

if (isset($_GET['cat'])) {

    $cat_id = $_GET['cat'];

    $statement = $db->prepare("SELECT * FROM categories WHERE id = $cat_id");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
      $cat_name = $row['category'];
    }
}

  ?>

<div class="jumbotron">
  <div class="container">
    <div id="details" class="animated fadeInLeft">
      <h1>Renewale<span> Blog</span></h1>

      <p>This is an online Tutorial Huge Portal.So Now Shine With Us</p>
    </div>
  </div>
  <img src="img/top.jpg" alt="top image">
</div>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
      <?php
      $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5 ");

     
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
              <?php 
              foreach($result as $row => $value){
              ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $row ?> " class="active"></li>
              <?php } ?>
              </ol>
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
              <?php 
              foreach($result as $row => $value){
              ?>
                <div class="item <?php if($row == 0){echo 'active';} ?>">
                  <a href="post.php?post_id=<?php echo $value['id'];?>"><img src="<?php echo 'img/'. $value['image']; ?>"></a>
                  <div class="carousel-caption">
                   <h2><?php echo $value['title'];?></h2> <?php echo $value['title'];?>
                  </div>
                </div>
              <?php } ?>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          
          
<?php
      if (isset($_POST['search'])) {
        $search = $_POST['search-title'];
        $statement = $db->prepare("SELECT * FROM posts WHERE status='publish' AND tags LIKE '%$search%' ORDER BY id DESC LIMIT $posts_start_from , $number_of_posts ");
      }
      else
      {
      if (isset($cat_name)) {
          $statement = $db->prepare("SELECT * FROM posts WHERE status='publish' AND categories = '$cat_name' ORDER BY id DESC LIMIT $posts_start_from , $number_of_posts ");
      }else
      {
        $statement = $db->prepare("SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT $posts_start_from , $number_of_posts");
   
      }
    }
    
    
       $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($result){
    foreach($result as $row){
      $id           = $row['id'];
      $date         = getdate($row['date']);
      $day          = $date['mday']; 
      $month        = $date['month'];
      $year         = $date['year'];
      $title        = $row['title'];
      $author       = $row['author'];
      $author_image = $row['author_image'];
      $image        = $row['image'];
      $categories   = $row['categories'];
      $tags         = $row['tags'];
      $post_data    = $row['post_data'];
      $views        = $row['views'];
      $status       = $row['status'];
    


?>
<div class="post">
    <div class="row">
      <div class="col-md-2 post-date">
        <div class="day"><?php echo $day;?></div>
        <div class="month"><?php echo $month;?></div>
        <div class="year"><?php echo $year;?></div>
      </div>
      <div class="col-md-8 post-title">
        <a href="post.php?post_id=<?php echo $id;?>"><h2><?php echo $title;?></h2></a>
        <p>Written by: <span><?php echo ucfirst($author);?></span></p>
      </div>
      <div class="col-md-2 profile-picture">
        <img src="img/<?php echo $author_image;?>" alt="profile-picture" class="img-circle"  height="auto" width="100%">
      </div>
    </div>

    <a href="post.php?post_id=<?php echo $id;?>"><img src="img/<?php echo $image;?>" alt="post-image"></a>
    <p class="description">
      <?php echo substr($post_data, 0,300)." ......";?>
    </p>
    <a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary">Read More....</a>
    <div class="bottom">
    <span class="first"><i class="fa fa-folder" aria-hidden="true"></i><a href=""> <?php echo ucfirst($categories);?></a></span> |
    <span class="second"><i class="fa fa-comment" aria-hidden="true"></i><a href=""> Comment</a></span>
    </div>
</div>
<?php
}
}
    else{
      ?>
      <center><h2>No Posts Available</h2></center>
      <?php

    }

?>



<nav id="pagination">
  <ul class="pagination">

          <?php
          for ($i=1; $i <= $number_of_pages ; $i++) { 
            echo "<li class = '".($page_id == $i? 'active': '')."'><a href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":" ")."'>$i</a></li>";
          }

           ?>
     
  </ul>
</nav>

      </div>
      <div class="col-md-4">
          <?php require_once('inc/sidebar.php');?>
    </div>
  </div>
  </div>
</section>
<?php require_once('inc/footer.php');?>