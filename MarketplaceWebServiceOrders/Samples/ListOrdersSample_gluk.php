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
ini_set('memory_limit','800M');
header("Content-type:text/html;charset=utf-8");
include "db_connect.php";


$dbcon	= new DBClass();
/**
$ss = "show tables;";
$ss				= $dbcon->execute($ss);
$ss				= $dbcon->getResultArray($ss);

var_dump($ss);exit;
/**/




$defaultstoreid = 12;
$user = "vipwang";

include "ListOrdersSample_gl_set.php";


	
//$interval_time = "+30 minute";	
/**
$end			= "2013-08-18 23:00:00";
$start			= "2013-08-20 02:00:00";

$end			= "2013-08-18 23:00:00";
$start			= "2013-08-20 02:00:00";

$end			= "2013-08-18 23:00:00";
$start			= "2013-08-20 02:00:00";


$end			= "2013-08-18 23:00:00";
$start			= "2013-08-20 02:00:00";

$end			= "2013-08-18 23:00:00";
$start			= "2013-08-20 02:00:00";
/**/



$is_debug = 1;
$account		= "wangxiaofeng20013@gmail.com";
//$account		= "eyiou168@gmail.com";

$AWS_ACCESS_KEY_ID		= "AKIAIUKUMTYQ6LBDNZOQ";
$AWS_SECRET_ACCESS_KEY	= "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";
$MERCHANT_ID			= "A19SKMIKD0BNZF";
$MARKETPLACE_ID			= "A1F83G8C2ARO7P";
$serviceUrl				= 'https://mws.amazonservices.co.uk/Orders/2011-01-01';


define('AWS_ACCESS_KEY_ID', $AWS_ACCESS_KEY_ID);
define('AWS_SECRET_ACCESS_KEY', $AWS_SECRET_ACCESS_KEY);  

define ('MERCHANT_ID', $MERCHANT_ID);
define ('MARKETPLACE_ID', $MARKETPLACE_ID);
set_include_path(get_include_path() . PATH_SEPARATOR . '../../.');    

function __autoload($className){
        $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $includePaths = explode(PATH_SEPARATOR, get_include_path());
        foreach($includePaths as $includePath){
            if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)){
                require_once $filePath;
                return;
            }
        }
    }








/************************************************************************
 * Instantiate Implementation of MarketplaceWebServiceOrders
 * 
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants 
 * are defined in the .config.inc.php located in the same 
 * directory as this sample
 ***********************************************************************/
// United States:
//$serviceUrl = "https://mws.amazonservices.com/Orders/2011-01-01";
// United Kingdom
//$serviceUrl = "https://mws.amazonservices.co.uk/Orders/2011-01-01";
// Germany
//$serviceUrl = "https://mws.amazonservices.de/Orders/2011-01-01";
// France
//$serviceUrl = "https://mws.amazonservices.fr/Orders/2011-01-01";
// Italy
//$serviceUrl = "https://mws.amazonservices.it/Orders/2011-01-01";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp/Orders/2011-01-01";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn/Orders/2011-01-01";
// Canada
//$serviceUrl = "https://mws.amazonservices.ca/Orders/2011-01-01";




 $config = array (
   'ServiceURL' => $serviceUrl,
   'ProxyHost' => null,
   'ProxyPort' => -1,
   'MaxErrorRetry' => 3,
 );

 $service = new MarketplaceWebServiceOrders_Client(
        AWS_ACCESS_KEY_ID,
        AWS_SECRET_ACCESS_KEY,
        APPLICATION_NAME,
        APPLICATION_VERSION,
        $config);

 
/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebServiceOrders
 * responses without calling MarketplaceWebServiceOrders service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebServiceOrders/Mock tree
 *
 ***********************************************************************/
 // $service = new MarketplaceWebServiceOrders_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out 
 * sample for List Orders Action
 ***********************************************************************/
 $request = new MarketplaceWebServiceOrders_Model_ListOrdersRequest();
  $request->setSellerId(MERCHANT_ID);
 
 
 
$interval_start = strtotime($start);
$interval_end = strtotime($interval_time,$interval_start);


$base_end = strtotime($end);




while($interval_end<=$base_end){
        
        
		
                        $marketplaceIdList = new MarketplaceWebServiceOrders_Model_MarketplaceIdList();
			 $marketplaceIdList->setId(array(MARKETPLACE_ID));
			 $request->setMarketplaceId($marketplaceIdList);
			 
			 
			$orderStatuses = new MarketplaceWebServiceOrders_Model_OrderStatusList();
                        $orderStatuses->setStatus(array('Unshipped','PartiallyShipped'));
                        $request->setOrderStatus($orderStatuses);
 
 
		
			$start = date("Y-m-d H:i:s",$interval_start);
                        $end = date("Y-m-d H:i:s",$interval_end);
                        
			$astart	= date('Y-m-d',strtotime($start))." ".date('H:i:s',strtotime($start));
			$aend	= date('Y-m-d',strtotime($end))." ".date('H:i:s',strtotime($end));
		
			
                        
                        $interval_start = $interval_end;
                        $interval_end = strtotime($interval_time,$interval_end);

                        
			echo $astart.'<br>';
			echo $aend;



			
			$request->setCreatedAfter(new DateTime($astart, new DateTimeZone('UTC')));
			$request->setCreatedBefore(new DateTime($aend, new DateTimeZone('UTC')));
			
			$errorstatus	=  invokeListOrders($service, $request);
	
	echo '$errorstatus:'.$errorstatus."<br><br>";
	
	
	
}

        echo "finish";
 

 
 
 
 
