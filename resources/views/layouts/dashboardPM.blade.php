<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('page_title') | Alcel Construction</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

  <!-- Custom Theme Style -->
  <link href="../build/css/construction.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bill.css">
  
  <style>
  .button {
    display: inline-block;
    padding: 5px 13px;
    font-size: 15px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    color: #fff;
    background-color: #4CAF50;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px #999;
    float:center;
  }

  .button:hover {background-color: #3e8e41;
    color: #fff;
  }

  .button:active {
    background-color: #3e8e41;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
    color: #fff;
  }
  .custom-file-upload-hidden {
    display: none;
    visibility: hidden;
    position: absolute;
    left: -9999px;
  }
  .custom-file-upload {
    display: block;
    width: auto;
    font-size: 16px;
    margin-top: 30px;
    //border: 1px solid #ccc;
    label {
      display: block;
      margin-bottom: 5px;
    }
  }

/* This only works with JavaScript, 
if it's not present, don't show loader *
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/Preloader_3.gif) center no-repeat #fff;
  }/*loader*/
</style>

<script>  
  // Wait for window load
  //$(window).load(function() {
    // Animate loader off screen
  //  $(".se-pre-con").fadeOut("slow");;
  //});
</script>
@yield('page_style')

</head>

<body class="nav-md">
  <div class="se-pre-con"></div>
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" >
            <a href="{{ url ('indexProjectManager') }}" class="site_title" style="text-shadow:5px 5px 5px #222;"><img src="images/logoheader.png" alt="" style="width:100%; height:100%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></span></a>
          </div>

          <div class="clearfix"></div>


          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Alcel Construction Inc.</h3>
              <ul class="nav side-menu">
                <li>
                  <a href="{{ url ('indexProjectManager') }}"><i class="fa fa-dashboard" style="margin-left:-55px; margin-bottom: 3px;"></i><br>Dashboard </a>
                </li>
                <li>
                  <a href="{{ url ('PM_project') }}"><i class="fa fa-cubes" style="margin-left:-75px; margin-bottom: 3px;"></i> <br>Project </a>
                </li>
                <li>
                  <a><i class="fa fa-pencil-square-o" style="margin-left:-40px; margin-bottom: 3px;"></i> <br> &nbsp; &nbsp; &nbsp; &nbsp;Milestone & Task <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                   <li><a href="{{ url ('PM_task') }}">Project Tasks</a></li>
                   <li><a href="{{ url ('PM_phase') }}">Milestones</a></li>
                 </ul>
               </li>
               <li>
                <a href="{{ url ('PM_calendar') }}"><i class="fa fa-calendar" style="margin-left:-40px; margin-bottom: 3px;"></i> <br>Schedule</a>
              </li>
            </ul>
          </div>
          

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          
          <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url ('loginpm') }}" style="width:100%; height:50px;">
            <span class="glyphicon glyphicon-off" aria-hidden="true" style="margin-top:10px;"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @foreach($empPic as $empPic)
                <img src="images/profile/{{$empPic->emp_image}}" alt="">{{$empPic->emp_first_name}} {{$empPic->emp_last_name}}
                <span class=" fa fa-angle-down"></span>
              @endforeach                  </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="{{ url ('profilePm') }}"> Profile</a></li>
                <li><a href="/PM_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
              </ul>
            </li>
            <li role="presentation" class="dropdown">
              <a id="notif" data-id="{{$id}}" style="cursor:pointer" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <img src="/images/notification-flat.png" class="w3-animate-top" style="width:2.2em; margin-top:-2px">
                <?php if($notifcount > 0) {
                  echo "<span class='badge bg-green w3-animate-zoom' id='notifcount'>". $notifcount ."</span>";
                } ?>
              </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                @foreach($notif as $notif)
                <li>
                  <a href="{{$notif->notif_pm_url}}">
                    <span class="image"><img src="images/profile/{{$notif->emp_image}}" alt="Profile Image" /></span>
                    <span>
                      <strong><span>{{$notif->emp_first_name}} {{$notif->emp_last_name}}</span></strong>
                      <span class="time" style="right:0px;margin-top:-20px">
                       <?php
                       $time = 0;
                       $notifdate = date_create($notif->notif_date);
                       $nowdate = date_create("now");
                       
                       $interval = date_diff($nowdate, $notifdate);
                       
                       $time = $interval->format('%y');
                       
                       if($time > 0) {
                         echo $time." years ago";
                       } else {
                         $time = $interval->format('%m');
                         if($time > 0 && $time < 12) {
                          echo $time." months ago";
                        } else {
                          $time = $interval->format('%d');
                          if($time > 0 && $time < 31) {
                           echo $time." days ago";
                         } else {
                           $time = $interval->format('%h');
                           if($time > 0 && $time < 12) {
                            echo $time." hours ago";
                          } else {
                            $time = $interval->format('%i');
                            if($time > 0 && $time < 60) {
                             echo $time." mins ago";
                           } else {
                             echo "a few moment ago";
                           }
                         }
                       }
                     }
                   }
                   ?>
                   <img src="/images/icon/{{$notif->notif_icon}}" style="height:45px; margin-top:20px; margin-right:5px;">
                 </span>
               </span>
               <span class="message" style="width:90%">
                {{$notif->notif_description}}
              </span>
            </a>
          </li>
          @endforeach
          <li>
            <div class="text-center">
              <a href="/PM_notification">
                <strong>See All Alerts</strong>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" style="height: 660px;">
  @yield('page_content')
</div>
<!-- /page content -->

<footer>
  <div class="pull-right">
    Alcel Construction Inc Admin by <a href="https://www.facebook.com">Shithi Inc.</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer -->
</div>

<script>
  $('#notif').click(function () {
    $.ajax({
      type : "get",
      url : '/updatenotif',
      data : {"id" : $(this).data('id')},
      dataType: "json",
      success: function(response) {
        
        $("#notifcount").hide();
      }
    });
  });
</script>

</body>
</html>