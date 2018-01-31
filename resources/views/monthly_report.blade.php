@extends('layouts.dashboardAM')
@section('page_title','Monthly Report')
@section('page_content')

         <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title" style="margin-bottom: 20px;">
                    <div class="title_left">
						<h4 style="margin-top: -4px;">Monthly <small>Report</small></h4>
					</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    It shows Monthly report of projects.
					</p>

                    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead style="background-color: #353959; color:#ffffff;">
                        <tr>
                          <th style="width: 2%;">#</th>
                          <th style="width: 60%;">Project Description</th>
                          <th style="width: 15%;">Start Date</th>
                          <th style="width: 15%;">End Date</th>
                          <th style="width: 8%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($fin as $fin)
                        <tr>
                          <td>{{$fin->proj_no}}</td>
                          <td>{{$fin->pi_title}}</td>
                          <td>{{$fin->proj_start_date}}</td>
                          <td>{{$fin->proj_end_date}}</td>
                          <td>
                            <a href="/monthlyreport?id={{$fin->proj_no}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" title="Monthly Report"><i class="fa fa-download"></i> Generate PDF</a>
                          </td>
                        </tr>
					  @endforeach
                      </tbody>
                    </table>


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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
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
