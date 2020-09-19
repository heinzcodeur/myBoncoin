<?php

function closest(array $numbers){
    if(empty($numbers)){
        return 0;
    }

    $closest=null;
    foreach ($numbers as $number) {
       // if (is_null($closest)) {
        print_r($closest);
        if ($closest==0) {
            //die('ici');
            $closest = $number;
        }
        if($closest > abs($number)){
            //echo abs($number);//die();
            $closest = $number;
        }
    }
    return $closest;
}
$arr=[2,1,4,7,4,8,3,6,4,7,0];
$tab2=[8,6,4,2];
//echo closest($tab2).'&nbsp;';

$l=null;

if( $l>abs(2)){
    echo 'ok';
}else { //echo 'no';
    }

//echo $l;

$closest=-5;
$number=5;

//print_r(abs($closest) === abs($number));
if($closest<$number) {
    echo $number;
}
