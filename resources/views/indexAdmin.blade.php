@extends('layouts.dashboardAM') 
@section('page_title','Dashboard') 
@section('page_content')

<div class="">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-7">
        <div class="x_panel">
          <div class="x_title">
            <h3>Project Financials <small>Information</small></h3>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="col-md-12 col-xs-24" >
  			  <div class="col-md-12 col-xs-24">
                <!-- start project list -->
                <table id="datatable-responsive" class=" table table-striped projects">
                  <thead style="background-color: #353959; color:#ffffff;">
                    <tr>
                      <th style="width: 50%">Project Name</th>
                      <th style="width: 20%">Amount</th>
                      <th style="width: 20%">Deadline</th>
                      <th style="width: 10%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($invoice))
                      @foreach($invoice as $invoice)
                      <tr>
                        <td>{{$invoice->pi_title}}</td>
                        <td>{{number_format($invoice->invoice_amount, 2,'.',',')}}</td>
                        <td>{{$invoice->invoice_due}}</td>
                        <td>
                          <!--button type="button" class="btn @if(strtotime($invoice->invoice_due) < strtotime('now') && $invoice->invoice_status == 'Sent') btn-danger 
                                                           @elseif($invoice->invoice_status=='Paid') btn-success 
                                                           @else btn-warning 
                                                           @endif btn-xs">@if(strtotime($invoice->invoice_due) < strtotime("now") &&$invoice->invoice_status=='Sent') Delayed 
                                                                          @else {$invoice->invoice_status}} 
                                                                          @endif
                          </button-->
                          <span class="label @if(strtotime($invoice->invoice_due) < strtotime('now') && $invoice->invoice_status == 'Sent') label-danger 
                                             @elseif($invoice->invoice_status=='Paid') label-success 
                                             @else label-warning 
                                             @endif" style="font-size: 1em;">
                            @if(strtotime($invoice->invoice_due) < strtotime("now") &&$invoice->invoice_status=='Sent') Delayed 
                            @else {{$invoice->invoice_status}} 
                            @endif
                          </span>
                        </td>
                      </tr>
                      @endforeach
                    @elseif(empty($invoice))
                      <td colspan="4" style="text-align:center;">There's no data</td>
                    @endif
                  </tbody>
                </table>
                    <!-- end project list -->
              </div>
            </div>
          </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h3>Equipment <small>Information</small></h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-xs-24" style="margin-left: 0px">
              <div class="col-md-12 col-xs-24" style="margin-left: 0px">
                <!-- start project list -->
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead style="background-color: #353959; color:#ffffff;">
                    <tr>
                      <th>ID</th>
                      <th>Description</th>
                      <th>Available</th>
                      <th>Deployed</th>
                      <th>Defective</th>
                      <th>Total Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($equip as $var)
                    <tr>
                      <td>{{$var->id}}</td>
                      <td>{{$var->ec_category}}</td>
                      <?php
                      if($var->Available==0){
                        echo '<td>0</td>';
                      }else{
                        echo '<td>'. $var->Available. '</td>';
                      }if($var->Deployed==0){
                        echo '<td>0</td>';
                      }else{
                        echo '<td>'. $var->Deployed. '</td>';
                      }if($var->Defective==0){
                        echo '<td>0</td>';
                      }else{
                        echo '<td>'. $var->Defective. '</td>';
                      }
                      ?>
                      <td>{{$var->ec_quantity}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                  <!-- end project list -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5 col-xs-24" style="margin-left: -30px; ">
        <ul>       
          @foreach($project as $proj)
		  <li>
			<div class="col-md-12 col-xs-24" style="text-align: center; margin-top:-10px;">
              <div class="w3-animate-zoom x_panel ui-ribbon-container fixed_height_350 fixed_width_600" style=" background-color: #353959; color:#ffffff;">
                <div class="x_content">
                  <div style="text-align: center; margin-bottom: 17px;">
                    <a href="/project_detail?id={{$proj->proj_no}}"><h5 class="name_title" style="color:#ffffff">{{$proj->ci_name}}</h5></a>
                    <p>Status: @if(strtotime($proj->proj_end_date) < strtotime("now") && $proj->proj_status!='Complete') Delayed 
                               @else {{$proj->proj_status}} 
                               @endif
                    </p>
                    <div class="project_progress">
                      <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$proj->proj_percentage}}"></div>
                      </div>
                      <small>{{$proj->proj_percentage}}% Complete</small>
                    </div>
                  </div>
                  <div class="divider"></div>
                  <div class="col-md-4 col-sm-4 col-xs-8 tile_stats_count">
                    <span class="count_top"><i class="fa fa-calendar"></i> START</span>
                    <div class="count">{{$proj->proj_start_date}}</div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-8 tile_stats_count">
                    <span class="count_top"><i class="fa fa-calendar"></i> Remaining</span>
                    @if(date_diff(date_create("now"),date_create($proj->proj_end_date))->format('%r%a days') > 0)<div class="count green">@else<div class="count red">@endif<strong>@php echo date_diff(date_create("now"),date_create($proj->proj_end_date))->format('%r%a days') @endphp CD</strong></div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-8 tile_stats_count" >
                    <span class="count_top"><i class="fa fa-calendar"></i> DEADLINE</span>
                    <div class="count"><strong>{{$proj->proj_end_date}}</strong></div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          @endforeach
		
        </ul>
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
@stop