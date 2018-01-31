@extends('layouts.dashboardAM') 
@section('page_title','Deploy Detail') 
@section('page_content')

          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Equipment Deployed</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
				  @php $fin1 = $fin @endphp
					@foreach($fin1 as $fin1)
                    <div class="col-md-9 col-sm-9 col-xs-12">

                    <div class="col-md-2 col-sm-2 col-xs-2">
						<h1 style="color: #d2d600"><i class="fa @if ($fin1->ci_desc == 'Vertical') fa-building @else fa-road @endif"></i></h1>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-22" style="margin-left: -5%">
						<h1 style="color:#d2d600">{{$fin1->pi_title}}</h1>
					</div>
					@endforeach
                    <!-- tabs left -->
                  <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                      <li><a href="#information" data-toggle="tab">Information</a></li>
                      <li><a href="#request" data-toggle="tab">Request for replacement</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- start form for validation -->
                      <div id="information" class="tab-pane fade in active">
                        <table class="table table-striped">
                          <thead style="background-color: #353959; color:#ffffff;">
                            <tr>
                              <th style="width: 2%">No</th>
                              <th style="width: 13%">Equipment</th>
                              <th style="width: 27%">Serial/Model/Plate no.</th>
                              <th style="width: 8%">capacity</th>
                              <th style="width: 20%">Start date</th>
                              <th style="width: 25%">total days</th>
                              <th style="width: 5%">Status</th>                              
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
                                <span class="label @if($equipdep->ei_status=='Maintenance') label-warning 
                                                   @elseif($equipdep->ei_status=='Deployed') label-success 
                                                   @else label-danger @endif" 
                                      style="font-size: 1.1em">{{$equipdep->ei_status}}
                                </span>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
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
                          @if(!empty($equipreq))
                            @foreach($equipreq as $equipreq)
                            <tr>
                              <td>
                                <div class="btn-group">
                                  <button class="btn btn-default pull-top showdetail" data-id="{{$equipreq->ejr_no}}" data-toggle="tooltip" data-placement="right" title="View info" style="text-align:center;">
                                    <i class="fa fa-eye">View Info</i>
                                  </button>	
                                  <a @if($equipreq->req_status != 'Approved') href="/approveequipreq?id={{$equipreq->req_item_id}}"@endif><button class="btn btn-success btn-sm pull-left @if($equipreq->req_status == 'Approved') disabled @endif" data-toggle="tooltip" data-placement="left" title="Approve Request" style="text-align:center;"><i class="fa fa-check"></i></button></a>
                                  <a @if($equipreq->req_status != 'Rejected' && $equipreq->req_status != 'Approved') href="/rejectequipreq?id={{$equipreq->req_item_id}}" @endif>
                                    <button class="btn btn-danger btn-sm pull-right @if($equipreq->req_status == 'Rejected' || $equipreq->req_status == 'Approved') disabled @endif" data-toggle="tooltip" data-placement="right" title="Reject" style="text-align:center;"><i class="fa fa-close"></i>
                                    </button>
                                  </a>
						        </div>
                              </td>
                              <td>{{$equipreq->req_items}}</td>
                              <td>{{$equipreq->req_qty}}</td>
                              <td>
                                @if($equipreq->req_status == 'Sent')
                                  <span class="label label-info" style="font-size: 1.1em"><i class="fa fa-paper-plane-o"></i> Recieved</span>
                                @elseif($equipreq->req_status == 'Approved')
                                  <span class="label label-success" style="font-size: 1.1em"><i class="fa fa-check"></i> {{$equipreq->req_status}}</span>
                                @else
                                  <span class="label label-danger" style="font-size: 1.1em"><i class="fa fa-times"></i> {{$equipreq->req_status}}</span>
                                @endif
                              </td>                            
                            </tr>
                            @endforeach
                            @elseif(empty($equipreq))
                              <td colspan="4" style="text-align:center;">There's no data</td>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
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
  
  <div class="modal fade" id="showDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title" id="myModalLabel">Equipment Job Request</h4>
         </div>
         <div class="modal-body">
           
           
           <table style="width:100%; border: 1.5px solid black;">
             <thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
               <tr style="font-size: 1.15em;">
                 <td colspan="2" style="padding: 7px;"> &nbsp; I. Job Request</td>
               </tr>
             </thead>
             <tbody>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Date
                 </th>
                 <td class="reqdate" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;location
                 </th>
                 <td class="location" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Driver name
                 </th>
                 <td class="driver" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
					</td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Repaired By
                 </th>
                 <td class="repairedby" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
             </tbody>
           </table>
           
           <table style="width:100%; border: 1.5px solid black;">
             <thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
               <tr style="font-size: 1.15em;">
                 <td colspan="2" style="padding: 7px;"> &nbsp; II. REQUEST INFORMATION</td>
               </tr>
             </thead>
             <tbody>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Checked By
                 </th>
                 <td class="checkedby" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Checked date
                 </th>
                 <td class="checkeddate" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Problems Encountered
                 </th>
                 <td style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                   <textarea class="resizable_textarea form-control problems" rows="8" cols="50"></textarea>
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Work Done
                 </th>
                 <td style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                   <textarea class="resizable_textarea form-control workdone" rows="8" cols="50"></textarea>
                 </td>
               </tr>
             </tbody>
           </table>
           
           <table style="width:100%; border: 1.5px solid black;">
             <thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
               <tr style="font-size: 1.15em;">
                 <td colspan="2" style="padding: 7px;"> &nbsp; III. Trial Run</td>
               </tr>
             </thead>
             <tbody>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Trial Run Date
                 </th>
                 <td class="trialdate" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Trial Run By
                 </th>
                 <td class="trialrunby" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Turned Over By
                 </th>
                 <td class="turnedover" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
               <tr style="border-bottom: 1.5px solid #494949;">
                 <th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
                   &nbsp;&nbsp;&nbsp;&nbsp;Accepted By
                 </th>
                 <td class="acceptedby" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
                 </td>
               </tr>
             </tbody>
           </table>
                                
         </div>
         
       </div>
                <!-- /.modal-content -->
    </div>
            <!-- /.modal-dialog -->
  </div>
        <!-- /.modal -->	
	  
  <script>
$('.showdetail').click(function () {
  $.ajax
    ({
      type : "get",
      url : '/ejr_detail',
      data : {"id" : $(this).data('id')},
      dataType: "json",
      success: function(response) {
        response.forEach(function(data){
          $('#showDetail .reqdate').text(data.ejr_date);
          $('#showDetail .location').text(data.ejr_location);
          $('#showDetail .problems').text(data.ejr_problems);
          $('#showDetail .workdone').text(data.ejr_work_done);
          $('#showDetail .repairedby').text(data.ejr_repaired_by);
          $('#showDetail .driver').text(data.ejr_driver_name);
          $('#showDetail .checkedby').text(data.ejr_checked_by);
          $('#showDetail .checkeddate').text(data.ejr_checked_date);
          $('#showDetail .trialdate').text(data.et_date);
          $('#showDetail .turnedover').text(data.et_turned_over);
          $('#showDetail .acceptedby').text(data.et_accept_by);
          $('#showDetail .trialrunby').text(data.et_trialrun_by);
        })
      }
    });
    $('#showDetail').modal('show');
  });

    $(document).ready(function() {
			$('select').material_select();
	  });
      
	  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
	  </script>
@stop