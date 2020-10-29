<?php session_start(); ?>
<?php include('../config.php'); ?>
<?php include('../model/customer_db.php'); ?>
<?php
   global $db;
   $query = " SELECT Id FROM bets WHERE DATE(EnterTime) = CURDATE()";
   $result = $db->prepare($query);
   $result->execute();
   $count_today_stakers = $result->rowCount();

  global $db;
  $query = " SELECT price FROM bets ";
  $result = $db->prepare($query);
  $result->execute();
  $get_total_prices = $result->fetchAll();
  $counts = $result->rowCount();
  $result->closeCursor();
   $total_price = 0;
  foreach($get_total_prices as $get_total_price)
  {
    $total_price = $get_total_price['price'] + $total_price;
  }

  global $db;
  $query = " SELECT Id FROM bets WHERE DATE(EnterTime) >= (DATE(NOW())- INTERVAL 7 DAY)";
  $result = $db->prepare($query);
  $result->execute();
  $count_last_seven_days_stakers = $result->rowCount();
  $result->closeCursor();

  global $db;
  $query = " SELECT Id FROM bets";
  $result = $db->prepare($query);
  $result->execute();
  $count_total_stakers = $result->rowCount();
  $result->closeCursor();

  global $db;
  $query = " SELECT id FROM user  ";
  $result = $db->prepare($query);
  $result->execute();
  $count_users = $result->rowCount();
  $result->closeCursor();
?>

<!-- Chart Data -->
<?php
  $days = array();
  $onlines = array();
  $online_offs = array();
  for ($m=6; $m>=0 ; $m--)
  { 
    try
    {
      date_default_timezone_set("Africa/Lagos");
        $day =  date('i',strtotime("-$m minutes")); 
        $status = 'ON';
      global $db;
      $query = " SELECT * FROM user_online WHERE (MINUTE(last_activity)>=:month) AND status =:status";
      $result = $db->prepare($query);
      $result->bindValue(':month', $day);
      $result->bindValue(':status', $status);
      $result->execute();
      $online = $result->rowCount();
      array_push($onlines, $online);
      $online_off = $count_users - $online;
      array_push($online_offs, $online_off);
      $result->closeCursor();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }

    //$num = str_pad( $m, 0, 0, STR_PAD_LEFT );
     $day =   date('h:i:a',strtotime(-$m."minutes")); 
       array_push($days, $day);
   
    }
      $days = json_encode($days);
      $onlines = json_encode($onlines);
      $online_offs = json_encode($online_offs);
        $online_users = $online;

$offline = $count_users- $online_users;
 //calculating percentage of users online and offline
 $value_1 = (float) $online_users;
 $value_2 = (float) $offline;
 $total_v = (float) ($offline + $online_users);

 $perc_online = ($value_1/$total_v)*100;
 $perc_offline = ($value_2/$total_v)*100;

 $perc_online = round($perc_online,2);
 $perc_offline = round($perc_offline,2);  


?>


<?php if(strlen($_SESSION['get_username'])==0): header("Location: ../home.php"); ?>
  <?php else: ?>
<?php  require_once('views/header.php'); ?>
<title>Dashboard| AMS</title>
</head>
<?php include('includes/sidebar.php'); ?>
<?php include('includes/header_dashboard.php'); ?>
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
    <div class="row">
      <div class="col-sm-3 col-lg-3 ">
        <div class="overview-item overview-item--c4">
          <div class="overview_inner">
            <div class="overview-box clearfix">
              <div class="icon">
                <i class="zmdi zmdi-reddit" style="color: black;"></i>
                <h1 align="center" style="color: white;"><?php echo $count_today_stakers; ?></h1>
              </div>
              <hr>
              <div class="text">
                <span style="font-size: 1em;"> Today's Stakes</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-3 col-lg-3 ">
        <div class="overview-item overview-item--c4">
          <div class="overview_inner">
            <div class="overview-box clearfix">
              <div class="icon">
                <i class="zmdi zmdi-code-smartphone" style="color: black;"></i><br>
                <h1 align="center" style="color: white;"><?php echo $count_last_seven_days_stakers; ?></h1>
              </div>
              <hr>
              <div class="text">
                <span style="font-size: 1em;">  Last Seven Days'  Stakes</span>
              </div>
            </div>
          </div>
        </div>
      </div>  

      <div class="col-sm-3 col-lg-3 ">
        <div class="overview-item overview-item--c4">
          <div class="overview_inner">
            <div class="overview-box clearfix">
              <div class="icon">
                <i class="zmdi zmdi-receipt" style="color: black;"></i>
                <h1 align="center" style="color: white; "><?php echo '&#8358;'.number_format($total_price); ?></h1>
              </div>
              <hr>
              <div class="text">
                <span style="font-size: 1em;">Total amount realised</span>
              </div>
            </div>
          </div>
        </div>
      </div>  

      <div class="col-sm-3 col-lg-3 ">
        <div class="overview-item overview-item--c4">
          <div class="overview_inner">
            <div class="overview-box clearfix">
              <div class="icon">
                <i class="zmdi zmdi-accounts" style="color: black;"></i>
                <h1 style="color: white;"><?php echo $count_total_stakers; ?></h1>
              </div>
              <hr>
              <div class="text">
                <span style="font-size: 1em;"> Total Stakes Till Date</span>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
