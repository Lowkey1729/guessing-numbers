<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
</head>
<title>Transaction Guess Right</title>
<body>
    <?php include('view/navbar.php'); ?>
    <br><br><br><br>
    <?php
      if(isset($_GET['price']) && isset($_GET['chance']))
      {
        
      }
?>
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
     	<h1 align="center"> ***Let's transact***</h1>
     	<div class="login-form">
     	<form class="form-horizontal" action="create_payment.php" method="post">
     		<div class="form-control">
     			<input type="text" name="first_name" required class="form-control form-control-lg" placeholder="First Name">
     		</div>
        <div class="form-control">
          <input type="text" name="last_name" required="" class="form-control form-control-lg" placeholder=" Last Name">
        </div>
        <div class="form-control">
          <input type="text" name="email" required="" class="form-control form-control-lg" placeholder="Email" >
        </div>
        <div class="form-control">
          <input type="text" required="" name="price" class="form-control form-control-lg" placeholder="Price">
        </div>
        <div class="form-control">
          <button class="au-btn au-btn--block btn-primary m-b-20" type="submit" name="submit">Pay</button>
        </div>
     	</form>
     	</div>

     </div>
 </body>
     <?php include('view/footer.php'); ?>
 </html>

