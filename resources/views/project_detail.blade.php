@extends('layouts.dashboardAM') 
@section('page_title','Description') 
@section('page_content')

     <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
					@foreach($proj as $proj)
					<div class="col-md-2 col-sm-2 col-xs-2" style="width: 6%">
						<h1 class="lime-text darken-4"><i class="fa @if ($proj->ci_desc == 'Vertical') fa-building @else fa-road @endif"></i></h1>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-22" style="margin-left: 0%; width: 94%">
						<h1 class="lime-text darken-4" style="color:#d2d600";>{{$proj->pi_title}}</h1>
					</div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="col-md-12 col-sm-12 col-xs-24">
                      <ul class="stats-overview">
                        <li style="width: 31%;">
                          <span class="name"> Estimated budget </span>
                          <span class="value text-success"> P <?php $number = $proj->cb_total; echo number_format ( $number , "2" , "." , "," )?> </span>
                        </li>
                        <li style="width: 36%;">
						  <span class="value text-default"> Progress Status (%)</span>
                          <div class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$proj->proj_percentage}}"></div>
                            </div>
                            <small>
								<?php $number = $proj->proj_percentage; echo number_format ( $number , "0" , "." , "," )?>
								% Complete
							</small>
                          </div>
                        </li>
                        <li class="hidden-phone" style="width: 30%;">
                          <span class="name"> Estimated project duration </span>
                          <span class="value text-success"> @php echo date_diff(date_create($proj->proj_start_date),date_create($proj->proj_end_date))->format('%r%a days') @endphp</span>
                        </li>
                      </ul>
					  <ul class="stats-overview">
                        <li style="width: 31%;">
                          <span class="name"> Project Expense </span>
                          <span class="value text-success"> P <?php $number = $proj->cb_expense; echo number_format ( $number , "2" , "." , "," )?> </span>
                        </li>
                        <li style="width: 36%;">
						  <h3><span @if (strtotime($proj->proj_end_date) < strtotime('now') && $proj->proj_status!='Complete') style="color:#af0000"; @elseif($proj->proj_status=='Pending') style="color:#0057af"; @elseif($proj->proj_status=='Complete') style="color:#00af14"; @else style="color:#f9840e"; @endif">@if(strtotime($proj->proj_end_date) < strtotime("now") && $proj->proj_status!='Complete') Delayed @else {{$proj->proj_status}} @endif</span></h3>
						</li>
                        <li class="hidden-phone" style="width: 30%;">
						  @if($proj->proj_status!='Complete')
							@if(strtotime($proj->proj_end_date) < strtotime('now'))
								<span class="name"> Days Delayed</span>
								<span class="value text-danger"> @php echo date_diff(date_create("now"),date_create($proj->proj_end_date))->format('%a days') @endphp</span>
							@else
								<span class="name"> Remaining Days</span>
								<span class="value text-success"> @php echo date_diff(date_create("now"),date_create($proj->proj_end_date))->format('%r%a days') @endphp</span>
							@endif
						  @else
							<span class="name"> Date Completed </span>
							<span class="value text-success"> {{$proj->proj_complete_date}} </span>
                          @endif
						</li>
                      </ul>
                      <br />
                    </div>

					
					<!-- start project-detail sidebar -->
                    <div class="col-md-12 col-sm-12 col-xs-24">

                      <section class="panel">

                        <div class="panel-body" style="margin-top:-27px;">
						  <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:15px;">

                          <p style="font-size:1.5em;" ><strong>Project Description</strong></p>
                          <p style="font-size:1em;">{{$proj->pi_description}}</p>
						  <br />

                          <div class="project_detail">
						  @foreach($client as $client)
                            <p style="font-size:1.5em;"><strong>Client Company</strong></p>
                            <p>{{$client->cl_company}}<br>
							   {{$client->cl_address}} <br>
							   {{$client->cl_contact}}<br>
							   {{$client->cl_email}}
							</p>
						  @endforeach
                            <p style="font-size:1.5em;"><strong>Project Leader</strong></p>
                            <img src="images/profile/{{$proj->emp_image}}" class="avatar" alt="Avatar">
								&nbsp;{{$proj->emp_first_name.' '.$proj->emp_middle_initial.' '.$proj->emp_last_name}}
							</div>

                          <br />
						  </div>

						  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="margin-top:15px;">
							<p style="font-size:1.5em;"><strong>Equipment Deployed</strong></p>
                                 <table class="table table-striped projects">
								 <thead>
                                 <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 50%">Equipment</th>
                                    <th style="width: 10%">Capacity</th>
                                 </tr>
                                 </thead>
								 <tbody>
								 @foreach($equipdep as $equipdep)
                                 <tr>
									<td>{{$equipdep->ei_id}}</td>
									<td>{{$equipdep->ei_manufacturer.' '.$equipdep->ei_serial_model_plate}}</td>
									<td>{{$equipdep->ei_capacity_qty.' '.$equipdep->ei_capacity_unit}}</td>
                                 </tr>
								 @endforeach
								 </tbody>
					             </table>
								 <div class="divider"></div>
                          </div>

						<div class="col-md-12 col-sm-12 col-xs-24">
							<p class="title"><strong>Project Tasks</strong></p>
							<!-- start task list -->
							<table class="table table-striped ">
								<thead style="background-color: #353959; color:#ffffff;">
									<tr>
										<th style="width: 25%">Phase</th>
										<th style="width: 30%">Task</th>
										<th style="width: 10%">Deadline</th>
										<th style="width: 15%; text-align:center;">Percentage</th>
										<th style="width: 15%; text-align:center;">Status</th>
									</tr>
								</thead>
								<tbody>
								@foreach($task as $task)
									<tr>
										<td>
											<a>{{$task->phase_title}}</a>
											<br />
											<small>{{$task->phase_description}}</small>
										</td>
										<td>
											{{$task->task_description}}
										</td>
										<td>
											@if($task->pt_end_date == '1111-11-11') Not yet set
                                            @else{{$task->pt_end_date}}
                                            @endif
										</td>
										<td class="center">
											<div class="project_progress" style="text-align:center;">
												<div class="progress progress_sm">
													<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$task->pt_percentage}}"></div>
												</div>
												<small>{{$task->pt_percentage}}% Complete</small>
											</div>
										</td>
										<td class="center">
											<span class="@if ($task->pt_status=='Complete') label label-success @elseif ($task->pt_status=='On Going') label label-warning @else label label-error grey-text @endif"  style="font-size:13px;">{{$task->pt_status}}</span>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						<!-- end task list -->
						  </div>
						  
						<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
							<p class="title"><strong>Project Financials</strong></p>

							<table class="table table-striped">
							<thead style="background-color: #353959; color:#ffffff;">
								<tr>
									<th>Contract Plan</th>
									<th>Cost</th>
									<th style="text-align:center">Quantiy</th>
									<th style="text-align:center">Final Cost</th>
								</tr>
							</thead>
							<tbody style="font-size: 14px;">
								@foreach($plan as $plan)
                                 <tr>
									<td>{{$plan->task_description}}</td>
									<td>{{$plan->task_unit_cost.' / '.$plan->task_unit}}</td>
									<td style="text-align:center">{{$plan->pt_qty}}</td>
									<td style="text-align:right">
										<span>
											<strong>
												₱ <?php $number = $plan->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>
											</strong>
										</span>
									</td>
								@endforeach
										<tr style=" border-top: 3px solid gray;">
											<td colspan="3" align="right" class="quote-align-right"style="color:black; font-size:16px"><strong>Total Cost:</strong></td>
											<td class="subtotal" style="text-align:right;"><strong>₱ <?php $number = $plan->cb_total; echo number_format ( $number , "2" , "." , "," )?></strong></td>
										</tr>
										<tr>
											<td colspan="3" align="right" class="quote-align-right" style="color:black; font-size: 16px;"><strong>Received by ALCEL:</strong></td>
											<td class="subtotal bg-green " style="text-align:right"><strong>₱ <?php $number = $plan->cb_paid; echo number_format ( $number , "2" , "." , "," )?></strong></td>
										</tr>
										<tr>
											<td colspan="3" align="right" class="quote-align-right" style="color:black; font-size: 16px;"><strong>Balance:</strong></td>
											<td class="subtotal bg-red" style="text-align:right"><strong>₱ <?php $number = $plan->cb_balance; echo number_format ( $number , "2" , "." , "," )?></strong></td>
										</tr>
							</tbody>
						</table>

						</div>


                      </section>

                    </div>
					<div class="text-center">
                            
                        @if($proj->proj_status != 'Closed')<a @if($proj->proj_status != 'Closed') href="/project_edit?id={{$proj->proj_no}}" @endif class="btn btn-primary edittype" style="width: 140px; height: 30px; font-size:15px;">Edit Details</a>@endif
                    </div>
					@endforeach
                  </div>


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
    <!-- ECharts -->
    <script src="../vendors/echarts/dist/echarts.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>


	<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script>
	  $(document).ready(function() {
			$('select').material_select();
	  });

	  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
	  </script>
@stop