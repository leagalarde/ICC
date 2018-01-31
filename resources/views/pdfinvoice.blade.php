<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Invoice | Alcel Construction</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

<style>
div.container {
    width: 100%;
	font-family: Arial, Helvetica, sans-serif;
}

.contract-header1 {
    color: black;
    padding: 1em;
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

.task{
    border-collapse : collapse;
    padding: 6px;
    border: 1px solid black;
}

.theader td, th {
    text-align: left;
    padding: 6px;
}

td, th {
    padding: 6px;
}

</style>
</head>
<body>
@foreach($proj as $proj)
<table class="theader" style="width:100%; border-collapse : collapse;">
  <tr>
	<td rowspan="3" style="font-size: 1em; width: 40%; text-align:left">
		<strong>Invoice</strong> #{{$proj->invoice_no}}<br>
		<strong>Payment Due:</strong> @php echo date("F d, Y", (strtotime($proj->invoice_due))) @endphp<br>
		<strong>Account: </strong> {{$proj->proj_no}}
	</td>
    <td rowspan="3" style="text-align: center; width: 20%;"></td>
    <td rowspan="3" style="text-align: center; width: 40%; border:none"></td>
<img src="images/logoheader.png" alt="" style="width:30%; height:14%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); float:right; margin-left: .75%; margin-top:-10%;">
  </tr>
</table>
<table class="theader" style="width:100%">
  <tr>
	<td  style="font-size: .9em; width: 50%; text-align:left">
		From
		<strong>Alcel Construction Inc</strong>
        <br>Quezon Avenue, Poblacion
        <br>Alaminos City, Pangasinan
        <br>Phone: 1 (075) 552-7511
        <br>Email: alcelconstruction@gmail.com
	</td>
    <td  style="font-size: .9em; width: 50%; text-align:left">
		 To
        <strong>{{$proj->cr_first_name}} {{$proj->cr_last_name}}</strong>
        <br>{{$proj->cl_company}}
        <br>{{$proj->cl_address}}
        <br>Phone: {{$proj->cl_contact}}
        <br>Email: {{$proj->cl_email}}
	</td>
  </tr>
</table>

<p>
<br>
<br>
<strong>Subject:</strong> <u>Request for Partial Payment<u/>
</p>
<p>
<br>
Sir/Mam:
</p>
<p>
<br>
As a contractor for the <strong>{{$proj->pi_title}}</strong>, I would like to request from your good office
payment for our <u><?php $number = $proj->proj_percentage; echo number_format ( $number , "0" , "." , "," )?>% work accomplish</u> for the said project.
</p>

    <table class="task" style="width:100%; border: 1.5px solid black; margin-top:10px;">
		<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
			<tr>
				<th>Contract Plan</th>
				<th style="text-align:center">Cost</th>
				<th style="text-align:center">Quantiy</th>
				<th>Final Cost</th>
			</tr>
		</thead>
		<tbody style="font-size: 14px;">
		@php $task1 = $task @endphp
		@foreach($task1 as $task1)
			<tr>
				<td>{{$task1->task_description}}</td>
				<td>{{$task1->task_unit_cost.' / '.$task1->task_unit}}</td>
				<td style="text-align:center">{{$task1->pt_qty}}</td>
				<td><span><strong>
					P <?php $number = $task1->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>
				</strong></span></td>
			</tr>
		@endforeach
			<tr>
				<td colspan="3" align="right" style="text-align: left;" class="quote-align-left" style="font-size: 18px;">Total Cost:</td>
				<td class="subtotal"><strong>P <?php $number = $expense; echo number_format ( $number , "2" , "." , "," )?></strong></td>
			</tr>
			<tr>
				<td colspan="3" align="right" style="text-align: left;" class="quote-align-left" style="font-size: 18px;">Invoice Amount (Accumulated Percentage <?php $number = $proj->proj_percentage - $invoiceper; echo number_format ( $number , "14" , "." , "," )?> %):</td>
				<td class="subtotal bg-green"><strong>P <?php $number = $expense * ($proj->proj_percentage * .01); echo number_format ( $number , "2" , "." , "," )?></strong></td>
			</tr>
		</tbody>
	</table>
	
	
<p>
<br>
Any favorable action to my request is highly appreciated by the undersigned.
</p>
<p>
Thank you and good day.
</p>
						
	<table style="width:100%; border: none; margin-left: 15px; margin-top: 30px;">
		<tr>
			<td style="font-size: .8em;">Prepared by: </td>
			<td style="font-size: .8em;">Signed by: </td>
		</tr>
		<tr>
			<td style="text-align: center">
				______________________ <br>
				<strong>Alexander M. Ang</strong><br>
				Proprietor/Manager
				
			</td>
			<td style="text-align: center">
				______________________ <br>
				<strong>{{$proj->cr_first_name}} {{$proj->cr_last_name}}</strong><br>
				{{$proj->cr_position}}
			</td>
		</tr>
</table>
               
@endforeach
<div class="foot" style="text-align: center; position:fixed; bottom: 40px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:30%; height:10%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>


</body>
</html>
