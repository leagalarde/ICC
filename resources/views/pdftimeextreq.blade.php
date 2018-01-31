<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Time Extension Request | Alcel Construction</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

<style>
div.container {
    width: 100%;
}

header, footer {
    color: black;
    background-color: white;
    clear: left;
    text-align: center;
}
.contract-header {
    color: black;
    text-align: left;
    border-bottom: 3px solid gray;
}
.contract-header1 {
    color: black;
    text-align: center;
    padding: 1em;
    margin-left: 15px;
}
.letter-header {
    color: black;
    text-align: left;
    padding: 1em;
	margin-top: 4%;
}

.contract-body {
    margin-left: 20px;
    padding: 1em;
    overflow: hidden;
    text-align: justify;
	font-size: 15px;
}

td, th {
    border: none;
    text-align: left;
    padding: 6px;
}

.foot { 
	position: fixed; 
	bottom: -10px;  
	height: 50px;
	text-align: center;
	margin-left: 20px;
}
</style>
</head>
<body>

<div class="container">
@foreach($ter as $ter)
<header>
	<label><strong>ALCEL CONSTRUCTION INC.<strong> </label>
	<div class="contract-header">
		<p style="font-size: 13px; line-height:150%">
			<strong>Request No &nbsp; &nbsp; &nbsp; :<strong>&nbsp; &nbsp; {{$ter->ter_id}} <br>
			<strong>Project Name &nbsp;&nbsp;:<strong> &nbsp; {{$ter->pi_title}}
		</p>
	</div>
	<!--<img src="images/logoheader.png"  style="width:100%;">-->
</header>

<label style="float:right; margin-top:5%;"> @php echo date("F d, Y", (strtotime("now"))) @endphp </label>

<div class="letter-header">
<strong>{{$ter->cr_first_name}} {{$ter->cr_last_name}}</strong><br>
{{$ter->cl_company}}<br>
{{$ter->cl_address}}<br>
{{$ter->cl_contact}}<br><br><br>
<label style="margin-top:2%;"><strong>Subject:&nbsp;</strong><u>Time Extension Request</u></label>
</div>

<div class="contract-body">
  <p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  In accordance with THE CONTRACT, we are requesting a TIME EXTENSION for the project:
  <strong>{{$ter->pi_title}}</strong>, of {{$ter->cl_company}}.
  The project has 
  @php echo date_diff(date_create($ter->proj_start_date),date_create($ter->proj_end_date))->format('%r%a day project limit') @endphp
  and has project completion date of 
 {{date("jS", (strtotime($ter->proj_end_date)))}} day of {{date("F Y", (strtotime($ter->ter_date)))}}.
 The project is {{$ter->proj_percentage}} percent complete.
  </p>
  <p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  The delay in completing the project is due to {{$ter->ter_reason}}.
  This factor caused the schedule of the project construction to be delayed.
  The Head Engineer have requested the time be extended to  
  <?php 
	$nodays = $ter->ter_days;
	$addd = '+ '.$nodays.' days';
	$newend = date('Y-m-d',strtotime($ter->proj_end_date. $addd)) ;
	echo date("jS", (strtotime($newend)));
	echo " day of ";
	echo date("F Y", (strtotime($newend)));
  ?>
  to complete the work (total of {{$ter->ter_days}} day/s extension).
  </p>
  <p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Your consideration of this request is appreciated.
  </p>
  <p>
  <br>
  <strong>Note:</strong>&nbsp;&nbsp;{{$ter->ter_remarks}}
  </p>
  
  <table style="width:100%; margin-top:10%;">
	<thead>
		<tr>
			<td>Signed by:<td>
			<td>Approved by:</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><td>
			<td></td>
		</tr>
		<tr>
			<td><td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:center">
				<strong>{{$ter->emp_first_name}} {{$ter->emp_last_name}}</strong><br>
				Head Engineer
			<td>
			<td style="text-align:center">
				<strong>{{$ter->cr_first_name}} {{$ter->cr_last_name}}</strong><br>
				District Engineer
			</td>
		</tr>
		<tr>
			<td><td>
			<td></td>
		</tr>
		<tr>
			<td><td>
			<td></td>
		</tr>
		<tr>
			<td><td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:center">
				
			<td>
			<td style="text-align:center">
				<strong>Alexander Ang</strong><br>
				CEO, Alcel Construction Inc.
			</td>
		</tr>
	</tbody>
  </table>

</div>

<div class="foot" style="text-align: center; position:fixed; bottom: 0px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:30%; height:100%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>


@endforeach

</div>

</body>
</html>