<!-- 
     <div class="col-sm-3  ">
        <div class="overview-item overview-item--c4">
          <div class="overview_inner">
            <div class="overview-box clearfix">
              <div class="icon">
                <i class="zmdi zmdi-accounts" style="color: black;"></i>
                <h1 style="color: white;"><?php echo $count_users; ?></h1>
              </div>
              <hr>
              <div class="text">
                <span style="font-size: 1em;"> Total Users</span>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div> -->



    <!-- User activity statistics -->
                          <div class="card card-default" id="linechart">
                            <div class="row no-gutters">
                              <div class="col-xl-8">
                                <div class="border-right">
                                  <div class="card-header justify-content-between py-5">
                                    <h2>User Activity</h2>
                                    <h2 align="center">Users(<?php echo $count_users; ?>)</h2>
                                    <div class="date-range-report ">
                                      <span></span>
                                    </div>
                                  </div>
                                  <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-xl-start border-bottom" role="tablist" style="background: #fff;">
                                    <li class="nav-item">
                                      <a class="nav-link active pb-md-0" data-toggle="tab" href="#user" role="tab" aria-controls="" aria-selected="true">
                                        <span class="type-name">ONLINE</span>
                                        <h4 class="d-inline-block mr-2 mb-3"><?php echo $online_users; ?></h4>
                                        <span class="text-success "><?php echo $perc_online. '%'; ?>
                                          <i class="mdi mdi-arrow-up-bold"></i>
                                        </span>
                                      </a>
                                    </li>
                                   <!--  <li class="nav-item">
                                      <a class="nav-link pb-md-0" data-toggle="tab" href="#session" role="tab" aria-controls="" aria-selected="false">
                                        <span class="type-name">Sessions</span>
                                        <h4 class="d-inline-block mr-2 mb-3">638</h4>
                                        <span class="text-success ">20%
                                          <i class="mdi mdi-arrow-up-bold"></i>
                                        </span>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link pb-md-0" data-toggle="tab" href="#bounce" role="tab" aria-controls="" aria-selected="false">
                                        <span class="type-name">Bounce Rate</span>
                                        <h4 class="d-inline-block mr-2 mb-3">36.9%</h4>
                                        <span class="text-danger ">7%
                                          <i class="mdi mdi-arrow-down-bold"></i>
                                        </span>
                                      </a>
                                    </li> -->
                                    <li class="nav-item">
                                      <a class="nav-link pb-md-0" data-toggle="tab" href="#session-duration" role="tab" aria-controls="" aria-selected="false">
                                        <span class="type-name">OFFLINE</span>
                                        <h4 class="d-inline-block mr-2 mb-3"><?php echo $offline; ?></h4>
                                        <span class="text-success "><?php echo $perc_offline.'%'; ?>
                                          <i class="mdi mdi-arrow-up-bold"></i>
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
                                  <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="home-tab" style="background: #fff;">
                                          <canvas id="activity" class="linechart"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer d-flex flex-wrap bg-white border-top">
                                    <a href="#" class="text-uppercase py-3"><h3>Audience Overview</h3></a>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-4">
                                <div data-scroll-height="642">
                                  <div class="card-header pt-5 flex-column align-items-start">
                                    <h4 class="text-dark mb-4">Current Users</h4>
                                    <div class="mb-3">
                                      <p class="my-2">Ave Page views per minute</p>
                                      <h4></h4>
                                    </div>
                                  </div>
                                  <div class="border-bottom"></div>
                                  <div class="card-body" style="background: #fff;">
                                    <canvas id="currentUser" class="chartjs"></canvas>
                                  </div>
                                  <div class="card-footer d-flex flex-wrap bg-white border-top">
                                    <a href="#" class="text-uppercase py-3"><h3>Audience Overview</h3></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          

        </div>
      </div>
  </div>
