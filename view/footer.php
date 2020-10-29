
     <a href="#" class="back-to-top"><i class="zmdi zmdi-long-arrow-up"></i></a> 
	<footer  id="footer" style="margin-top: 6em; " >
<!--  -->

      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6 footer-contact">
              <h3>Guess~Me~Right</h3>
              <p>
                A108, Otedola Street, <br>
                Lafenwa-Itele, Ogun State<br>
                Nigeria<br><br>
                <strong>Phone:</strong> +234 702 575 2538<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="home.php">Home</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="about.php">About us</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="faq.php">FAQs</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="terms.php">Terms of service</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="policy.php">Privacy policy</a></li>
                <li><i class=""></i> <a href="bets.php">Games</a></li>
              </ul>
            </div>

             <div class="col-lg-3 col-md-6 footer-links">
              <h4>Sponsored By</h4>
              <img src="./static/nextrevolution.jpeg" class="img-fluid" height="150px" width="150px">
            </div> 

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Social Networks</h4>
              <p>You can contact us on any of the social media platform listed below.</p>
              <div class="social-links mt-3">
                <a href="https://twitter.com/NextEvolution5?s=08" class="twitter"><i class="zmdi zmdi-twitter"></i></a>
                <a href="https://www.facebook.com/Guess-Right-105396124600430/" class="facebook"><i class="zmdi zmdi-facebook"></i></a>
                <a href=" https://www.instagram.com/invites/contact/?i=hp4yl10iwpm7&utm_content=i7g9un1" class="instagram"><i class="zmdi zmdi-instagram"></i></a>
                <a href="#" class="google-plus"><i class="zmdi zmdi-google"></i></a>
                <!-- <a href="#" class="linkedin"><i class="zmdi zmdi-linkedin"></i></a> -->
                <a href="https://www.facebook.com/Guess-Right-105396124600430/" class="facebook"><i class="zmdi zmdi-whatsapp"></i></a>
              </div>
            </div>

          </div>
        </div>
      </div>



      <div class="container pd-5 py-5" style="margin-bottom: 0 ">
        <div class="row">
        <div class="col-xl-6">
          <div class="copyright">
          &copy; Copyright <strong><span>Guess~Right</span></strong>. All Rights Reserved
        </div>
        </div>
        <div class="col-xl-6">
            
        <div class="credits">
       
          Designed by <a href="#">Olarewaju Mojeed</a>
        </div>    
        </div>
        </div>
      
      </div>
	</footer>
		  <script src="./static/jquery.js"></script>
			<script  src="./static/bootstrap.js"></script>
       <!-- <script src="./static/jquery.easing.min.js"></script> -->
      <script  src="./typed.js/typed.min.js"></script>
      <script  src="./owl.carousel/owl.carousel.min.js"></script>
      <script  src="./static/isotope.pkgd.js" ></script>
      <script  src="./static/venobox.js"></script>
      <script  src="./aos/aos.js"></script>
      <script  src="./static/main.js"></script>                   
      <!-- <script src="./static/style.js"></script> -->

			<script>
 $(document).ready(function () {
     $(window).scroll(function () {
         if ($(this).scrollTop() > 100) {
             $('.back-to-top').fadeIn('slow');
             // adding padding
              $('body').css('padding-top', $('.navbar').outerHeight() + 'px');


         } else {
             $('.back-to-top').fadeOut('slow');
              // remove padding top from body
        $('body').css('padding-top', '0');
         }
     });
     $('.back-to-top').click(function () {
         $("html, body").animate({
             scrollTop: 0
         }, 1400);
         return false;
     });
 });

 $(window).scroll(function()
 {
    if($(this).scrollTop()> 200)
    {
      $('#header').addClass("fixed-top");
    }
    else
    {
      $('#header').removeClass("fixed-top");
    }
 });
</script>
 <script>
   $(document).ready(function()
   {
    <?php if(isset($_SESSION['get_username'])): ?>
      function update_user_activity()
      {
        var action = 'update_time';
        $.ajax(
        {
            url: "./index.php",
            method: "POST",
            data: {action:action},
            success:function(data)
            {

            }
        });
      }
    setInterval(function()
    {
      update_user_activity()
    }, 3000);
  <?php endif; ?>
   })
 </script>


