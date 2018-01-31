<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project Financial | Alcel Construction</title>
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
        
        .task td,
        th,
        tr {
            border-collapse: collapse;
            padding: 1px;
            border: 1.5px solid black;
            text-align: left;
        }
        
        .task thead {
            border-collapse: collapse;
            padding: 6px;
            border: 1.5px solid black;
            text-align: left;
        }
        
        table {
            border-collapse: collapse;
            padding: 6px;
            border: 1px solid black;
        }
        
        .theader td,
        th {
            border: 1.5px solid black;
            text-align: left;
            padding: 6px;
            border-collapse: collapse;
        }
        
        td,
        th {
            padding: 6px;
        }

    </style>
</head>

<body>

    <div class="container">
        @foreach($fin as $fin)
        <img src="images/logoheader.png" alt="" style="width:25%; height:6%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); float:left; margin-left: .75%; margin-top: 1%;">
        <table class="theader" style="width:100%">
            <tr>
                <td rowspan="3" style="text-align: center; width: 28%;"></td>
                <th rowspan="3" style="text-align: center; width: 45%;"><u>PROJECT FINANCIAL REPORT</u></th>
                <td style="font-size: .72em; width: 27%"></td>
            </tr>
            <tr>
                <td style="font-size: .72em;">Rev. </td>
            </tr>
            <tr>
                <td style="font-size: .72em;">Effective Date: @php echo date("F d, Y", (strtotime("now"))) @endphp</td>
            </tr>
        </table>

        <p class="contract-header1" style="font-size: 14px; line-height:130%">
            <strong>Project Name :</strong> {{$fin->pi_title}}<br>
            <strong>Location Site&nbsp;&nbsp;:</strong> {{$fin->pi_construction_site}}<br>
            <strong>Contract ID &nbsp;: </strong> <label style="text-transform: uppercase;">{{$fin->ci_no}}</label>
		</p>
        @endforeach

