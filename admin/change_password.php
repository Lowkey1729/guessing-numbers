<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php  require_once('views/header.php'); ?>
<title>Change Password</title>
</head>
<?php include('includes/sidebar.php'); ?>
<?php include('includes/header_dashboard.php');?>
<div class="content-wrapper">
  <div class="content">
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
      <h1 style="color: #fff; background: #111111;" align="center"> ***Change Password*** </h1>
      <hr>
      <div class="login-form">
        <form class="form-horizontal" action="." method="post">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="old_password" class="form-control form-control-lg" placeholder="Old Password" required="">
          </div>
          <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control form-control-lg" placeholder="New Password" required="">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" required="">
          </div>
          <div class="form-group">
             <button class="au-btn au-btn--block btn-success m-b-20" type="submit" name="action" value="change_password">Change</button>
          </div>
        </form>
      </div>

         </div>
</div>
<?php include('includes/today.php'); ?>
<?php include('views/footer.php'); ?>
</body>
</html>
