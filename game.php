<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Guess</title>
</head>
<body style="background-image: url('static/new_grass.jpeg');">
    <?php include('view/navbar.php'); ?>
    <br><br><br><br>
   <?php
        if(isset($_SESSION['bet_error']))
        {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Oops!!!</h4>
              ".$_SESSION['bet_error']."
            </div>
          ";
          unset($_SESSION['bet_error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Congratulations!!!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

      <!-- one hundred naira game -->
      <?php if(($_SESSION['chances']>0) && ($_SESSION['price'] == 100)): ?>
     <div class="container">
      <?php
      
      $to_guess = $_SESSION['to_guess']; 
      ?> 
      <h1><?php echo $to_guess; ?></h1>
      <div class="col-xl-12">
        <h3 align="center"> Notice!!!</h3>
        <hr>
        <ol>
      <li><strong>You are staking with &#8358;100</strong> </li>
          <li><strong>Expected cashout is &#8358;<?php echo number_format(5000,2); ?></strong></li>
          <li><strong>You have Four Chances to exhaust</strong></li>
          <li><strong>After Exhausting your Four Chances, You won't be able to play again.</strong></li>
          <li><strong>Enjoy!!!</strong></li>
        </ol>
      </div>
      <div class="card">
        <!-- Display the countdown timer in an element -->
<h1 align="center" style="color: #fff; background: #111111;" id="demo"></h1>
        <h2 align="center"> ***Let's Play***</h2>
        <hr>
        <h4 align="center">Choose numbers ranging from 0-9 for each box. </h4>
        <!-- input 1 -->
        <div class="form-control">
           <form class="form-horizontal" action="." method="post">
            <input type="hidden" name="shuffle" value="<?php echo $to_guess; ?>">
          <div class="row">
          <div class="col-sm-3 col-lg-3"  style="margin-top: 1em;">
            <input type="text" placeholder="1st Digit" name="input_1" class="form-control form-control-sm">
          </div>
          <!-- input 2 -->
          <div class="col-sm-3 col-lg-3"  style="margin-top: 1em;">
            <input type="text" name="input_2" placeholder="2nd Digit" class="form-control form-control-sm">
          </div>
          <!-- input 3 -->
          <div class="col-sm-3 col-lg-3"  style="margin-top: 1em;">
            <input type="text" name="input_3" placeholder="3rd Digit" class="form-control form-control-sm">
          </div>
          <!-- input 4 -->
          <div class="col-sm-3 col-lg-3"  style="margin-top: 1em;">
            <input type="text" name="input_4" placeholder="4th Digit" class="form-control form-control-sm">
          </div>
           <!-- input 5 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_5" placeholder="5th Digit" class="form-control form-control-sm">
          </div>
           <!-- input 6 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_6" placeholder="6th Digit" class="form-control form-control-sm">
          </div>
        </div><br>
         <button name="action" value="guess_result_hundred" class="au-btn au-btn--block btn-primary m-b-20">Submit</button>
      </div>
    </form>
      </div>
      </div>
       </div>

       <!-- two hundred naira game -->
       <?php elseif(($_SESSION['chances']>0) && ($_SESSION['price'] == 200)):?>
       <div class="container">
        <?php
         
          $to_guess = $_SESSION['to_guess'];
      ?>
      <h1><?php echo $to_guess; ?></h1>
      <div class="col-xl-12">
        <h3 align="center"> Notice!!!</h3>
        <hr>
        <ol>
          <li><strong>You are staking with &#8358;200</strong> </li>
          <li><strong>Expected cashout is &#8358;<?php echo number_format(10000,2); ?></strong></li>
          <li><strong>You have Six Chances to exhaust</strong></li>
          <li><strong>After Exhausting your Six Chances, You won't be able to play again.</strong></li>
          <li><strong>Enjoy!!!</strong></li>
        </ol>
      </div>
      <div class="card">
               <!-- Display the countdown timer in an element -->
<h1 align="center" style="color: #fff; background: #111111;" id="demo"></h1>

        <h2 align="center"> ***Let's Play***</h2>
        <hr>
        <h4 align="center">Choose numbers ranging from 0-9 for each box. </h4>
        <!-- input 1 -->
        <div class="form-control">
           <form class="form-horizontal" action="." method="post">
            <input type="hidden" name="shuffle" value="<?php echo $to_guess; ?>">
          <div class="row">
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" placeholder="1st Digit" name="input_1" class="form-control form-control-sm">
          </div>
          <!-- input 2 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_2" placeholder="2nd Digit" class="form-control form-control-sm">
          </div>
          <!-- input 3 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_3" placeholder="3rd Digit" class="form-control form-control-sm">
          </div>
          <!-- input 4 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_4" placeholder="4th Digit" class="form-control form-control-sm">
          </div>
          <!-- input 5 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_5" placeholder="5th Digit" class="form-control form-control-sm">
          </div>
        </div><br>
         <button name="action" value="guess_result_t_hundred" class="au-btn au-btn--block btn-primary m-b-20">Submit</button>
      </div>
    </form>
      </div>
      </div>
       </div>

       <!-- five hundred naira game -->
       <?php elseif(($_SESSION['chances']>0) && ($_SESSION['price'] == 500)): ?> 
        <div class="container">
      <?php
         
          $to_guess = $_SESSION['to_guess'];
      ?>
      <h1><?php echo $to_guess; ?></h1>
      <div class="col-xl-12">
        <h3 align="center"> Notice!!!</h3>
        <hr>
        <ol>
          <li><strong>You are staking with &#8358;500</strong> </li>
          <li><strong>Expected cashout is &#8358;<?php echo number_format(30000,2); ?></strong></li>
          <li><strong>You have Two Chances to exhaust</strong></li>
          <li><strong>After Exhausting your Two Chances, You won't be able to play again.</strong></li>
          <li><strong>Enjoy!!!</strong></li>
        </ol>
      </div>
      <div class="card">
               <!-- Display the countdown timer in an element -->
<h1 align="center" style="color: #fff; background: #111111;" id="demo"></h1>
 
        <h2 align="center"> ***Let's Play***</h2>
        <hr>
        <h4 align="center">Choose numbers ranging from 0-9 for each box. </h4>
        <!-- input 1 -->
        <div class="form-control">
           <form class="form-horizontal" action="." method="post">
            <input type="hidden" name="shuffle" value="<?php echo $to_guess; ?>">
          <div class="row">
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" placeholder="1st Digit" name="input_1" class="form-control form-control-sm">
          </div>
          <!-- input 2 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_2" placeholder="2nd Digit" class="form-control form-control-sm">
          </div>
          <!-- input 3 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_3" placeholder="3rd Digit" class="form-control form-control-sm">
          </div>
        </div><br>
         <button name="action" value="guess_result_f_hundred" class="au-btn au-btn--block btn-primary m-b-20">Submit</button>
      </div>
    </form>
      </div>
      </div>
       </div> 


       <!-- one thousand naira game -->
           <?php elseif(($_SESSION['chances']>0) && ($_SESSION['price'] == 1000)):  ?>
                    <div class="container">
                        <?php
        
          $to_guess = $_SESSION['to_guess'];
           
      ?>
      <h1><?php echo $to_guess; ?></h1>
      <div class="col-xl-12">
        <h3 align="center"> Notice!!!</h3>
        <hr>
        <ol>
          <li><strong>You are staking with &#8358;1000</strong> </li>
          <li><strong>Expected cashout is &#8358;<?php echo number_format(60000,2); ?></strong></li>
          <li><strong>You have Four Chances to exhaust</strong></li>
          <li><strong>After Exhausting your Four Chances, You won't be able to play again.</strong></li>
          <li><strong>Enjoy!!!</strong></li>
        </ol>
      </div>
      <div class="card">
               <!-- Display the countdown timer in an element -->
<h1 align="center" style="color: #fff; background: #111111;" id="demo"></h1>
 
        <h2 align="center"> ***Let's Play***</h2>
        <hr>
        <h4 align="center">Choose numbers ranging from 0-9 for each box. </h4>
        <!-- input 1 -->
        <div class="form-control">
           <form class="form-horizontal" action="." method="post">
            <input type="hidden" name="shuffle" value="<?php echo $to_guess; ?>">
          <div class="row">
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" placeholder="1st Digit" name="input_1" class="form-control form-control-sm">
          </div>
          <!-- input 2 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_2" placeholder="2nd Digit" class="form-control form-control-sm">
          </div>
          <!-- input 3 -->
          <div class="col-sm-3 col-lg-3" style="margin-top: 1em;">
            <input type="text" name="input_3" placeholder="3rd Digit" class="form-control form-control-sm">
          </div>
        </div><br>
         <button name="action" value="guess_result_thousand" class="au-btn au-btn--block btn-primary m-b-20">Submit</button>
      </div>
    </form>
      </div>
      </div>
       </div> 
    <?php endif; ?>


      <?php 
        if($_SESSION['chances']==0 )
        {
          $_SESSION['bet_error'] = " Chances used up.";
          unset($_SESSION['chances']);
          header('location: bets.php');
        }
        elseif(!isset($_SESSION['chances']))
        {
          header('location: bets.php');
        }
    ?>
 </body>
 </html>
 <?php include('view/footer.php'); ?>
 <script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML =  hours + "hr: "
  + minutes + "min: " + seconds + "s";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

