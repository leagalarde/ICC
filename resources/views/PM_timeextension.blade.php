<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Time Extension | Alcel Construction</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
	
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
    <!-- FullCalendar -->
    <link href="../vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
	<script src='../moment.min.js'></script>
	<script src='../jquery.min.js'></script>
	<script src='../fullcalendar.min.js'></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/construction.css" rel="stylesheet">
	
  </head>

 <body class="nav-md">
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
				      <a><i class="fa fa-calendar" style="margin-left:-40px; margin-bottom: 3px;"></i> <br> &nbsp; &nbsp; &nbsp; &nbsp; Schedule <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
                         <li><a href="{{ url ('PM_calendar') }}">Calendar</a></li>
						 <li><a href="{{ url ('PM_timeextension') }}">Time Extension</a></li>
                    </ul>
				  </li>
                </ul>
              </div>
             

            </div>
            <!-- /sidebar menu -->

             <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="/PM_logout" style="width:100%; height:50px;">
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

              <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @php $emp1 = $emp @endphp
						@foreach($emp1 as $emp1)
							<img src="images/profile/{{$emp1->emp_image}}" alt="" >{{$emp1->emp_first_name}} {{$emp1->emp_last_name}}
							<span class=" fa fa-angle-down"></span>
						@endforeach
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.html"> Profile</a></li>
                    <li><a href="/PM_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

				<li role="presentation" class="dropdown">
                  <a id="notif" data-id="{{$id}}" style="cursor:pointer" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <img src="/images/notification-flat.png" style="width:2.2em; margin-top:-2px">
					<?php if($notifcount > 0) {
						echo "<span class='badge bg-green' id='notifcount'>". $notifcount ."</span>";
					} ?>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
				  @foreach($notif as $notif)
                    <li>
                      <a href="{{$notif->notif_url}}">
                        <span class="image"><img src="images/profile/{{$notif->emp_image}}" alt="Profile Image" /></span>
                        <span>
                          <strong><span>{{$notif->emp_first_name}} {{$notif->emp_last_name}}</span></strong>
                          <span class="time" style="right:0px; margin-top:-20px;">
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
							<img src="/images/icon/{{$notif->notif_icon}}" style="height:50px; margin-top:13px; margin-right:5px;">
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
                        <a href="/notification">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
		
         <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel" style="height: 100%;">
                  <div class="x_title" style="height: 12%;">
                    <h1>Calendar</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

					<div id='fullcal'></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		</div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
 
 <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- FullCalendar -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>

	<script>
		$('#notif').click(function () {
		$("#notifcount").hide();
		$.ajax
        ({
            type : "get",
            url : '/updatenotif',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
            }
        });
	});
	</script>
  </body>
</html>