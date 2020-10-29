<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Bets</title>
</head>
<body>
    <?php include('view/navbar.php'); ?>
    <br><br><br><br>
    <div class="container">
        <?php
        if(isset($_SESSION['bet_error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Oops!</h4>
              ".$_SESSION['bet_error']."
            </div>
          ";
          unset($_SESSION['bet_error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Sucess!!!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <?php if(isset($_SESSION['win_num'])): ?>
        <div class="col-xl-12" style="color: #fff; background: #111111;">
          <h1 align="center"><?php echo 'Correct Guess: '. $_SESSION['to_guess'];?></h1>
        <?php unset($_SESSION['to_guess']); ?>
        </div>
      <?php unset($_SESSION['win_num']); ?>
      <?php endif;?>

    	<h1 align="center">Stakes</h1>
    	<div class="row">
    		<div style="" class="col-xl-3 box">
    			<h3> ONE LEVEL STAKE </h3>
    			<hr>
    			<p>This level of stake  requires a chance of 
    				playing <b>FOUR TIMES WITH SIX BOXES TO FILL</b> after placing your stake with the price below.<hr>
            <b>Expected Cashout: &#8358;5,000</b>
    			</p>
    			<i  class="zmdi zmdi-receipt size"></i>
    				<hr>
    			<button class="btn btn-danger size hundred ">&#8358;100</button>
    		</div>
    		<div class="col-xl-3 box">
    			<h3> TWO LEVEL STAKE</h3>
    			<hr>
    			<p>
    				This level of stake  requires a chance of
    				playing <b>SIX TIMES WITH FIVE BOXES TO FILL</b> after placing your stake with the price below<hr>
               <b>Expected Cashout: &#8358;10,000</b>
    			</p>
    			<i  class="zmdi zmdi-receipt size"></i>
    			<hr>
    			<button class="btn btn-danger size t_hundred">&#8358;200</button>
    		</div>
    		<div class="col-xl-3 box">
    			<h3>THREE LEVEL STAKE</h3>
    			<hr>
    			<p>
    				This level of stake  requires a chance of
    				playing <b>TWO TIMES WITH THREE BOXES TO FILL</b> after placing your stake with the price below<hr>
               <b>Expected Cashout: &#8358;30,000</b>
    			</p>
    			<i  class="zmdi zmdi-receipt size"></i>
    			<hr>
    			<button class="btn btn-danger size f_hundred">&#8358;500</button>
    		</div>
    		<div class="col-xl-3 box">
    			<h3>FOUR LEVEL STAKE</h3>
    			<hr>
    			<p>
    				This level of stake  requires a chance of
    				playing <b>FOUR TIMES WITH THREE BOXES TO FILL</b> after placing your stake with the price below<hr>
               <b>Expexcted Cashout: &#8358;60,000</b>
    			</p>
    			<i  class="zmdi zmdi-receipt size"></i>
    			<hr>
    			<button class="btn btn-danger size thousand">&#8358;1000</button>
    		</div>
    	</div>
    </div>
    <?php include('includes/bet_modal.php'); ?>
</body>
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