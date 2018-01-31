@extends('layouts.dashboard')
@section('page_title','Project')
@section('page_content')

<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title" style="height: 13%;">
                    <h1>My Projects</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p>It shows all project information including progress status and client of the project. It also allows you to update and view project information.</p>

                    <!-- start project list -->
          <table  class="table table-striped table-bordered" id="datatable-responsive" cellspacing="0">
                      <thead style="background-color: #353959; color:#ffffff;">
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 40%">Project Name</th>
                          <th style="width: 15%">Company</th>
                          <th style="width: 20%">Progress (%)</th>
                          <th style="width: 10%">Status</th>
                          <th style="width: 14%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
						@foreach($var as $var)
                        <tr>
                          <td>{{$var->proj_no}}</td>
                          <td>
                            <a style="font-size: 18px;">{{$var->pi_title}}</a>
                            <br />
                            <small>Created {{$var->proj_created_date}}</small>
                          </td>
                          <td class="project_progress">
                            <h4>{{$var->cl_company}}</h4>
                          </td>
                          <td>
                            <div class="project_progress" style="text-align:center;">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$var->proj_percentage}}"></div>
                            </div>
                            <small>
							<?php $number = $var->proj_percentage; echo number_format ( $number , "0" , "." , "," )?>
								% Complete
							   </small>
                            </div>
                          </td>
						  <td style="text-align:center;">
                            <span class="label @if (strtotime($var->proj_end_date) < strtotime('now') && $var->proj_status!='Complete') label-danger @elseif($var->proj_status=='Pending') label-default @elseif($var->proj_status=='Complete') label-success @else label-warning @endif" style="font-size:1em;">@if(strtotime($var->proj_end_date) < strtotime("now") && $var->proj_status!='Complete') Delayed @else {{$var->proj_status}} @endif</span>
						  </td>
                          <td>
                            <a href="/PM_project_detail?id={{$var->proj_no}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            @if($var->proj_status != 'Closed')<a @if($var->proj_status != 'Closed') href="/PM_project_edit?id={{$var->proj_no}}" @endif class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>@endif
                            <!--a href="/download" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a-->
                          </td>
                        </tr>
						@endforeach
                      </tbody>
                    </table>
                    <!-- end project list -->

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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
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
    <script src="../build/js/custom.min.js"></script>

	<!-- DELETE Modal -->		
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Project</h4>
                                        </div>
                                        <div class="modal-body">
                                           Are you sure you want to delete this project?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
@stop