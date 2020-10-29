<header id="header"   class=" d-flex align-items-center ">
 <div class="container-fluid d-flex align-items-center">
 	<div class="logo mr-auto">
		<a  class="pull-left " href="#" style=" color: black; font-family:  'Averia Serif Libre'" ><h1 id="logo"><img src="./static/gr.jpeg" style="border-radius: 2em;" height="30px" width="30px"> Guess~Right</h1></a>
	</div> 

		<nav  class="nav-collapse nav-menu d-none d-lg-block">
 		<ul >
 		
				 <li style="margin-top: 1em;">
					<a  href="home.php" style="color:white; "><i class="zmdi zmdi-home"></i>Home</a>
				</li>
				<li style="margin-top: 1em;" >
					<a  href="about.php" style="color: white;"><i class="zmdi zmdi-card"></i>About</a>
				</li>
				<li style="margin-top: 1em;">
					<a  href="contact.php" style="color: white;" ><i class="zmdi zmdi-phone"></i>Contact</a>
				</li>
				<li style="margin-top: 1em;">
					<a  href="bets.php" style="color: white;" ><i class="zmdi zmdi-book"></i>Games</a>
				</li>
				<li style="margin-top: 1em;">
					<a  href="faq.php" style="color: white;" ><i class="zmdi zmdi-case"></i>FAQs</a>
				</li>
				<?php if(isset($_SESSION['get_username'])):?>
				<?php else:?>
				<li style="margin: 1em;">	
				<a style="padding-right: 2em;" href="sign_in.php" class=" btn btn-primary" >SignIn</a>
				</li>
				<li style="margin: 1em;">
				<a style="padding-right: 2em;" href="sign_up.php" class="btn btn-primary">SignUp</a>
				</li>
			<?php endif;?>
				</li>

		    <?php if(isset($_SESSION['get_username'])):
		    	require('./model/customer_db.php');
		       $user = new Users();
			   $username = $_SESSION['get_username'];
			   $username = strtoupper($username);
			   $_SESSION['image'] = $user->get_user_image($username);
			   $image = $_SESSION['image'];
			   $image = ($_SESSION['image']!=null)?"./images/author/$image":"./images/author/avatar.png";
			   $email = $_SESSION['email'];
			   $balance = $user->get_user_balance($email);
		 	?>
		 	<li style="margin:0.2em;" class="drop-down"><a href=""><img style="border-radius: 1.5em;" src="<?php echo $image; ?>"><?php echo $username; ?></a>
            <ul>
              <li><a href="profile.php">My Profile</a></li>
              <li><a href="my_stakes.php">My Stakes</a></li>
              <li><a href="my_wins.php">Wins</a></li>
              <li><a href="transaction.php">Transact</a></li>
              <li style="margin: 1em;">
				<a style="padding-right: 2em;" href="index.php?action=logout"  class="btn btn-primary">Logout</a>
				</li>
            </ul>
          </li>
          <?php endif;?>
          <?php if(isset($_SESSION['get_username'])): ?>
				<li style="margin: 1em;">
                  <h3 style="color: #1bdad1;"><?php echo '&#8358;'.number_format($balance,2) ; ?></h3>
				</li>
			<?php endif; ?>
			</ul>
 	</nav>

 </div>
</div> 
</header>

