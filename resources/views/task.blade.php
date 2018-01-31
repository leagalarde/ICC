@extends('layouts.dashboardAdmin')
@section('page_title','Task')
@section('page_content')

         <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title" style="margin-bottom: 20px;">
                    <div class="title_left">
						<h4 style="margin-top: -4px;">Tasks <small>Information</small></h4>
						<div style="margin-top: -42px;">
                            <button type="button" class="button" id="addtask"><i class="fa fa-plus"></i> &nbsp Add Task</button>
						</div>
					</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    It shows list of tasks that will included in project phases.
					</p>
                    @if(count($errors))
                    <div class='form-group' id = 'flash'>
                      <div class = 'alert alert-danger'>
                        <ul>
                          @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    @endif
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead style="background-color: #353959; color:#ffffff;">
                        <tr>
                          <th>Phase</th>
                          <th style="width: 10%;">Item No.</th>
                          <th style="width: 10%;">Description</th>
                          <th>Type</th>
                          <th style="width: 10%;">Unit</th>
                          <th style="width: 20%;">Unit Cost</th>
                          <th style="width: 20%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($var as $var)
                        <tr>
                          <td>{{$var->phase_title}}</td>
                          <td>{{$var->task_item_no}}</td>
                          <td>{{$var->task_description}}</td>
                          <td>{{$var->task_type}}</td>
                          <td>{{$var->task_unit}}</td>
                          <td>{{$var->task_unit_cost}}</td>
                          <td>
                            <button class="btn btn-info btn-xs edittype" data-id="{{$var->task_id}}"><i class="fa fa-pencil"></i> Edit </button>
                            <button class="btn btn-delete deletetype" data-id="{{$var->task_id}}"><i class="fa fa-trash-o"></i> Delete </button>
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



	<!-- ADD TASK -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #353959; color:#ffffff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add Project Task</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="/addtask">
						{{csrf_field()}}
						<div class="input-field col-md-9 col-sm-9 col-xs-18" >
							<i class="large material-icons prefix" style="font-size: 37px">business</i>
							<input class="inpTdesc" name="task_description" placeholder=" Task Description *" required type="text">
						</div>

						<div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback" style="margin-top: 2%">
							<input class="inpTitemno" name="task_item_no" placeholder=" Item No *" required type="text">
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label style="font-size: 15px;">Unit</label>
							<div class="input-field col s12">
								<input type="text" class="inpPunit" name="plan_unit" onkeydown="Check(event);" onkeyup="Check(event);" placeholder="e.g. Kgs, Cu.m., Sq.m." required>
							</div>
                        </div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label style="font-size: 15px;">Unit Cost *</label>
							<div class="input-field col s12">
								<input type="text" id="unit_cost" class="plan_unit_cost" name="plan_unit_cost" placeholder="0.00" required >
							</div>
                        </div>

						<div class="form-group col-xs-6">
							<label>Phase</label>
							<select class="form-control inpTphase" name="task_phase" required>
								<option value="" disabled selected>Select Phase</option>
								@php $type2 = $type @endphp
								@foreach($type2 as $type2)
									<option value="{{$type2->phase_id}}">{{$type2->phase_title}} : {{$type2->phase_description }}</option>
								@endforeach
								</select>
						</div>
						<div class="form-group col-xs-6">
							<label>Task Type</label>
							<select class="form-control inpTtype" name="task_type" required>
								<option value="" disabled selected>Select Task Type</option>
								<option value="Horizontal"> Horizontal (eg. roads & motorways) </option>
								<option value="Vertical"> Vertical (eg. buildings & houses) </option>
								<option value="Both"> Both </option>
							</select>
						</div>
				</div>
				<div class="modal-footer" style="background-color: #353959; color:#ffffff;">
					<div class="form-group" style="margin-left:5%%; ">
						<div class="col-md-9 col-sm-9 col-xs-12 ">
							<button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top:-10px; ">Cancel</button>
							<button class="btn btn-primary" type="reset">Reset</button>
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
  </div>
</div>

