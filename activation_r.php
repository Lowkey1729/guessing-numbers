<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Reactivation</title>
</head>
<?php
if((isset($_SESSION['code']))&&isset($_SESSION['user_id']))
{
  $code = $_SESSION['code'];
  $id = $_SESSION['user_id'];
  global $db;
  $query = " SELECT *, COUNT(*) As numrows FROM user WHERE activate_code = :code AND id = :id";
  $result = $db->prepare($query);
  $result->bindValue(':code', $code);
  $result->bindValue(':id', $id);
  $result->execute();
  $row = $result->fetch();
  $result->closeCursor();
}
?>
<?php if($row['numrows']>0): ?>
<body>
    <?php include('view/navbar.php'); ?>
    <br><br>
    <?php
        if(isset($_SESSION['bet_error'])){
          echo "<br>
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['bet_error']."
            </div>
          ";
          unset($_SESSION['bet_error']);
        }
        if(isset($_SESSION['success'])){
          echo "<br>
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
     <div class="container">
      <h1 align="center">Reactivate Account</h1>
      <hr>
     	<div class="login-form">
        <form action="." class="form-horizontal" method="post">
          <div class="form-group">
            <h3>Enter The <b>Five digit code</b> sent to your email.</h3>
            <input type="text" name="activate_code" placeholder="Enter the code here." required="true" class="form-control form-control-lg activate">
          </div>
          <button class="au-btn au-btn--block btn-primary m-b-20" type="submit" name="action" value="activate_code_r">Activate</button>
        </form>
      </div>
        <!-- ======= Contact Us Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title" data-aos="fade-down">
            
            <h2 align="center">Contact Us</h2>
            <hr>
          </div>

          <div class="row justify-content-center">
            <div class="col-xl-3 box" data-aos="fade-up" data-aos-delay="100">
              <div class="info-box">
                <h3><i class="zmdi zmdi-pin color"></i> Our Address</h3>
                <p>A108, Otedola Street, Lafenwa-Itele, Ogun State.</p>
              </div>
            </div>
            <div class="col-xl-3 box" data-aos="fade-up" data-aos-delay="200">
              <div class="info-box">
                <i class="bx bx-envelope"></i>
                <h3><i class="zmdi zmdi-email color">&nbsp;</i>Email Us</h3>
                <p>info@example.com<br>contact@example.com</p>
              </div>
            </div>
            <div class="col-xl-3 box" data-aos="fade-up" data-aos-delay="300">
              <div class="info-box">
             
                <h3> <i class="zmdi zmdi-phone-in-talk color"></i>&nbsp;Call Us</h3>
                <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
              </div>
            </div>
          </div>

        
     

        </div>
      </section>
     </div>
     <br><br><br>
 </body>
 <?php else: ?>
  <?php header('location: home.php'); ?>
<?php endif; ?>
 </html>
 <?php include('view/footer.php'); ?>