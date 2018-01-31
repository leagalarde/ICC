<?php
    $equipment = [];
    /*$category = ['category'=>["",],
                 'categoryctr'=>[1,],
                 'startday'=>[0,],
                 'totalday'=>[0,]];//*/
    //$category = [];
    $output = [];
    //$output = array(array(0=>array(),1=>array()));
    //$output = [""=>['startday'=>[0,],
    //      /          'totalday'=>[0,],
    //                'categoryctr'=>[1,]],];
    foreach($equip as $key => $equip){
        $equipment['category'][$key] = $equip->ec_category;
        $equipment['startday'][$key] = $equip->days;
        $equipment['totalday'][$key] = $equip->ed_total_days;
        //echo 'key='.$key;
        $startday = [];
        $totalday = [];
        if($key == 0){
            //$category = $equipment['category'][$key];
            $startday[0][0]=$equipment['startday'][$key];
            $totalday[0][0]=$equipment['totalday'][$key]+$equipment['startday'][$key];
            $output[0][0] = $equipment['category'][$key];
            $output[0][1][0] = $startday[0][0];
            $output[0][2][0] = $totalday[0][0];
            echo 'key == 0 output is('.$output[0][0].')<br>';
        }else{//if output is null or 0
            for($ctr2=count($output)-1;$ctr2>-1;$ctr2--){
                echo '<br> output[ctr2='.$ctr2.'][0] inside ctr2 ='.$output[$ctr2][0].'<br>';
                echo 'equipment[key='.$key.'] inside ctr2 ='.$equipment['category'][$key].'<br>'; 
                if($equipment['category'][$key]==$output[$ctr2][0]){
                    //echo '2<br>';
                    $ctrSD = count($output[$ctr2][1]);
                    $ctrTD = count($output[$ctr2][2]);
                    $output[$ctr2][1][$ctrSD] = $equipment['startday'][$key];
                    $output[$ctr2][2][$ctrTD] = $equipment['totalday'][$key]+$equipment['startday'][$key];
                    echo 'they are equal(saved to existing file)<br>';
                    $ctr2 = -1;
                }elseif($ctr2 == 0){
                    $ctrOUT = count($output);
                    $output[$ctrOUT][0] = $equipment['category'][$key];
                    $output[$ctrOUT][1][0] = $equipment['startday'][$key];
                    $output[$ctrOUT][2][0] = $equipment['totalday'][$key]+$equipment['startday'][$key];
                    echo 'they not are equal(saved to new file)<br>';
                }//*
                //echo '<br> output[ctr2='.$ctr2.'][0] inside ctr2 ='.$output[$ctr2][0].'<br>';
                //echo '<br> equipment[ctr1='.$ctr1.'] inside ctr2 ='.$equipment['category'][$ctr1].'<br>';
                echo 'key='.$key.'          ctr2='.$ctr2.'     count='.count($output).'<br>';
                    //echo 'ctr1='.$ctr1.'  ctr2='.$category['category'][$ctr2].'<br><br>';
                //$ctr2 = -1;
                //$ctr1 = 5;
            }//if it is already stored
        }//else if key != 0*/
    }//foreach
    /*foreach($equipment as $masterkey => $equipment){
        echo '<br>'.$masterkey.'</br>';
        /*
        }//
        if($masterkey == 'category'){
            foreach($equipment as $key => $equipment){
                if($equipment == $category){
                    $catcount++;
                }else{
                    echo '<br>'.$key." = ".$equipment . "=";
                }//if category = category + 1
                echo $catcount.'</br>';
                $category = $equipment;
                echo $equipment[$masterkey+1];
            }//if it is category/for category only
        }//foreach
    }//foreach*/
    //echo count($equipment['category']);
    //echo $category['count'][0]+=1;
    /*for($ctr1=0;$ctr1<count($equipment['category']);$ctr1++){
        $startday = [];
        $totalday = [];
        if($ctr1 == 0){
            //$category = $equipment['category'][$ctr1];
            $startday[0][0]=$equipment['startday'][$ctr1];
            $totalday[0][0]=$equipment['totalday'][$ctr1]+$equipment['startday'][$ctr1];
            $output[0][0] = $equipment['category'][$ctr1];
            $output[0][1][0] = $startday[0][0];
            $output[0][2][0] = $totalday[0][0];
            echo 'ctr1 == 0 output is('.$output[0][0].')<br>';
            $ctr1++;
        }//if output is null or 0
        for($ctr2=count($output)-1;$ctr2>-1;$ctr2--){
            echo '<br> output[ctr2='.$ctr2.'][0] inside ctr2 ='.$output[$ctr2][0].'<br>';
            echo 'equipment[ctr1='.$ctr1.'] inside ctr2 ='.$equipment['category'][$ctr1].'<br>'; 
            if($equipment['category'][$ctr1]==$output[$ctr2][0]){
                //echo '2<br>';
                $ctrSD = count($output[$ctr2][1]);
                $ctrTD = count($output[$ctr2][2]);
                $output[$ctr2][1][$ctrSD] = $equipment['startday'][$ctr1];
                $output[$ctr2][2][$ctrTD] = $equipment['totalday'][$ctr1]+$equipment['startday'][$ctr1];
                echo 'they are equal(saved to existing file)<br>';
                $ctr2 = -1;
            }elseif($ctr2 == 0){
                $ctrOUT = count($output);
                $output[$ctrOUT][0] = $equipment['category'][$ctr1];
                $output[$ctrOUT][1][0] = $equipment['startday'][$ctr1];
                $output[$ctrOUT][2][0] = $equipment['totalday'][$ctr1]+$equipment['startday'][$ctr1];
                echo 'they not are equal(saved to new file)<br>';
            }//*
            //echo '<br> output[ctr2='.$ctr2.'][0] inside ctr2 ='.$output[$ctr2][0].'<br>';
            //echo '<br> equipment[ctr1='.$ctr1.'] inside ctr2 ='.$equipment['category'][$ctr1].'<br>';
            echo 'ctr1='.$ctr1.'          ctr2='.$ctr2.'     count='.count($output).'<br>';
                //echo 'ctr1='.$ctr1.'  ctr2='.$category['category'][$ctr2].'<br><br>';
            //$ctr2 = -1;
            //$ctr1 = 5;
        }//if it is already stored*
    }//for category only */
    //var_dump($equipment);
    echo '<br><br>';
    var_dump($output);
?>