@extends('layouts.dashboardAdmin')
@section('page_title','Plans')
@section('page_content')

          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title" style="margin-bottom: 20px;">
                    <div class="title_left">
						<h4>Contract Plan <small>List</small></h4>
						<div style="margin-top: -50px;">
                            <button type="button" class="button" id="addplan"><i class="fa fa-plus"></i> &nbsp Add Contract Plan</button>
						</div>
					</div> 
			 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    It allows you to add, edit, delete contract plans.
					</p>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead style="background-color: #353959; color:#ffffff;">
                        <tr>
                          <th style="width: 10%; text-align:center;">ID</th>
                          <th>Description</th>
                          <th>Unit</th>
                          <th>Price</th>
                          <th style="width: 20%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($var as $var)
                        <tr>
                          <td>{{$var->plan_id}}</td>
                          <td>{{$var->plan_description}}</td>
                          <td>{{$var->plan_unit}}</td>
                          <td>{{$var->plan_unit_cost}}</td>
                          <td>
                            <button class="btn btn-info btn-xs edittype" data-id="{{$var->plan_id}}"><i class="fa fa-pencil"></i> Edit </button>
                            <button class="btn btn-delete deletetype" data-id="{{$var->plan_id}}"><i class="fa fa-trash-o"></i> Delete </button>
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
	
	
	
	<!-- ADD PLAN -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #353959; color:#ffffff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add Contract Plan</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="/addplan">
						{{csrf_field()}}
						<div class="input-field col s12">
							<i class="large material-icons prefix" style="font-size: 37px">business</i>
							<input name="plan_description" placeholder="Description *" required type="text">
						</div>
						<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                            <label style="font-size: 15px;">Unit</label>
							<div class="input-field col s12">
								<input name="plan_unit" placeholder="e.g. Kgs, Cu.m., Sq.m." required type="text">
							</div>
                        </div>
						<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                            <label style="font-size: 15px;">Unit Cost *</label>
							<div class="input-field col s12">
								<input type="text" class="plan_unit_cost" name="plan_unit_cost" placeholder="0.00" required >
							</div>
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

<!-- EDIT PLAN -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #353959; color:#ffffff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit Contract Plan</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="/editplan">
						{{csrf_field()}}
						<input type="hidden" class="id" name="id">	
						<div class="input-field col s12">
							<i class="large material-icons prefix" style="font-size: 37px">business</i>
							<input type="text" class="inpPdesc" name="plan_description" placeholder="Description *" required >
						</div>
						<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                            <label style="font-size: 15px;">Unit</label>
							<div class="input-field col s12">
								<input type="text" class="inpPunit" name="plan_unit" placeholder="e.g. Kgs, Cu.m., Sq.m." required>
							</div>
                        </div>
						<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                            <label style="font-size: 15px;">Unit Cost *</label>
							<div class="input-field col s12">
								<input type="text" class="plan_unit_cost" name="plan_unit_cost" placeholder="0.00" required >
							</div>
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
                                            <h4 class="modal-title" id="myModalLabel">Delete Contract Plan</h4>
                                        </div>
                                        <div class="modal-body">
										<form method="post" action="/deleteplan" id="delete-form">
                                        {{csrf_field()}}
										   <input type="hidden" name="id" class="id">
                                           Are you sure you want to delete this contract plan?
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
<script type="text/javascript">
	$('#addplan').click(function () {
	  $('#addModal').modal('show');
	});

    $('.edittype').click(function () {
        $.ajax
        ({
            type : "get",
            url : '/getPlan',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editModal .id').val(data.plan_id);
                    $('#editModal .inpPdesc').val(data.plan_description);
                    $('#editModal .inpPunit').val(data.plan_unit);
                    $('#editModal .plan_unit_cost').val(data.plan_unit_cost);
                })
            }
        });
        $('#editModal').modal('show');
    });

    $('.deletetype').click(function(){
        $('#delete-form .id').val($(this).data('id'));
        $('#deleteModal').modal('show');
    });
	
	 $('.plan_unit_cost').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
    eve.preventDefault();
  }
     
// this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
 $('.plan_unit_cost').keyup(function(eve) {
  if($(this).val().indexOf('.') == 0) {    $(this).val($(this).val().substring(1));
  }
 });
});
  
</script>

@stop