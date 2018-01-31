@extends('layouts.dashboardPM')
@section('page_title','Phase')
@section('page_content')

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h1>My Milestones</h1>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
          It shows all approved plans and specifications including the following work of items at the unt prices.
        </p>
        <!-- start project list -->
        <table id="datatable-responsive" class="table table-striped projects">
          <thead style="background-color: #353959; color:#ffffff;">
            <tr>
              <th style="width: 5%">#</th>
              <th style="width: 20%">Task</th>
              <th style="width: 20%">Project</th>
              <th>Start Date</th>
              <th>Deadline</th>
              <th style="width: 20%">Progress (%)</th>
              <!--th style="width: 10%">Action</th-->
            </tr>
          </thead>
          <tbody>
           @foreach($phase as $phase)
           <tr>
            <td>{{$phase->phase_id}}</td>
            <td>
              <a style="font-size: 18px;">{{$phase->phase_title}}</a>
              <br />
              <small>{{$phase->phase_description}}</small>
            </td>
            <td>
              <h4>{{$phase->pi_title}}</h4>
            </td>
            <td>
              <h5>{{$phase->pp_start_date}}</h5>
            </td>
            <td>
              <h5>{{$phase->pp_end_date}}</h5>
            </td>
            <td>
              <div class="project_progress" style="text-align:center;">
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$phase->pp_percentage}}"></div>
                </div>
                <small>{{$phase->pp_percentage}}% Complete</small>
              </div>
            </td>
                <!--td>
                  <button class="btn btn-primary editmilestone" type="button"  data-id="{{$phase->pp_id}}"><i class="fa fa-pencil"></i> Edit </button>
                </td-->
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
  <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="/editProjectTask">
           {{csrf_field()}}
           <input type="hidden" id="proj_no" name="proj_no"> 
           <input type="hidden" id="id" name="id">
           <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" id="task-title" name="task-title" required="required" placeholder="Task Title *">
            <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
          </div> 

          <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
            <label> Assigned Milestone</label>
            <select class="form-control" id="select_taskphase" name="select_taskphase">
              <option value="" disabled selected>Select Project Manager</option>

            </select>
          </div>

          <div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
            <label> Task Status</label>
            <select class="form-control" id="select_taskstatus" name="select_taskstatus">
              <option value="" disabled selected>Select Project Status</option>
              <option value="Pending">Pending</option>
              <option value="On Going">On Going</option>
              <option value="Complete">Complete</option>
            </select>
          </div>

          <div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
            <label> Percentage Complete</label>
            <select class="form-control" id="select_taskpercent" name="select_taskpercent">
              <option value="0">0%</option>
              <option value="10">10%</option>
              <option value="20">20%</option> 
              <option value="30">30%</option>
              <option value="40">40%</option>
              <option value="50">50%</option>
              <option value="60">60%</option>
              <option value="70">70%</option>
              <option value="80">80%</option>
              <option value="90">90%</option>
              <option value="100">100%</option>
            </select>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label> Estimated Budget </label>
            <input type="number" class="form-control" id="task_cost" name="task_cost" required="required" >
            <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
          </div>

          <div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
            <label> Expense</label>
            <input type="number" class="form-control" id="task_expense" name="task_expense" required="required" >
            <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
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

          <div id="alert" class="alert alert-success col-md-12 col-sm-12 col-xs-24" style="display: none; margin-top: 5%;">
            <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
          </div>
        </div>
        <div class="modal-footer"style="margin-top: 0%">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Edit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
		// Get data for editTask Modal
		$('.editmilestone').click(function () {
      $.ajax
      ({
        type : "get",
        url : '/getProjectTask',
        data : {"id" : $(this).data('id')},
        dataType: "json",
        success: function(response) {
          response.forEach(function(data){
            $('#editTask #proj_no').val(data.proj_no);
            $('#editTask #id').val(data.pt_id);
            $('#editTask #task-title').val(data.task_description);
            $('#editTask #start_task').val(data.pt_start_date).attr({
						"max" : data.pp_end_date,        // substitute your own
						"min" : data.pp_start_date          // values (or variables) here
					});
            $('#editTask #end_task').val(data.pt_end_date).attr({
						"max" : data.pp_end_date,        // substitute your own
						"min" : data.pp_start_date          // values (or variables) here
					});
            $('#editTask #task_cost').val(data.pt_cost);
            $('#editTask #task_expense').val(data.pt_expense);
            $('#editTask select option[value="'+data.pt_status+'"]').attr("selected","selected");
            $('#editTask select option[value="'+data.pt_percentage+'"]').attr("selected","selected");
            if (data.pt_percentage == 100) {   
						$("#editTask #alert").show("fast"); //Slide Down Effect
					}
					else {
						$("#editTask #alert").hide();
					}
          $('#editTask select option[value="'+data.phase_id+'"]').attr("selected","selected");
        })
        }
      });
      $('#editTask').modal('show');
    });

	// Task status and percentage	
  $('#select_taskpercent').on('change', function(){
   if($('#select_taskpercent').val()==0){
    $('#select_taskstatus option[value="Pending"]').prop('selected', true);
  }else if ($('#select_taskpercent').val()==100){
    $('#select_taskstatus option[value="Complete"]').prop('selected', true);
  }else {
    $('#select_taskstatus option[value="On Going"]').prop('selected', true);
  }
});
  $('#select_taskstatus').on('change', function(){
   if($('#select_taskstatus').val()=='Pending'){
    $('#select_taskpercent option[value="0"]').prop('selected', true);
  }else if ($('#select_taskstatus').val()=='Complete'){
    $('#select_taskpercent option[value="100"]').prop('selected', true);
  }else {
    $('#select_taskpercent option[value="10"]').prop('selected', true);
  }
});
</script>

	<!-- DELETE Modal>		
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
                                    <!-- /.modal-content ->
                                </div>
                                <!-- /.modal-dialog ->
                            </div>
                            <!-- /.modal -->
                            @stop