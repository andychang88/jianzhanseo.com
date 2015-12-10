<?php

$start = $_REQUEST['date1'];
$end = $_REQUEST['date2'];

if(empty($start)){
        die("url缺少参数date1: 2013-08-30 00:00:01");
}

if(empty($end)){
        die("url缺少参数date2: 2013-08-30 24:50:59");
}


$tag = 1;
if(!empty($_REQUEST['tag'])){
       $tag = $_REQUEST['tag']; 
}
//$start		= "2013-08-30 00:00:01";
//$end		= "2013-08-30 24:50:59";


$is_debug = 0;

if($tag==1){
        $interval_time = "+1 hour";
}else{
        $interval_time = "+30 minute";
}