</div>
<?php include('views/footer.php'); ?>
</body>
</html>
<?php endif; ?>
<script>
$(function(){

   /*======== 16. ANALYTICS - ACTIVITY CHART ========*/
    var activity = document.getElementById("activity");
    if (activity !== null) {
      var activityData = [
        {
          
          first: <?php echo $onlines; ?>,
          second: <?php echo $online_offs; ?>
        },
        {
          first: [0, 65, 77, 33, 49, 100, 100],
          second: [88, 33, 20, 44, 111, 140, 77]
        },
        {
          first: [0, 40, 77, 55, 33, 116, 50],
          second: [55, 32, 20, 55, 111, 134, 66]
        },
        {
          first: [0, 44, 22, 77, 33, 151, 99],
          second: [60, 32, 120, 55, 19, 134, 88]
        }
      ];

      var config = {
        // The type of chart we want to create
        type: "line",
        // The data for our dataset
        data: {
          labels: <?php echo $days; ?>,
          datasets: [
            {
              label: "Active",
              backgroundColor: "transparent",
              borderColor: "rgb(82, 136, 255)",
              data: activityData[0].first,
              lineTension: 0,
              pointRadius: 5,
              pointBackgroundColor: "rgba(255,255,255,1)",
              pointHoverBackgroundColor: "rgba(255,255,255,1)",
              pointBorderWidth: 2,
              pointHoverRadius: 7,
              pointHoverBorderWidth: 1
            },
            {
              label: "Inactive",
              backgroundColor: "transparent",
              borderColor: "rgb(255, 199, 15)",
              data: activityData[0].second,
              lineTension: 0,
              borderDash: [10, 5],
              borderWidth: 1,
              pointRadius: 5,
              pointBackgroundColor: "rgba(255,255,255,1)",
              pointHoverBackgroundColor: "rgba(255,255,255,1)",
              pointBorderWidth: 2,
              pointHoverRadius: 7,
              pointHoverBorderWidth: 1
            }
          ]
        },
        // Configuration options go here
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [
              {
                gridLines: {
                  display: false,
                },
                ticks: {
                  fontColor: "#8a909d", // this here
                },
              }
            ],
            yAxes: [
              {
                gridLines: {
                  fontColor: "#8a909d",
                  fontFamily: "Roboto, sans-serif",
                  display: true,
                  color: "#eee",
                  zeroLineColor: "#eee"
                },
                ticks: {
                  // callback: function(tick, index, array) {
                  //   return (index % 2) ? "" : tick;
                  // }
                  stepSize: 50,
                  fontColor: "#8a909d",
                  fontFamily: "Roboto, sans-serif"
                }
              }
            ]
          },
          tooltips: {
            mode: "index",
            intersect: false,
            titleFontColor: "#888",
            bodyFontColor: "#555",
            titleFontSize: 12,
            bodyFontSize: 15,
            backgroundColor: "rgba(256,256,256,0.95)",
            displayColors: true,
            xPadding: 10,
            yPadding: 7,
            borderColor: "rgba(220, 220, 220, 0.9)",
            borderWidth: 2,
            caretSize: 6,
            caretPadding: 5
          }
        }
      };

      var ctx = document.getElementById("activity").getContext("2d");
      var myLine = new Chart(ctx, config);

      var items = document.querySelectorAll("#user-activity .nav-tabs .nav-item");
      items.forEach(function (item, index) {
        item.addEventListener("click", function () {
          config.data.datasets[0].data = activityData[index].first;
          config.data.datasets[1].data = activityData[index].second;
          myLine.update();
        });
      });
    }

});  


</script>