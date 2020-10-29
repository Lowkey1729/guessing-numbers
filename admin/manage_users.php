<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php  require_once('views/header.php'); ?>
<title>Manage Users|Guess~Right</title>
</head>
<?php
  global $db;
  $status = '';
  $query = " SELECT * FROM user WHERE status IS NULL ORDER BY id DESC";
  $result = $db->prepare($query);
  $result->bindValue(':status', $status);
  $result->execute();
  $users = $result->fetchAll();
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
      <h1 align="center" style="color: #fff; background: #111111;">***Manage Users***</h1>
      <hr>
      	<table  id="example1" class="table table-bordered table-striped" >
      		<thead>
      			<th>N</th>
      			<th>Name</th>
      			<th>Username</th>
      			<th>Email</th>
      			<th>Balance</th>
      			<th>Mobile</th>
      			<th>Created On </th>
      			<th>Last Updated</th>
            <th>Action</th>
      		</thead>
          <tbody>
            <?php foreach($users as $key=>$user): ?>
              <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $user['firstname']." ".$user['lastname']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo '&#8358;'.number_format($user['balance']); ?></td>
                <td><?php echo  $user['mobile']; ?></td>
                <td><?php echo date('Y, F d, l g:i a', strtotime($user['created_at'])) ; ?></td>
                <td><?php echo date('Y, F d, l g:i a', strtotime($user['updated_at'])) ; ?></td>
                <td>
                  <button class="btn btn-danger delete" data-id="<?php echo $user['id']; ?>">
                    <i class="fa fa-trash">Delete</i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
 </div>
</div>
<?php include('includes/new_users_modal.php'); ?>
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
    url: 'user_row.php',
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