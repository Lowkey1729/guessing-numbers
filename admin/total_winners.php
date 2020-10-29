<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php  require_once('views/header.php'); ?>
<?php $user = new Users(); ?>
<title>Total Winners|Guess~Right</title>
</head>
<?php
  global $db;
  $status = '';
  $query = " SELECT * FROM userwins  ORDER BY id DESC";
  $result = $db->prepare($query);
  $result->execute();
  $wins = $result->fetchAll();
  $result->closeCursor();


?>
<?php include('includes/sidebar.php'); ?>
<?php include('includes/header_dashboard.php');?>
<div class="content-wrapper">
  <div class="content">
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
      <h1 align="center" style="color: #fff; background: #111111;">***Total Winners***</h1>
      <hr>
      <table  id="example1" class="table table-bordered table-striped" >
          <thead>
            <th>N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Stake Price</th>
            <th>Win Credit</th>
            <th> Date </th>
          </thead>
          <tbody>
            <?php foreach($wins as $key=>$win): ?>
              <?php $detail = $user->get_details_by_id($win['user_id']); ?>
              <tr>
                <th><?php echo $key+1; ?></th>
                <th><?php echo $detail['firstname']. " ".$detail['lastname']; ?></th>
                <th><?php echo $detail['email']; ?></th>
                <th><?php echo $detail['username']; ?></th>
                <th><?php echo '&#8358;'.number_format($win['price']) ; ?></th>
                <th><?php echo '&#8358;'.number_format($win['won_credits']); ?></th>
                <th><?php echo  date('Y, F d, l g:i a', strtotime($win['WinDate'])) ; ?></th>
              </tr>
            <?php endforeach; ?>
          </tbody>
       </div>
</div>
<?php include('views/footer.php'); ?>
</body>
</html>
