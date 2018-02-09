@extends('layouts.dashboardAdmin')
@section('page_title','Employee')
@section('page_content')

<div class="">

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" >
        <div class="x_title" style="margin-bottom: 20px;">
          <div class="title_left">
            <h4 style="margin-top: -3px;"> Employee <small>Query</small></h4>
          </div>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">
            This query will retrieve information from Employee table based on condition. 
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
		  
		  	<div class="col-md-4 col-sm-4 col-xs-24 form-group has-feedback">
				<label>First Name</label>
             	<input name="emp_first_name" required="required" placeholder="First Name " type="text" class="inpFname" minlength="2" style="margin-top:-.5%" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
            </div>
			
			<div class="col-md-4 col-sm-4 col-xs-24 form-group has-feedback">
				<label>Middle Name</label>
             	<input name="emp_middle_name" required="required" placeholder="Middle Name " type="text" class="inpMname" style="margin-top:-.5%" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
            </div>
			
			<div class="col-md-4 col-sm-4 col-xs-24 form-group has-feedback">
				<label>Last Name</label>
             	<input name="emp_last_name" required="required" placeholder="Last Name " type="text" class="inpLname" style="margin-top:-.5%" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
            </div>
			
			<div class="col-md-8 col-sm-8 col-xs-24 form-group has-feedback" style="margin-top:-1%">
				<label>Address</label>
           		<input type="text" class="inpAddress" name="emp_address" required="required" placeholder="Address" minlength="5" style="margin-top:-.5%">
          </div>
			
			<div class="col-md-4 col-sm-4 col-xs-24 form-group has-feedback" style="margin-top:-1%">
				<label>Email</label>
           		<input type="text" class="inpEmail" name="emp_Email" required="required" placeholder="Email" minlength="5" style="margin-top:-.5%">
          </div>
		  
            <div class="col-md-4 col-sm-4 col-xs-8 form-group " style="margin-top:-1%">
	             <label style="margin-bottom:5%">Position</label>
	             <select class="form-control inpPosition" name="emp_position" required="" style="margin-top:-.5%">
	              <option value="" disabled selected>Choose position</option>
	              <option value="Admin">Admin</option>
	              <option value="Project Manager">Project Manager</option>
	            </select>
          	</div>
			
			<div class="col-md-4 col-sm-4 col-xs-24 form-group " style="margin-top:-1%;" id="divstatus" >
	             <label style="margin-bottom:5%">Status</label>
	             <select class="form-control inpStatus" name="emp_Status" required="" style="margin-top:-.5%" id="inpStatus" disabled>
	              <option value="" selected>Choose Status</option>
	              <option value="Available">Available</option>
	              <option value="Deployed">Deployed</option>
	            </select>
          	</div>
			
			<div class="col-md-12 col-sm-12 col-xs-24 form-group " style="margin-top:2%">
              <button type="button" class="button searchemp" id="searchemp" style="width:100%" data-id="0"><i class="fa fa-search"></i> &nbsp Search</button>
            </div>
		  
          <table id="queryemptable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead style="background-color: #353959; color:#ffffff;">
              <tr>
                <th>Action</th>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Username</th>
                <!--th>Password</th-->
              </tr>
            </thead>
            <tbody>
             <tr>
              <td>
              </td>
              <td></td>
              <td>
               
             </td>
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


<!-- JAVASCRIPT - ADD, EDIT, DELETE -->
<!--script type="text/javascript">
  var fname = document.getElementById('emp_first_name');
  fname.oninvalid = function(event) {
    event.target.setCustomValidity('First name should only contain letters and required to have atleast 2 letters');
  }
