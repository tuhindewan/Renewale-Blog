<?php
require_once('inc/top.php');
?>

  </head>
  <body>

<?php
require_once('inc/header.php');
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
    <div class="day">22</div>
    <div class="month">February</div>
    <div class="year">2017</div>
  </div>
  <div class="col-md-8 post-title">
    <a href=""><h2>Learn Full CMS Project Using HTML, CSS, JQuery, PHP and MySQL</h2></a>
    <p>Written by: <span>Md.Saiduzzaman</span></p>
  </div>
  <div class="col-md-2 profile-picture">
    <img src="img/profile.jpg" alt="profile-picture" class="img-circle">
  </div>
</div>
<a href=""><img src="img/image1.jpg" alt="post-image"></a>
<p class="description">
  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
</p>
<div class="bottom">
<span class="first"><i class="fa fa-folder" aria-hidden="true"></i><a href=""> Category</a></span> |
<span class="second"><i class="fa fa-comment" aria-hidden="true"></i><a href=""> Comment</a></span>
</div>
</div>

<div class="related-posts">
  <h3>Related Posts</h3><hr>
  <div class="row">
    <div class="col-sm-4">
      <a href="">
        <img src="img/image1.jpg" alt="slider one">
        <h4>This is the heading for post one</h4>
      </a>
    </div>
    <div class="col-sm-4">
      <a href="">
        <img src="img/image2.jpg" alt="slider two">
        <h4>This is the heading for post two</h4>
      </a>
    </div>
    <div class="col-sm-4">
      <a href="">
        <img src="img/image3.jpg" alt="slider three">
        <h4>This is the heading for post three</h4>
      </a>
    </div>
  </div>
</div>
<div class="author">
  <div class="row">
    <div class="col-sm-3">
      <img src="img/profile.jpg" alt="profile-picture" class="img-circle" style="height: 150px; width: 150px; ">
    </div>
    <div class="col-sm-9">
      <h4>Md. Saiduzzaman</h4>
      <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
      </p>
    </div>
  </div>
</div>
<div class="comment">
  <h3>Comments</h3><hr>
  <div class="row single-comment">
    <div class="col-sm-2">
      <img src="img/unknown-profile.png" alt="unknown" class="img-circle" style="height: 100px; width: 100px;">
    </div>
    <div class="col-sm-10">
      <h4>Md. Saiduzzaman</h4>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
    </div>
  </div>
   <div class="row single-comment">
    <div class="col-sm-2">
      <img src="img/unknown-profile.png" alt="unknown" class="img-circle" style="height: 100px; width: 100px;">
    </div>
    <div class="col-sm-10">
      <h4>Md. Saiduzzaman</h4>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
    </div>
  </div>
</div>
<div class="comment-box">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal" action="" method="">
      <div class="form-group">
    <label for="full name" class="col-sm-2 control-label">Full Name* :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="full-name" placeholder="Full Name">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email* :</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="website" class="col-sm-2 control-label">Website :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="website" placeholder="Website URL">
    </div>
  </div>
  <div class="form-group">
    <label for="comment" class="col-sm-2 control-label">Comment* :</label>
    <div class="col-sm-10">
     <textarea class="form-control" rows="10" cols="30" placeholder="Your Comment Should be Here"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Submit Comment</button>
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