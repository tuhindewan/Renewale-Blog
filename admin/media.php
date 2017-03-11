

<?php require_once('inc/top.php');?>
 <?php 

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
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
      <h1><i class="fa fa-tachometer" aria-hidden="true"></i> Media <small>Add or View Media Files</small></h1><hr>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-database" aria-hidden="true"></i> Media</li>
      </ol>

              <?php 

              if (isset($_POST['submit'])) {
                if (count($_FILES['media']['name']) > 0) {
                  for ($i=0; $i < count($_FILES['media']['name']); $i++) { 
                    $image = $_FILES['media']['name'][$i];
                    $tmp_name = $_FILES['media']['tmp_name'][$i];

                    $statement = $db->prepare("INSERT INTO media (image) VALUES ('$image')");
                    $statement->execute();
                    if ($statement) {
                      move_uploaded_file($tmp_name,"media/$image");
                    }
                  }
                }
              }

               ?>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-4 col-xs-8">
                  <input type="file" name="media[]" required multiple>
                </div>
                <div class="col-sm-4 col-xs-4">
                  <input type="submit" name="submit" value="Add Media" class="btn btn-primary btn-sm">
                </div>
              </div>
            </form>
            <hr>

            <div class="row">
            <?php 

            $statement = $db->prepare("SELECT * FROM media ORDER BY id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
              foreach($result as $row){

                $get_image = $row['image'];

             ?>
              <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 thumb">
                <a href="media/<?php echo $get_image;?>" class="thumbnail">
                  <img src="media/<?php echo $get_image;?>" width="100">
                </a>
              </div>
              <?php 
                        }
                          }
            else
            {
              echo "<center><h3>No Media Available</h3></center>";
            }


               ?>

            </div>

    </div>
  </div>
</div>
<?php require_once('inc/footer.php');?>