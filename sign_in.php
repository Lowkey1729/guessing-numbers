<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Sign in</title>
</head>
<body>
    <?php include('view/navbar.php'); ?>
    <br>
        
       <?php
        if(isset($_SESSION['bet_error'])){
          echo "<br><br>
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['bet_error']."
            </div>
          ";
          unset($_SESSION['bet_error']);
        }
        if(isset($_SESSION['success'])){
          echo "<br><br>
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
	<div class="page-wrapper">
		<div class="page-content--bge5">
			<div class="container">
				<div class="login-wrap">
					<div class="login-content">
						<div class="login-logo">
							<a href="home.php" style="font-family: 'Averia San Serif"; ><img src="static/gr.jpeg" style="border-radius: 2em;" height="30px" width="30px">Guess~Right</a>
							<hr>
						</div>
					<?php if(isset($_SESSION['ecomm_err'])): ?>
                        <h4 align="center" style="color: #3d0444;">
                            <?php echo $_SESSION['ecomm_err'];  ?>
                        </h4>
                        <?php elseif(isset($_SESSION['success'])): ?>
                        <h4 align="center" style="color: #3d0444;">
                            <?php echo $_SESSION['success'];  ?>
                        </h4>
                    <?php endif; ?> 
					<div class="login-form">
						<form action="."  class="form-horizontal"  method="post" >
                            <input type="hidden" name="action" value="login">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control form-control-lg " type="text" name="email" placeholder="Email" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Password" required="true">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <a style="color: pink;" href="forgotten_password.php">Forgot Password?</a>
                                    </label>    
                                     <label>
                                        <a style="color: pink;" href="sign_up.php">Not Registered?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block btn-primary m-b-20" type="submit" name="action" value="sign_in">Sign in</button>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php session_destroy(); ?>
	<?php require_once('view/footer.php'); ?>
</body>
</html>