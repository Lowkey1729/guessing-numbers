<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
 <?php if(isset($_SESSION['email'])): ?> 
<title>Reset Password</title>
</head>
<body>
     <?php include('view/navbar.php'); ?>
     <br><br><br><br>
	<div class="page-wrapper">
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
		<div class="page-content--bge5">
			<div class="container">
				<div class="login-wrap">
					<div class="login-content">
						<div class="login-logo">
							<a href="home.php" style="font-size: 24px;font-family: 'Averia San Serif'">
								Guess~Right
							</a>
						</div>
						<hr>
                      <h3 align="center"> Reset Your Password </h3>
                      <hr>
                      <div class="login-form">
						<form action="."  class="form-horizontal"  method="post" >
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control form-control-lg " type="password" name="n_password" placeholder="New Password" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control form-control-lg" type="password" name="confirm_password" placeholder="Confirm Password" required="true">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <a href="login.php" style="color: pink;">Sign In</a>
                                    </label>
                                </div>
                                
                                <button class="au-btn au-btn--block btn-success m-b-20" type="submit" name="action" value="password_reset">Reset</button>
                            </form>
                        </div> 
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
    <?php  ?>
    <?php if(!isset($_SESSION['email']))
    {
       header('location: home.php');
    }
    ?>
<?php include('view/footer.php'); ?>	
</body> 
</html> 
