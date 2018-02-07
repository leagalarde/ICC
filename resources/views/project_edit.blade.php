<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Edit Project | Alcel Construction</title>
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

  <!-- PNotify -->
  <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

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
  
  .editinvoice:hover {
  	color: #0000EE;
  }
  
   .editinvoice{
  	color: #6868f9;
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
    //$(".se-pre-con").fadeOut("slow");;
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
          					<a href="{{ url ('indexAdmin') }}" class="site_title" style="text-shadow:5px 5px 5px #222;"><img src="images/logoheader.png" alt="" style="width:100%; height:100%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></a>
        					</div>

        					<div class="clearfix"></div>

						<br />

				        <!-- sidebar menu -->
				        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
				         	 <div class="menu_section">
				            		<h3>Alcel Construction Inc.</h3>
				            		<ul class="nav side-menu">
				              		<li>
				                			<a href="{{ url ('indexAdmin') }}"><i class="fa fa-dashboard" ></i>Dashboard </a>
				              		</li>
					             	<li>
					               		 <a ><i class="fa fa-wrench" ></i>Maintenance<span class="fa fa-chevron-down"></span> </a>
					               		 <ul class="nav child_menu">
						                  	<li><a href="{{ url ('company') }}"> Client Company</a></li>
						                  	<li><a href="{{ url ('engineer') }}">Employee</a></li>
						                  	<li><a href="{{ url ('phase') }}">Phases</a></li>
						                  	<li><a href="{{ url ('tasks') }}">Tasks</a></li>
						                  	<li><a href="{{ url ('truck_category') }}">Truck Category</a></li>
					                		</ul>
					              </li>
				              	  <li>
				                		<a><i class="fa fa-cubes" ></i> Project Management<span class="fa fa-chevron-down"></span></a>
				                		<ul class="nav child_menu">
						                  <li><a href="{{ url ('project_add') }}">Add Project</a></li>
						                  <li>
										  		<a href="{{ url ('project') }}">Projects</a>
										  		<ul class="nav child_menu">
				                           			 <li ><a href="/project_edit">Edit Project</a></li>
				                       			 </ul>
										  </li>
						                  <li>
								  		  		<a>Contracts<span class="fa fa-chevron-down"></span></a>
												<ul class="nav child_menu">
				                           			 <li ><a a href="{{ url ('contract') }}">All Contracts</a></li>
				                           			 <li><a>Terminated</a></li>
				                       			 </ul>
								 		  </li>
				                		</ul>
				              	  </li>
				              		<li>
				               			<a><i class="fa fa-money" ></i> Billing<span class="fa fa-chevron-down"></span></a>
				               			<ul class="nav child_menu">
				                				<li><a href="{{ url ('project_financial') }}">Project Financial</a></li>
				              			</ul>
				            			</li>
				            			<li>
				              			<a ><i class="fa fa-truck" ></i>Inventory<span class="fa fa-chevron-down"></span> </a>
				              			<ul class="nav child_menu">
							                <li><a href="{{ url ('equipment_add') }}">Add Equipment</a></li>
							                <li><a href="{{ url ('equipment_dep') }}">Equipment deploy</a></li>
				              			</ul>
				            			</li>
				            			<li>
				              			<a ><i class="fa fa-file-pdf-o jumbo" ></i>Report<span class="fa fa-chevron-down"></span> </a>
				              			<ul class="nav child_menu">
							                <li><a href="{{ url ('monthly_report') }}">Project Monthly Report</a></li>
							                <li><a href="{{ url ('financial') }}">Financial</a></li>
							                <li><a href="{{ url ('equipment_util') }}">Equipment Utilization</a></li>
							             </ul>
							         </li>
						            <li>
						              <a ><i class="fa fa-question-circle-o jumbo"></i>Queries<span class="fa fa-chevron-down"></span></a>
						              <ul class="nav child_menu">
						                <li><a href="{{ url ('queryEmployee') }}">Employee</a></li>
                							<li><a href="{{ url ('queryClient') }}">Client Company</a></li>
						              </ul>
						            </li>
				          		</ul>
				        		</div>
				      </div>
				      <!-- /sidebar menu -->
				      <!-- /menu footer buttons -->
				      <div class="sidebar-footer hidden-small">
				        		<a data-toggle="tooltip" data-placement="top" title="Logout" href="/admin_logout" style="width:100%; height:50px;">
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
		            			@endforeach                  
							</a>
				            <ul class="dropdown-menu dropdown-usermenu pull-right">
				              	<li><a href="{{ url ('profileAdmin') }}"> Profile</a></li>
				             	<li><a href="/admin_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
				                <a href="{{$notif->notif_url}}">
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
				            <a href="/notification">
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
	<div class="right_col" role="main" style="">
		<div class="">
			<div class="clearfix"></div>
			
			<div class="col-md-12 col-sm-12 col-xs-24">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Project <small>Edit</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="project-tab" role="tab" data-toggle="tab" aria-expanded="true">General</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="client-tab" data-toggle="tab" aria-expanded="false">Client Information</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="taskmilestone-tab" data-toggle="tab" aria-expanded="false">Tasks & Milestones</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="equipment-tab" data-toggle="tab" aria-expanded="false">Equipment</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content5" role="tab" id="financial-tab" data-toggle="tab" aria-expanded="false">Financial</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
					  		<!-- Project Tab -->
					  		<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="project-tab">
						
                        			<div class="col-md-8 col-sm-8 col-xs-16">
									<div class="col-md-12 col-sm-12 col-xs-24">
										<div class="x_panel">
											<div class="x_title">
												<h2 style="font-size: 2em;">Project Description</h2>
												<div class="clearfix"></div>
											</div>
											<div class="x_content">
													<form method="post" class="form-horizontal form-label-left input_mask" action="/editproject" data-parsley-validate>
													{{csrf_field()}}
													@foreach($proj as $proj)
													<div class="col-md-12 col-sm-12 col-xs-24".>

															<div class="col-md-8 col-sm-8 col-xs-16 form-group has-feedback" style="margin-top:2%;">
																<input value="{{$proj->pi_title}}" type="text" class="form-control has-feedback-left" id="project-name" name="project-name" placeholder="Project Name" required>
																<span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
															</div>

															<div class="col-md-4 col-sm-4 col-xs-8 form-group has-feedback" style="margin-top:2%;">
																<input value="{{$proj->proj_no}}" style="text-align: right;" type="text" id="project-id" class="form-control col-md-7 col-xs-12" name="project-id" placeholder="1"  readonly>
																<span class=" form-control-feedback left" aria-hidden="true" style="color:#000; margin-top: 5px;">ID</span>
															</div>

															<div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top:2%;">
																<label>Project Manager</label>
																<div>
																	<select class="form-control" required id="project-manager" name="project-manager">
																		<option value="default" disabled selected>Select Project Manager</option>
																			@foreach($PM as $PM)
																			<option value="{{$PM->emp_id}}" @if ($proj->emp_id==$PM->emp_id) selected @else @endif >{{$PM->emp_first_name}} {{$PM->emp_last_name}} </option>
																			@endforeach
																	</select>
																</div>
															</div>

															<div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top:2%;">
																<label>Start & End Date</label>
																<fieldset>
																<div class="control-group">
																	<div class="controls">
																		<div class="input-prepend input-group">
																			<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
																			<input readonly onchange="sync()" type="text" name="reservation" id="reservation" class="form-control" value="{{date('m/d/Y', strtotime ($proj->proj_start_date))}} - {{date('m/d/Y', strtotime ($proj->proj_end_date))}}" />
																		</div>
																	</div>
																</div>
																</fieldset>
																<!--for inside transaction-->
																<input type="hidden" id="start" name="start" value="{{$proj->proj_start_date}}" >
																<input type="hidden" id="end" name="end" value="{{$proj->proj_end_date}}">
																<input type="hidden" value="{{$proj->ci_desc}}" id="contype">
																<!--//for inside transacction-->
															</div>

															<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="floor-nono" style="margin-top: 3px;">
																<label> Number of Floor/s</label>
																<input type="text" value="{{$proj->pi_floor_no}}"  class="form-control has-feedback-left" name="floor-no" id="floor-no" placeholder="No of Floor/s" required="required" style="background-color: #fff">
																<span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
															</div>

															<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="floor-areaa" style="margin-top: 3px;">
																<label>Floor Area  (sq.m.)</label>
																<input type="text"value="{{$proj->pi_floor_area}}"  class="form-control has-feedback-left" name="floor-area" id="floor-area" placeholder="Floor Area (square feet)" required="required" style="background-color: #fff">
																<span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
															</div>

															<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="road-lengthh" style="margin-top: 5px;">
																<label> Total Length Road (km)</label>
																<input type="text" value="{{$proj->pi_road_length}}"  class="form-control has-feedback-left" name="road-length" id="road-length" placeholder="Road Length (km)" required="required" style="background-color: #fff">
																<span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
															</div>

															<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="road-typee" style="margin-top: 5px;">
																<label>Road Type</label>
																<input type="text"value="{{$proj->pi_road_type}}"  class="form-control has-feedback-left" name="road-type" id="road-type" placeholder="Road Type" required="required" style="background-color: #fff">
																<span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
															</div>

															<div class="form-group col-md-12 col-sm-12 col-xs-24" style="margin-top: 5px;">
																<div class="form-group">
																	<label>Project Site</label>
																	<input value="{{$proj->pi_construction_site}}" type="text" id="project-site" name="project-site" class="form-control" placeholder="Project Site"  required >
																</div>
															</div>

															<div class="form-group col-md-12 col-sm-12 col-xs-24" style="margin-top:5px;">
																<label >Project Description</label>
																<textarea class="resizable_textarea form-control" name-="project-desc" id="project-desc" name="project-desc" rows="5" cols="50" required >{{$proj->pi_description}}</textarea>
															</div>


															<div class="ln_solid" style="margin-top: 79%"></div>
															<div class="form-group">
																<div class="col-md-12 col-sm-12 col-xs-24 " style="margin-left:30%;">
																	<button type="submit" class="btn btn-success" style="width:40%;">Edit Project Details</button>
																</div>
															</div>
													</div>
													</form>

													<!-- Hidden input for inside transactions-->
													<input type="hidden" id="project-percentage" value="{{$proj->proj_percentage}}">
													<input type="hidden" id="payment-mode" value="{{$proj->ci_payment_mode}}">
													<input type="hidden" id="done">
													<!-- Notifications -->
													<button id="payment-notif" style="display: none" class="btn btn-default source" onclick="new PNotify({
													title: 'Request for Payment',
													text: 'You can now request the 2nd Partial Payment for 50% work accomplished of the project.',
													hide: false,
													styling: 'bootstrap3',
												});">Success</button>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-xs-24">
									<div class="x_panel ">
										<div class="x_title">
											<h2>Time Extension Request <small>Information</small></h2>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">

											<table class="table table-striped">
												<thead style="background-color: #353959; color:#ffffff;">
													<tr>
														<th style="width: 20%;">Action</th>
														<th style="width: 20%">Date Created</th>
														<th style="width: 20%">No. of Days</th>
														<th style="width: 25%">Reason of Delay</th>
														<th style="width: 15%; text-align:center">Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($ter as $ter)
													<tr>
														<td style="text-align:right">
															@if($ter->ter_status == 'Sent')
															<div class="btn-group">
																<a href="/approvetimeextreq?id={{$ter->ter_id}}"><button class="btn btn-success btn-sm" style="width:48%;" data-toggle="tooltip" data-placement="left" title="Approve Request"><i class="fa fa-check"></i></button></a>
																<a href="/rejecttimeextreq?id={{$ter->ter_id}}"><button class="btn btn-danger btn-sm" style="width:48%;" data-toggle="tooltip" data-placement="right" title="Reject Request"><i class="fa fa-close"></i></button></a>
																<a href="/pdftimeextreq?id={{$ter->ter_id}}"><button class="btn btn-primary btn-sm" style="width:100%;" data-toggle="tooltip" data-placement="left" title="Download Time Extension Request Letter"><i class="fa fa-file-pdf-o"></i></button></a>
															</div>
															@elseif($ter->ter_status == 'Waiting')
															<div class="btn-group">
																<a href="/approvetimeextreq?id={{$ter->ter_id}}"><button class="btn btn-success btn-sm" style="width:48%;" data-toggle="tooltip" data-placement="left" title="Approve Request"><i class="fa fa-check"></i></button></a>
																<a href="/rejecttimeextreq?id={{$ter->ter_id}}"><button class="btn btn-danger btn-sm" style="width:48%;" data-toggle="tooltip" data-placement="right" title="Reject Request"><i class="fa fa-close"></i></button></a>
																<a href="/pdftimeextreq?id={{$ter->ter_id}}"><button class="btn btn-primary btn-sm" style="width:100%;" data-toggle="tooltip" data-placement="left" title="Download Time Extension Request Letter"><i class="fa fa-file-pdf-o"></i></button></a>
															</div>@else
															<a href="/files/time extension request/{{$ter->ter_no}}.pdf" download><button class="btn btn-primary btn-sm" style="width:100%;" data-toggle="tooltip" data-placement="left" title="Download Time Extension Request Letter"><i class="fa fa-file-pdf-o"></i></button></a>
															@endif
														</td>
														<td style="text-align:center">{{$ter->ter_date}}</td>
														<td>{{$ter->ter_days}}</td>
														<td>{{$ter->ter_reason}}</td>
														<td style="text-align:center">
															@if($ter->ter_status=='Waiting')
															<span style="font-size: 1.1em; font-weight: bold;color:OrangeRed">Pending</span>
															@elseif($ter->ter_status=='Approved')
															<span style="font-size: 1.1em; font-weight: bold;color:green">{{$ter->ter_status}}</span>
															@else
															<span style="font-size: 1.1em; font-weight: bold;color:red">{{$ter->ter_status}}</span>
															@endif
														</td>
													</tr> 
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-24">
									<div class="x_panel ">
										<div class="x_title">
											<h2>Remarks <small>Information</small></h2>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">

										<form method="post" class="form-horizontal form-label-left input_mask" action="/editProjRemarks" data-parsley-validate>
											{{csrf_field()}}
											<div class="form-group col-md-12 col-sm-12 col-xs-24">
												<p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
													Information entered here will be shown on "Project Status Monthly Report".  Please update your remarks monthly.
												</p>
												<input type="hidden" value="{{$proj->proj_no}}" name="proj_no">
												<textarea class="resizable_textarea form-control" name-="project-remarks" id="project-remarks" name="project-remarks" rows="8" cols="50" required >{{$proj->pi_remarks}}</textarea>
											</div>
											<br/>
											<div class="ln_solid" style="margin-top: 40%;"></div>
												<div class="form-group">
													<div class="col-md-12 col-sm-12 col-xs-24 " style=" margin-bottom:5px;">
														<button type="submit" class="btn btn-success" style="width:100%">Update Project Remarks</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							</div>
								
							<div class="col-md-4 col-sm-4 col-xs-8">
								<div class="x_panel">
									<div class="x_title">
										<h2 style="font-size: 2em;">Task Status</h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content well" style="padding:20px">
										<h2 class="StepTitle" style="text-align:left; margin-bottom: 25px;"><strong>Project Manager</strong></h2>
										<h4><strong>Name:</strong> {{$proj->emp_first_name}} {{$proj->emp_last_name}}</h4>
										<h4><strong>Job Title:</strong> {{$proj->el_position}}</h4>
										<h4><strong>Email:</strong> {{$proj->emp_email}}</h4>
										<h4><strong>Telephone:</strong> {{$proj->emp_contact}}</h4>

										<br />

										<div class="ln_solid" style="margin-top: 8%;"></div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-24 " style="width:100%;">
												<button type="submit" data-id="{{$proj->proj_no}}" class="btn btn-success editclient" style="width:100%">Edit client information</button>
											</div>
										</div>

										<div class="ln_solid" style="margin-top: 33%;"></div>
										<h2 class="StepTitle" style="text-align:left; margin-bottom: 15px;"><strong>Project Status</strong></h2>
										<table>
											@php $task2 = $task @endphp
											@foreach($task2 as $task2)
											<tr>
												<td style="width:20%;">@if($task2->pt_status=='Complete') <span class="label label-success"><i class="fa fa-check"></i></span> @else <span class="label label-danger"><i class="fa fa-close"></i></span> @endif</td>
												<td style="width:80%;"><h5><strong>{{$task2->task_description}}</strong></h5></td>
											</tr>
											@endforeach
										</table>

										<div class="ln_solid" style="margin-top: 0%;"></div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-24 " style="width:100%;">
												<a href="/monthlyreport?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Monthly Report</button></a>
												
												<button type="submit" data-id="{{$proj->proj_no}}" class="btn btn-success addinvoice" style="margin-top: 13px; width:100%">Create an Invoice</button>
									
												@if ($proj->proj_status == 'Closed')
												<a href="/openproject?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Open Project</button></a>
												@else
												<a href="/closeproject?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Close Project</button></a>
												@endif
											</div>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							
							<div class="col-md-4 col-sm-4 col-xs-8" style="float:right;">
				<div class="x_panel ">
					<div class="x_title">
						<h2>Contract Form <small>Information</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<!-- start form for validation -->
						<form method="post" class="form-horizontal form-label-left input_mask" action="/editAdminProjContract" data-parsley-validate>
							{{csrf_field()}}
							@foreach($contract as $contract)
							<input type="hidden" value="{{$contract->proj_no}}" name="proj_no">
							<label >Contract Title</label>
							<input type="text" id="ci_name" class="form-control" name="ci_name" value="{{$contract->ci_name}}" required />

							<label style="margin-top: 4%;">Contract Type*:</label>
							<p>
								Horizontal
								<input type="radio" class="flat" name="ci_desc" id="Horizontal" disabled value="Horizontal" @if($contract->ci_desc=='Horizontal') checked @else @endif  />
								Vertical
								<input type="radio" class="flat" name="ci_desc" id="Vertical" disabled  value="Vertical" @if($contract->ci_desc=='Vertical') checked @else @endif />
								@endforeach
							</p>

							<!-- start task list -->
							<table class="table table-striped" style="margin-top:6%;">
								<thead style="background-color: #353959; color:#ffffff;">
									<tr>
										<th style="width: 100%">Contract Plans</th>
									</tr>
								</thead>
								<tbody>
									@php $plan1 = $plan @endphp
									@foreach($plan1 as $plan1)
									<tr>
										<td>
											<a data-toggle="tooltip" data-placement="left" title="Price per unit:₱<?php $number = $plan1->task_unit_cost; echo number_format ( $number , "2" , "." , "," )?>/{{$plan1->task_unit}} Quantity:{{$plan1->pt_qty}} {{$plan1->task_unit}}  Total_Cost:₱<?php $number = $plan1->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>">{{$plan1->task_description}}</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<br/>
							<div class="ln_solid"  style="margin-top:-10%;"></div>
							<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-24 " style="margin-top:-5%; margin-bottom:5px;">
									<!--<button type="submit" class="btn btn-success" style="width:100%">Edit Contract Details</button>-->
								</form>
								<a href="/previewcontract?id={{$proj->proj_no}}" class="btn btn-success" style="margin-top: 13px; width:100%">Preview Contract</a>
							</div>
						</div>
						<!-- end form for validations -->
					</div>
				</div>
			</div>
			
			
                        </div> 
						<!-- //Project Tab -->
						<!--Client Tab-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="client-tab">
						
                         	<form method="post" action="/editAdminClientCompany">
								{{csrf_field()}}
								<input type="hidden" id="id" name="id" value="{{$proj->proj_no}}">
								<h2 class="StepTitle" style="text-align:center; margin-bottom: 15px; margin-top: 30px;">Client Information</h2>
								@foreach($client as $client)
								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" value="{{$client->cr_first_name}}" id="client_fname" name="client_fname" required="required" placeholder="First Name">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control" value="{{$client->cr_last_name}}" id="client_lname" name="client_lname" required="required" placeholder="Last Name">
									<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" value="{{$client->cr_email}}" id="client_email" name="client_email" required="required" placeholder="Email">
									<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control" id="client_phone" value="{{$client->cr_contact}}" name="client_phone" required="required" placeholder="Phone" maxlength="11" >
									<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
								</div>

								<div class="col-md-9 col-sm-9 col-xs-18 form-group has-feedback" style="margin-bottom:20px;">
									<input type="text" class="form-control has-feedback-left" value="{{$client->cr_address}}" id="client_address" name="client_address" required="required" placeholder="Address">
									<span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback" style="margin-bottom:20px;">
									<input type="text" class="form-control" id="client_position" value="{{$client->cr_position}}" name="client_position" required="required" placeholder="Position">
									<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>

								<h2 class="StepTitle" style="text-align:center; ">Company Information</h2>
								<div class="form-group col-md-12 col-sm-12 col-xs-24">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="company-name" value="{{$client->cl_company}}" name="company-name" required="required" class="form-control col-md-7 col-xs-12" name="company-name">
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-24">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="company-address" value="{{$client->cl_address}}" name="company-address" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-24">
									<label  class="control-label col-md-3 col-sm-3 col-xs-12">Telephone No. <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="company-phone" value="{{$client->cl_contact}}" maxlength="11" name="company-phone" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-24" >
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 1%">
										<input type="text" id="company-email" value="{{$client->cl_email}}" name="company-email" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
									</div>
								</div>
								@endforeach
								<div class="modal-footer"style="margin-top: 20%">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-success" >Edit Details</button>
								</div>
							</form>
							
                        </div>
						<!--//Client Tab-->
						<!--Task&Milestone-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="taskmilestone-tab">
						
							<div class="col-md-12 col-sm-12 col-xs-24">
							<div class="col-md-8 col-sm-8 col-xs-18">
								<div class="x_panel">
									<div class="x_title">
										<h2>Project Tasks</h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
											It contains the project tasks, and each is described in detail. There are some tasks and some phases that can happen simultaneously. The responsibility of the Project Manager is to schedule the tasks at the appropriate time so that the critical path is completed in the least amount of time.
										</p>
										<!-- start project task list -->
										<table id="datatable-responsive" class="table projects">
											<thead style="background-color: #353959; color:#ffffff;">
												<tr>
													<th style="width: 100%">Project Tasks</th>
												</tr>
											</thead>
											<tbody>
												@php $task1 = $task @endphp
												@foreach($task1 as $task1)
												<tr>
													<td>
														<div class="col-md-24 col-xs-24">
															<div class="flex">
																<ul class="list-inline widget_profile_box">
																	<li style="width:75%; margin-top:-8px;">
																		<h3 style="color:#232323; font-size: 1.7em;">{{$task1->task_description}} </h3>
																	</li>
																	<li style="width:25%; text-align:right; margin-top:-7px;">
																		<h3><span class="label @if($task1->pt_end_date != '1111-11-11') 
																			@if(strtotime($task1->pt_end_date) < strtotime('now') && $task1->pt_percentage!=100) label-danger 
																			@elseif($task1->pt_status=='Complete') label-success 
																			@elseif($task1->pt_status=='Pending') label-default 
																			@else label-warning
																			@endif
																			@else
																			label-default
																			@endif">
																			@if($task1->pt_end_date != '1111-11-11')
																			@if(strtotime($task1->pt_end_date) < strtotime("now") && $task1->pt_percentage != 100) Delayed 
																			@else {{$task1->pt_status}} 
																			@endif
																			@else
																			{{$task1->pt_status}}
																			@endif
																		</span></h3>
																	</li>
																	<li style="width:100%">
																		<div class="project_progress" style="text-align:center;">
																			<div class="progress progress_sm">
																				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$task1->pt_percentage}}"></div>
																			</div>
																			<small>{{$task1->pt_percentage}}% Complete</small>
																		</div>
																	</li>
																</ul>
															</div>
															<div class="flex">
																<ul class="list-inline count2">
																	<li style="text-align:center; width:30%">
																		<span>Start Date: {{$task1->pt_start_date}}</span>
																	</li>
																	<li style="text-align:center; width:40%">
																		<span style="color: @if($task1->pt_expense>$task1->pt_total_cost) #c60303 @else @endif"> 
																			₱<?php $number = $task1->pt_expense; echo number_format ( $number , "2" , "." , "," )?> / 
																			₱<?php $number = $task1->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>  
																			<br> BUDGET 
																		</span>
																	</li>
																	<li style="text-align:center; width:25%">
																		<span>Deadline: @if($task1->pt_end_date == '1111-11-11') Not yet set
																			@else{{$task1->pt_end_date}}@endif</span>
																		</li>
																	</ul>
																</div>
															</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											<!-- end project task list -->
										</div>
									</div>
								</div>
								
								<div class="col-md-4 col-sm-4 col-xs-24" style="float:right;">
									<div class="x_panel tile fixed_height_300">
										<div class="x_title">
											<h2>Project Milestones</h2>
											<ul class="nav navbar-right panel_toolbox">
												<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
												</li>
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#">Settings 1</a>
														</li>
														<li><a href="#">Settings 2</a>
														</li>
													</ul>
												</li>
												<li><a class="close-link"><i class="fa fa-close"></i></a>
												</li>
											</ul>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">
											<p style="margin-bottom:6%;">
												We have divided the project process into three (3) phases. (You can edit phases here.)
											</p>
											@php $phase1 = $phase @endphp
											@foreach($phase1 as $phase1)
											<div class="widget_summary">
												<div class="w_left w_25">
													<a class="editmilestone" data-id="{{$phase1->pp_id}}" style="cursor:pointer"><span>{{$phase1->phase_title}}</span></a>
												</div>
												<div class="w_center w_55">
													<div class="progress">
														<div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$phase1->pp_percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phase1->pp_percentage}}%;">
														</div>
													</div>
												</div>
												<div class="w_right w_20">
													<span>{{$phase1->pp_percentage}}%</span>
												</div>
												<div class="clearfix"></div>
											</div>
											@endforeach

										</div>
									</div>
								</div>
								
								</div>
							
                        </div>
						<!--//Task&Milestone-->
						<!--Equipment-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="equipment-tab">
						
                         <!--equipment-->
							<div class="col-md-12 col-xs-24">
								<div class="x_panel ">
									<div class="x_title">
										<h2>Equipment</h2>
										<div style="float:right;">
											<ul class="nav nav-tabs">
												<li class="active"><a href="#information" data-toggle="tab">Information</a></li>
												<li><a href="#request" data-toggle="tab">Request</a></li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="tab-content">
										<!-- start form for validation -->
										<div id="information" class="tab-pane fade in active">
											<table class="table table-striped">
												<thead style="background-color: #353959; color:#ffffff;">
													<tr>
														<th style="width: 2%">No</th>
														<th style="width: 18%">Equipment</th>
														<th style="width: 30%">Serial/Model/Plate no.</th>
														<th style="width: 8%">capacity</th>
														<th style="width: 20%">Start date</th>
														<th style="width: 20%">total days</th>
														<th style="width: 2%">Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($equipdep as $equipdep)
													<tr>
														<td>{{$equipdep->ei_id}}</td>
														<td>{{$equipdep->ec_category}}</td>
														<td>{{$equipdep->ei_serial_model_plate}}</td>
														<td>{{$equipdep->ei_capacity_qty}}{{$equipdep->ei_capacity_unit}}</td>
														<td>{{$equipdep->ed_start_date}}</td>
														<td>{{$equipdep->ed_total_days}}</td>
														<td style="text-align:center">
															<span style="font-weight: bold;color:@if($equipdep->ei_status=='Maintenance') OrangeRed
																@elseif($equipdep->ei_status=='Deployed') green 
																@else red @endif" 
																style="font-size: 1.1em">{{$equipdep->ei_status}}
															</span>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										@foreach($equipreq as $equipreq)
										<div id="request" class="tab-pane fade">
											<table class="table table-striped">
												<thead style="background-color: #353959; color:#ffffff;">
													<tr>
														<th style="width: 25%">Action</th>
														<th style="width: 35%">Equipment</th>
														<th style="width: 20%">Quantity</th>
														<th style="width: 20%">Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<!--if(equipreq->req_status == 'Sent')-->
															<a href="/approveequipreq?id={{$equipreq->req_item_id}}"><button class="btn btn-success btn-sm pull-left  @if($equipreq->req_status == 'Approved') disabled @endif" data-toggle="tooltip" data-placement="left" title="Approve Request" style="text-align:center;"><i class="fa fa-check"></i></button></a>
															<a @if($equipreq->req_status != 'Rejected') href="/rejectequipreq?id={{$equipreq->req_item_id}}" @endif>
																<button class="btn btn-danger btn-sm pull-left @if($equipreq->req_status == 'Rejected' || $equipreq->req_status == 'Approved') disabled @endif" data-toggle="tooltip" data-placement="right" title="Reject Request" style="text-align:center;"><i class="fa fa-close"></i>
																</button>
															</a>
															<!--endif-->
														</td>
														<td>{{$equipreq->req_items}}</td>
														<td>{{$equipreq->req_qty}}</td>
														<td>
															@if($equipreq->req_status == 'Sent')
															<span style="color: OrangeRed;font-weight: bold;"><!--i class="fa fa-hourglass-end"></i--> Pending</span>
															@elseif($equipreq->req_status == 'Approved')
															<span style="color: green;font-weight: bold;"><!--i class="fa fa-check"></i--> {{$equipreq->req_status}}</span>
															@else
															<span style="color: red;font-weight: bold;"><!--i class="fa fa-times"></i--> {{$equipreq->req_status}}</span>
															@endif
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							
                        </div>
						<!--//Equipment-->
						<!--Financialt-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="financial-tab">
						
	                        <div class="col-md-12 col-sm-12 col-xs-24">
	                      		<ul class="stats-overview">
	                       			<li style="width: 31%;">
	                         	 		<span class="name"> Estimated budget </span>
	                          			<span class="value text-success"> P <?php $number = $proj->cb_total; echo number_format ( $number , "2" , "." , "," )?> </span>
	                       			 </li>
	                       			 <li style="width: 31%;">
	                         			 <span class="name"> Remaining budget </span>
							 			 @if($proj->cb_total - $proj->cb_expense > 0)
	                         			 <span class="value text-success"> P <?php $number = $proj->cb_total - $proj->cb_expense; echo number_format ( $number , "2" , "." , "," )?> </span>
	                         			 @else
							 			 <span class="value text-error" style="color: red"> P <?php $number = $proj->cb_total - $proj->cb_expense; echo number_format ( $number , "2" , "." , "," )?> </span>
	                         			 @endif
									</li>
	                       			 <li style="width: 31%;">
	                          			<span class="name"> Project Expense </span>
	                         			 <span class="value text-success"> P <?php $number = $proj->cb_expense; echo number_format ( $number , "2" , "." , "," )?> </span>
	                        			</li>
	                     		 </ul>
	                     		 <br />
	                   		 </div>
							 
							 <div class="col-md-6 col-xs-24">
									<div class="x_panel">
										<div class="x_title">
											<h2>Payments <small></small></h2>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">
											<form class="form-horizontal form-label-left">
												<p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
													It shows all received payments for the project.
												</p>
												<table class="table table-striped">
													<thead style="background-color: #353959; color:#ffffff;">
														<tr>
															<th style="width:35%">Payment #</th>
															<th style="width:25%">Date</th>
															<th style="width:40%">Amount</th>
														</tr>
													</thead>
													<tbody style="font-size: 14px;">
													@foreach($payment as $payment)
														<tr>
															<td>{{$payment->payment_refno}}</td>
															<td>{{$payment->payment_date}}</td>
															<td>₱  <?php $number = $payment->payment_amount; echo number_format ( $number , "2" , "." , "," )?></td>
														</tr>
													@endforeach
													</tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
								
								<div class="col-md-6 col-xs-24">
									<div class="x_panel">
										<div class="x_title">
											<h2>Invoices <small></small></h2>
											<div class="clearfix"></div>
										</div>
										<div class="x_content" >
											<form class="form-horizontal form-label-left">
												<p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
													It shows all invoices that is sent to the client but haven't been paid.
												</p>
												<table class="table table-striped">
													<thead style="background-color: #353959; color:#ffffff;">
														<tr>
															<th style="width:35%">Invoice #</th>
															<th style="width:25%">Due Date</th>
															<th style="width:40%">Amount</th>
														</tr>
													</thead>
													<tbody style="font-size: 14px;">
													@php $invoice1 = $invoice @endphp
												    @foreach($invoice1 as $invoice1)
														<tr>
															<input type="hidden" id="invoice_status" class="form-control" value="{{$invoice1->invoice_status}}">
															<td>
																<a data-id="{{$invoice1->invoice_no}}" class="editinvoice" style="cursor:pointer;">{{$invoice1->invoice_no}}</a>
															</td>
															<td>{{$invoice1->invoice_due}}</td>
															<td>₱ <?php $number = $invoice1->invoice_amount; echo number_format ( $number , "2" , "." , "," )?></td>
														</tr>
													@endforeach
													</tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							
							<div class="row">
								<div class="col-md-12 col-xs-24">
									<div class="x_panel">
										<div class="x_title">
											<h2>Project Financials <small></small></h2>
											<ul class="nav navbar-right panel_toolbox">
												<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
												</li>
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#">Settings 1</a>
														</li>
														<li><a href="#">Settings 2</a>
														</li>
													</ul>
												</li>
												<li><a class="close-link"><i class="fa fa-close"></i></a>
												</li>
											</ul>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">
											<form class="form-horizontal form-label-left">
												<p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
													It shows all approved plans and specifications including the following work of items at the unt prices.
												</p>
												<table class="table table-striped">
													<thead style="background-color: #353959; color:#ffffff;">
														<tr>
															<th>Contract Plan</th>
															<th>Cost</th>
															<th>Quantiy</th>
															<th>Final Cost</th>
														</tr>
													</thead>
													<tbody style="font-size: 14px;">
														@php $plan2 = $plan @endphp
														@foreach($plan2 as $plan2)
														<tr>
															<td>{{$plan2->task_description}}</td>
															<td>₱ <?php $number = $plan2->task_unit_cost; echo number_format ( $number , "2" , "." , "," )?>
																/ {{$plan2->task_unit}}</td>
																<td>{{$plan2->pt_qty}}</td>
																<td>
																	<span><strong>
																		₱ <?php $number = $plan2->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>
																	</strong></span>
																</td>
																@endforeach
																<tr>
																	<td colspan="3" align="right" style="text-align: left;" class="quote-align-left" style="font-size: 18px;">Total Cost:</td>
																	<td class="subtotal">
																		<strong>
																			₱ <?php $number = $plan2->cb_total; echo number_format ( $number , "2" , "." , "," )?>
																		</strong>
																	</td>
																</tr>
																<tr>
																	<td colspan="3" align="right" style="text-align: left;" class="quote-align-left" style="font-size: 18px;">Received by Alcel:</td>
																	<td class="subtotal bg-green ">
																		<strong>
																			₱ <?php $number = $plan2->cb_paid; echo number_format ( $number , "2" , "." , "," )?>
																		</strong>
																	</td>
																</tr>
																<tr>
																	<td colspan="3" align="right" style="text-align: left;" class="quote-align-left" style="font-size: 18px;">Balance:</td>
																	<td class="subtotal bg-red">	
																		<strong>
																			₱ <?php $number = $plan2->cb_balance; echo number_format ( $number , "2" , "." , "," )?>
																		</strong>
																	</td>
																</tr>
															</tbody>
														</table>
													</form>
												</div>
											</div>
										</div>
									</div>
							
                        </div>
						<!--//Financial-->
						
                      </div>
                    </div>
					
	

		
			

			


			

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
			<!-- bootstrap-wysiwyg -->
			<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
			<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
			<script src="../vendors/google-code-prettify/src/prettify.js"></script>
			<!-- jQuery Tags Input -->
			<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
			<!-- Switchery -->
			<script src="../vendors/switchery/dist/switchery.min.js"></script>
			<!-- Select2 -->
			<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
			<!-- Parsley -->
			<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
			<!-- Autosize -->
			<script src="../vendors/autosize/dist/autosize.min.js"></script>
			<!-- jQuery autocomplete -->
			<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
			<!-- starrr -->
			<script src="../vendors/starrr/dist/starrr.js"></script>
			<!-- PNotify -->
			<script src="../vendors/pnotify/dist/pnotify.js"></script>
			<script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
			<script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

			<!-- Custom Theme Scripts -->
			<script src="../build/js/custom.js"></script>


			<div class="modal fade" id="editClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Edit Details</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="/editAdminClientCompany">
								{{csrf_field()}}
								<input type="hidden" id="id" name="id">
								<h2 class="StepTitle" style="text-align:center; margin-bottom: 15px;">Client Information</h2>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" id="client_fname" name="client_fname" required="required" placeholder="First Name">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control" id="client_lname" name="client_lname" required="required" placeholder="Last Name">
									<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control has-feedback-left" id="client_email" name="client_email" required="required" placeholder="Email">
									<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" class="form-control" id="client_phone" name="client_phone" required="required" placeholder="Phone">
									<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
								</div>

								<div class="col-md-9 col-sm-9 col-xs-18 form-group has-feedback" style="margin-bottom:20px;">
									<input type="text" class="form-control has-feedback-left" id="client_address" name="client_address" required="required" placeholder="Address">
									<span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback" style="margin-bottom:20px;">
									<input type="text" class="form-control" id="client_position" name="client_position" required="required" placeholder="Position">
									<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>

								<h2 class="StepTitle" style="text-align:center; ">Company Information</h2>
								<div class="form-group col-md-12 col-sm-12 col-xs-24">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="company-name" name="company-name" required="required" class="form-control col-md-7 col-xs-12" name="company-name">
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-24">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="company-address" name="company-address" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-24">
									<label  class="control-label col-md-3 col-sm-3 col-xs-12">Telephone No. <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="company-phone" name="company-phone" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-24" >
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 1%">
										<input type="text" id="company-email" name="company-email" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
									</div>
								</div>
							</div>
							<div class="modal-footer"style="margin-top: 0%">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-success" >Edit Details</button>
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->

			<div class="modal fade" id="addInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Create Invoice</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="/invoice">
								{{csrf_field()}}
								<input type="hidden" id="proj_no" name="proj_no">

								<div class="col-md-8 col-sm-8 col-xs-16 form-group has-feedback" style="margin-top:2%;" id="divprojname">
									<label> Project Title </label>
									<input value="" type="text" class="form-control has-feedback-left" id="project-name" name="project-name" placeholder="Project Name" required>
									<span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-8 form-group has-feedback" style="margin-top:2%;" id="divprojno">
									<label> Project ID </label>
									<input value="" style="text-align: right;" type="text" id="project-id" class="form-control col-md-7 col-xs-12" name="project-id" placeholder=""  readonly>
									<span class=" form-control-feedback left" aria-hidden="true" style="color:#000; margin-top: 5px;">ID</span>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="divprojdate">
									<label> Invoce Due Date: </label>
									<input type="date" class="form-control" id="invoice_due" name="invoice_due" required="required" >
									<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>


								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="divnote">					
									<p class="text-muted well well-sm no-shadow" style="margin-top: 5px;">
										It is suggested to request a payment at the end of the month.
									</p>
								</div>
								
								<div id="alert" class="alert alert-error col-md-12 col-sm-12 col-xs-24" style="display:none">
								</div>

							</div>
							<div class="modal-footer"style="margin-top: 0%">
								<button type="button" class="btn btn-default" id ="divcancel" data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-default" id ="divOK" data-dismiss="modal" style="display:none; margin-left:46%">OK</button>
								<button type="submit" class="btn btn-success" id="divadd" >Add Invoice</button>
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->


			<div class="modal fade" id="editInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Invoice Details</h4>
						</div>
						<div class="modal-body" >
							<form method="post" action="/editprojinvoice">
								{{csrf_field()}}
								
								<div class="col-md-6 col-sm-6 col-xs-24" style="margin-top:1.5%">

										<input type="hidden" id="proj_no" name="proj_no" value="">

										<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
											<input type="text" class="form-control has-feedback-left" id="invoice_no" value="" name="invoice_no" required="required" placeholder="Invoice No *">
											<span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-top: 5px;">
											<input type="text" class="form-control has-feedback-left" id="proj_title" value="" name="proj_title" required="required" placeholder="Project Title *">
											<span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" style="margin-top: 5px;">
											<label>Total Amount</label>
											<input type="text" class="form-control has-feedback-left" id="invoice_amount" name="invoice_amount" value="" required="required" placeholder="Total Amount *">
											<span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
										</div>

										<div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
											<label>Payment Status</label>
											<div>
												<select class="form-control"  id="invoice_status" name="invoice_status">
													<option value="default" disabled >Payment Status</option>
													<option value="Paid">Paid</option>
													<option value="Unpaid">Unpaid</option>
												</select>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
											<label> Invoice Date </label>
											<input type="date" class="form-control" id="invoice_date" value="" name="invoice_date" required="required" style=" line-height:5px;">
											<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
										</div>

										<div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
											<label> Invoice Due</label>
											<input type="date" class="form-control" id="invoice_due" value="" name="invoice_due" required="required" style=" line-height:5px;" >
											<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
										</div>
								</div>

								<div class="form-group col-md-6 col-sm-6 col-xs-24" id="invoice_receipt" >
									<label>Payment Receipt</label>
									<div class="input-field col s6" style="text-align:center; margin-top:-4px;">
										<img id="blah1" src="/images/payment/payment.jpg" alt="your image" style="width:100%;"/>
										<div style="text-align:center; margin-top:10px; margin-left:30px;">
											<input type='file' onchange="readURL1(this);" name="payment_image" id="payment_image" style="margin-left: 18%"/>
										</div>
									</div>
									<input type="hidden" class="inpImage" id="image" name="image">
								</div>
								<div class="clearfix"></div>


							</div>
							<div class="modal-footer"style="margin-top: 0%">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<a class="btn btn-success" id="pdfinvoice">Generate Invoice</a>
								<button type="submit" class="btn btn-success">Update Invoice</button>
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->



			<script type="text/javascript">
	// Get data for editClient Modal
	$('.editclient').click(function () {
		console.log($(this).data('id'));
		$.ajax
		({
			type : "get",
			url : '/getAdminClientCompany',
			data : {"id" : $(this).data('id')},
			dataType: "json",
			success: function(response) {
				response.forEach(function(data){
                  //console.log(data.proj_no);
                  $('#editClient #id').val(data.proj_no);
                  $('#editClient #client_fname').val(data.cr_first_name);
                  $('#editClient #client_lname').val(data.cr_last_name);
                  $('#editClient #client_email').val(data.cr_email);
                  $('#editClient #client_phone').val(data.cr_contact);
                  $('#editClient #client_address').val(data.cr_address);
                  $('#editClient #client_position').val(data.cr_position);
                  $('#editClient #company-name').val(data.cl_company);
                  $('#editClient #company-address').val(data.cl_address);
                  $('#editClient #company-phone').val(data.cl_contact);
                  $('#editClient #company-email').val(data.cl_email);
              })
			}
		});
		$('#editClient').modal('show');
	});

	// Get data for addInvoice Modal
	$('.addinvoice').click(function () {
	var date = new Date(), y = date.getFullYear(), m = date.getMonth();
var firstDay = new Date(y, m, 1);
var lastDay = new Date(y, m + 1, 0);
var curdate = new Date();
var lastDay = "<?php  $lastday = date('m',strtotime('today')).'/'.date('t',strtotime('today')).'/'.date('Y',strtotime('today')); echo $lastdayformat = date('jS',strtotime($lastday)).' day of '.date('F Y.',strtotime($lastday))?>";
		$.ajax
		({
			type : "get",
			url : '/addinvoice',
			data : {"id" : $(this).data('id')},
			dataType: "json",
			success: function(response) {
				response.forEach(function(data){
					$('#addInvoice #proj_no').val(data.proj_no);
					$('#addInvoice #project-id').val(data.proj_no);
					$('#addInvoice #project-name').val(data.pi_title);
					var indate = new Date(data.invoice_date);
					if (indate.getMonth() == curdate.getMonth()) {
						 document.getElementById('alert').style.display = "block";
						 document.getElementById('divprojname').style.display = "none";
						 document.getElementById('divprojno').style.display = "none";
						 document.getElementById('divprojdate').style.display = "none";
						 document.getElementById('divnote').style.display = "none";
						 document.getElementById('divcancel').style.display = "none";
						 document.getElementById('divadd').style.display = "none";
						 document.getElementById('divOK').style.display = "block";
						$('#addInvoice #alert').text("It is suggested to request a payment at the end of the month. Next billing is scheduled on " + lastDay );
					} else {
						 document.getElementById('alert').style.display = "none";
						$('#addInvoice #alert').text("It is suggested to request a payment at the end of the month. Next billing is scheduled on " + lastDay );
					}
				})
			}
		});
		$('#addInvoice').modal('show');
	});

	// Get data for addInvoice Modal
	$('.editinvoice').click(function () {
		$.ajax
		({
			type : "get",
			url : '/getinvoice',
			data : {"id" : $(this).data('id')},
			dataType: "json",
			success: function(response) {
				response.forEach(function(data){
					$('#editInvoice #proj_no').val(data.proj_no);
					$('#editInvoice #invoice_no').val(data.invoice_no);
					$('#editInvoice #proj_title').val(data.pi_title);
					$('#editInvoice #invoice_amount').val(data.invoice_amount);
					$('#editInvoice select option[value="'+data.invoice_status+'"]').attr("selected","selected");
					$('#editInvoice #invoice_date').val(data.invoice_date);
					$('#editInvoice #invoice_due').val(data.invoice_due);
					$('#editInvoice #image').val(data.invoice_image);
					var path = "/images/payment/" + data.invoice_image;
					$('#editInvoice #blah1').attr("src",path);
					var a = document.getElementById("pdfinvoice");
					a.href = "/pdfinvoice?id="+data.invoice_id;
					
					if(data.invoice_status == "Waiting") {
        					$('#invoice_receipt').css('display', 'none');
   				   }
	
				})
			}
		});
		$('#editInvoice').modal('show');
	});


		//Convert project start and end date
		/*var projdate = document.getElementById("reservation").value;

		var s = projdate.slice(0, 11);
		var date = new Date(s);
		var year = date.getFullYear();
		var month = (1 + date.getMonth()).toString();
		month = month.length > 1 ? month : '0' + month;
		var day = date.getDate().toString();
		day = date.length > 1 ? day : '0' + day;
		var start = year + '-' + month + '-' + day;
		document.getElementById("start").value = start;

		e = projdate.slice(13, 24);
		var date1 = new Date(e);
		var year1 = date1.getFullYear();
		var month1 = (1 + date1.getMonth()).toString();
		month1 = month1.length > 1 ? month1 : '0' + month1;
		var day1 = date1.getDate().toString();
		day1 = day1.length > 1 ? day1 : '0' + day1;
		var end = year1 + '-' + month1 + '-' + day1;
		document.getElementById("end").value = end;
/*
		function sync()
		{
			var projdate = document.getElementById("reservation").value;

			var s = projdate.slice(0, 11);
			var date = new Date(s);
			var year = date.getFullYear();
			var month = (1 + date.getMonth()).toString();
			month = month.length > 1 ? month : '0' + month;
			var day = date.getDate().toString();
			day = date.length > 1 ? day : '0' + day;
			var start = year + '-' + month + '-' + day;
			document.getElementById("start").value = start;

			e = projdate.slice(13, 24);
			var date1 = new Date(e);
			var year1 = date1.getFullYear();
			var month1 = (1 + date1.getMonth()).toString();
			month1 = month1.length > 1 ? month1 : '0' + month1;
			var day1 = date1.getDate().toString();
			day1 = day1.length > 1 ? day1 : '0' + day1;
			var end = year1 + '-' + month1 + '-' + day1;
			document.getElementById("end").value = end;
		}*/

		var contype = document.getElementById("contype");
		var floornono= document.getElementById("floor-nono");
		var floorareaa= document.getElementById("floor-areaa");
		var floorno= document.getElementById("floor-no");
		var floorarea= document.getElementById("floor-area");
		var roadtypee= document.getElementById("road-typee");
		var roadlengthh= document.getElementById("road-lengthh");
		var roadtype= document.getElementById("road-type");
		var roadlength= document.getElementById("road-length");

		if (contype.value == "Vertical") {
			roadlength.value = "0" ;
			roadtype.value =  "0" ;
		}
		else {
			floorno.value =  "0" ;
			floorarea.value =  "0" ;
		}

		floornono.style.display = contype.value == "Vertical" ? "block" : "none";
		floorareaa.style.display = contype.value == "Vertical" ? "block" : "none";
		roadlengthh.style.display = contype.value == "Vertical" ? "none" : "display";
		roadtypee.style.display = contype.value == "Vertical" ? "none" : "display";


		var pmode= document.getElementById("payment-mode");
		var projper= document.getElementById("project-percentage");
		var paynotif= document.getElementById("payment-notif");
		var addinvoice= document.getElementById("addinvoice");
		var invoicestatus= document.getElementById("invoice_status");


		if(pmode.value == "Half" && projper.value >= 50 ) {
			paynotif.click();
		}

		if(invoicestatus.value == "Unpaid" ) {

			PNotify.removeAll();
		}

		if(invoicestatus.value == "Paid" ) {
			PNotify.removeAll();
		}

	/*	var paymentstatus= document.getElementById("invoice_status");
		var paymentreceipt= document.getElementById("invoice_receipt");
		
		paymentreceipt.style.display = paymentstatus.value == "Paid" ? "block" : "none";
		paymentreceipt.style.display = paymentstatus.value == "Unpaid" ? "none" : "block";*/

		function readURL1(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#blah1')
					.attr('src', e.target.result);
				};

				reader.readAsDataURL(input.files[0]);
			}
		}


	</script>
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
</div>
<script>
  $('#notif').click(function () {
    $("#notifcount").hide();
    $.ajax({
      type : "get",
      url : '/updatenotifadmin',
      data : {"id" : $(this).data('id')},
      dataType: "json",
      success: function(response) {
      }
    });
  });
</script>
</body>
</html>