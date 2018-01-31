<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contract | Alcel Construction</title>
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

.contract-body {
    margin-left: 20px;
    padding: 1em;
    overflow: hidden;
    text-align: justify;
	font-size: 15px;
}

td, th {
    border: 1px solid black;
    text-align: left;
    padding: 6px;
}

.foot { 
	position: fixed; 
	bottom: -10px;  
	height: 50px;
	text-align: center;
	margin-left: 20px;
	page-break-after: always;
}
</style>
</head>
<body>

<div class="container">
@foreach($proj as $proj)
<header>
	<label><strong>Department of Public Works and Highways (DPWH)<strong> </label>
	<div class="contract-header">
		<p style="font-size: 13px; line-height:150%">
			<strong>Contract No &nbsp; &nbsp; &nbsp; :<strong>&nbsp; &nbsp; {{$proj->ci_no}} <br>
			<strong>Contract Name &nbsp;:<strong> &nbsp; {{$proj->ci_name}}
		</p>
	</div>
	<!--<img src="images/logoheader.png"  style="width:100%;">-->
</header>
	<div class="contract-header1">
		<p style="font-size: 14px; line-height:130%">
			Pangasinan 2nd District Engineering Office<br>
			Alvear St. Lingayen Pangasinan
		</p>
		<p style="font-size: 16px; line-height:130%">
			<strong> CONTRACT AGREEMENT </strong>
		</p>
		<p style="font-size: 12px; line-height:130%">
			<strong> FOR </strong>
		</p>
		<p style="font-size: 15px; line-height:130%; width: 70%; text-align: center; margin-left: 100px;">
			<strong> {{$proj->pi_title}} </strong>
		</p>
	</div>

<div class="contract-body">
  <p>
  THIS CONTRACT made and entered on this 
  {{date("jS", (strtotime($proj->ci_date)))}} day of
  {{date("F Y", (strtotime($proj->ci_date)))}}, at Lingayen,Pangasinan.
  </p>
  <p style="text-align: center; padding: 1em;">
  By and Between:
  </p>
  <p>
  @foreach($client as $client)
  The {{$client->cl_company}}, represented herein by {{$client->cr_first_name}} {{$client->cr_last_name}}
  duly authorized for this purpose, with main office address at {{$client->cl_address}}
  @endforeach
  herein referred to as the 'EMPLOYER'.
  </p>
  <p style="text-align: center; padding: 1em;">
  and
  </p>
  <p>
  ALCEL CONSTRUCTION, a sole organized and existing and by virtue of the laws of the Republic of the Philippines
  and licensed by the Philippine Contractors Accreditation Board (PCAB), with main ofice address at San Alaminos City,
  Pangasinan, represented herein by MR. ALEXANDER M. ANG, duly authorized for the purpose, hereinafter referred to as the "CONTRACTOR".
  </p>
  <p style="text-align: center; padding: 1em;">
  <u>WITNESSETH</u>
  </p>
  <p>
  WHEREAS, the EMPLOYER is desirous to have the Works for the project undertaken by Contract: {{$proj->ci_name}};
  </p>
  <p>
  WHEREAS, the CONTRACTOR represents itself as possessing the capability, expertise, technical knowledge, and immediately
  available resources needed for the works;
  </p>
  <p>
  WHEREAS, the award in the amount of NUMBER IN WORD Only <input type="hidden" id="num" value="{{$proj->cb_total}}"></input> (Php {{$proj->cb_total}}) was accepted by the CONTRACTOR;
  </p>
  <p>
  WHEREAS, the whole of the works of the Project as covered by this Contract shall be completed within the
  period of ONE HUNDRED FIFTY (150) CALENDAR DAYS (CD), from the Effectivity Date of Contract, based on the
  Notice to Proceed (NTP) to be issued by the EMPLOYER to the Contractor; and
  </p>
</div>

<div class="foot" style="text-align: center; position:fixed; bottom: 0px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:30%; height:100%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>
	
