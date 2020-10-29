<?php session_start(); ?>
<?php include('config.php'); ?>
<?php require_once('view/header.php'); ?>
<title>My Stakes</title>
</head>
<?php
    $id = $_SESSION['bet_id'];
    global $db;
    $query = " SELECT * FROM bets WHERE user_id = :id ORDER BY id DESC LIMIT 10";
    $result = $db->prepare($query);
    $result->bindValue(':id', $id);
    $result->execute();
    $stakes = $result->fetchAll();
    $result->closeCursor();

?>
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
     <div  class="content-wrapper">
      <div class="content">
      <table id="" class="table table-bordered table-striped" >
        <thead>
          <th>N</th>
          <th>Price</th>
          <th>Stake Time</th>   
        </thead>
        <tbody>
          <?php foreach($stakes as $key=>$stake): ?>
          <tr>
            <td style="color: black;"><?php echo $key+1; ?></td>
            <td style="color: black;"><?php echo $stake['price']; ?></td>
            <td style="color: black;"><?php echo date('Y, F d, l g:i a', strtotime($stake['EnterTime'])) ; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
       </div>
     </div>
 </body>
 </html>
 <?php include('view/footer.php'); ?>
 