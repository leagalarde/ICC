@extends('layouts.dashboardAM') 
@section('page_title','Notification') 
@section('page_content')

<div class="">            
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Notification <small>Activity report</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                @php $empPic2 = $empPic @endphp
                @foreach($empPic2 as $empPic2)
                <img class="img-responsive avatar-view" src="images/profile/{{$empPic2->emp_image}}" alt="Avatar" title="Change the avatar">
              </div>
            </div>
            <h3>{{$empPic2->emp_first_name}} {{$empPic2->emp_last_name}}</h3>
            <ul class="list-unstyled user_data">
              <li><i class="fa fa-map-marker user-profile-icon"></i> {{$empPic2->emp_address}}
              </li>

              <li>
                <i class="fa fa-briefcase user-profile-icon"></i> {{$empPic2->el_position}}
              </li>

              <li class="m-top-xs">
                <i class="fa fa-external-link user-profile-icon"></i>
                <a target="_blank">{{$empPic2->emp_email}}</a>
              </li>
            </ul>

            <a href="/profileAdmin" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
            @endforeach
            <br />
            
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="profile_title">
              <div class="col-md-6">
                <h2>User Activity Report</h2>
              </div>
              <div class="col-md-6">
                <!--div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
</div-->
              </div>
            </div>

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                         
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                  <!-- start recent activity -->
                  <ul class="messages">
                    @foreach($not as $not)
                    <li>
                      <img src="images/profile/{{$not->emp_image}}" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-info"><?php echo date("d",strtotime($not->notif_date)); ?></h3>
                        <p class="month"><?php echo date("M",strtotime($not->notif_date)); ?></p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">{{$not->emp_first_name}}{{$not->emp_last_name}}</h4>
                        <blockquote class="message">
                          {{$not->notif_description}} <?php echo date("d",strtotime($not->notif_date)); ?>
                        </blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          <a href="{{$not->notif_url}}"><i ></i> 
                            Show Details </a>
                        </p>
                      </div>
                    </li>
                    @endforeach

                  </ul>
                  <!-- end recent activity -->

                </div>
              </div>
            </div>
          </div>
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
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
   
@stop