<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>FAQs</title>
</head>
<body>
    <?php include('view/navbar.php'); ?>
    <br><br><br>
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
      <section id="faq" class="faq">
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

            
              <li data-aos="fade-up">
                <a data-toggle="collapse" class="collapsed" href="#faq-list-1"><span class="zmdi zmdi-help-outline"></span> Do i need to  ? <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-1" class="collapse " data-parent=".faq-list">
                  <p>
                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="100">
               <a data-toggle="collapse" href="#faq-list-2" class="collapsed"><span class="zmdi zmdi-help-outline"></span>Feugiat scelerisque varius morbi enim nunc? <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                  <p>
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="200">
                <a data-toggle="collapse" href="#faq-list-3" class="collapsed"><span class="zmdi zmdi-help-outline"></span>Dolor sit amet consectetur adipiscing elit?<i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                  <p>
                    Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                  </p>
                </div>
              </li>

              <li data-aos="fade-up" data-aos-delay="300">
               <a data-toggle="collapse" href="#faq-list-4" class="collapsed"><span class="zmdi zmdi-help-outline"></span>Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="zmdi zmdi-caret-down pull-right"></i></a>
                <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                  <p>
                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                  </p>
                </div>
              </li>

            </ul>
          </div>

        </div>
      </section><!-- End F.A.Q Section -->
 
       </div>
 </body>
 </html>
 <?php include('view/footer.php'); ?>     