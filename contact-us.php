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
      <h1>Contact<span> Us</span></h1>
      <p>We are available 24x7. So Feel Free to Contact Us.</p>
    </div>
  </div>
  <img src="img/top.jpg" alt="top image">
</div>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3678.2453951321368!2d91.09834631454088!3d22.793369285069552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754af712aaac0b7%3A0x4bab3d112f6b6f3f!2sNoakhali+Science+and+Technology+University!5e0!3m2!1sen!2sbd!4v1487910357931" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <div class="col-md-12 contact-form">
        <h2>Contact Form</h2><hr>
          <form class="form-horizontal" action="" method="">
          <div class="form-group">
    <label for="full-name" class="col-sm-2 control-label">Full Name* :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Full Name">
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
      <input type="text" class="form-control" id="inputEmail3" placeholder="website">
    </div>
  </div>
  <div class="form-group">
    <label for="message" class="col-sm-2 control-label">Message :</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="10" cols="30" placeholder="Your Message Sould Be Here" id="message"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
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