<table class="task" style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		@foreach($proj as $proj)
            
        <tr style="font-size: .74em;">
			<td rowspan="3" style="width: 45%; text-align: center;"> </td>
            <?php
            $totalCost = $proj->cb_total;
            $startdate =$proj->proj_start_date;
            $diff = date_diff(date_create($proj->proj_start_date),date_create($proj->proj_end_date))->format('%r%a');
            //$diff = 277;
            $divide = floor($diff/15);
            $mod = $diff%15;
            $odd = 0;
            if($divide % 2 != 0){
                $divide -= 1;
                $odd = 1;
            }
            $divi = $divide;
            $divide /= 2;
            
            $ABC = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            
            for($ctr = 1;$ctr<$divide+1;$ctr++){
                $display = $ABC[$ctr-1];
                echo '<td colspan="2" style="width: 10%; text-align: center;">'.$display.'</td>';
            }//for
            if($mod > 0){
                $display = $ABC[$ctr-1];
                echo '<td colspan="2" style="width: 10%; text-align: center;">'.$display.'</td>';
            }//if

            ?>
        </tr>
		<tr style="font-size: .6em;">
        <?php
            for($ctr = 1;$ctr<$divide+1;$ctr++){
                echo '<td style="width: 5%; text-align: center;">15</td>
                      <td style="width: 5%; text-align: center;">15</td>';
            }//for  
            if($mod > 0){
                if($odd == 1){
                    echo '<td style="width: 5%; text-align: center;">15</td>';
                    echo '<td style="width: 5%; text-align: center;">'.$mod.'</td>';
                }else{
                    echo '<td style="width: 5%; text-align: center;">'.$mod.'</td>';
                    echo '<td style="width: 5%; text-align: center;">-</td>';
                }//if
            }//if
        ?>  
		</tr>
		<tr style="font-size: .5em;">';
        <?php   
            $ctr2 = 0;
            for($ctr = 1;$ctr<$divide+1;$ctr++){
                $ctr2 += 15;
                echo '<td style="width: 5%; text-align: center;">'.$ctr2.'</td>';
                $ctr2 += 15;
                echo '<td style="width: 5%; text-align: center;">'.$ctr2.'</td>';   
            }//for
            if($mod > 0){
                if($odd == 1){
                    $ctr2 += 15;
                    echo '<td style="width: 5%; text-align: center;">'.$ctr2.'</td>';
                    $ctr2 += $mod;
                    echo '<td style="width: 5%; text-align: center;">'.$ctr2.'</td>';
                }else{
                    $ctr2 += $mod;
                    echo '<td style="width: 5%; text-align: center;">'.$ctr2.'</td>';
                    echo '<td style="width: 5%; text-align: center;">-</td>';
                }//if else
                
            }//if else if
        ?>
		</tr>
        @endforeach
	</thead>
  @foreach($proj_history as $key=>$proj_history)
    <?php 
      $pphdate[$key] = $proj_history->pph_date;
      $pphper[$key] = $proj_history->pph_percentage;
      $pphadded[$key] = $proj_history->pph_percentage_added;
    ?>
  @endforeach
  <?php 
    $ifctr = 0;
    $elsectr = 0;
    $divide2 = $divide*2;
    $startadd1 = 0;
    $startadd2 = 15;
    $pphadd = 0;
    $accomplishment = [];
    $accoctr = 0;
            
    $accupphadd = 0;
    $accuaccom = [];
            
    $makeitdecimal;
    $cashget = 0;
    $cash = [];
            
    $accucashget = 0;
    $accucash = [];
    
    if($mod > 0){
      $divide2 += 1;  
    }// if mod > 0
    if($odd == 1){
      $divide2 += 1;
    }// if there is an odd
    
    for($fif = 0, $startadd1=0, $startadd2=15;$fif<$divide2; $fif++, $startadd1 += 15, $startadd2 += 15){
      //echo '$divide2 = '.$divide2.' $fif='.$fif.' original = 1='.$startadd1.' original = 2='.$startadd2.'<br>';
      if($mod > 0 && $fif == $divide2-1){
        for($x = 0; $x < $ifctr; $x++ ){
          $startadd1 += 15;
          $startadd2 += 15;
        }
        for($y = 0; $y < $elsectr; $y++ ){
          $startadd1 -= 15;
          $startadd2 -= 15;
        }
        //echo '$divide2 = '.$divide2.' $fif='.$fif.' +15 = 1='.$startadd1.' +15 = 2='.$startadd2.'<br>';
        $startadd1 -= 15;
        $startadd2 -= 15;
        //echo '$divide2 = '.$divide2.' $fif='.$fif.' -15 = 1='.$startadd1.' -15 = 2='.$startadd2.'<br>';
        $startadd1 += $mod;
        $startadd2 += $mod;
        //echo '$divide2 = '.$divide2.' $fif='.$fif.' +'.$mod.' = 1='.$startadd1.' +'.$mod.' = 2='.$startadd2.'<br>';
      }//if it is in the end of loop and checking if there is a mod
      if($fif < count($pphdate)){
        if(date("Y-m-d",strtotime($pphdate[$fif])) >= date("Y-m-d",strtotime($startdate."+".$startadd1." days")) && date("Y-m-d",strtotime($pphdate[$fif])) < date("Y-m-d",strtotime($startdate."+".$startadd2." days")) ){ 
          $accoctr += 1;
          $pphadd = $pphadded[$fif];
          $accupphadd += $pphadded[$fif];
          $makeitdecimal = $pphadded[$fif] / 100;
          $cashget = $totalCost * $makeitdecimal;
          $accucashget += $totalCost * $makeitdecimal;
          $ctr = $fif+1;
                
          for($ctr2 = $ctr; $ctr2<count($pphdate);$ctr2++){
            if(date("Y-m-d",strtotime($pphdate[$ctr2])) >= date("Y-m-d",strtotime($startdate."+".$startadd1." days")) && date("Y-m-d",strtotime($pphdate[$ctr2])) < date("Y-m-d",strtotime($startdate."+".$startadd2." days")) ){ 
              $pphadd += $pphadded[$ctr2];
              $accupphadd += $pphadded[$ctr2];
              $makeitdecimal = $pphadded[$ctr2] / 100;
              $cashget += $totalCost*$makeitdecimal;
              $accucashget += $totalCost*$makeitdecimal;
            }//if
          }//for
          $accomplishment[$accoctr] = $pphadd;
          $accuaccom[$accoctr] = $accupphadd;
          $cash[$accoctr] = $cashget;
          $accucash[$accoctr] = $accucashget;
        }else{
          if(date("Y-m-d",strtotime($pphdate[$fif])) < date("Y-m-d",strtotime($startdate."+".$startadd1." days"))){
            $startadd1 -= 15;
            $startadd2 -= 15;
            $ifctr += 1;
          }elseif(date("Y-m-d",strtotime($pphdate[$fif])) > date("Y-m-d",strtotime($startdate."+".$startadd2." days"))){
            $accoctr += 1;
            $fif -= 1;
            $elsectr += 1;
            $accomplishment[$accoctr] = '-';
            $accuaccom[$accoctr] = $accupphadd;
            $cash[$accoctr] = '-';
            $accucash[$accoctr] = $accucashget;
          }//if else
        }//if else
      }//if           
      $pphadd = 0;
      $cashget = 0;
    }//for  
  ?>
	<tbody>
		<tr style="font-size: .75em;">
			<td style=" text-align: center;">ACCOMPLISHMENT</td>
          <?php
            for($result = 1; $result <= $divide2 ; $result++){
              if($result <= count($accomplishment)){
                if($accomplishment[$result] == 0){
                  $accomplishment[$result] = '-';
                }else{
                  $accomplishment[$result] = number_format((float)$accomplishment[$result],2,".",",");
                }//if it is empty
                
                echo '<td style=" text-align: center;">'.$accomplishment[$result].'</td>';
              }else{
                echo '<td style=" text-align: center;">-</td>';
              }
            }
          ?>
          
        </tr>
        <tr style="font-size: .75em;">
			<td style=" text-align: center; ">CUMULATIVE ACCOMPLISHMENT</td>
            <?php
            for($result = 1; $result <= $divide2 ; $result++){
              if($result <= count($accuaccom)){
                if($accuaccom[$result] == 0){
                  $accuaccom[$result] = '-';
                }else{
                  $accuaccom[$result] = number_format((float)$accuaccom[$result],2,".",",");
                }//if it is empty
                echo '<td style=" text-align: center;">'.$accuaccom[$result].'</td>';
              }else{
                echo '<td style=" text-align: center;">-</td>';
              }
            }
            ?>
        </tr>
        <tr style="font-size: .75em;">
			<td style=" text-align: center; ">CASHFLOW</td>
        	<?php
            for($result = 1; $result <= $divide2 ; $result++){
              if($result <= count($cash)){
                $format = number_format((float)$cash[$result],2,".",",");
                echo '<td style=" text-align: center;">'.$format.'</td>';
              }else{
                echo '<td style=" text-align: center;">-</td>';
              }
            } 
            ?>
        </tr>
        <tr style="font-size: .75em;">
			<td style=" text-align: center; ">CUMULATIVE CASHFLOW</td>
            <?php
            for($result = 1; $result <= $divide2 ; $result++){
              if($result <= count($accucash)){
                $format = number_format((float)$accucash[$result],2,".",",");
                echo '<td style=" text-align: center;">'.$format.'</td>';
              }else{
                echo '<td style=" text-align: center;">-</td>';
              }
            }
            ?>
        </tr>
	</tbody>
</table>


</div>

<div class="foot" style="text-align: center; position:fixed; bottom: 40px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:20%; height:5%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>
</body>
</html>
