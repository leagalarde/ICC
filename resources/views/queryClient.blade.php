@extends('layouts.dashboardAdmin') @section('page_title','Company') @section('page_content')

<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title" style="margin-bottom: 20px;">
                    <div class="title_left">
                        <h4>Client <small> Query</small></h4>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        It shows all company information including their address and contact information.
                    </p>
					
					<div class="col-md-8 col-sm-8 col-xs-24 form-group has-feedback">
						<label>Company Name</label>
		             	<input type="text" class="comName" name="comName" required="required" placeholder="Company Name" style="margin-top:-1%" minlength="2" pattern="[A-Za-z -]{2,}" title="Letters Only and atleast 2 characters">
					 </div>
					 
					<div class="col-md-4 col-sm-4 col-xs-24 form-group has-feedback" style="margin-top:-.25rem" >
						<label>Main Contact</label><br>
		             	<input type="text" class="MCFname" name="MCFname" required="required" placeholder="First" style="margin-top:-1%; width:49%" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
                        <input type="text" class="MCLname" name="MCLname" required="required" placeholder="Last" style="margin-top:-1%; width:49%" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
                    </div>    
					
					<div class="col-md-8 col-sm-8 col-xs-24 form-group has-feedback" style="margin-top:-1%">
						<label>Company Address</label>
		             	<input type="text" class="comAddress" name="comAddress" required="required" placeholder="Address" style="margin-top:-1%" minlength="2" pattern="[A-Za-z -]{2,}" title="Letters Only and atleast 2 characters">
					 </div>
					 
					 <div class="col-md-4 col-sm-4 col-xs-8 form-group " style="margin-top:-1%">
			             <label style="margin-bottom:5%">Status</label>
			             <select class="form-control comStatus" name="comStatus" required="" style="margin-top:-.5%">
			              <option value="" disabled selected>Choose Status</option>
			              <option value="Active">Active</option>
			              <option value="Inactive">Inactive</option>
			            </select>
		          	</div>
			
					<div class="col-md-12 col-sm-12 col-xs-24 form-group " style="margin-top:1%">
		              <button type="button" class="button searchclient" id="searchclient" style="width:100%" data-id="0"><i class="fa fa-search"></i> &nbsp Search</button>
		            </div>

                    <table id="queryclienttable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead style="background-color: #353959; color:#ffffff;">
                            <tr>
                                <th>Action</th>
                                <th style="width: 8%">ID</th>
                                <th style="width: 25%">Company Name</th>
                                <th style="width: 20%">Contact Person</th>
                                <th>Email</th>
                                <th>Contact #</th>
                                <th style="width: 30%">Company Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> </td>
                                <td></td>
                                <td></td>
								<td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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



<!-- EDIT ENGINEER -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #353959; color:#ffffff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" action="/editcompany">
                        {{csrf_field()}}
                        <input type="hidden" class="id" name="id">
                        <div class="input-field col s12">
                            <i class="large material-icons prefix" style="font-size: 37px">account_balance</i>
                            <input type="text" class="comName" name="comName" required="required" placeholder="Company Name *" minlength="2" pattern="[A-Za-z -]{2,}" title="Letters Only and atleast 2 characters">
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input type="email" class="comEmail" name="comEmail" required="required" placeholder="Email *">
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input type="text" class="comPhone" name="comPhone" required="required" placeholder="Phone *" id="phone" minlength="7" maxlength="15">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-top:2px;">
                            <input type="text" class="form-control has-feedback-left comAddress" name="comAddress" required="required" placeholder="Address" minlength="5">
                            <span class="form-control-feedback right"><i class="large material-icons prefix" style="font-size: 30px">home</i></span>
                        </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #353959;">
                <div class="form-group" style="margin-right:24%; margin-top: 10px; ">
                    <div class="col-md-12 col-sm-12 col-xs-24 ">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:-10px; ">Cancel</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT Client -->
