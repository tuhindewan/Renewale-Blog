<?php 

$session_role1 = $_SESSION['role'];

$statement = $db->prepare("SELECT * FROM comments WHERE status = 'pending'");
$statement->execute();
$num_rowas = $statement->rowCount();
?>     
      <div class="list-group">
            <a href="index.php" class="list-group-item active">
              <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            </a>
            <a href="posts.php" class="list-group-item">
              <i class="fa fa-file-text" aria-hidden="true"></i> All Posts
            </a>
             <a href="media.php" class="list-group-item">
              <i class="fa fa-database" aria-hidden="true"></i> Media
            </a>

            <?php if ($session_role1 == 'admin') {
              ?>
           

            <a href="comments.php" class="list-group-item">
              <?php echo "<span class='badge'>$num_rowas</span>"; ?>
              <i class="fa fa-comment" aria-hidden="true"></i> Comments
            </a>
            <a href="categories.php" class="list-group-item">
              <i class="fa fa-folder-open" aria-hidden="true"></i> Categories
            </a>
            <a href="users.php" class="list-group-item">
              <i class="fa fa-users" aria-hidden="true"></i> Users
            </a>

            <?php } ?>
      </div>