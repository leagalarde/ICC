<html>
<!--head>
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
    
  <- validation ->
  <script src="../vendors/validation/dist/jquery.validate.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      $('#loginForm').validate({
          rules: {
              username: {
                  minlength: 3,
                  maxlength: 15,
                  required: true
              },
              password: {
                  minlength: 3,
                  maxlength: 15,
                  required: true
              }
          },
          highlight: function(element) {
              $(element).closest('.form-group').addClass('has-error');
          },
          unhighlight: function(element) {
              $(element).closest('.form-group').removeClass('has-error');
          },
          errorElement: 'span',
          errorClass: 'help-block',
          errorPlacement: function(error, element) {
              if (element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
              } else {
                  error.insertAfter(element);
              }
          }
      });

    });
  </script>
  <script type="text/javascript">
    window.onload = function() {
      if (window.jQuery) {  
        // jQuery is loaded  
        alert("Yeah!");
      } else {
        // jQuery is not loaded
        alert("Doesn't Work");
      }
    }
  </script>
  <script type="text/javascript">
    var form = $('#formvalidation');
    if(form.data('validator')){
      // validator exists   
      alert("Yeah!!");  
    }
  </script>
</head-->  
<head>
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Smoke -->
  <link href="smoke/css/smoke.min.css" rel="stylesheet">

  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Smoke -->
  <script src="smoke/js/smoke.min.js"></script>

</head>
<body>
 <div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <!-- Float -->
      <form id="formFloat">
        <div class="form-group">
          <label class="control-label">Currency</label>
            <input type="text" class="form-control" data-smk-type="currency" required>
        </div>
        <button type="submit" class="btn btn-default" id="btnFloat">Convert Float</button>
      </form>
      <hr />
      
      <!-- Currency -->
      <form id="formCurrency">
        <div class="form-group">
          <label class="control-label">Currency</label>
            <input type="text" class="form-control" data-smk-type="currency" required>
        </div>
        <button type="submit" class="btn btn-default" id="btnCurrency">Convert Currency</button>
      </form>
      <hr />
      
      <!-- Show pass -->
      <form>
        <div class="form-group">
          <label class="control-label">Show Password</label>
          <input type="password" class="form-control" id="showPass" value="Smoke3">
        </div>
      </form>
      <hr />
      
      <!-- Hide email -->
      <form id="formHideEmail">
        <div class="form-group">
          <label class="control-label">Email</label>
            <input type="email" class="form-control" value="alfredobarronc@gmail.com" required>
        </div>
        <button type="submit" class="btn btn-default" id="btnHideEmail">Hide email</button>
      </form>
      <hr />
      
      <!-- URL -->
      <a href="" class="btn btn-default" id="btnGetUrl">Get URL</a>
      <hr />
      
      <!-- Date -->
      <form id="formDate">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label class="control-label">Date</label>
              <input type="text" class="form-control" id="date" value="12-30-2015">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label class="control-label">Format</label>
              <input type="text" class="form-control" id="format" value="dd/MM/yyyy">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-default" id="btnDate">Customize</button>
      </form>
      <hr />
      
      <!-- Difference Dates-->
      <form id="formDateDiff">
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Date 1</label>
              <input type="text" class="form-control" id="date1" value="09/25/2014">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Date 2</label>
              <input type="text" class="form-control" id="date2" value="09/30/2014">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Interval</label>
              <input type="text" class="form-control" id="interval" value="days">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-default" id="btnDateDiff">Difference</button>
      </form>
    </div>
  </div>
</div>
<!--script>
  $('#login').click(function() {
    if( $('#loginForm').smkValidate() ){
      // Code here
      $.smkAlert({
        text: 'Validate!',
        type: 'success'
      });
    }
  });
</script-->
<script type="text/javascript">
  // Float
$('#btnFloat').click(function(e) {
  e.preventDefault();
  if($('#formFloat').smkValidate()){
    var float = $.smkFloat($('#formFloat input').val());
    $.smkAlert({
      text: float,
      type:'success'
    });
  }
});

// Currency
$('#btnCurrency').click(function(e) {
  e.preventDefault();
  if($('#formCurrency').smkValidate()){
    var currency = $.smkCurrency($('#formCurrency input').val(), '$');
    $.smkAlert({
      text: currency,
      type:'success'
    });
  }
});

// Show pass
$('#showPass').smkShowPass();

// Hide email
$('#btnHideEmail').click(function(e) {
  e.preventDefault();
  if($('#formHideEmail').smkValidate()){
    var email = $.smkHideEmail($('#formHideEmail input').val());
    $.smkAlert({
      text: email,
      type:'success'
    });
  }
});

// URL
$('#btnGetUrl').click(function(e) {
  e.preventDefault();
  var url = $.smkGetURL();
  $.smkAlert({
    text: url,
    type:'success'
  });
});

// Date
$('#btnDate').click(function(e) {
  e.preventDefault();
  var date = $.smkDate({
    date: $('#formDate #date').val(),
    format: $('#formDate #format').val()
  });
  $.smkAlert({
    text: date,
    type:'success'
  });
});

// Difference Dates
$('#btnDateDiff').click(function(e) {
  e.preventDefault();
  var date = $.smkDateDiff({
    fromDate: $('#formDateDiff #date1').val(),
    toDate: $('#formDateDiff #date2').val(),
    interval: $('#formDateDiff #interval').val()
  });
  $.smkAlert({
    text: date + ' ' + $('#formDateDiff #interval').val(),
    type:'success'
  });
});
</script>
</body>

</html>
