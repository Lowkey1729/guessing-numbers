<?php session_start(); ?>
<?php include('config.php'); ?>
<?php include('model/customer_db.php'); ?>
 <?php if(strlen($_SESSION['avmusername'])==0): header("Location: login.php"); ?>
  <?php else: ?>
 <?php  require_once('views/header.php'); ?>
<title>Change Password | AMS</title>
</head>
<?php include('sidebar.php'); ?>
<?php include('header_dashboard.php'); ?>
<div class="content-wrapper">
 <div class="container-fluid">
 </div>
</div>
<?php include('views/footer.php'); ?>
</body>
</html>
<?php endif; ?>