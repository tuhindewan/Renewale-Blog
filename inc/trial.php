  for ($i=1; $i <= $number_of_pages ; $i++) { 
      echo "<li><a href='#'>$i</a></li>";
    }

     ?>
     <?php 
      
      $number_of_posts = 3; 
      $statement = $db->prepare("SELECT * FROM posts");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      $total = $statement->rowCount();
      $number_of_pages = ceil($total / $number_of_posts);

      


 ?>