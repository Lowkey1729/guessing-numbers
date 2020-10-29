<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
</head>
<title>Contact Us Guess Right</title>
<body>
    <?php include('view/navbar.php'); ?>
    <br><br><br>
    <?php
      if(isset($_GET['price']) && isset($_GET['chance']))
      {
        
      }
?>

      <section>
      <div class="container-fluid" id="contact">
        <div class="row">
          <div class="col-12" style="padding-top: 20em;">
            <h2 class="text-center content-title" style="color: white; font-family: 'Averia Serif Libre';">Got Some Messages to drop??<hr>Contact Us Via <span class="typed" data-typed-items="Email , Facebook, Linkedln, Whatsapp!!!"></span>  </h2>
            <hr>
          </div>
        </div>
      </div>
    </section>
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
              <!-- register to comment -->
           <div class="row mt-5 justify-content-center">
          <div class="col-lg-10" style="box-shadow:0px 2px 40px rgba(0, 0, 0, 0.2); ">
            <form action="." method="post" role="form" class="php-email-form">
              <div class="form-row" style="margin-top: 2em;">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" required="" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" required="" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="username" required="" id="subject" placeholder="Username" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" required="" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              
              <div class="text-center"><button type="submit" class="btn btn-primary" name="action" value="send_message">Send Message</button></div>
            </form>
          </div>

        </div>
    </div>
<br>
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
                <p>+234 702 575 2538</p>
              </div>
            </div>
          </div>

        
     

        </div>
      </section>


 </body>
 </html>
 <?php include('view/footer.php'); ?>