<div class="modal fade" tabindex="-1" role="dialog" id="editcrModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #353959; color:#ffffff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Contact Person</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" action="/editclient">
                        {{csrf_field()}}
                        <input type="hidden" class="id" name="id">
                        <div class="input-field col s6">
                            <i class="large material-icons prefix" style="font-size: 37px">account_box</i>
                            <input type="text" class="clientFname" name="clientFname" required="required" placeholder="First Name *" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
                        </div>
                        <div class="input-field col s6">
                            <i class="large material-icons prefix">account_box</i>
                            <input type="text" class="clientLname" name="clientLname" required="required" placeholder="Last Name *" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input type="email" class="clientEmail" name="clientEmail" required="required" placeholder="Email *">
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input type="text" class="clientPhone" name="clientPhone" required="required" placeholder="Phone *" id="phone" minlength="7" maxlength="15">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-top:2px;">
                            <input type="text" class="form-control has-feedback-left clientAddress" name="clientAddress" required="required" placeholder="Address" minlength="5">
                            <span class="form-control-feedback right"><i class="large material-icons prefix" style="font-size: 30px">home</i></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-top:2px;">
                            <input type="text" class="form-control has-feedback-left clientPosition" name="clientPosition" required="required" placeholder="Position" minlength="3">
                            <span class="form-control-feedback right"><i class="large material-icons prefix" style="font-size: 30px">account_circle</i></span>
                        </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #353959;">
                <div class="form-group" style="margin-right:24%; margin-top: 10px; ">
                    <div class="col-md-12 col-sm-12 col-xs-24 ">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:-10px; ">Cancel</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Edit Details</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Company</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="/deletecompany" id="delete-form">
                    {{csrf_field()}}
                    <input type="hidden" name="id" class="id"> Are you sure you want to delete this company?
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
    $('.edittype').click(function() {
        $.ajax({
            type: "get",
            url: '/getCompany',
            data: {
                "id": $(this).data('id')
            },
            dataType: "json",
            success: function(response) {
                response.forEach(function(data) {
                    $('#editModal .id').val(data.cl_no);
                    $('#editModal .comName').val(data.cl_company);
                    $('#editModal .comAddress').val(data.cl_address);
                    $('#editModal .comEmail').val(data.cl_email);
                    $('#editModal .comPhone').val(data.cl_contact);
                })
            }
        });
        $('#editModal').modal('show');
    });
	
	  $('.editcr').click(function() {
        $.ajax({
            type: "get",
            url: '/getClient',
            data: {
                "id": $(this).data('id')
            },
            dataType: "json",
            success: function(response) {
                response.forEach(function(data) {
                    $('#editcrModal .id').val(data.cr_id);
                    $('#editcrModal .clientFname').val(data.cr_first_name);
                    $('#editcrModal .clientLname').val(data.cr_last_name);
                    $('#editcrModal .clientAddress').val(data.cr_address);
                    $('#editcrModal .clientEmail').val(data.cr_email);
                    $('#editcrModal .clientPhone').val(data.cr_contact);
                    $('#editcrModal .clientPosition').val(data.cr_position);
                })
            }
        });
        $('#editcrModal').modal('show');
    });

    $('.deletetype').click(function() {
        $('#delete-form .id').val($(this).data('id'));
        $('#deleteModal').modal('show');
    });
	
	  $('.searchclient').click(function () {
	   	$('#queryclienttable').html('');
		$('#queryclienttable').html('<thead style="background-color: #353959; color:#ffffff;"><tr><th style="width:5%">ID</th><th style="width:20%">Company Name</th><th style="width:15%">Contact Person</th><th style="width:15%">Email</th><th style="width:10%">Contact #</th><th style="width:20%">Company Address</th></tr></thead>');
   		$.ajax
	    ({
	      type : "get",
	      url : '/searchclient',
	      data : {
		  		"name" : $('.comName').val(),
		  		"fname" : $('.MCFname').val(),
		  		"lname" : $('.MCLname').val(),
		  		"address" : $('.comAddress').val(),
		  		"status" : $('.comStatus').val(),
				},
	      dataType: "json",
	      success: function(response) {
		        response.forEach(function(data){
						var name 	= data.cr_first_name + ' ' + data.cr_last_name;
						var col1	 	= '<tr><td style="text-align:center">' + data.cl_no + '</td>';
						var col2 		= '<td>' + data.cl_company + '</td>';
						var col3 		= '<td>' + name + '<br /><small style="font-size: .8rem;">' + data.cr_position + '</small></td>';
						var col4		=	'<td>'+ data.cl_contact+ '</td><td>' + data.cl_email +'</td><td>' + data.cl_address + '</td></tr>';
							
						var row = col1+ col2 + col3 + col4;
					
					$('#queryclienttable').append(row);   
	        		})
	      }
	    });
	  });

 $('#phone').keypress(function(eve) {
    if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
      eve.preventDefault();
    }
  });
</script>

@stop
