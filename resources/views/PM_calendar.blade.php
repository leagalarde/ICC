@extends('layouts.dashboard')
@section('page_title','Calendar')
@section('page_content')

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
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
	
	<style>
	#fullcal {
		max-width: 900px;
		margin: 0 auto;
	}
	</style>

	
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form method="post" action="/editCalProjTask">
					{{csrf_field()}}
					<input type="hidden" id="proj_no" name="proj_no"> 
					<input type="hidden" id="id" name="id">
                      <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="task-title" name="task-title" required="required" placeholder="Task Title *">
                        <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					   <label> Start Date </label>
                        <input type="date" class="form-control" id="start_task" name="start_task" required="required" >
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
					  </div>
					  
					<div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
					   <label> Deadline</label>
                        <input type="date" class="form-control" id="end_task" name="end_task" required="required" >
						<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
					</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
		  </form>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->
	
	
	<script>

	$(document).ready(function() {
		
		$('#fullcal').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: new Date(),
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			selectHelper: true,
			eventClick: function(calEvent, jsEvent, view) {
				$.ajax
				({
					type : "get",
					url : '/getProjectTask',
					data : {"id" : calEvent.id},
					dataType: "json",
					success: function(response) {
						response.forEach(function(data){
							$('#CalenderModalEdit #proj_no').val(data.proj_no);
							$('#CalenderModalEdit #id').val(data.pt_id);
							$('#CalenderModalEdit #task-title').val(data.task_description);
							$('#CalenderModalEdit #start_task').val(data.pt_start_date).attr({
								"max" : data.pp_end_date,        // pp_start_date
								"min" : data.pp_start_date          // pp_end_date
							});
							$('#CalenderModalEdit #end_task').val(data.pt_end_date).attr({
								"max" : data.pp_end_date,        // pp_start_date
								"min" : data.pp_start_date          // pp_end_date
							});
						})
					}
				});
				$('#fc_edit').click();

					categoryClass = $("#event_type").val();

					$(".antosubmit2").on("click", function() {
					  calEvent.title = $("#title2").val();

					  calendar.fullCalendar('updateEvent', calEvent);
					  $('.antoclose2').click();
					});

					calendar.fullCalendar('unselect');
				  },
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: function(start, end, timezone, callback) {
				$.ajax
				({
					url : '/getMyTask',
					type : "get",
					dataType: "json",
					success: function(response) {
						var events = [];
						response.forEach(function(data){
							var color = ' ';
							if(data.pt_status == 'Complete') {
								color = 'rgb(33,186,69)';
							} else if(data.pt_status == 'Pending') {
								color = 'rgb(219,40,40)';
							} else {
								color: 'rgb(33,133,208)';
							}
							events.push ({
								id: data.pt_id,
								title: data.task_description,
								start: data.pt_start_date,
								end: data.pt_end_date,
								color: color,
							});
						});
						callback(events)	;
					}
				})
			}				
		});
      });
	
</script>
@stop