<header>
	<label><strong>Department of Public Works and Highways (DPWH)<strong> </label>
	<div class="contract-header">
		<p style="font-size: 13px; line-height:150%">
			<strong>Contract No &nbsp; &nbsp; &nbsp; :<strong>&nbsp; &nbsp; {{$proj->ci_no}} <br>
			<strong>Contract Name &nbsp;:<strong> &nbsp; {{$proj->ci_name}}
		</p>
	</div>
	<!--<img src="images/logoheader.png"  style="width:100%;">-->
</header>

<div class="contract-body">
  <p>
  WHEREAS, this Contract shall not be considered until the Contractor shall have furnished and delivered to 
  the EmMPLOYER all the requirements, including a Performance Security, acceptable to the Employer, in accordance
  with the provisions of Clause 7 of the General Conditions of Contract.
  </p>
  <p>
  NOW, THEREFORE, in view of the chuchu premises, the EMPLOYER and the CONTRACTOR have mutually chuchu chuchu chuchu
  contract subject to the following terms and condition:
  </p>
  <p>
  1. &nbsp; &nbsp; In this CONTRACT, Words and expressions shall have the same XXXXXX as are respectivily assigned <br>
  &nbsp; &nbsp; &nbsp; &nbsp; to them in the general Conditiotic Contrald XXXXXX referred to.
  </p>
  <p>
  2. &nbsp; &nbsp; The following documents shall be XXXXXX to from, and be XXXXXX and constred as part to this <br>
  &nbsp; &nbsp; &nbsp; &nbsp; contract, viz,
  </p>  
  <p>
	&nbsp; &nbsp; a. &nbsp; &nbsp; Sidding Document;<br>
	&nbsp; &nbsp; b. &nbsp; &nbsp; Drawings/Plant;<br>
	&nbsp; &nbsp; c. &nbsp; &nbsp; DPWH Standart Specifications for the Public Works and Highways;<br>
	&nbsp; &nbsp; d. &nbsp; &nbsp; Addends and/or Supplementat/Bid Bulletin, if any;<br>
	&nbsp; &nbsp; e. &nbsp; &nbsp; Contractro, Bid Induding Technical and Finandel Proposal the other documents/statemerts;<br>
	&nbsp; &nbsp; f. &nbsp; &nbsp; Approved Budget of the Contract, Program of Work and Detalled Coat Estimates;<br>
	&nbsp; &nbsp; g. &nbsp; &nbsp; Abstract of Bids;<br>
	&nbsp; &nbsp; h. &nbsp; &nbsp; Performanse Security;<br>
	&nbsp; &nbsp; i. &nbsp; &nbsp; Construction Scheduie and S-curve;<br>
	&nbsp; &nbsp; j. &nbsp; &nbsp; Manpower Schedule;<br>
	&nbsp; &nbsp; k. &nbsp; &nbsp; Equipment Utillzation Schedule;<br>
	&nbsp; &nbsp; l. &nbsp; &nbsp; Project Organizational Chart;<br>
	&nbsp; &nbsp; m. &nbsp; Constrution Methods;<br>
	&nbsp; &nbsp; n. &nbsp; &nbsp; Contractor,s All Risk Insuranse Policy;<br>
	&nbsp; &nbsp; o. &nbsp; &nbsp; Authoriby of Signing Officity;<br>
	&nbsp; &nbsp; p. &nbsp; &nbsp; Affidavit of No Tax Lizbifitios;<br>
	&nbsp; &nbsp; q. &nbsp; &nbsp; Construction Safeby and Health Program approved by DOLE;<br>
	&nbsp; &nbsp; r. &nbsp; &nbsp; Resolution of Award;<br>
	&nbsp; &nbsp; s. &nbsp; &nbsp; Notice of Award with Contractor's Conforme;<br>
	&nbsp; &nbsp; t. &nbsp; &nbsp; All relevant provisions of Republic Act (RA) 9184 and its revised implementing Rules and Regulations <br>
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(IRR) shall apply to this Contract;<br>
	&nbsp; &nbsp; u. &nbsp; &nbsp; Certificate of Availability of Funds; and<br>
	&nbsp; &nbsp; v. &nbsp; &nbsp; Other contract documents that may be required by existing laws and/or the EMPLOYER.<br>
  </p>
  <p>
  2. &nbsp; &nbsp; In consideration of the payments to be made by the EMPLOYER to the CONTRACTOR as hereinafter <br>
  &nbsp; &nbsp; &nbsp; &nbsp; mentioned, the CONTRACTOR, hereby XXXXXX to fully execute the  items of work at the unit prices<br>
  &nbsp; &nbsp; &nbsp; &nbsp; indicated in this Contract following strictly the approved plans and specifications and construction<br>
  &nbsp; &nbsp; &nbsp; &nbsp; schedule, namely:
  </p> 