</script-->
<script type="text/javascript">
 $('#addPhone').keypress(function(eve) {
    if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
      eve.preventDefault();
    }
  });
 $('#editPhone').keypress(function(eve) {
    if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
      eve.preventDefault();
    }
  });

	$('#addengineer').click(function () {
   $('#addModal').modal('show');
 });

  $('.edittype').click(function () {
    $.ajax
    ({
      type : "get",
      url : '/getEngineer',
      data : {"id" : $(this).data('id')},
      dataType: "json",
      success: function(response) {
        response.forEach(function(data){
          $('#editModal .id').val(data.emp_id);
          $('#editModal .inpFname').val(data.emp_first_name);
          $('#editModal .inpMname').val(data.emp_middle_initial);
          $('#editModal .inpLname').val(data.emp_last_name);
          var path = "/images/profile/" + data.emp_image;
          $('#editModal #blah').attr("src",path);
          $('#editModal .inpImage').val(data.emp_image);
          $('#editModal .inpAddress').val(data.emp_address);
          $('#editModal .inpEmail').val(data.emp_email);
          $('#editModal .inpPhone').val(data.emp_contact);
          $('#editModal .inpUser').val(data.username);
          $('#editModal .inpPass').val(data.password);
          $('#editModal select option[value="'+data.el_position+'"]').attr("selected","selected");
        })
      }
    });
    $('#editModal').modal('show');
  });

  $('.deletetype').click(function(){
    $('#delete-form .id').val($(this).data('id'));
    $('#deleteModal').modal('show');
  });
  
   $('.searchemp').click(function () {
   	$('#queryemptable').html('');
	if ($('.inpStatus').val() == 'Deployed') {
		$('#queryemptable').html('<thead style="background-color: #353959; color:#ffffff;"><tr><th style="width:10%">Employee ID</th><th style="width:11%"></th><th style="width:20%">Name</th><th style="width:15%">Position</th> <th>Username</th><th>Project</th></tr></thead>');
    }
	else {
		$('#queryemptable').html('<thead style="background-color: #353959; color:#ffffff;"><tr><th style="width:10%">Employee ID</th><th style="width:15%"></th><th style="width:30%">Name</th><th style="width:15%">Position</th> <th>Username</th></tr></thead>');
    }
	$.ajax
    ({
      type : "get",
      url : '/searchemp',
      data : {
	  		"fname" : $('.inpFname').val(),
	  		"mname" : $('.inpMname').val(),
	  		"lname" : $('.inpLname').val(),
	  		"address" : $('.inpAddress').val(),
	  		"position" : $('.inpPosition').val(),
	  		"status" : $('.inpStatus').val()
			},
      dataType: "json",
      success: function(response) {
	        response.forEach(function(data){
					var path 		= "/images/profile/" + data.emp_image;
					var name 	= data.emp_first_name + ' ' + data.emp_middle_initial + ' ' + data.emp_last_name;
					var col12 	= '<tr><td style="text-align:center">' + data.emp_id + '</td><td><img src="' + path + '" alt="your image" style="width:100%;"/></td>';
					var col3 		= '<td><strong><label style="color:black; font-size:1.2em">' + name + '</label></strong><br>' + data.emp_address + '<br>' + data.emp_contact+ '<br>' + data.emp_email + '<br></td>';
					var col45 	= '<td>' + data.el_position + '</td><td>' + data.username + '</td>';
					var col6 		='<td>' + '<a href="/project_detail?id=' + data.proj_no + '">' + data.pi_title + '</a></td></tr>';
					if ($('.inpStatus').val() == 'Deployed') {
						var row = col12+col3 +col45 +col6;
					}
					else {
						var row = col12+col3 +col45;
					}
				$('#queryemptable').append(row);   
        		})
      }
    });
  });
  
    $('.inpPosition').on('change', function () {
			var position = $('.inpPosition').val();
			if (position == 'Project Manager') {
   			 document.getElementById('inpStatus').disabled = false;
			 }
			 else if (position == 'Admin ') {
   			 document.getElementById('inpStatus').disabled = true;
			 document.getElementById('inpStatus').value = '';
			 }
			 else {
   			 document.getElementById('inpStatus').disabled = true;
			 document.getElementById('inpStatus').value = '';
			 }

  	});

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function() {
    readURL(this);
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
