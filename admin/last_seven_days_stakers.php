<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php  require_once('views/header.php'); ?>
<title>Last Seven Days Stakers</title>
</head>
<?php
$user = new Users();
	global $db;
	$query = " SELECT * FROM bets ORDER BY id DESC";
	$result = $db->prepare($query);
	$result->execute();
	$bets = $result->fetchAll();
	$id = $db->lastInsertId();
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
       <h1 style="color: #fff; background: #111111;" align="center"> ***Last Seven Days Stakers*** </h1>
       <hr>
      <table  id="example1" class="table table-bordered table-striped" >											
        <thead>
      			<th>N</th>
      			<th>Email</th>
      			<th>Price</th>
      			<th>Stake Time</th>
      			<th>Action</th>
      		  </thead>
      		  <tbody>
      		  	<?php foreach($bets As $key=>$bet): ?>
      		  	<tr>
      		  		<td><?php echo $key+1; ?></td>
      		  		<td><?php echo $user->get_email($bet['user_id']); ?></td>
      		  		<td><?php echo $bet['price'] ?></td>
      		  		<td><?php echo date('Y, F d, l g:i a', strtotime($bet['EnterTime'])) ; ?></td>
      		  		<td>
      		  			 <button class="btn btn-danger delete" data-id="<?php echo $bet['user_id']; ?>">
                    <i class="fa fa-trash">Delete</i>
                  </button>
      		  		</td>
      		  	</tr>
      		  <?php endforeach; ?>
      		  </tbody>
   </table>
    </div>
</div>
<?php include('includes/last_seven.php'); ?>
<?php include('views/footer.php'); ?>
</body>
</html>
<script>
  $(function(){
      $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'staker_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.prodid').val(response.user_id);
      $('.name').html(response.email);
     
      getCategory();
    }
  });
}


</script>