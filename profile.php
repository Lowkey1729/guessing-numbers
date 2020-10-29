<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>Profile</title>
</head>
<?php
$email = $_SESSION['email'];
  global $db;
  $query = " SELECT * FROM user WHERE email=:email";
  $result = $db->prepare($query);
  $result->bindValue(':email', $email);
  $result->execute();
  $profile = $result->fetch();
  $result->closeCursor(); 

    $image = $_SESSION['image'];
    $image = ($_SESSION['image']!=null)?"./images/author/$image":"./images/author/avatar.png";
?>
<body>
    <?php include('view/navbar.php'); ?>
    <br><br><br><br>
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
      <h1 align="center">My Profile</h1>
      <div class="form-control">
        <h1 align="center"><img height="60px" width="60px" src="<?php echo $image; ?>"></h1>
        <div class="">
                <table border="1" class=" table table-bordered ">
                  <form action="." method="post" class="form-horizontal" >
                  <tr>
                    <th style=" font-size: 1em;">First Name</th>
                    <td>
                      <input class="form-control form-control-lg" type="text" name="first_name" value="<?php echo $profile['firstname']; ?>"></td>
                    </td>
                  </tr>
                  <tr>
                    <th style=" font-size: 1em;">Last name</th>
                    <td>
                      <input class="form-control form-control-lg" type="text" name="last_name" value="<?php echo $profile['lastname']; ?>"></td>
                    </td>
                  </tr>
                  <tr>
                  <th style=" font-size: 1em;">Mobile</th>
                    <td >
                      <input disabled=""  class="form-control form-control-lg" type="text" name="mobile" value="<?php echo $profile['mobile']; ?>"></td>
                  </tr>
                  <tr>
                    <th style=" font-size: 1em;">Email</th>
                    <td><input disabled  class="form-control form-control-lg" type="text" name="email" value="<?php echo $profile['email']; ?>"></td></td>
                  </tr>
                  <tr>
                    <th style=" font-size: 1em;">Joined</th>
                    <?php $joined = date('l, F d, Y \a\t g:i a', strtotime($profile['created_at'])); ?>
                    <td style="font-size: 1.2em;">
                      <?php echo $joined; ?>
                    </td>
                  </tr>
                  <tr>
                    <th style=" font-size: 1em;">Username</th>
                    <td>
                      <input class="form-control form-control-lg" type="text" name="username" value="<?php echo $profile['username']; ?>"></td>
                    </td>
                  </tr>
                  <tr>
                    <th style=" font-size: 1em;">Balance</th>
                    <td><input disabled  class="form-control form-control-lg" type="text" name="email" value="<?php echo '&#8358;'.number_format($profile['balance'],2); ?>"></td></td>
                  </tr>
                  <tr align="center">
                        <td colspan="2"><button type="submit" name="action" value="update_user" class="au-btn au-btn--block btn-primary m-b-20">Update</button></td>
                      </tr>
                    </form>
                </table>
      </div>
    </div>
  </div>
 </body>
 </html>
 <?php include('view/footer.php'); ?>
 