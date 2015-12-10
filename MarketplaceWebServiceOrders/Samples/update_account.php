<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     MarketplaceWebServiceOrders
 *  @copyright   Copyright 2008-2009 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2011-01-01
 */
/******************************************************************************* 
 *  Marketplace Web Service Orders PHP5 Library
 *  Generated: Fri Jan 21 18:53:17 UTC 2011
 * 
 *
 */

/**
 * List Orders  Sample
 */
set_time_limit(0);

header("Content-type:text/html;charset=utf-8");
include "db_connect.php";


$dbcon	= new DBClass();
/**
$ss = "show tables;";
$ss				= $dbcon->execute($ss);
$ss				= $dbcon->getResultArray($ss);

var_dump($ss);exit;
/**/



$content = file_get_contents("ebay_order.sql");
$preg = "/;;;ordersn:([^\s]+)\s/i";
preg_match_all($preg,$content,$arr);

foreach($arr[1] as $key=>$val){
        $ordersn = trim($val);
        $sql = "select ebay_account from ebay_order where ebay_ordersn='$ordersn' and ebay_account='eyiou168@gmail.com' limit 1";
        $sql = $dbcon->execute($sql);
        $sql = $dbcon->getResultArray($sql);
        
        if(!empty($sql)){
                $account = $sql[0]['ebay_account'];
                if(!empty($account) && $account=='eyiou168@gmail.com'){
                        $update_sql = "update ebay_order set ebay_account='everglcorpsales002@gmail.com' where ebay_ordersn='$ordersn'  and ebay_account='eyiou168@gmail.com'  limit 1";
                        
                        //echo $update_sql."<br>";
                        
                        $dbcon->execute($update_sql);
                        echo '$ordersn:'.$ordersn."<br>";
                        //exit;
                }
        }
        
        
}
echo 'finish<pre>';
