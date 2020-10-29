<?php 




?>

<div class="page-wrapper">
   <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle" >
                <i class="sr-only"></i>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
                <div class="input-group">
                  <form class="form-header" method="post" action="">
                  <input type="text" name="search"  class="form-control" placeholder="">
                    <button type="submit" name="" value=""  class="btn btn-flat">
                    <i class="zmdi zmdi-search"></i>
                  </button>
                  </form>
                </div>
                <div id="search-results-container">
                  <ul id="search-results"></ul>
                </div>
              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                  
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" style="" data-toggle="dropdown">
                      <img src="<?php echo 'static/images/' . $post;?>" class="user-image" alt="" />
                      <span style="font-family: 'Averia Serif Libre';" class="d-none d-lg-inline-block"><?php if(isset($_SESSION['get_username'])){echo $_SESSION['get_username'];} ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        <img src="<?php echo '../static/images/'. $post; ?>" class="img-circle" alt="" />
                        <div class="d-inline-block">
                          <p><?php if(isset($_SESSION['get_username'])){echo $_SESSION['get_username'];}  ?></p> <small style=" font-family: 'Averia Serif Libre', cursive color: black" class="pt-1"><?php echo $_SESSION['email'];?></small>
                        </div>
                      </li>

                      <li>
                        <a href="#">
                          <i class="mdi mdi-account"></i> My Profile
                        </a>
                      </li>
                      <li>
                        <a href="change_password.php">
                          <i class="mdi mdi-email"></i> Change Password
                        </a>  
                      </li>
                      <li>
                        <a href="index.php?action=logout"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
      
          </header>