<!-- EDIT TASK -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #353959; color:#ffffff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit Project Task</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="/edittask">
						{{csrf_field()}}
						<input type="hidden" class="id" name="id">
						<div class="input-field col-md-9 col-sm-9 col-xs-18" >
							<i class="large material-icons prefix" style="font-size: 37px">business</i>
							<input class="inpTdesc" name="task_description" placeholder=" Task Description *" required type="text">
						</div>

						<div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback" style="margin-top: 2%">
							<input class="inpTitemno" name="task_item_no" placeholder=" Item No *" required type="text">
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label style="font-size: 15px;">Unit</label>
							<div class="input-field col s12">
								<input type="text" class="inpPunit" name="plan_unit" onkeydown="Check(event);" onkeyup="Check(event);" placeholder="e.g. Kgs, Cu.m., Sq.m." required>
							</div>
                        </div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label style="font-size: 15px;">Unit Cost *</label>
							<div class="input-field col s12">
								<input type="text" id="task_unit_cost" class="inpPUnitCost" name="plan_unit_cost" placeholder="0.00" required >
							</div>
                        </div>

						<div class="form-group col-xs-6">
							<label>Phase</label>
							<select class="form-control inpTphase" name="task_phase" required>
								<option value="" disabled selected>Select Phase</option>
								@php $type2 = $type @endphp
								@foreach($type2 as $type2)
									<option value="{{$type2->phase_id}}">{{$type2->phase_title}} : {{$type2->phase_description }}</option>
								@endforeach
								</select>
						</div>
						<div class="form-group col-xs-6">
							<label>Task Type</label>
							<select class="form-control inpTtype" name="task_type" required>
								<option value="" disabled selected>Select Task Type</option>
								<option value="Horizontal"> Horizontal (eg. roads & motorways) </option>
								<option value="Vertical"> Vertical (eg. buildings & houses) </option>
								<option value="Both"> Both </option>
							</select>
						</div>

				</div>
				<div class="modal-footer" style="background-color: #353959; color:#ffffff;">
					<div class="form-group" style="margin-left:5%%; ">
						<div class="col-md-9 col-sm-9 col-xs-12 ">
							<button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top:-10px; ">Cancel</button>
							<button class="btn btn-primary" type="reset">Reset</button>
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- DELETE PLAN -->
		<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
			<div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Task</h4>
                                        </div>
                                        <div class="modal-body">
										<form method="post" action="/deletetask" id="delete-form">
                                        {{csrf_field()}}
										   <input type="hidden" name="id" class="id">
                                           Are you sure you want to delete this task?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-delete">Delete</button>
                                        </div>
										</form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


	<!-- JAVASCRIPT - ADD, EDIT, DELETE -->
<script>
function Check(e) {
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58) {
        e.preventDefault();
    }
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
	// Validate company-phone (INT)
	$('#unit_cost').keypress(function(eve) {
		if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
		eve.preventDefault();
		}
	});
    $('#task_unit_cost').keypress(function(eve) {
		if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
		eve.preventDefault();
		}
	});
  });
	$('#addtask').click(function () {
	  $('#addModal').modal('show');
	});

    $('.edittype').click(function () {
        $.ajax
        ({
            type : "get",
            url : '/getTask',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editModal .id').val(data.task_id);
                    $('#editModal .inpTitemno').val(data.task_item_no);
                    $('#editModal .inpTdesc').val(data.task_description);
                    $('#editModal .inpTpercentage').val(data.task_percentage);
                    $('#editModal .inpPunit').val(data.task_unit);
                    $('#editModal .inpPUnitCost').val(data.task_unit_cost);
                    $('#editModal select option[value="'+data.phase_id+'"]').attr("selected","selected");
                    $('#editModal select option[value="'+data.task_type+'"]').attr("selected","selected");
                })
            }
        });
        $('#editModal').modal('show');
    });

    $('.deletetype').click(function(){
        $('#delete-form .id').val($(this).data('id'));
        $('#deleteModal').modal('show');
    });

</script>
<script>
    $(function() {
        $('#flash').delay(500).fadeIn('normal', function() {
            $(this).delay(1500).fadeOut();
        });
    });
</script>
@stop
