<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Home</title>
<style>
  @media(min-width: 1022px)
  {
    .pad
    {
      margin-left: 35%;
    }
  }
  .color-top-red
  {
    border-top: 0.7em solid red;
  }

  .color-top-yellow
  {
    border-top: 0.7em solid yellow;
  }

  .color-top-blue
  {
    border-top: 0.7em solid #141b23;
  }

  .color-top-green
  {
    border-top: 0.7em solid green;
  }
</style>
</head>
<?php
  global $db;
  $query = " SELECT * FROM notices WHERE DATE(created_at) = CURDATE() LIMIT 1";
  $result = $db->prepare($query);
  $result->execute();
  $messages = $result->fetch();
  $result->closeCursor();

?>

<body>
    <?php include('view/navbar.php'); ?>
    <br><br><br>
       <?php
        if(isset($_SESSION['bet_error'])){
          echo "<br>
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!!!</h4>
              ".$_SESSION['bet_error']."
            </div>
          ";
          unset($_SESSION['bet_error']);
        }
        if(isset($_SESSION['success'])){
          echo "<br>
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!!!</h4>
              <h4>".$_SESSION['success']."</h4>"."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

       <section id=" testimonials">
      <div>
        <div class="owl-carousel testimonials-carousel  ">
          <div class="col-xl-3 col-lg-3 pad color-top-red" style="background: #fff;">
            <h6 align="center" style="font-size: 1.3em;"><i class="zmdi zmdi-receipt"></i></h6><button class=" au-btn au-btn--block btn btn-primary m-b-20 hundred ">&#8358;100</button>
          </div>

          <div class="col-xl-3 col-lg-3 pad color-top-yellow" style="background: #fff;">
            <h6 align="center" style="font-size: 1.3em;"><i class="zmdi zmdi-receipt"></i></h6><button class=" au-btn au-btn--block btn btn-primary m-b-20 t_hundred ">&#8358;200</button>
          </div>

          <div class="col-xl-3 col-lg-3 pad color-top-blue" style="background: #fff;">
            <h6 align="center" style="font-size: 1.3em;"><i class="zmdi zmdi-receipt"></i></h6><button class=" au-btn au-btn--block btn btn-primary m-b-20 f_hundred ">&#8358;500</button>
          </div>

          <div class="col-xl-3 col-lg-3 pad color-top-green" style="background: #fff;">
            <h6 align="center" style="font-size: 1.3em;"><i class="zmdi zmdi-receipt"></i></h6><button class=" au-btn au-btn--block btn btn-primary m-b-20  thousand">&#8358;1000</button>
          </div>
        </div>
      </div>
      
    </section>


     	<section id=" testimonials" class="testimonials">
      	<div class="container">
      	<div class="testimonial-item">
        <div class="owl-carousel testimonials-carousel" data-aos="fade-in">
    	<h1 align="center">***Guess~Right***<hr><span class="type" data-typed-items="Welcome to Guess~Right , Stake and Win!!!, Absolute rewards for every stake, Enjoy!!!"></span> </h1>
    	
    </div>
</div>
</div>
</section>
<br>
<?php if(isset($messages)): ?>
  <div class="col-xl-12 box">
    <h3 align="center" class="typed" style=" color: black;" data-typed-items="<?php echo $messages['notice'];  ?>"></h3>
    
  </div>
<?php endif; ?>
    <div class="container">
   
<br>

<hr>
    <!-- 	<section id="faq" class="faq">
        <div class="container">

          <div class="section-title" data-aos="fade-down">
            
            <h2 align="center" style="color: #fff;">F.A.Q</h2>
            <p align="center
            " style="color: #fff;">Frequently Asked Questions</p>
          </div>

          <div class="faq-list">
            <ul>
              <li data-aos="fade-up">
                <a data-toggle="collapse" class="collapsed" href="#faq-list-1"><span class="zmdi zmdi-help-outline"></span> My balance doesn't update after transacting successfully  <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-1" class="collapse " data-parent=".faq-list">
                  <p>
                    Firstly, you are advised to contact us with the contact details attached at the bottom of every page.You would be replied to within 24 hours. Note that you can also use the contact section to message us directly.<br>

                    Secondly, Ensure you enter the email you used for registration in the spaces required for  transacting on the transaction page.
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="100">
               <a data-toggle="collapse" href="#faq-list-2" class="collapsed"><span class="zmdi zmdi-help-outline"></span>Could I have a play for the game? <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                  <p>
                      We currently don't have demos for the guess game. You can only play the game once your balance is up to or more than the required balance to play the game for each section.
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="200">
                <a data-toggle="collapse" href="#faq-list-3" class="collapsed"><span class="zmdi zmdi-help-outline"></span>Can I contact Guess~Right through social media platform?<i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                  <p>
                    You can contact us with any of the social media platform listed at the bottom of the page.
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="300">
               <a data-toggle="collapse" href="#faq-list-4" class="collapsed"><span class="zmdi zmdi-help-outline"></span>How do i get paid after winning? <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                  <p>
                      You would be requested to send your account details after every wins you've got.
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="400">
                 <a data-toggle="collapse" href="#faq-list-5" class="collapsed"><span class="zmdi zmdi-help-outline"></span> How is the game played? <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-5" class="collapse" data-parent=".faq-list">
                  <p>
                    Each stake level has it's requirements of play. In each section, you have number of boxes to fill and chances to exhaust. After exhausting the chances, you would be taken away from the game page. Note that each level of stake determines your number of chances and number of boxes to fill.
                  </p>
                </div>
              </li>

            </ul>
          </div>

        </div>
      </section> End F.A.Q Section -->

      <!--  ======= Team Section =======
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2 align="center">Testimonials</h2>
           <h3> <span>Team</span></h3> -->
          <!-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> -->
        </div>
<!-- 
        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="static/images/testimonials-1.jpg"  class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4 align="center">Walter White</h4>
                <p>At first, when i started guess~right, i took it among the other game sites created for scamming. Fortunately for me, i realised i was 101.99% wrong.Keep growing guess~right!!!</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="static/images/testimonials-4.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4 align="center">Sarah Jhonson</h4>
                <p>At first, when i started guess~right, i took it among the other game sites created for scamming. Fortunately for me, i realised i was 101.99% wrong.Keep growing guess~right!!!</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="static/images/testimonials-3.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4 align="center">William Anderson</h4>
                <p>At first, when i started guess~right, i took it among the other game sites created for scamming. Fortunately for me, i realised i was 101.99% wrong.Keep growing guess~right!!!</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="static/images/testimonials-5.jpg" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4 align="center">Amanda Jepson</h4>
                <p>At first, when i started guess~right, i took it among the other game sites created for scamming. Fortunately for me, i realised i was 101.99% wrong.Keep growing guess~right!!!</p>
              </div>
            </div>
          </div>

        </div>

      </div> -->
    </section> End Testimonial Section --> 

       <!-- ======= Contact Us Section ======= -->
      <section id="contact" class="contact">
        <div class="container" >

          <div class="section-title" style="background-color: #fff;"  data-aos="fade-down">
            
            <h2 align="center">Contact Us</h2>
            <hr>
          </div>

          <div class="row justify-content-center">
            <div class="col-xl-3 box" style="background-color: #fff;" data-aos="fade-up" data-aos-delay="100">
              <div class="info-box">
                <h3><i class="zmdi zmdi-pin color"></i> Our Address</h3>
                <p>A108, Otedola Street, Lafenwa-Itele, Ogun State.</p>
              </div>
            </div>
            <div class="col-xl-3 box" data-aos="fade-up" data-aos-delay="200">
              <div class="info-box">
                <i class="bx bx-envelope"></i>
                <h3><i class="zmdi zmdi-email color">&nbsp;</i>Email Us</h3>
                <p>nextevolution.inc@gmail.com<br></p>
              </div>
            </div>
            <div class="col-xl-3 box" style="background-color: #fff;" data-aos="fade-up" data-aos-delay="300">
              <div class="info-box">
             
                <h3> <i class="zmdi zmdi-phone-in-talk color"></i>&nbsp;Call Us</h3>
                <p>+234 702 575 2538 </p>
              </div>
            </div>
          </div>

        
     

        </div>
      </section>

    </div>
</body>
<?php include('includes/bet_modal.php'); ?>
</html>
<?php require_once('view/footer.php'); ?>
<script>
$(function(){
  $(document).on('click', '.hundred', function(e){
    e.preventDefault();
    $('#hundred').modal('show');
    // var id = $(this).data('id');
    // getRow(id);
  });

  $(document).on('click', '.t_hundred', function(e){
    e.preventDefault();
    $('#t_hundred').modal('show');
    // var id = $(this).data('id');
    // getRow(id);
  });

  $(document).on('click', '.f_hundred', function(e){
    e.preventDefault();
    $('#f_hundred').modal('show');
    // var id = $(this).data('id');
    // getRow(id);
  });

$(document).on('click', '.thousand', function(e){
    e.preventDefault();
    $('#thousand').modal('show');
    // var id = $(this).data('id');
    // getRow(id);
  });
});
</script>