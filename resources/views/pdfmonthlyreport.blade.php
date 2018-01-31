<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Monthly Report | Alcel Construction</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

<style>
div.container {
    width: 100%;
	font-family: Arial, Helvetica, sans-serif;
}

.contract-header1 {
    color: black;
    text-align: left;
    padding: 1em;
    margin-left: 30px;
}

.contract-body {
    margin-left: 20px;
    padding: 1em;
    overflow: hidden;
    text-align: justify;
	font-size: 15px;
}

.task td, th, tr {
    border-collapse : collapse;
    padding: 1px;
	border: 1.5px solid black;
    text-align: left;
}

.task thead {
    border-collapse : collapse;
    padding: 6px;
	border: 1.5px solid black;
    text-align: left;
}

table{
    border-collapse : collapse;
    padding: 6px;
    border: 1px solid black;
}

.theader td, th {
    border: 1.5px solid black;
    text-align: left;
    padding: 6px;
	border-collapse : collapse;
}

td, th {
    padding: 6px;
}

</style>
</head>
<body>

<div class="container">
@foreach($proj as $proj)
<img src="images/logoheader.png" alt="" style="width:28%; height:12%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); float:left; margin-left: .75%; margin-top: 2.5%;">
<table class="theader" style="width:100%">
  <tr>
    <td rowspan="3" style="text-align: center; width: 28%;"></td>
    <th rowspan="3" style="text-align: center; width: 45%;"><u>MONTHLY PROJECT STATUS REPORT</u></th>
    <td style="font-size: .72em; width: 27%">Form No.</td>
  </tr>
  <tr>
    <td style="font-size: .72em;">Rev. </td>
  </tr>
  <tr>
    <td style="font-size: .72em;">Effective Date: @php echo date("F d, Y", (strtotime("now"))) @endphp</td>
  </tr>
</table>

		<p class="contract-header1" style="font-size: 14px; line-height:130%">
			<strong>Project &nbsp; :</strong> {{$proj->pi_title}}<br>
			<strong>Location :</strong> {{$proj->pi_construction_site}}<br>
			<strong>Month&nbsp;&nbsp;&nbsp;&nbsp; : </strong> <label style="text-transform: uppercase;">@php echo date("F", (strtotime("now"))) @endphp</label>
		</p>
		
<table style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		<tr style="font-size: .8em;">
			<td colspan="4" > &nbsp; I. PROJECT DESCRIPTION</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 25%; font-size: .7em;">
			@if ($proj->ci_desc == 'Vertical') 
					No. of Floors <br>
					Building Floor Areas <br>
			
			@else 
					Road Type <br>
					Total Road Length <br>
			
			@endif
					Total No. of Days <br>
					Date Start
			</td>
			<td style="width: 25%; font-size: .7em;">
			@if ($proj->ci_desc == 'Vertical') 
					: &nbsp; {{$proj->pi_floor_no}} <br>
					: &nbsp; @php echo $proj->pi_floor_area * $proj->pi_floor_no @endphp sq.m.<br>
			
			@else 
					: &nbsp; {{$proj->pi_road_type}} <br>
					: &nbsp; {{$proj->pi_road_length}} km<br>
			
			@endif
					: &nbsp; @php echo date_diff(date_create($proj->proj_start_date),date_create($proj->proj_end_date))->format('%r%a days') @endphp <br>
					: &nbsp; {{$proj->proj_start_date}}
			</td>
			<td style="width: 25%; font-size: .7em;">
					Date End <br>
					Total Project Cost <br>
					Project In-charge <br>
					<br>
			</td>
			<td style="width: 25%; font-size: .7em;">
					: &nbsp; {{$proj->proj_end_date}} <br>
					: &nbsp; P <?php $number = $proj->cb_total; echo number_format ( $number , "2" , "." , "," )?> <br>
					: &nbsp; {{$proj->emp_first_name}} {{$proj->emp_last_name}} <br>
					<br>
			</td>
		</tr>
	</tbody>
</table>
		
<table style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		<tr style="font-size: .8em;">
			<td colspan="4" > &nbsp; II. ACCOMPLISHMENT REPORT</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 25%; font-size: .7em;">
					Actual Accomplishment(%) <br>
					Projected Accomplishment(%) <br>
					Variance(%) <br>
					Variance(days)
			</td>
			<td style="width: 25%; font-size: .7em;">
					: &nbsp; {{$proj->proj_percentage}}%<br>
					: &nbsp; <br>
					: &nbsp; <br>
					: &nbsp; 
			</td>
			<td style="width: 25%; font-size: .7em;">
					Days Accumulated <br>
					Days Remaining <br>
					<br>
					<br>
			</td>
			<td style="width: 25%; font-size: .7em;">
					: &nbsp; @php echo date_diff(date_create($proj->proj_start_date),date_create("now"))->format('%r%a days') + 1; @endphp <br>
					: &nbsp; @php echo date_diff(date_create("now"),date_create($proj->proj_end_date))->format('%r%a days') @endphp <br>
					<br>
					<br>
			</td>
		</tr>
	</tbody>
