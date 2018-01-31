@extends('layouts.dashboard')
@section('page_title','Profile')
@section('page_content')
@php $var1 = $empPic @endphp
@php $var2 = $empPic @endphp
@php $var3 = $empPic @endphp
<div class="row" >
  <div class="col-md-12">
  <div class="x_panel">
    <div class="x_title">
      <h1>Edit <small>Profile</small></h1>
      <div class="clearfix"></div>
    </div>
    <div>
      <ul class="nav nav-tabs">
        <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
        <li><a href="#acount" data-toggle="tab">Password</a></li>
      </ul>
    </div>
    <div class="x_content ">
    <!-- left column -->
      <div class="tab-content">
          
            
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
            
          
        <div class="tab-pane fade in active" id="profile">
        <!--div class="tab-pane fade" id="acount"-->
          <form method="post" action="/PMeditProfile">
          <div class="col-md-3 col-sm-4 col-xs-7">
            <div class="text-center">
              @foreach($var1 as $var1)
                <img id="blah" src="images/profile/{{$var1->emp_image}}" class="img-responsive img-circle img-thumbnail" alt="image">
                <h6>Upload a different photo...</h6>
                <input type="file" onchange="previewPic()" class="text-center center-block well well-sm" name="emp_image" id="imgInp">
              @endforeach
            </div>
          </div>
        <!-- edit form column -->
          <div class="col-md-9 col-sm-8 col-xs-17 personal-info">  
            <h3>Personal info</h3>
              {{csrf_field()}}
              @foreach($var2 as $var2)
              <div class="form-group">
                <label class="col-lg-3 control-label">First name:</label>
                <div class="col-lg-8">
                  <input class="form-control" required value="{{$var2->emp_first_name}}" type="text" name="emp_first_name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Middle initial:</label>
                <div class="col-lg-8">
                  <input class="form-control" value="{{$var2->emp_middle_initial}}" type="text" name="emp_middle_initial">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Last name:</label>
                <div class="col-lg-8">
                  <input class="form-control" required value="{{$var2->emp_last_name}}" type="text" name="emp_last_name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Address:</label>
                <div class="col-lg-8">
                  <input class="form-control" required value="{{$var2->emp_address}}" type="text" name="emp_address">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Contact Number:</label>
                <div class="col-lg-8">
                  <input class="form-control" required value="{{$var2->emp_contact}}" type="number" name="emp_contact">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Position:</label>
                <div class="col-lg-8">
                  <input class="form-control" readonly value="{{$var2->el_position}}" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Email:</label>
                <div class="col-lg-8">
                  <input class="form-control" required value="{{$var2->emp_email}}" type="email" name="emp_email">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button type="submit" class="btn btn-success">Submit</button>
				</div>
              </div>
              @endforeach
            </div>
          </form>
        </div>
        
        <!--div class="tab-pane fade in active" id="profile"-->
        <div class="tab-pane fade" id="acount">
          <div class="form-group">
            <form method="post" action="/PMeditPassword">
              {{csrf_field()}}
              <div class="form-group col-md-5">
              @foreach($var3 as $var3)
              <div class="form-group td">
                <label class="col-md-5 control-label">Username:</label>
                <div class="col-md-6">
                  <input class="col-md-3 col-sm-3 col-xs-6 form-control" required value="{{$var3->username}}" type="text" name="username" id="username">
                </div>
              </div>
              <div class="form-group td">
                <label class="col-md-5 control-label">Password:</label>
                <div class="col-md-6">
                  <input class="form-control" value="{{$var3->password}}" type="password" name="password" id="password" onkeyup="checker()">
                </div>
              </div>
              <div class="form-group td">
                <label class="col-md-5 control-label">Confirm password:</label>
                <div class="col-md-6">
                  <input class="form-control" value="{{$var3->password}}" type="password" name="password_confirmation" id="password_confirmation" onkeyup="checker()">
                </div>
              </div>
              <div class="col-md-8 registrationFormAlert" id="passconfirm"></div>
              @endforeach
              <div class="form-group">
                <div class="col-md-8">
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button type="submit" class="btn btn-success">Submit</button>
				</div>
              </div>
              </div>
            </form>
          </div>
        </div>
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
<script>
  function checker() {
    var pass = document.getElementById('password').value;
    var cpass = document.getElementById('password_confirmation').value;
    
    if(pass == cpass){
      $("#passconfirm").html("Passwords match.");
    }else{
      $("#passconfirm").html("Passwords do not match!");
    }//if pass match
  }
</script>
<script>
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
        $('#flash').delay(800).fadeIn('normal', function() {
            $(this).delay(800).fadeOut();
        });
    });
</script>

@stop