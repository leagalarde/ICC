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
            <h4 style="margin-top: -3px;"> Employee<small>List</small></h4>
            <div style="margin-top: -40px;">
              <button type="button" class="button addengineer" id="addengineer"><i class="fa fa-plus"></i> &nbsp Add Employee</button>
            </div>
          </div>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">
            Project Management Department is responsible for modern management as well as an understanding of the design and construction process.
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
                <th>Action</th>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Username</th>
                <!--th>Password</th-->
              </tr>
            </thead>
            <tbody>
             @foreach($var as $var)
             <tr>
              <td>
                <button class="btn  edittype" data-id="{{$var->emp_id}}"><i class="fa fa-pencil"></i> Edit </button>
                <button class="btn-delete deletetype " data-id="{{$var->emp_id}}"><i class="fa fa-trash-o"></i> Delete </button>
              </td>
              <td><img src="/images/profile/{{$var->emp_image}}" alt="your image" style="width:100px;"/></td>
              <td>
               <strong><label style="color:black; font-size:1.2em">{{$var->emp_first_name.' '.$var->emp_middle_initial.' '.$var->emp_last_name}}</label></strong><br>
               {{$var->emp_address}}<br>
               {{$var->emp_contact}}<br>
               {{$var->emp_email}}<br>
             </td>
             <td>{{$var->el_position}}</td>
             <td>{{$var->username}}</td>
             <!--td>{{$var->password}}</td-->
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



<!-- ADD ENGINEER -->
<div class="modal fade addModal" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header" style="background-color: #353959; color:#ffffff;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <form id="add" method="post" action="/addengineer">
          {{csrf_field()}}
          <div class="input-field col s6">
            <i class="large material-icons prefix" style="font-size: 37px">account_box</i>
            <input id = "emp_first_name" name="emp_first_name" required="required" minlength="2" placeholder="First Name *" type="text" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" name="emp_middle_initial" placeholder="Middle Name(optional)" pattern="[A-Za-z ]{1,}" title="Letters Only">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" name="emp_last_name" required="required" placeholder="Last Name *" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
            <i class="material-icons prefix">phone</i>
            <input id="addPhone" type="text" name="emp_contact" required="required" placeholder="Phone *" pattern=".{7,15}" title="minimum of 7 numbers and maximum of 15 numbers">
          </div>
          <div class="input-field col s6" style="text-align:center; margin-top:-4px;">
            <img id="blah" src="/images/profile/eng2.jpg" alt="your image" style="width:100%;"/>
            <div style="text-align:center; margin-top:10px; margin-left:30px;">
              <input type='file' onchange="previewPic()" name="emp_image" id="imgInp" />
            </div>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input type="email" name="emp_email" required="required" placeholder="Email *">
          </div>

          <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-top:2px;">
            <input type="text" class="form-control has-feedback-left" name="emp_address" required="required" placeholder="Address" minlength="5">
            <span class="form-control-feedback right"><i class="large material-icons prefix" style="font-size: 30px">home</i></span>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" >
             <label>Position</label>
             <select class="form-control" name="el_position" required>
              <option value="" disabled selected>Select position</option>
              <option value="Admin">Admin</option>
              <option value="Project Manager">Project Manager</option>
            </select>
          </div>
        </div>
        <div class="input-field col s6">
         <i class="material-icons prefix">person</i>
         <input type="text" name="username" required="required" placeholder="Username" minlength="3" maxlength="15">
       </div>
       <div class="input-field col s6">
         <i class="material-icons prefix">lock</i>
         <input type="password" name="password" required="required" placeholder="Password" minlength="3">
       </div>
     </div>
   </div>
   <div class="modal-footer" style="background-color: #353959;">
     <div class="form-group" style="margin-right:24%; margin-top: 10px; ">
      <div class="col-md-12 col-sm-12 col-xs-24 ">
       <button type="button" class="btn btn-delete" data-dismiss="modal" style="margin-top:-10px; ">Cancel</button>
       <button class="btn btn-primary" type="reset">Reset</button>
       <button type="submit" class="btn btn-success">Submit</button>
     </div>
   </div>
 </div>
</form>
</div>
</div>
</div>

<!-- EDIT ENGINEER -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #353959; color:#ffffff;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
			</div>
			<div class="modal-body">
        <div class="row">
          <form method="post" action="/editengineer">
            {{csrf_field()}}
            <input type="hidden" class="id" name="id">
            <div class="input-field col s6">
             <i class="large material-icons prefix" style="font-size: 37px">account_box</i>
             <input name="emp_first_name" required="required" placeholder="First Name *" type="text" class="inpFname" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
             <i class="material-icons prefix">account_circle</i>
             <input type="text" name="emp_middle_initial" placeholder="Middle Name(optional)" class="inpMname" pattern="[A-Za-z ]{1,}" title="Letters Only">
             <i class="material-icons prefix">account_circle</i>
             <input type="text" name="emp_last_name" required="required" placeholder="Last Name *" class="inpLname" minlength="2" pattern="[A-Za-z ]{2,}" title="Letters Only and atleast 2 characters">
             <i class="material-icons prefix">phone</i>
             <input type="text" id="editPhone" name="emp_contact" required="required" placeholder="Phone *" class="inpPhone" minlength="7" maxlength="15" title="minimum of 7 numbers and maximum of 15 numebrs">
           </div>
           <div class="input-field col s6" style="text-align:center;">
             <img id="blah" src="" alt="your image" style="width:100%;"/>
             <div style="text-align:center; margin-top:20px; margin-left:30px;">
               <input type='file' onchange="previewPic()" name="emp_image" id="imgInp"/>
             </div>
           </div>
           <input type="hidden" class="inpImage" id="image">
           <div class="input-field col s12">
             <i class="material-icons prefix">email</i>
             <input type="email" class="inpEmail" name="emp_email" required="required" placeholder="Email *">
           </div>
           <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-top:2px;">
             <input type="text" class="form-control has-feedback-left inpAddress" name="emp_address" required="required" placeholder="Address" minlength="5">
             <span class="form-control-feedback right"><i class="large material-icons prefix" style="font-size: 30px">home</i></span>
           </div>
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" >
             <label>Position</label>
             <select class="form-control inpPosition" name="el_position" required="">
              <option value="" disabled selected>Choose your position</option>
              <option value="Admin">Admin</option>
              <option value="Project Manager">Project Manager</option>
            </select>
          </div>
        </div>

        <div class="input-field col s6">
         <i class="material-icons prefix">person</i>
         <input type="text" class="inpUser" name="username" required="required" placeholder="Username" minlength="3" maxlength="15">
       </div>
       <div class="input-field col s6">
         <i class="material-icons prefix">lock</i>
         <input type="password" class="inpPass" name="password" required="required" placeholder="Password">
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

<!-- DELETE Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Delete Employee</h4>
    </div>
    <div class="modal-body">
      <form method="post" action="/deleteengineer" id="delete-form">
        {{csrf_field()}}
        <input type="hidden" name="id" class="id">
        Are you sure you want to delete this employee?
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