/**
  * List Orders Action Sample
  * ListOrders can be used to find orders that meet the specified criteria.
  *   
  * @param MarketplaceWebServiceOrders_Interface $service instance of MarketplaceWebServiceOrders_Interface
  * @param mixed $request MarketplaceWebServiceOrders_Model_ListOrders or array of parameters
  */
  function invokeListOrders(MarketplaceWebServiceOrders_Interface $service, $request) 
  {
       global $user,$account,$dbcon,$defaultstoreid,$is_debug;
	  
      try {

              $response = $service->listOrders($request);
              
              if($is_debug){
                print_r($response);
              }
              //print_r($response);
              if ($response->isSetListOrdersResult()) {
                
                        $listOrdersResult = $response->getListOrdersResult();
                        if ($listOrdersResult->isSetNextToken()) {
                                $tokens =  $listOrdersResult->getNextToken();
                                $gg	= 0 ;
                                
                                while(true){
                                                                        $request = new MarketplaceWebServiceOrders_Model_ListOrdersByNextTokenRequest();
									 $request->setSellerId(MERCHANT_ID);
									 $request->setNextToken($tokens);
									 $nexttokens	= invokeListOrdersByNextToken($service, $request,$tokens);
                                                                         
									 if(strlen($nexttokens) >= 10 ){

											
											$nexttokens	= invokeListOrdersByNextToken($service, $request,$nexttokens);
											$tokens		= $nexttokens;


									}else{

											 break;


									}

									$gg++;
									if($gg>=20) break;
                                }
                                
                                echo '<br>'.$nexttokens.'ggggggggggg';
                                
                                
                        }
                        
                        
                        if ($listOrdersResult->isSetOrders()) {
                                
                                $orders = $listOrdersResult->getOrders();
                                $orderList = $orders->getOrder();
                                foreach ($orderList as $order) {
                                        $val= '';
                                        
                                        if ($order->isSetSellerOrderId()) 
                                        {
                                   //         echo("                        SellerOrderId\n");
                                   //         echo("                            " . $order->getSellerOrderId() . "\n");
                                        }
                                        
                                        
                                        if ($order->isSetPurchaseDate()) 
                                        {
                          
                                                                            
                                                                            $CreatedDate						=  strtotime($order->getPurchaseDate()) ;
                                        }
                                        
                                        if ($order->isSetLastUpdateDate()) 
                                        {
                                                                            $PaidTime						=  strtotime($order->getLastUpdateDate()) ;
                                        }
                                        
                                        if ($order->isSetOrderStatus()) 
                                        {
                                       
                                                                            if($order->getOrderStatus() == 'Unshipped'){
                                                                            $orderstatus				= 822;
                                                                            }
                                                                            
                                        }
                            
                                        //comment by andy 20130518
					if($order->isSetAmazonOrderId() && $orderstatus == '822' ) 
                             
                                        {
                                    
                                                                             $val							= $order->getAmazonOrderId();
                                                                             $request = new MarketplaceWebServiceOrders_Model_ListOrderItemsRequest();
                                                                             $request->setSellerId(MERCHANT_ID);
                                                                             $request->setAmazonOrderId($val);
                                                                             if($val != '') invokeListOrderItems($service, $request,$val,$account); 
                                        }
                                        
                                        
                                        
                                        
                                        if ($order->isSetFulfillmentChannel()) 
                                        {
                                           // echo("                        FulfillmentChannel\n");
                                           // echo("                            " . $order->getFulfillmentChannel() . "\n");
                                        }
                                        if ($order->isSetSalesChannel()) 
                                        {
                                          //  echo("                        SalesChannel\n");
                                          //  echo("                            " . $order->getSalesChannel() . "\n");
                                        }
                                        if ($order->isSetOrderChannel()) 
                                        {
                                          //  echo("                        OrderChannel\n");
                                          //  echo("                            " . $order->getOrderChannel() . "\n");
                                        }
                                        if ($order->isSetShipServiceLevel()) 
                                        {
                                          //  echo("                        ShipServiceLevel\n");
                                          //  echo("                            " . $order->getShipServiceLevel() . "\n");
                                        }
                                        
                                        
                                        
                                        
                                        $Street1	= '';
					$Street2	= '';
					$CityName   = '';
					$StateOrProvince = '';
                                        
                                        
                                        
                                        if ($order->isSetShippingAddress()) { 
                                                $shippingAddress = $order->getShippingAddress();
                                                if ($shippingAddress->isSetName()) 
                                                {
                                                                                        
                                                                                        $Name	= mysql_escape_string($shippingAddress->getName()) ;
                                                }
                                                if ($shippingAddress->isSetAddressLine1()) 
                                                {
                                                                                        $Street1	= mysql_escape_string($shippingAddress->getAddressLine1()) ;
                                                                                        
                                                                                        
                                                }
                                                if ($shippingAddress->isSetAddressLine2()) 
                                                {
                                                                                        $Street2	= mysql_escape_string($shippingAddress->getAddressLine2()) ;
                                                                                        
                                                }
                                                if ($shippingAddress->isSetAddressLine3()) 
                                                {
                                                //    echo("                                " . $shippingAddress->getAddressLine3() . "\n");
                                                }
                                                                                
                                                                                
                                                                                
                                                if ($shippingAddress->isSetCity()) 
                                                {
                                                  
                                                                                        $CityName			= mysql_escape_string($shippingAddress->getCity());
                                                                                        
                                                }
                                                if ($shippingAddress->isSetCounty()) 
                                                {
                                                                                        
                                                                                        $CountryName				=  $shippingAddress->getCounty() ;
                                                                                        
                                                }
                                                if ($shippingAddress->isSetDistrict()) 
                                                {
                                                //    echo("                                " . $shippingAddress->getDistrict() . "\n");
                                                }
                                                if ($shippingAddress->isSetStateOrRegion()) 
                                                {
                                               
                                                                                        
                                                                                        $StateOrProvince						=  $shippingAddress->getStateOrRegion();
                                                }
                                                if ($shippingAddress->isSetPostalCode()) 
                                                {
                                                                                        $PostalCode		=  $shippingAddress->getPostalCode();
                                                                                        
                                                }
                                                if ($shippingAddress->isSetCountryCode()) 
                                                {
                                                                                        $Country				=  $shippingAddress->getCountryCode() ;
                                                                                        
                                                }
                                                if ($shippingAddress->isSetPhone()) 
                                                {
                                                                        
                                                                                        $Phone			= $shippingAddress->getPhone() ;
                                                                                        
                                                }
                                        }
                                        
                                        if ($order->isSetOrderTotal()) { 
                             
                                                $orderTotal = $order->getOrderTotal();
                                                if ($orderTotal->isSetCurrencyCode()) 
                                                {
                                                 
                                     
                                                                                        $Currency					= $orderTotal->getCurrencyCode();
                                                                                        
                                                                                        
                                                                                        
                                                }
                                                if ($orderTotal->isSetAmount()) 
                                                {
                                            
                                                                                        $AmountPaid	= $orderTotal->getAmount() ;
                                                                                        
                                                }
                                        }
                                        
                                        
                                        if ($order->isSetNumberOfItemsShipped()) 
                                        {
                                      
                                           // echo("                            " . $order->getNumberOfItemsShipped() . "\n");
                                        }
                                        if ($order->isSetNumberOfItemsUnshipped()) 
                                        {
                                         
                                          //  echo("                            " . $order->getNumberOfItemsUnshipped() . "\n");
                                        }
                                        if ($order->isSetPaymentExecutionDetail()) { 
                                         
                                            $paymentExecutionDetail = $order->getPaymentExecutionDetail();
                                            $paymentExecutionDetailItemList = $paymentExecutionDetail->getPaymentExecutionDetailItem();
                                            foreach ($paymentExecutionDetailItemList as $paymentExecutionDetailItem) {
                                               // echo("                            PaymentExecutionDetailItem\n");
                                                if ($paymentExecutionDetailItem->isSetPayment()) { 
                                                  //  echo("                                Payment\n");
                                                    $payment = $paymentExecutionDetailItem->getPayment();
                                                    if ($payment->isSetCurrencyCode()) 
                                                    {
                                                       // echo("                                    CurrencyCode\n");
                                                       // echo("                                        " . $payment->getCurrencyCode() . "\n");
                                                    }
                                                    if ($payment->isSetAmount()) 
                                                    {
                                                      //  echo("                                    Amount\n");
                                                       // echo("                                        " . $payment->getAmount() . "\n");
                                                    }
                                                } 
                                                if ($paymentExecutionDetailItem->isSetSubPaymentMethod()) 
                                                {
                                                  //  echo("                                SubPaymentMethod\n");
                                                  //  echo("                                    " . $paymentExecutionDetailItem->getSubPaymentMethod() . "\n");
                                                }
                                            }
                                        }
                                        
                                        
                                        
                                        
                                        if ($order->isSetPaymentMethod()) 
                                        {
                                            //echo("                        PaymentMethod\n");
                                            //echo("                            " . $order->getPaymentMethod() . "\n");
                                        }
                                        if ($order->isSetMarketplaceId()) 
                                        {
                                            //echo("                        MarketplaceId\n");
                                           // echo("                            " . $order->getMarketplaceId() . "\n");
                                        }
                                        if ($order->isSetBuyerEmail()) 
                                        {
                                         //   echo("                        BuyerEmail\n");
                                        //    echo("                            " . $order->getBuyerEmail() . "\n");
                                                                            
                                                                            $Email				=  $order->getBuyerEmail() ;
                                                                            
                                        }
                                        if ($order->isSetBuyerName()) 
                                        {
                                                                            
                                                                            $UserID	= mysql_escape_string($order->getBuyerName());
                                                                            
                                                                            
                                        }
                                        if ($order->isSetShipmentServiceLevelCategory()) 
                                        {
                                            //echo("                        ShipmentServiceLevelCategory\n");
                                           // echo("                            " . $order->getShipmentServiceLevelCategory() . "\n");
                                        }
                            
                            			
							
							
					$addrecordnumber = $val;
                                        
                                        $Country_q = countryname_change($Country);
                                        
                                        $sql			 = "INSERT INTO `ebay_order` (`ebay_paystatus`,`ebay_ordersn` ,`ebay_tid` ,`ebay_ptid` ,`ebay_orderid` ,";
					$sql			.= "`ebay_createdtime` ,`ebay_paidtime` ,`ebay_userid` ,`ebay_username` ,`ebay_usermail` ,`ebay_street` ,";
					$sql			.= "`ebay_street1` ,`ebay_city` ,`ebay_state` ,`ebay_couny` ,`ebay_countryname` ,`ebay_postcode` ,`ebay_phone`";
					$sql			.= " ,`ebay_currency` ,`ebay_total` ,`ebay_status`,`ebay_user`,`ebay_shipfee`,`ebay_account`,`recordnumber`,`ebay_addtime`,`ebay_note`,`ebay_site`,`eBayPaymentStatus`,`PayPalEmailAddress`,`ShippedTime`,`RefundAmount`,`ebay_warehouse`,`order_no`)VALUES ('Complete','$val', '$tid' , '$ptid' , '$orderid' , '$CreatedDate' , '$PaidTime' , '$UserID' ,";
					$sql			.= " '$Name' , '$Email' , '$Street1' , '$Street2' , '$CityName','$StateOrProvince' , '$Country' , '$Country_q' , '$PostalCode' , '$Phone' , '$Currency' , '$AmountPaid' , '$orderstatus','$user','$shipingfee','$account','$addrecordnumber','$mctime','$BuyerCheckoutMessage','$site','$eBayPaymentStatus','$PayPalEmailAddress','$ShippedTime','$RefundAmount','$defaultstoreid','$order_no')";
					
                                        
                                        
                                        $sg				= "select * from ebay_order where ebay_ordersn ='$val' ";
                                        $sg				= $dbcon->execute($sg);
					$sg				= $dbcon->getResultArray($sg);
                                        
                                        if(count($sg) == 0){
                                                $dbcon->execute($sql);
                                                addLog("ordersn:$val 添加成功。");
                                        }else{
                                                addLog("ordersn:$val 在数据库中已经存在。");
                                        }
                                        
                                        
                            
                            
                            
                            
                            
                                }
                        }
                
                
                
                
              }
			  
			  
//print_r($response);exit;

			  
       

     } catch (MarketplaceWebServiceOrders_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
		 print_r($ex);
	
		 
     }
 }
 
 
 
 
 
 // Set the order statuses for this ListOrdersRequest (optional)
 // $orderStatuses = new MarketplaceWebServiceOrders_Model_OrderStatusList();
 // $orderStatuses->setStatus(array('Shipped'));
 // $request->setOrderStatus($orderStatuses);

 // Set the Fulfillment Channel for this ListOrdersRequest (optional)
 //$fulfillmentChannels = new MarketplaceWebServiceOrders_Model_FulfillmentChannelList();
 //$fulfillmentChannels->setChannel(array('MFN'));
 //$request->setFulfillmentChannel($fulfillmentChannels);

 // @TODO: set request. Action can be passed as MarketplaceWebServiceOrders_Model_ListOrdersRequest
 // object or array of parameters
 
 
 


 
 
  function invokeListOrderItems(MarketplaceWebServiceOrders_Interface $service, $request,$val,$account) 
  {		
  
  		global $dbcon;
		
      try {
              $response = $service->listOrderItems($request);
            // print_r($response);
			 
			  
 
                if ($response->isSetListOrderItemsResult()) { 
                  //  echo("            ListOrderItemsResult\n");
                    $listOrderItemsResult = $response->getListOrderItemsResult();
                    if ($listOrderItemsResult->isSetNextToken()) 
                    {
                     //   echo("                NextToken\n");
                     //   echo("                    " . $listOrderItemsResult->getNextToken() . "\n");
                    }
                    if ($listOrderItemsResult->isSetAmazonOrderId()) 
                    {
                     //   echo("                AmazonOrderId\n");
                     //   echo("                    " . $listOrderItemsResult->getAmazonOrderId() . "\n");
                    }
                    if ($listOrderItemsResult->isSetOrderItems()) { 
                      //  echo("                OrderItems\n");
                        $orderItems = $listOrderItemsResult->getOrderItems();
                        $orderItemList = $orderItems->getOrderItem();
                        foreach ($orderItemList as $orderItem) {
                    //        echo("                    OrderItem\n");
                            if ($orderItem->isSetASIN()) 
                            {
                   //             echo("                        ASIN\n");
                                //echo("                            " . $orderItem->getASIN() . "\n");
								
								$ebay_itemid			= $orderItem->getASIN() ;
								
                            }
                            if ($orderItem->isSetSellerSKU()) 
                            {
                     //           echo("                        SellerSKU\n");
                       //         echo("                            " . $orderItem->getSellerSKU() . "\n");
								
								$sku			= $orderItem->getSellerSKU();
								
                            }
                            if ($orderItem->isSetOrderItemId()) 
                            {
                        //        echo("                        OrderItemId\n");
                        //        echo("                            " . $orderItem->getOrderItemId() . "\n");
								$recordnumber						= $orderItem->getOrderItemId();
								
                            }
                            if ($orderItem->isSetTitle()) 
                            {
                          //      echo("                        Title\n");
                         //       echo("                            " . $orderItem->getTitle() . "\n");
								
								$title			= $orderItem->getTitle();
								
                            }
                            if ($orderItem->isSetQuantityOrdered()) 
                            {
                         //       echo("                        QuantityOrdered\n");
                       //        echo("                            " . $orderItem->getQuantityOrdered() . "\n");
								
								$amount			= $orderItem->getQuantityOrdered();
								
                            }
                            if ($orderItem->isSetQuantityShipped()) 
                            {
                      //          echo("                        QuantityShipped\n");
                     //           echo("                            " . $orderItem->getQuantityShipped() . "\n");
                            }
                            if ($orderItem->isSetItemPrice()) { 
                       //         echo("                        ItemPrice\n");
                                $itemPrice = $orderItem->getItemPrice();
                                if ($itemPrice->isSetCurrencyCode()) 
                                {
                      //              echo("                            CurrencyCode\n");
                      //              echo("                                " . $itemPrice->getCurrencyCode() . "\n");
                                }
                                if ($itemPrice->isSetAmount()) 
                                {
                          //          echo("                            Amount\n");
                          //          echo("                                " . $itemPrice->getAmount() . "\n");
									
									
									$ebayitemprice			= $itemPrice->getAmount();
									
                                }
                            } 
                            if ($orderItem->isSetShippingPrice()) { 
                            //    echo("                        ShippingPrice\n");
                                $shippingPrice = $orderItem->getShippingPrice();
                                if ($shippingPrice->isSetCurrencyCode()) 
                                {
                          //          echo("                            CurrencyCode\n");
                           //         echo("                                " . $shippingPrice->getCurrencyCode() . "\n");
                                }
                                if ($shippingPrice->isSetAmount()) 
                                {
                           //         echo("                            Amount\n");
                           //         echo("                                " . $shippingPrice->getAmount() . "\n");
							//		
									$shipingfee	= $shippingPrice->getAmount();
									
                                }
                            } 
                            if ($orderItem->isSetGiftWrapPrice()) { 
                          //      echo("                        GiftWrapPrice\n");
                                $giftWrapPrice = $orderItem->getGiftWrapPrice();
                                if ($giftWrapPrice->isSetCurrencyCode()) 
                                {
                                 //   echo("                            CurrencyCode\n");
                                //    echo("                                " . $giftWrapPrice->getCurrencyCode() . "\n");
                                }
                                if ($giftWrapPrice->isSetAmount()) 
                                {
                                 //   echo("                            Amount\n");
                                 //   echo("                                " . $giftWrapPrice->getAmount() . "\n");
									
									
								
                                }
                            } 
                            if ($orderItem->isSetItemTax()) { 
                               // echo("                        ItemTax\n");
                                $itemTax = $orderItem->getItemTax();
                                if ($itemTax->isSetCurrencyCode()) 
                                {
                              //      echo("                            CurrencyCode\n");
                             //      echo("                                " . $itemTax->getCurrencyCode() . "\n");
                                }
                                if ($itemTax->isSetAmount()) 
                                {
                             //       echo("                            Amount\n");
                            //        echo("                                " . $itemTax->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetShippingTax()) { 
                              // echo("                        ShippingTax\n");
                                $shippingTax = $orderItem->getShippingTax();
                                if ($shippingTax->isSetCurrencyCode()) 
                                {
                              //      echo("                            CurrencyCode\n");
                              //      echo("                                " . $shippingTax->getCurrencyCode() . "\n");
                                }
                                if ($shippingTax->isSetAmount()) 
                                {
                                    //echo("                            Amount\n");
                                 //   echo("                                " . $shippingTax->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetGiftWrapTax()) { 
                             //   echo("                        GiftWrapTax\n");
                                $giftWrapTax = $orderItem->getGiftWrapTax();
                                if ($giftWrapTax->isSetCurrencyCode()) 
                                {
                               //     echo("                            CurrencyCode\n");
                               //     echo("                                " . $giftWrapTax->getCurrencyCode() . "\n");
                                }
                                if ($giftWrapTax->isSetAmount()) 
                                {
                               //     echo("                            Amount\n");
                               //     echo("                                " . $giftWrapTax->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetShippingDiscount()) { 
                              //  echo("                        ShippingDiscount\n");
                                $shippingDiscount = $orderItem->getShippingDiscount();
                                if ($shippingDiscount->isSetCurrencyCode()) 
                                {
                               //     echo("                            CurrencyCode\n");
                                    //echo("                                " . $shippingDiscount->getCurrencyCode() . "\n");
                                }
                                if ($shippingDiscount->isSetAmount()) 
                                {
                               //     echo("                            Amount\n");
                               //     echo("                                " . $shippingDiscount->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetPromotionDiscount()) { 
                               // echo("                        PromotionDiscount\n");
                                $promotionDiscount = $orderItem->getPromotionDiscount();
                                if ($promotionDiscount->isSetCurrencyCode()) 
                                {
                                    //echo("                            CurrencyCode\n");
                                  //  echo("                                " . $promotionDiscount->getCurrencyCode() . "\n");
                                }
                                if ($promotionDiscount->isSetAmount()) 
                                {
                                    //echo("                            Amount\n");
                                   // echo("                                " . $promotionDiscount->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetPromotionIds()) { 
                               // echo("                        PromotionIds\n");
                                $promotionIds = $orderItem->getPromotionIds();
                                $promotionIdList  =  $promotionIds->getPromotionId();
                                foreach ($promotionIdList as $promotionId) { 
                                 //   echo("                            PromotionId\n");
                                //    echo("                                " . $promotionId);
                                }    
                            } 
                            if ($orderItem->isSetCODFee()) { 
                                echo("                        CODFee\n");
                                $CODFee = $orderItem->getCODFee();
                                if ($CODFee->isSetCurrencyCode()) 
                                {
                                  //  echo("                            CurrencyCode\n");
                                  //  echo("                                " . $CODFee->getCurrencyCode() . "\n");
                                }
                                if ($CODFee->isSetAmount()) 
                                {
                                 //   echo("                            Amount\n");
                                 //   echo("                                " . $CODFee->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetCODFeeDiscount()) { 
                               // echo("                        CODFeeDiscount\n");
                                $CODFeeDiscount = $orderItem->getCODFeeDiscount();
                                if ($CODFeeDiscount->isSetCurrencyCode()) 
                                {
                                 //   echo("                            CurrencyCode\n");
                                 //   echo("                                " . $CODFeeDiscount->getCurrencyCode() . "\n");
                                }
                                if ($CODFeeDiscount->isSetAmount()) 
                                {
                                 //   echo("                            Amount\n");
                                  //  echo("                                " . $CODFeeDiscount->getAmount() . "\n");
                                }
                            } 
                            if ($orderItem->isSetGiftMessageText()) 
                            {
                                //echo("                        GiftMessageText\n");
                                //echo("                            " . $orderItem->getGiftMessageText() . "\n");
                            }
                            if ($orderItem->isSetGiftWrapLevel()) 
                            {
                               // echo("                        GiftWrapLevel\n");
                               // echo("                            " . $orderItem->getGiftWrapLevel() . "\n");
                            }
							
                            if ( (strtolower(substr($sku,0,1)) =="q" && is_numeric(substr($sku,1,1))) || (strtoupper(substr($sku,0,1)) == 'Q' 
                                    && ord(strtoupper(substr($sku,1,1))) >= 65 && ord(strtoupper(substr($sku,1,1))) <= 90) ) {
                                    $sku=substr($sku,2);
                            }
                            
                            if(substr($sku,0,2)=="WS"){
                                $sku = substr($sku,2);
                            }
                                
                                $title = addslashes($title);
							
				$esql	 = "INSERT INTO `ebay_orderdetail` (`ebay_ordersn` ,`ebay_itemid` ,`ebay_itemtitle` ,`ebay_itemprice` ,";
				$esql    .= "`ebay_amount` ,`ebay_createdtime` ,`ebay_shiptype` ,`ebay_user`,`sku`,`shipingfee`,`ebay_account`,`addtime`,`ebay_itemurl`,`ebay_site`,`recordnumber`,`storeid`,`ListingType`,`ebay_tid`,`FeeOrCreditAmount`,`FinalValueFee`,`attribute`,`notes`,`goods_location`)
                                    VALUES ('$val', '$ebay_itemid' , '$title' , '$ebayitemprice' , 
                                        '$amount'";
				$esql	.= " , '$ctime' , '$shiptype' , '$user','$sku','$shipingfee','$account','$mctime','$pic','$site','$recordnumber','$storeid','$ListingType','$tid','$FeeOrCreditAmount','$FinalValueFee','$arrribute','$BuyerCheckoutMessage','$goods_location')";	
				
		
				
							
							$sg			= "select * from ebay_orderdetail where ebay_ordersn ='$val' and recordnumber ='$recordnumber' ";
							$sg			= $dbcon->execute($sg);
							$sg			= $dbcon->getResultArray($sg);
							
							if(count($sg) == 0){
						
								if($dbcon->execute($esql)){
									addLog("orderdetail ordersn:$val 添加成功。");
									
								}else{
                                                                        addLog("orderdetail ordersn:$val 添加失败。\n".$esql."\n");
									
								}
							}
					
				
				
				
                        }
                    } 
                } 
                if ($response->isSetResponseMetadata()) { 
                  //  echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                     //   echo("                RequestId\n");
                     //   echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

     } catch (MarketplaceWebServiceOrders_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
     }
 }
 
 
 
 
 
 
        
 function invokeListOrdersByNextToken(MarketplaceWebServiceOrders_Interface $service, $request,$tokens) 
  {	
	  

      try {


		



              $response = $service->listOrdersByNextToken($request);
echo '我执行了,invokeListOrdersByNextToken,,';




           

                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        ListOrdersByNextTokenResponse\n");
                if ($response->isSetListOrdersByNextTokenResult()) { 
                    echo("            ListOrdersByNextTokenResult\n");
                    $listOrdersByNextTokenResult = $response->getListOrdersByNextTokenResult();


                   
                    if ($listOrdersByNextTokenResult->isSetCreatedBefore()) 
                    {
                        echo("                CreatedBefore\n");
                        echo("                    " . $listOrdersByNextTokenResult->getCreatedBefore() . "\n");
                    }
                    if ($listOrdersByNextTokenResult->isSetLastUpdatedBefore()) 
                    {
                        echo("                LastUpdatedBefore\n");
                        echo("                    " . $listOrdersByNextTokenResult->getLastUpdatedBefore() . "\n");
                    }
                    if ($listOrdersByNextTokenResult->isSetOrders()) { 
                        echo("                Orders\n");
                        $orders = $listOrdersByNextTokenResult->getOrders();
                        $orderList = $orders->getOrder();
                         foreach ($orderList as $order) {
							
							
							
							$val= '';


                            if ($order->isSetSellerOrderId()) 
                            {
                       //         echo("                        SellerOrderId\n");
                       //         echo("                            " . $order->getSellerOrderId() . "\n");
                            }
                            if ($order->isSetPurchaseDate()) 
                            {
              
								
								$CreatedDate						=  strtotime($order->getPurchaseDate()) ;
                            }
                            if ($order->isSetLastUpdateDate()) 
                            {
								$PaidTime						=  strtotime($order->getLastUpdateDate()) ;
                            }

							$orderstatus						= '';

                            if ($order->isSetOrderStatus()) 
                            {
                           
								if($order->getOrderStatus() == 'Unshipped'){
								$orderstatus				= 822;
								}
								
                            }
							


							 if($order->isSetAmazonOrderId() && $orderstatus == '822' ) 
                            {
                        
								 $val							= $order->getAmazonOrderId();
								 $request = new MarketplaceWebServiceOrders_Model_ListOrderItemsRequest();
								 $request->setSellerId(MERCHANT_ID);
								 $request->setAmazonOrderId($val);
								 if($val != '') invokeListOrderItems($service, $request,$val,$account); 
                            }


							
							
							
                            if ($order->isSetFulfillmentChannel()) 
                            {
                               // echo("                        FulfillmentChannel\n");
                               // echo("                            " . $order->getFulfillmentChannel() . "\n");
                            }
                            if ($order->isSetSalesChannel()) 
                            {
                              //  echo("                        SalesChannel\n");
                              //  echo("                            " . $order->getSalesChannel() . "\n");
                            }
                            if ($order->isSetOrderChannel()) 
                            {
                              //  echo("                        OrderChannel\n");
                              //  echo("                            " . $order->getOrderChannel() . "\n");
                            }
                            if ($order->isSetShipServiceLevel()) 
                            {
                              //  echo("                        ShipServiceLevel\n");
                              //  echo("                            " . $order->getShipServiceLevel() . "\n");
                            }
							
							
							$Street1	= '';
							$Street2	= '';
							$CityName   = '';
							$StateOrProvince = '';
							
							
                            if ($order->isSetShippingAddress()) { 
                                $shippingAddress = $order->getShippingAddress();
                                if ($shippingAddress->isSetName()) 
                                {
									
									$Name	= mysql_escape_string($shippingAddress->getName()) ;
                                }
                                if ($shippingAddress->isSetAddressLine1()) 
                                {
									$Street1	= mysql_escape_string($shippingAddress->getAddressLine1()) ;
									
									
                                }
                                if ($shippingAddress->isSetAddressLine2()) 
                                {
									$Street2	= mysql_escape_string($shippingAddress->getAddressLine2()) ;
									
                                }
                                if ($shippingAddress->isSetAddressLine3()) 
                                {
                                //    echo("                                " . $shippingAddress->getAddressLine3() . "\n");
                                }
								
								
								
                                if ($shippingAddress->isSetCity()) 
                                {
                                  
									$CityName			= mysql_escape_string($shippingAddress->getCity());
									
                                }
                                if ($shippingAddress->isSetCounty()) 
                                {
									
									$CountryName				=  $shippingAddress->getCounty() ;
									
                                }
                                if ($shippingAddress->isSetDistrict()) 
                                {
                                //    echo("                                " . $shippingAddress->getDistrict() . "\n");
                                }
                                if ($shippingAddress->isSetStateOrRegion()) 
                                {
                               
									
									$StateOrProvince						=  $shippingAddress->getStateOrRegion();
                                }
                                if ($shippingAddress->isSetPostalCode()) 
                                {
									$PostalCode		=  $shippingAddress->getPostalCode();
									
                                }
                                if ($shippingAddress->isSetCountryCode()) 
                                {
									$Country				=  $shippingAddress->getCountryCode() ;
									
                                }
                                if ($shippingAddress->isSetPhone()) 
                                {
							
									$Phone			= $shippingAddress->getPhone() ;
									
                                }
                            } 
                            if ($order->isSetOrderTotal()) { 
                             
                                $orderTotal = $order->getOrderTotal();
                                if ($orderTotal->isSetCurrencyCode()) 
                                {
                                 
                     
									$Currency					= $orderTotal->getCurrencyCode();
									
									
									
                                }
                                if ($orderTotal->isSetAmount()) 
                                {
                            
									$AmountPaid	= $orderTotal->getAmount() ;
									
                                }
                            } 
                            if ($order->isSetNumberOfItemsShipped()) 
                            {
                          
                               // echo("                            " . $order->getNumberOfItemsShipped() . "\n");
                            }
                            if ($order->isSetNumberOfItemsUnshipped()) 
                            {
                             
                              //  echo("                            " . $order->getNumberOfItemsUnshipped() . "\n");
                            }
                            if ($order->isSetPaymentExecutionDetail()) { 
                             
                                $paymentExecutionDetail = $order->getPaymentExecutionDetail();
                                $paymentExecutionDetailItemList = $paymentExecutionDetail->getPaymentExecutionDetailItem();
                                foreach ($paymentExecutionDetailItemList as $paymentExecutionDetailItem) {
                                   // echo("                            PaymentExecutionDetailItem\n");
                                    if ($paymentExecutionDetailItem->isSetPayment()) { 
                                      //  echo("                                Payment\n");
                                        $payment = $paymentExecutionDetailItem->getPayment();
                                        if ($payment->isSetCurrencyCode()) 
                                        {
                                           // echo("                                    CurrencyCode\n");
                                           // echo("                                        " . $payment->getCurrencyCode() . "\n");
                                        }
                                        if ($payment->isSetAmount()) 
                                        {
                                          //  echo("                                    Amount\n");
                                           // echo("                                        " . $payment->getAmount() . "\n");
                                        }
                                    } 
                                    if ($paymentExecutionDetailItem->isSetSubPaymentMethod()) 
                                    {
                                      //  echo("                                SubPaymentMethod\n");
                                      //  echo("                                    " . $paymentExecutionDetailItem->getSubPaymentMethod() . "\n");
                                    }
                                }
                            } 
                            if ($order->isSetPaymentMethod()) 
                            {
                                //echo("                        PaymentMethod\n");
                                //echo("                            " . $order->getPaymentMethod() . "\n");
                            }
                            if ($order->isSetMarketplaceId()) 
                            {
                                //echo("                        MarketplaceId\n");
                               // echo("                            " . $order->getMarketplaceId() . "\n");
                            }
                            if ($order->isSetBuyerEmail()) 
                            {
                             //   echo("                        BuyerEmail\n");
                            //    echo("                            " . $order->getBuyerEmail() . "\n");
								
								$Email				=  $order->getBuyerEmail() ;
								
                            }
                            if ($order->isSetBuyerName()) 
                            {
								
								$UserID	= mysql_escape_string($order->getBuyerName());
								
								
                            }
                            if ($order->isSetShipmentServiceLevelCategory()) 
                            {
                                //echo("                        ShipmentServiceLevelCategory\n");
                               // echo("                            " . $order->getShipmentServiceLevelCategory() . "\n");
                            }
							
						
							
							
					$Country_q = countryname_change($Country);
					$sql			 = "INSERT INTO `ebay_order` (`ebay_paystatus`,`ebay_ordersn` ,`ebay_tid` ,`ebay_ptid` ,`ebay_orderid` ,";
					$sql			.= "`ebay_createdtime` ,`ebay_paidtime` ,`ebay_userid` ,`ebay_username` ,`ebay_usermail` ,`ebay_street` ,";
					$sql			.= "`ebay_street1` ,`ebay_city` ,`ebay_state` ,`ebay_couny` ,`ebay_countryname` ,`ebay_postcode` ,`ebay_phone`";
					$sql			.= " ,`ebay_currency` ,`ebay_total` ,`ebay_status`,`ebay_user`,`ebay_shipfee`,`ebay_account`,`recordnumber`,`ebay_addtime`,`ebay_note`,`ebay_site`,`eBayPaymentStatus`,`PayPalEmailAddress`,`ShippedTime`,`RefundAmount`,`ebay_warehouse`,`order_no`)VALUES ('Complete','$val', '$tid' , '$ptid' , '$orderid' , '$CreatedDate' , '$PaidTime' , '$UserID' ,";
					$sql			.= " '$Name' , '$Email' , '$Street1' , '$Street2' , '$CityName','$StateOrProvince' , '$Country' , '$Country_q' , '$PostalCode' , '$Phone' , '$Currency' , '$AmountPaid' , '$orderstatus','$user','$shipingfee','$account','".(($addrecordnumber=='')?$val:$addrecordnumber)."','$mctime','$BuyerCheckoutMessage','$site','$eBayPaymentStatus','$PayPalEmailAddress','$ShippedTime','$RefundAmount','$defaultstoreid','$order_no')";
                                        
                                        
                                        $sg				= "select * from ebay_order where ebay_ordersn ='$val' ";
                                        $sg				= $dbcon->execute($sg);
					$sg				= $dbcon->getResultArray($sg);
                                        
                                        if(count($sg) == 0){
                                                $dbcon->execute($sql);
                                                addLog("ordersn:$val 添加成功。");
                                        }else{
                                                addLog("ordersn:$val 在数据库中已经存在。");
                                        }
                                        
                                        
                                        
					
		
					

								
                        }
                    }
					


					 if ($listOrdersByNextTokenResult->isSetNextToken()) 
                    {
                        echo("                NextToken\n");
                        echo("                    " . $listOrdersByNextTokenResult->getNextToken() . "\n");

						$tokens			= $listOrdersByNextTokenResult->getNextToken() ;
						return $tokens;

                    }else{

						
						return 0;


					}

                } 
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

     } catch (MarketplaceWebServiceOrders_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
     }
 }
 
 
 
 
function addLog($log,$type="1"){
     global $account;
    
    
    if($type==1){
        $filename	=	"ebay_order_".$account.".sql";
    }else{
        $filename	=	"ebay_orderdetail_".$account.".sql";
    }
    
            $fp = @fopen($filename, 'ab');
            @flock($fp, LOCK_EX);
            @fwrite($fp, $log.";;;");
            @flock($fp, LOCK_UN);
}



 function countryname_change($Country){
	
		$UKshortCountryName= array(
							
							'Angola'=>'AO',
							'Afghanistan'=>'AF',
							'Albania'=>'AL',
							'Algeria'=>'DZ',
							'Andorra'=>'AD',
							'Anguilla'=>'AI',
							'Antigua and Barbuda'=>'AG',
							'Argentina'=>'AR',
							'Armenia'=>'AM',
							'Australia'=>'AU',
							'Austria'=>'AT',
							'American samoa'=>'AS',
							'Antarctica'=>'AQ',
							'Aruba'=>'AW',
							'Azerbaijan'=>'AZ',
							'Bahamas'=>'BS',
							'Bahrain'=>'BH',
							'Bangladesh'=>'BD',
							'Barbados'=>'BB',
							'Belarus'=>'BY',
							'Belgium'=>'BE',
							'Belize'=>'BZ',
							'Benin'=>'BJ',
							'Bermuda Is.'=>'BM',
							'Bolivia'=>'BO',
							'Botswana'=>'BW',
							'Brazil'=>'BR',
							'Brunei'=>'BN',
							'Bulgaria'=>'BG',
							'Burkina-faso'=>'BF',
							'Bhutan'=>'BT',
							'Bosnia and herzegovina'=>'BA',
							'Bouvet Island'=>'BV',
							'British indian ocean territory'=>'IO',
							'Burundi'=>'BI',
							'Christmas Island'=>'CX',
							'Cape Verde'=>'CV',
							'Cameroon'=>'CM',
							'Canada'=>'CA',
							'Cayman Is.'=>'KY',
							'Central African Republic'=>'CF',
							'Chad'=>'TD',
							'Chile'=>'CL',
							'Cambodia'=>'KH',
							'Cocos Islands'=>'CC',
							'Comors'=>'KM',
							'Cote　D\'lvoire'=>'CI',
							'Croatia'=>'HR',
							'Colombia'=>'CO',
							'Congo'=>'CG',
							'Cook Is.'=>'CK',
							'Costa Rica'=>'CR',
							'Cuba'=>'CU',
							'Cyprus'=>'CY',
							'Czech Republic'=>'CZ',
							'Denmark'=>'DK',
							'Djibouti'=>'DJ',
							'Dominica Rep.'=>'DO',
							'Ecuador'=>'EC',
							'East Timor'=>'TP',
							'Equatoria Guinea '=>'GQ',
							'Egypt'=>'EG',
							'EI Salvador'=>'SV',
							'Estonia'=>'EE',
							'Ethiopia'=>'ET',
							'Fiji'=>'FJ',
							'Finland'=>'FI',
							'France'=>'FR',
							'Falkland Islands'=>'FK',
							'Faroe Islands'=>'FO',
							'French Polynesia'=>'PF',
							'French Guiana'=>'GF',
							'French Southern'=>'TF',
							'Gabon'=>'GA',
							'Gambia'=>'GM',
							'Georgia'=>'GE',
							'Germany'=>'DE',
							'Ghana'=>'GH',
							'Gibraltar'=>'GI',
							'Guadeloupe'=>'GP',
							'Greece'=>'GR',
							'Grenada'=>'GD',
							'Guam'=>'GU',
							'Guernsey'=>'GG',
							'Guatemala'=>'GT',
							'Guinea-Bissau'=>'GW',
							'Guinea'=>'GN',
							'Guyana'=>'GY',
							'Haiti'=>'HT',
							'Honduras'=>'HN',
							'Heard and McDonald'=>'HM',
							'Hongkong'=>'HK',
							'Hungary'=>'HU',
							'Iceland'=>'IS',
							'India'=>'IN',
							'Indonesia'=>'ID',
							'Iran'=>'IR',
							'Iraq'=>'IQ',
							'Ireland'=>'IE',
							'Israel'=>'IL',
							'Italy'=>'IT',
							'Ivory Coast'=>'CI',
							'Jamaica'=>'JM',
							'Jersey'=>'JE',
							'Japan'=>'JP',
							'Jordan'=>'JO',
							'Kazakstan'=>'KZ',
							'Korea'=>'KR',
							'Kuwait'=>'KW',
							'Kyrgyzstan'=>'KG',
							'Kosovo'=>'KV',
							'Laos'=>'LA',
							'Lativia'=>'LV',
							'Lebanon'=>'LB',
							'Lesotho'=>'LS',
							'Liberia'=>'LR',
							'Liechtenstein'=>'LI',
							'Lithuania'=>'LT',
							'Luxembourg'=>'LU',
							'Macau'=>'MO',
							'Madagascar'=>'MG',
							'Marshall Islands'=>'MH',
							'Martinique'=>'MQ',
							'Malawi'=>'MW',
							'Malaysia'=>'MY',
							'Maldives'=>'MV',
							'Mali'=>'ML',
							'Malta'=>'MT',
							'Mauritius'=>'MU',
							'Micronesia'=>'FM',
							'Mexico'=>'MX',
							'Moldova Republic of'=>'MD',
							'Monaco'=>'MC',
							'Myanmar'=>'MM',
							'Mongolia'=>'MN',
							'Montserrat Is'=>'MS',
							'Morocco'=>'MA',
							'Mozambique'=>'MZ',
							'Namibia'=>'NA',
							'Nauru'=>'NR',
							'Nepal'=>'NP',
							'Netheriands　Antilles'=>'AN',
							'Netherlands'=>'NL',
							'Neutral　Zone'=>'NT',
							'New　Caledonia'=>'NC',
							'New　Zealand'=>'NZ',
							'Nicaragua'=>'NI',
							'Niger'=>'NE',
							'Norfolk　Island'=>'NF',
							'Northern　Mariana'=>'MP',
							'Nigeria'=>'NG',
							'North　Korea'=>'KP',
							'Norway'=>'NO',
							'Oman'=>'OM',
							'Pakistan'=>'PK',
							'Palau'=>'PW',
							'Pitcairn'=>'PN',
							'Panama'=>'PA',
							'Papua　New　Cuinea'=>'PG',
							'Paraguay'=>'PY',
							'Peru'=>'PE',
							'Philippines'=>'PH',
							'Poland'=>'PL',
							'Portugal'=>'PT',
							'Puerto Rico'=>'PR',
							'Qatar'=>'QA',
							'Reunion'=>'RE',
							'Rwanda'=>'RW',
							'Romania'=>'RO',
							'Russia'=>'RU',
							'Saint Lueia'=>'LC',
							'Saint Vincent'=>'VC',
							'Saint Kitts and Nevis'=>'KN',
							'Svalbard and  Jan'=>'SJ',
							'Samoa Eastern'=>'AS',
							'Samoa Western'=>'WS',
							'San Marino'=>'SM',
							'Sao Tome and Principe'=>'ST',
							'Saudi Arabia'=>'SA',
							'Senegal'=>'SN',
							'Seychelles'=>'SC',
							'Sierra Leone'=>'SL',
							'Singapore'=>'SG',
							'Slovakia'=>'SK',
							'Slovenia'=>'SI',
							'Solomon Is'=>'SB',
							'Somali'=>'SO',
							'South Africa'=>'ZA',
							'Spain'=>'ES',
							'Sri Lanka'=>'LK',
							'St.Lucia'=>'LC',
							'Saipan'=>'MP',
							'St.Vincent'=>'VC',
							'Sudan'=>'SD',
							'Suriname'=>'SR',
							'Swaziland'=>'SZ',
							'Sweden'=>'SE',
							'Switzerland'=>'CH',
							'Syria'=>'SY',
							'Taiwan'=>'TW',
							'Tajikstan'=>'TJ',
							'Tanzania'=>'TZ',
							'Thailand'=>'TH',
							'Togo'=>'TG',
							'Tonga'=>'TO',
							'Tokelau'=>'TK',
							'Turks and Caicos'=>'TC',
							'Trinidad and Tobago'=>'TT',
							'Tunisia'=>'TN',
							'Turkey'=>'TR',
							'Tahiti'=>'PF',
							'Turkmenistan'=>'TM',
							'Uganda'=>'UG',
							'Ukraine'=>'UA',
							'United Arab Emirates'=>'AE',
							'United Kingdom'=>'GB',
							'US Minor Outlying'=>'UM',
							'United States'=>'US',
							'Uruguay'=>'UY',
							'Uzbekistan'=>'UZ',
							'Vanuatu'=>'VU',
							'Vatican City State'=>'VA',
							'Virgin Islands（U.s）'=>'VI',
							'Virgin Islands（British）'=>'VG ',
							'Venezuela '=>'VE',
							'Vietnam'=>'VN',
							'Yemen'=>'YE',
							'Yugoslavia'=>'YU',
							'Zimbabwe'=>'ZW',
							'Zaire'=>'ZR',
							'Zambia'=>'Z');
								
		$Country_q = array_search($Country,$UKshortCountryName);
		
		if($Country_q == false){
			
			$Country_q = $Country;
		
		}
		return $Country_q;
 
 }