<?php
// 请求新蛋 API！REST网络服务使用 
// 带有 curl的 HTTP POST。PHP4/PHP5 
// 可实现错误记录 HTTP状态代码的检索 
  
error_reporting(E_ALL); 

$SellerID = 'A49A';
$app_key = '622cc7ce6a30841f4e3156ac7d8bc78c';
$secret_key = 'e20ed23f-e057-40b8-b9f0-ce8b85df6e7d';


// 执行 POST操作的 URL和参数 
// 请确认你的请求 URL中所有字母都是小写 
//$request  = 'https://api.newegg.com/marketplace/ordermgmt/order/orderinfo?sellerid='.$SellerID.'&version=304'; 

  function curlrequest($url,$data,$header,$method='post'){
	$ch = curl_init(); //初始化CURL句柄 
	curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
	
	//curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-HTTP-Method-Override: $method"));//设置HTTP头信息
	
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	curl_setopt($ch,CURLOPT_HTTPHEADER,$header);//设置HTTP头信息
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
	
	curl_setopt($ch, CURLOPT_HEADER, false); 
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
	$document = curl_exec($ch);//执行预定义的CURL 
	if(!curl_errno($ch)){ 
	  $info = curl_getinfo($ch); 
	  echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
	} else { 
	  echo 'Curl error: ' . curl_error($ch); 
	}
	curl_close($ch);
	
	return $document;
}

$url  = 'http://test.com/newegg2.php'; 
 $tmp_arr = array('a'=>'aaa'); 
 // $return = curlrequest($adb_url,array('a'=>'aa'),'post');
  $url  = 'https://api.newegg.com/marketplace/ordermgmt/order/orderinfo?sellerid='.$SellerID.'&version=304'; 
  $header_array =array('Content-Type:application/xml', 
'Accept:application/xml', 
'Authorization: '.$app_key, 
'SecretKey: '.$secret_key); 



$data = "request from put method";
$data = '<NeweggAPIRequest><OperationType>GetOrderInfoRequest</OperationType><RequestBody> 
	   <PageIndex>1</PageIndex> 
	    <PageSize>10</PageSize> 
	     <RequestCriteria>
	       <Status>0</Status>
	       <Type>0</Type>
	     </RequestCriteria> 
	  </RequestBody></NeweggAPIRequest>';
	  
$data = '{ 
    "OperationType": "GetOrderInfoRequest", 
    "RequestBody": { 
        "PageIndex": "1", 
        "PageSize": "10", 
        "RequestCriteria": { 
            "OrderNumberList": { 
                "OrderNumber": [ 
                    "159243598", 
                    "41473642" 
                ] 
            }, 
            "Status": "1", 
            "Type": "1", 
            "OrderDateFrom": "2011-01-01 09:30:47", 
            "OrderDateTo": "2011-12-17 09:30:47", 
            "OrderDownloaded": 0 
        } 
    } 
} ';
	  $url = 'http://api.newegg.com/marketplace/ordermgmt/servicestatus?sellerid='.$SellerID;
	  echo $url;
$return = curlrequest($url, $data,$header_array, 'GET');

var_dump($return);exit;