</div>

<div class="foot" style="text-align: center; position:fixed; bottom: 0px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:30%; height:100%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>
	
<header>
	<label><strong>Department of Public Works and Highways (DPWH)<strong> </label>
	<div class="contract-header">
		<p style="font-size: 13px; line-height:150%">
			<strong>Contract No &nbsp; &nbsp; &nbsp; :<strong>&nbsp; &nbsp; {{$proj->ci_no}} <br>
			<strong>Contract Name &nbsp;:<strong> &nbsp; {{$proj->ci_name}}
		</p>
	</div>
	<!--<img src="images/logoheader.png"  style="width:100%;">-->
</header>

<table class="table table-striped" style="width: 100%; margin-top: 10px; border-collapse: collapse; text-align: center;">
	<thead style="background-color: #353959; color:#ffffff;">
		<tr>
			<th style="width: 5%;">#</th>
			<th style="width: 30%;">Description</th>
			<th style="text-align: center;">Unit Cost</th>
			<th style="text-align: center;">Quantiy</th>
			<th style="text-align: center;">Final Cost</th>
		</tr>
	</thead>
	<tbody style="font-size: 14px;">
		@php $plan2 = $plan @endphp
			@foreach($plan2 as $plan2)
                <tr>
					<td>{{$plan2->task_id}}</td>
					<td>{{$plan2->task_description}}</td>
					<td style="text-align: center;">{{$plan2->task_unit_cost.' / '.$plan2->task_unit}}</td>
					<td style="text-align: center;">{{$plan2->pt_qty}}</td>
					<td style="text-align: right;"><span> <?php $number = $plan2->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?></span> &nbsp;</td>
			@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Total:</strong></td>
					<td class="subtotal" style="text-align: right;"><strong>P <?php $number = $plan2->cb_total; echo number_format ( $number , "2" , "." , "," )?></strong> &nbsp;</td>
				</tr>
</table>

@endforeach

</div>

<!--<script>
var th = ['','thousand','million', 'billion','trillion'];
var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine']; 
var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];
var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']; 

var num = document.getElementById("num").value;
var words = toWords(num);
document.getElementById("endd").value = words;
function toWords(s)
{  
    s = s.toString(); 
    s = s.replace(/[\, ]/g,''); 
    if (s != parseFloat(s)) return 'not a number'; 
    var x = s.indexOf('.'); 
    if (x == -1) x = s.length; 
    if (x > 15) return 'too big'; 
    var n = s.split(''); 
    var str = ''; 
    var sk = 0; 
    for (var i=0; i < x; i++) 
    {
        if ((x-i)%3==2) 
        {
            if (n[i] == '1') 
            {
                str += tn[Number(n[i+1])] + ' '; 
                i++; 
                sk=1;
            }
            else if (n[i]!=0) 
            {
                str += tw[n[i]-2] + ' ';
                sk=1;
            }
        }
        else if (n[i]!=0) 
        {
            str += dg[n[i]] +' '; 
            if ((x-i)%3==0) str += 'hundred ';
            sk=1;
        }

        if ((x-i)%3==1)
        {
            if (sk) str += th[(x-i-1)/3] + ' ';
            sk=0;
        }
    }
    if (x != s.length)
    {
        var y = s.length; 
        str += 'point '; 
        for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';
    }
    return str.replace(/\s+/g,' ');
}
       </script>-->

</body>
</html>
