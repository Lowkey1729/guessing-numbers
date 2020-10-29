<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php  require_once('views/header.php'); ?>
<title>Create Posts| Guess~Right</title>
</head>
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
      <h1 style="color: #fff; background: #111111;" align="center"> ***Create Posts*** </h1>
      <hr>
      <div class="container">
        <form  enctype="multipart/form-data" method="post" action="index.php">
        <textarea class="form-control" required="" name="text"  id="editor1"></textarea>
        <hr>

          <button class="au-btn au-btn--block btn-success m-b-20" type="submit" name="action" value="create_post">Create Post</button>
        </form>
      </div>

  </div>
</div>
<?php include('views/footer.php'); ?>

</body>
</html>
<!-- initialize ckeditor -->
<script>
  $(function(){
    //Initialize Select2 Elements

    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>

