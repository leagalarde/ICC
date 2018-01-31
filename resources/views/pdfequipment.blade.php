<!DOCTYPE html>
<html lang="en">

<head>
    <title>Equipment Utilization Schedule | Alcel Construction</title>
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
        
        .equip td,
        th,
        tr {
            border-collapse: collapse;
            padding: 1px;
            border: 1.5px solid black;
            text-align: left;
        }
        
        .equip thead {
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
                <th rowspan="3" style="text-align: center; width: 45%;"><u>Equipment Utilization Schedule</u></th>
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
            <strong>Project Name :</strong> {{$fin->pi_title}}<br>
            <strong>Location Site&nbsp;&nbsp;:</strong> {{$fin->pi_construction_site}}<br>
            <strong>Contract ID &nbsp;: </strong> <label style="text-transform: uppercase;">{{$fin->ci_no}}</label>
		</p>
        @endforeach

<table class="equip" style="width:100%; border: 1.5px solid black;">
	<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
		@foreach($proj as $proj)
            
        <tr style="font-size: .8em;">
			<td rowspan="2" style="width: 45%; text-align: center;"> EQUIPMENT </td>
            <?php
            $diff = date_diff(date_create($proj->proj_start_date),date_create($proj->proj_end_date))->format('%r%a');
            //$diff = 268;
            $divide = floor($diff/15);
            $mod = $diff%15;
            $odd = 0;
            if($divide % 2 != 0){
                $divide -= 1;
                $odd = 1;
            }
            $divi = $divide;
            $divide /= 2;
            
            $checker = $divide*2;
            if($mod > 0){
                if($odd == 1){
                    $checker += 1;   
                }
                $checker += 1;
                echo '<td colspan="'.$checker.'" style="width: 10%; text-align: center;">CONSTRUCTION DURATION = '.$diff.'CD</td>';
            }else{
                echo '<td colspan="'.$checker.'" style="width: 10%; text-align: center;">CONSTRUCTION DURATION = '.$diff.'CD</td>';
            }//if else
            ?>
        </tr>
		<tr style="font-size: .74em;">';
        <?php   
            $ctr2 = 0;
            for($ctr = 1;$ctr<$divide+1;$ctr++){
                $ctr2 += 15;
                echo '<td style="width: 5%; text-align: center;">'.$ctr2.'th</td>';
                $ctr2 += 15;
                echo '<td style="width: 5%; text-align: center;">'.$ctr2.'th</td>';   
            }//for
            if($mod > 0){
                if($odd == 1){
                    $ctr2 += 15;
                    echo '<td style="width: 5%; text-align: center;">'.$ctr2.'th</td>';
                }//if
                $ctr2 += $mod;
                echo '<td style="width: 5%; text-align: center;">'.$ctr2.'th</td>';
            }//if else if
        ?>
		</tr>
        @endforeach
	</thead>
	<tbody>
        <?php
            $equipment = [];
            $output = [];
            foreach($equip as $key => $equip){
                $equipment['category'][$key] = $equip->ec_category;
                $equipment['startday'][$key] = $equip->days;
                $equipment['totalday'][$key] = $equip->ed_total_days;
                $startday = [];
                $totalday = [];
                if($key == 0){
                    $startday[0][0]=$equipment['startday'][$key];
                    $totalday[0][0]=$equipment['totalday'][$key]+$equipment['startday'][$key];
                    $output[0][0] = $equipment['category'][$key];
                    $output[0][1][0] = $startday[0][0];
                    $output[0][2][0] = $totalday[0][0];
                }else{//if output is null or 0
                    for($ctr2=count($output)-1;$ctr2>-1;$ctr2--){
                        if($equipment['category'][$key]==$output[$ctr2][0]){
                            $ctrSD = count($output[$ctr2][1]);
                            $ctrTD = count($output[$ctr2][2]);
                            $output[$ctr2][1][$ctrSD] = $equipment['startday'][$key];
                            $output[$ctr2][2][$ctrTD] = $equipment['totalday'][$key]+$equipment['startday'][$key];
                            $ctr2 = -1;
                        }elseif($ctr2 == 0){
                            $ctrOUT = count($output);
                            $output[$ctrOUT][0] = $equipment['category'][$key];
                            $output[$ctrOUT][1][0] = $equipment['startday'][$key];
                            $output[$ctrOUT][2][0] = $equipment['totalday'][$key]+$equipment['startday'][$key];
                        }//if equipment exist in output list
                    }//for ctr 2
                }//else if key != 0*/
            }//foreach
        ?>
        <?php 
        $divide += 1;$divide *= 2;$divide = floor($divide);
		for($ctr1 = 0; $ctr1<count($output);$ctr1++){
            $ctrextend = [];
            echo '<tr style="font-size: .75em;">';
            echo '<td style=" text-align: center; width:20%">'.$output[$ctr1][0].'</td>';
            for($ctr2 = 1;$ctr2<$divide;$ctr2++){
                $days = 15 * $ctr2;
                $from = $days - 15;
                $to = $days+1;
                $dayctr = '-';
                for($ctr3=count($output[$ctr1][1])-1;$ctr3>-1;$ctr3--){
                    if(($output[$ctr1][1][$ctr3] > $days-15 && $output[$ctr1][1][$ctr3] < $days+1)||($output[$ctr1][2][$ctr3] > $days-15)){
                        for($ctr4=$ctr2;$ctr4>-1;$ctr4--){
                            $tempDay = $ctr4*15;
                            $tempFrom = $tempDay-15;
                            $tempTo = $tempDay+1;
                            if($output[$ctr1][1][$ctr3]>$tempFrom && $output[$ctr1][1][$ctr3]<$tempTo){
                                $dayctr += 1;
                                //echo '<br>equipment='.$output[$ctr1][0].'/start='.$output[$ctr1][1][$ctr3].'/end='.$output[$ctr1][2][$ctr3].'>1/tempDay='.$tempFrom.'-'.$tempTo.'/days='.$from.'-'.$to.'/dayctr='.$dayctr.'<br>';
                            }//if start day is in list
                        }//check if output startday is in past list of $days
                    }//if it is in range
                }//for the first base 
                echo '<td style=" text-align: center;">'.$dayctr.'</td>';
            }//for  
            if($mod > 0){
                if($odd == 1){
                    $dayctr = '-';
                    for($ctr3=count($output[$ctr1][1])-1;$ctr3>-1;$ctr3--){
                        if(($output[$ctr1][1][$ctr3] > $days-$mod && $output[$ctr1][1][$ctr3] < $diff+1)||($output[$ctr1][2][$ctr3] > $days-$mod)){
                            for($ctr4=$ctr2-1;$ctr4>0;$ctr4--){
                                $tempDay = $ctr4*15;
                                $tempFrom = $tempDay-15;
                                $tempTo = $tempDay+1;
                                if($output[$ctr1][1][$ctr3]>$tempFrom && $output[$ctr1][1][$ctr3]<$tempTo){
                                    $dayctr += 1;
                                }elseif($output[$ctr1][1][$ctr3] > $days-$mod && $output[$ctr1][1][$ctr3] < $diff+1){
                                    $dayctr += 1;
                                }//if start day is in list
                            }//check if output startday is in past list of $days
                        }//if it is in range
                    }//for the first base 
                    echo '<td style=" text-align: center;">'.$dayctr.'</td>';//*/                    
                    //echo '<td style=" text-align: center;">'.$mod.'</td>';
                }//if it is odd
            }//if mod > 0*/
            echo '</tr>';
        }
        ?>
	</tbody>
</table>
</div>

<div class="foot" style="text-align: center; position:fixed; bottom: 40px; margin-left 20px;"><img src="images/logoheader.png" alt="" style="width:20%; height:5%; -webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222); margin-left:-10px;"></div>
</body>
</html>