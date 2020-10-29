<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Register</title>
</head>
<body>
    <?php include('view/navbar.php'); ?>
  
	<div class="page-wrapper">
		<div class="page-content--bge5">
               <?php

        if(isset($_SESSION['bet_error'])){
          echo "<br><br><br><br>
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['bet_error']."
            </div>
          ";
          unset($_SESSION['bet_error']);
        }
        if(isset($_SESSION['success'])){
          echo "<br><br><br><br>
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
				<div class="login-wrap">
					<div class="login-content">
						<div class="login-logo">
							<a href="home.php" style="font-family: 'Averia San Serif;" ><img src="static/gr.jpeg" style="border-radius: 2em;" height="30px" width="30px">Guess~Right</a>
							<hr>
						</div>
					<?php if((isset($_SESSION['ecomm_err']))) : ?>
                        <h4 style="color: #3d0444;" align="center">
                            <?php echo $_SESSION['ecomm_err'];  ?>
                            
                        </h4>
                    <?php elseif(isset($_SESSION['captcha_err'])): ?>
                        <h4 style="color: #3d0444;" align="center">
                            <?php echo $_SESSION['captcha_err'];?>
                        </h4>
                    <?php endif; ?> 
					<div class="login-form">
						<form action="."  class="form-horizontal"  method="post" >
                            <input type="hidden" name="action" value="login">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control form-control-lg " type="text" name="first_name" placeholder="First Name" required="true" value="<?php echo (isset($_SESSION['first_name']))?$_SESSION['first_name']:'' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input class="form-control form-control-lg " type="text" name="last_name" placeholder="Last Name" required="true" value="<?php echo (isset($_SESSION['last_name']))? $_SESSION['last_name'] : ''?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control form-control-lg" type="text" name="email" placeholder="Email" required="true" value="<?php echo (isset($_SESSION['email']))? $_SESSION['email'] :'' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control form-control-lg" type="text" name="username" placeholder="Username" required="true" value="<?php echo (isset($_SESSION['bet_username']))? $_SESSION['bet_username'] :'' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input class="form-control form-control-lg" type="text" name="mobile" placeholder="Mobile" required="true" value="<?php echo (isset($_SESSION['mobile'])) ? $_SESSION['mobile'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control form-control-lg " type="password" name="password" placeholder="Password" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control form-control-lg " type="password" name="v_password" placeholder="Confirm Password" required="true">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <a style="color: pink;" href="sign_in.php">Sign In</a>
                                    </label>    
                                     
                                </div>
                                <button class="au-btn au-btn--block btn-primary m-b-20" type="submit" name="action" value="sign_up">Register</button>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
	<?php require_once('view/footer.php'); ?>
</body>
</html>
<?php session_destroy(); ?>