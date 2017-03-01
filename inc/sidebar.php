        <div class="widgets">
            <form action="index.php" method="post">
                 <div class="input-group">
                      <input type="text" class="form-control" name="search-title" placeholder="Search for...">
                      <span class="input-group-btn">
                      <input type="submit" value="GO" class="btn btn-default" name="search">
                      </span>
                  </div><!-- /input-group -->
            </form>
        </div><!-- /widgets close -->
        <div class="widgets">
           <div class="popular">
           <h4>Popular Posts</h4>
           <hr>
           <?php 


            $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' ORDER BY views DESC LIMIT 5");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
              foreach($result as $row){
                  $date         = getdate($row['date']);
                  $day          = $date['mday']; 
                  $month        = $date['month'];
                  $year         = $date['year'];
                ?>
                     <div class="row">
                                 <div class="col-xs-4">
                                  <a href="post.php?post_id=<?php echo $row['id']; ?>"><img src="img/<?php echo $row['image']; ?>"></a>
                                 </div>
                                 <div class="col-xs-8 details">
                                   <a href="post.php?post_id=<?php echo $row['id']; ?>"><h6><?php echo $row['title']; ?></h6></a>
                                   <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo "$day $month $year"; ?></p>
                                 </div>
                        </div>
            <?php
              }
            }
            else
            {
              ?>
              <h3>No Post Available</h3>
              <?php
            }
            ?>

            </div><!-- /input-group -->
        </div><!-- /widgets close -->
         <div class="widgets">
           <div class="popular">
           <h4>Recent Posts</h4>
           <hr>
           <?php 


            $statement = $db->prepare("SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
              foreach($result as $row){
                  $date         = getdate($row['date']);
                  $day          = $date['mday']; 
                  $month        = $date['month'];
                  $year         = $date['year'];
                ?>
                     <div class="row">
                                 <div class="col-xs-4">
                                  <a href="post.php?post_id=<?php echo $row['id']; ?>"><img src="img/<?php echo $row['image']; ?>"></a>
                                 </div>
                                 <div class="col-xs-8 details">
                                   <a href="post.php?post_id=<?php echo $row['id']; ?>"><h6><?php echo $row['title']; ?></h6></a>
                                   <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo "$day $month $year"; ?></p>
                                 </div>
                        </div>
            <?php
              }
            }
            else
            {
              ?>
              <h3>No Post Available</h3>
              <?php
            }
            ?>

            </div><!-- /input-group -->
        </div><!-- /widgets close -->
          <div class="widgets">
           <div class="popular">
           <h4>Categories</h4>
           <hr>
            
            <div class="row">
              <div class="col-xs-6">
                <ul>
                  <?php 


                    $statement = $db->prepare("SELECT * FROM categories");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($result) {
                      $count = 2;
                      foreach($result as $row){
                        $count = $count + 1;
                        if (($count % 2)==1) {
                          ?>
                           <li><a href="index.php?cat=<?php echo $row['id'];?>"><?php echo ucfirst($row['category']); ?></a></li>
                           <?php
                        }
                        ?>

                        
                         <?php
                      }
                    }
                 

                   ?>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul>
              <?php 


                    $statement = $db->prepare("SELECT * FROM categories");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($result) {
                      $count = 2;
                      foreach($result as $row){
                        $count = $count + 1;
                        if (($count % 2)==0) {
                          ?>
                           <li><a href="index.php?cat=<?php echo $row['id'];?>"><?php echo ucfirst($row['category']); ?></a></li>
                           <?php
                        }
                        ?>

                        
                         <?php
                      }
                    }
                 
                    

                   ?>
                </ul>
              </div>
            </div>
             
           </div>
           
            </div><!-- /input-group -->
              <div class="widgets">
           <div class="social">
           <h4>Social Icons</h4>
           <hr>         
           <div class="row">
             <div class="col-xs-4">
               <a href="http://www.facebook.com"><img style="width: 70%" src="img/facebook.png" alt="facebook"></a>
             </div>
             <div class="col-xs-4">
               <a href="http://www.twitter.com"><img style="width: 70%" src="img/twitter.jpg" alt="twitter"></a>
             </div>
             <div class="col-xs-4">
               <a href="http://www.google.com"><img style="width: 70%" src="img/google-plus.png" alt="google-plus"></a>
             </div>
           </div>
               <hr> 
           <div class="row">
             <div class="col-xs-4">
               <a href="http://www.linkedin.com"><img style="width: 70%" src="img/linkedin.png" alt="linkedin"></a>
             </div>
             <div class="col-xs-4">
               <a href="http://www.skype.com"><img style="width: 70%" src="img/skype.jpg" alt="skype"></a>
             </div>
             <div class="col-xs-4">
               <a href="http://www.youtube.com"><img style="width: 70%" src="img/youtube.jpg" alt="youtube"></a>
             </div>
           </div>
            </div><!-- /input-group -->
      </div>