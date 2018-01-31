<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
    <title>Login | Alcel Construction </title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

   <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/w3.css">
<style>
#flash-message {
    top: 28%;
    right: 10%;
    position: absolute;
    animation: flash-message 15s forwards;
}

@keyframes flash-message {
    0%   {opacity: 1;}
    100% {opacity: 0; display:none;}
}
</style>
</head>

<body>
<div class="cont">
	<div class="demo">
		<div class="login">
		  <div class="login__form">
			  <div class="w3-container w3-center w3-animate-zoom w3-margin-50">
				 <a href="{{ url ('') }}"><img src="images/logo.png" alt="" style="width:200px; top:80px; bottom:50px"></a>
			  </div>
				<div class="login__text">
				   <p> Sign In </p>
				</div>
        @if($flash = session('again'))
          <div class="alert alert-success" id="flash-message" role="alert">
            {{$flash}}
          </div>
        @endif
        <!--FORM-->
				<form method = "post" action="{{ url ('doLogin') }}">
				{{csrf_field()}}
					<div class="login__row">
						<div class="form-group col-md-12 col-sm-12 col-xs-24 w3-animate-left">
							<div>
								<select name = "loginType" class="form-control login__type">
									<option style="color:#000000;" value = "Admin">Administrator</option>
									<option style="color:#000000;" value = "Project Manager">Project Manager</option>
								</select>
							</div>
						</div>
					</div>
					<div class="login__row">
					  <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
						<path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
					  </svg>
					  <input type="text" class="login__input name" name = "user" placeholder="Username"/>
					</div>
					<div class="login__row">
					  <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
						<path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
					  </svg>
					  <input type="password" class="login__input pass" name = "pass" placeholder="Password"/>
					</div>
           	<button type="submit" class=" btn login__submit" name="submit" value="submit"><label style="color: #fff; margin-top: 10px;">Sign In</label></button>
				</form>
        <!--FORM-->

			</div>
		</div>
	</div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
