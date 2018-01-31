@extends('layouts.dashboardAM') 
@section('page_title','Financial Detail') 
@section('page_content')
		
<div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Financial</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
				  @php $fin1 = $fin @endphp
					@foreach($fin1 as $fin1)
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <ul class="stats-overview">
                        <li>
                          <span class="name"> Estimated budget </span>
                          <span class="value text-success"> <?php $number = $fin1->cb_budget; echo number_format ( $number , "2" , "." , "," )?></span>
                        </li>
                        <li>
                          <span class="name"> Total amount spent </span>
                          <span class="value text-success"> <?php $number = $fin1->cb_expense; echo number_format ( $number , "2" , "." , "," )?> </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Budget Remaining </span>
                          <span class="value text-success"> <?php $number = $fin1->cb_budget_left; echo number_format ( $number , "2" , "." , "," )?> </span>
                        </li>
                      </ul>
                      <br /> 

                    <div class="col-md-2 col-sm-2 col-xs-2">
						<h1 style="color: #d2d600"><i class="fa @if ($fin1->ci_desc == 'Vertical') fa-building @else fa-road @endif"></i></h1>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-22" style="margin-left: -5%">
						<h1 style="color:#d2d600">{{$fin1->pi_title}}</h1>
					</div>
					@endforeach
					
                    <div style="margin-top: 25%;">

                       <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead style="background-color: #353959; color:#ffffff;">
                        <tr>
                          <th>Item No</th>
                          <th style="width: 29%;">Description</th>
                          <th style="width: 17%;">Total Amount</th>
                          <th style="width: 17%;">Project Expense</th>
                          <th style="width: 17%;">Budget Remaining</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($task as $task)
                        <tr>
                          <td>{{$task->task_item_no}}</td>
                          <td>{{$task->task_description}}</td>
                          <td><?php $number = $task->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?></td>
                          <td><?php $number = $task->pt_expense; echo number_format ( $number , "2" , "." , "," )?></td>
                          <td><?php $number = $task->pt_total_cost - $task->pt_expense; echo number_format ( $number , "2" , "." , "," )?></td>
                        </tr>
					  @endforeach
                      </tbody>
                    </table>


                      </div>


                    </div>

                    <!-- start project-detail sidebar -->
                    <div class="col-md-3 col-sm-3 col-xs-12">

                      <section class="panel">
						@php $fin2 = $fin @endphp
						@foreach($fin2 as $fin2)
                        <div class="x_title">
                          <h2>Project Description</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                          <p>{{$fin2->pi_description}}</p>
                          <br />

                          <div class="project_detail">

                            <p class="title">Project Site</p>
                            <p>{{$fin2->pi_construction_site}}</p>
                            <p class="title">Project Leader</p>
                            <p>{{$fin2->emp_first_name}} {{$fin2->emp_last_name}}</p>
                          </div>

                          <br />
							
                          <div>
                            <a href="/downloadfinancial?id={{$fin2->proj_no}}" class="btn btn-sm btn-primary" style="width:100%"><i class="fa fa-download"></i> Generate PDF</a>
                            <a href="/project_detail?id={{$fin2->proj_no}}" class="btn btn-sm btn-warning" style="width:100%">View Details</a>
                          </div>
                        </div>
						@endforeach
                      </section>

                    </div>
                    <!-- end project-detail sidebar -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->


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