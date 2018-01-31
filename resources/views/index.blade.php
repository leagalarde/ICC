@extends('layouts.dashboardAM') 
@section('page_title','Project Add') 
@section('page_content')
<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel" >
				<div class="x_title">
					<h2>Add Project</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="container1">

						<div class="wrap-contact2">
							<form class="contact2-form validate-form">
								<div class="wrap-input2 validate-input" data-validate="Name is required">
									<input class="input2" type="text" name="name">
									<span class="focus-input2" data-placeholder="NAME"></span>
								</div>

								<div class="wrap-input2 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
									<input class="input2" type="text" name="email">
									<span class="focus-input2" data-placeholder="EMAIL"></span>
								</div>

								<div class="wrap-input2 validate-input" data-validate="Name is required">
									<select class="input2" name="name">
										<option value="" disabled selected></option>
										@foreach($company as $company)
										<option value="{{$company->cl_no}}">{{$company->cl_company}}</option>
										@endforeach
									</select>
									<span class="focus-input2" data-placeholder="Select Company Name"></span>
								</div>

								<div class="wrap-input2 validate-input" data-validate = "Message is required">
									<textarea class="input2" name="message"></textarea>
									<span class="focus-input2" data-placeholder="MESSAGE"></span>
								</div>
								
								<hr/>

								<div class="wrap-input2 validate-input" data-validate="Project Name is required">
									<input type="text" class="input2" id="project-name" name="project-name" maxlength="5">
									<span class="focus-input2" data-placeholder="Project Name"></span>
								</div>

								<div class="wrap-input2 validate-input" style="float:left; width: 30%" data-validate="Construction Site is required">
									<input type="text" class="input2" name="construction-site" id="construction-site">
									<span class="focus-input2" data-placeholder="Construction Site"></span>
								</div>
								
								<div class="wrap-input2 validate-input" style="float:right; width: 30%" data-validate="Select Project Manager">
									<select class="input2" id="project-manager" name="">
										<option value="" disabled selected></option>
										@foreach($promanager as $promanager)
										<option value="{{$promanager->emp_id}}">{{$promanager->emp_first_name}} {{$promanager->emp_last_name}} </option>
										@endforeach
									</select>
									<span class="focus-input2" data-placeholder="Select Project Manager"></span>
								</div>

								<div id="floor-nono" class="wrap-input2 validate-input" data-validate="Floor Number is required" style="display:noe">
									<input type="text" class="input2" name="floor-no" id="floor-no">
									<span class="focus-input2" data-placeholder="Floor No"></span>
								</div>

								<div id="floor-areaa" class="wrap-input2 validate-input" data-validate="Floor Area is required" style="display:noe">
									<input type="text" class="input2" name="floor-area" id="floor-area">
									<span class="focus-input2" data-placeholder="Floor Area"></span>
								</div>

								<div id="road-lengthh" class="wrap-input2 validate-input" data-validate="Road Length is required" >
									<input type="text" class="input2" name="road-length" id="road-length">
									<span class="focus-input2" data-placeholder="Road Length"></span>
								</div>

								<div id="road-typee" class="wrap-input2 validate-input" data-validate="Road Type is required">
									<input type="text" class="input2" name="road-type" id="road-type">
									<span class="focus-input2" data-placeholder="Road Type"></span>
								</div>

								<!--div class="form-group col-md-6 col-sm-6 col-xs-12 ">
									<label>Start & End Date</label>
									<fieldset>
										<div class="control-group">
											<div class="controls">
												<div class="input-prepend input-group">
													<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
													<input onchange="sync()" type="text" name="reservation" id="reservation" class="form-control" required>
												</div>
											</div>
										</div>
									</fieldset>
									<input type="hidden" id="start" name="project-start-date" required>
									<input type="hidden" id="end" name="project-end-date" required>
								</div-->

								<div>
									<div class="wrap-input2 data-validate" data-validate = "Project Description is required">
										<textarea class="input2" name="message" id="project-desc" rows="7" cols="50"></textarea>
										<span class="focus-input2" data-placeholder="Project Description"></span>
									</div>
								</div>


								<div class="container-contact2-form-btn">
									<div class="wrap-contact2-form-btn">
										<div class="contact2-form-bgbtn"></div>
										<button class="contact2-form-btn">
											Send Your Message
										</button>
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

<!--===============================================================================================-->
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css/util.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>
@stop