</table>


<table class="task" style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		<tr style="font-size: .8em;">
			<td colspan="4" > &nbsp; III. PROJECT CONCERNS</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 5%;"></td>
			<td style="width: 5%; border: none;"></td>
			<td style="width: 25%; font-size: .7em; text-align: center; border-left: none;">
				DESCRIPTION
			</td><td style="width: 25%; font-size: .7em; text-align: center;">
				REMARKS
			</td>
		</tr>
		<tr>
			<td style="width: 5%;"></td>
			<td style="width: 5%; text-align: center;"></td>
			<td style="width: 25%; font-size: .7em; text-align: center;">
				DESCRIPTION
			</td><td style="width: 25%; font-size: .7em; text-align: center;">
				REMARKS
			</td>
		</tr>
	</tbody>
</table>

<table class="task" style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		<tr style="font-size: .8em;">
			<td colspan="4" > &nbsp; IV. ON-GOING ACTIVITIES</td>
		</tr>
	</thead>
	<tbody style="font-size: .7em; text-align: center;">
		<tr>
			<td style="width: 5%; text-align: center;"></td>
			<td style="width: 5%; border: none;text-align: center;"></td>
			<td style="width: 25%; border-left: none; text-align: center;">
				DESCRIPTION
			</td><td style="width: 25%; text-align: center;">
				REMARKS
			</td>
		</tr>
		@php $task1 = $task @endphp
		@foreach($task1 as $task1)
		@if(date("m",strtotime($task1->pt_start_date)) == date("m",strtotime("now"))) 
		<tr>
			<td style="width: 5%; text-align: center;" ></td>
			<td style="width: 5%;text-align: center;"> {{$task1->task_id}}</td>
			<td style="width: 25%; text-align: center;">
				{{$task1->task_description}}
			</td>
			<td style="width: 25%; text-transform: uppercase; text-align: center;">
				{{$task1->pt_status}} ( {{$task1->pt_percentage}}% )
			</td>
		</tr>
		@endif
		@endforeach
	</tbody>
</table>

<table class="task" style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		<tr style="font-size: .8em;">
			<td colspan="4" > &nbsp; IV. LOOK-AHEAD (3 weeks)</td>
		</tr>
	</thead>
	<tbody>
		<tr style="font-size: .7em; text-align: center;">
			<td style="width: 5%;"></td>
			<td style="width: 5%; border: none;"></td>
			<td style="width: 25%; border-left: none; text-align: center;">
				DESCRIPTION
			</td><td style="width: 25%;text-align: center;">
				REMARKS
			</td>
		</tr>
		@php $task2 = $task @endphp
		@foreach($task2 as $task2)
		@if(date("Y-m-d",strtotime($task2->pt_start_date)) <= date("Y-m-d",strtotime("+3 weeks")) && date("Y-m-d",strtotime($task2->pt_start_date)) >= date("Y-m-d",strtotime("now"))) 
		<tr style="font-size: .7em; text-align: center;">
			<td style="width: 5%;"></td>
			<td style="width: 5%;"> {{$task2->task_id}}</td>
			<td style="width: 25%; text-align: center;">
				{{$task2->task_description}}
			</td>
			<td style="width: 25%; text-transform: uppercase; text-align: center;">
				{{$task2->pt_status}} ( {{$task2->pt_percentage}}% )
			</td>
		</tr>
		@endif
		@endforeach
	</tbody>
</table>

<table class="task" style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		<tr style="font-size: .8em;">
			<td> &nbsp; V. OTHER REMARKS</td>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>

<table style="width:100%; border: none; margin-left: 15px; margin-top: 15px;">
		<tr>
			<td style="font-size: .8em;">Prepared by: </td>
			<td style="font-size: .8em;">Noted by: </td>
		</tr>
		<tr>
			<td>_____________________ </td>
			<td>_____________________ </td>
		</tr>
</table>

</div>

<div class="foot" style="text-align: center; position:fixed; bottom: 40px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:30%; height:10%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>
	
@endforeach
</body>
</html>
