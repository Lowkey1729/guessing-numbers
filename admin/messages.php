<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php  require_once('views/header.php'); ?>
<?php $user = new Users(); ?>
<title>Messages|Guess~Right</title>
</head>
<?php
  global $db;
  $status = '';
  $query = " SELECT * FROM sites  ORDER BY id DESC";
  $result = $db->prepare($query);
  $result->execute();
  $messages = $result->fetchAll();
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
      <h1 align="center" style="color: #fff; background: #111111;">***Messages***</h1>
      <hr>
      <div class="container">
        <div class="row">
           <?php foreach($messages as $key=>$message): ?>
          <div class="col-xl-12 box">
            <h4 align="center"><?php echo '('."Name:".$message['name']. " || "."Username:". $message['username']," || "."Email:".$message['email']." || "."Time:".date('Y, F d, l g:i a', strtotime($message['message_at'])).")"; ?></h4><hr>
            <p class="text"><?php echo $message['text']; ?></p>
            <button style="float: right;" class="btn btn-danger delete" data-id="<?php echo $message['id']; ?>"><span class="zmdi zmdi-delete"> Delete</span></button>
          </div>
             <?php endforeach; ?>
        </div>
      </div>
  </div>
</div>
<?php include('includes/message_modal.php'); ?>
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
    url: 'message_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.prodid').val(response.id);
      $('.name').html(response.email);
     
      getCategory();
    }
  });
}


</script>