<?php
header("Content-type:text/html;charset=utf-8");
error_reporting(1);
$end			= "2013-06-29";
$start			= "2013-06-30";
$account		= "yansuxianzl888@gmail.com";




$ss = array(
    array("id"=>487,
        "ebay_account"=>"yansuxianzl888@gmail.com",
        "ebay_user"=>"vipwang",
        "AWS_ACCESS_KEY_ID"=>"AKIAJT2QE6JRFXXXCJUQ",
        "AWS_SECRET_ACCESS_KEY"=>"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",
        "MERCHANT_ID"=>"A080458028AFWRSIX0I7V",
        "MARKETPLACE_ID"=>"ATVPDKIKX0DER",
        "serviceUrl"=>"https://mws.amazonservices.com",
        
        ),
);

//echo '<pre>';print_r($ss);exit;

$AWS_ACCESS_KEY_ID		= $ss[0]['AWS_ACCESS_KEY_ID'];
$AWS_SECRET_ACCESS_KEY	= $ss[0]['AWS_SECRET_ACCESS_KEY'];
$MERCHANT_ID			= $ss[0]['MERCHANT_ID'];
$MARKETPLACE_ID			= $ss[0]['MARKETPLACE_ID'];
$serviceUrl				= $ss[0]['serviceUrl'].'/Orders/2011-01-01';
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
 
 if($user != 'amdd99'){

 // List all orders udpated after a certain date
 $request->setCreatedAfter(new DateTime($start.' 00:00:00', new DateTimeZone('UTC')));
 //$request->setCreatedBefore(new DateTime($end.' 23:59:59', new DateTimeZone('UTC')));
 // Set the marketplaces queried in this ListOrdersRequest
 $marketplaceIdList = new MarketplaceWebServiceOrders_Model_MarketplaceIdList();
 $marketplaceIdList->setId(array(MARKETPLACE_ID));
 $request->setMarketplaceId($marketplaceIdList);
 invokeListOrders($service, $request);
 
 
	
	
 }else{
 	
	
	
	

	
	
	
	
	    $start		= date('Y-m-d H:i:s',strtotime('-16 hour',strtotime($start.' 00:00:00')));
		$end		= date('Y-m-d H:i:s',strtotime('-16 hour',strtotime($end.date('H:i:s'))));	
		
		 $marketplaceIdList = new MarketplaceWebServiceOrders_Model_MarketplaceIdList();
			 $marketplaceIdList->setId(array(MARKETPLACE_ID));
			 $request->setMarketplaceId($marketplaceIdList);
		
		$i = 0;
		while(true){
			if($i == 0){
				$tstart		= $start;
				$tend		= date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($start)));					
			}else{				
				$tstart		= $tend;
				$tend		= date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($tstart)));
			}			
			$astart	= date('Y-m-d',strtotime($tstart))." ".date('H:i:s',strtotime($tstart));
			$aend	= date('Y-m-d',strtotime($tend))." ".date('H:i:s',strtotime($tend));
			echo '<br>';
			
			echo $astart;
			echo $aend;

			
			$request->setCreatedAfter(new DateTime($astart, new DateTimeZone('UTC')));
			$request->setCreatedBefore(new DateTime($aend, new DateTimeZone('UTC')));
			
			$errorstatus	=  invokeListOrders($service, $request);
			
			
			if($errorstatus == 88) invokeListOrders($service, $request);
		
			
			
			
			
			$i++;
			
			//if($i ==3 ) die();
	
			
			echo $astart.' ** '.$aend.'<br>';
			
			if(strtotime($tend)>strtotime($end)){
				echo 'pp销售额已经同步完成<br>';
				break;
			}
			
			
			
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
 
 
 


                                        
/**
  * List Orders Action Sample
  * ListOrders can be used to find orders that meet the specified criteria.
  *   
  * @param MarketplaceWebServiceOrders_Interface $service instance of MarketplaceWebServiceOrders_Interface
  * @param mixed $request MarketplaceWebServiceOrders_Model_ListOrders or array of parameters
  */
  function invokeListOrders(MarketplaceWebServiceOrders_Interface $service, $request) 
  {
  
  	  global $user,$account,$dbcon,$defaultstoreid;
	  
      try {
              $response = $service->listOrders($request);
              
			  
			

			  
       
	
//print_r($response);



			
			  
              //  echo ("Service Response\n");
             //   echo ("=============================================================================\n");

                if ($response->isSetListOrdersResult()) { 
                  //  echo("            ListOrdersResult\n");
                    $listOrdersResult = $response->getListOrdersResult();echo '000000000';
                    if ($listOrdersResult->isSetNextToken()) 
                    {
                 //       echo("                NextToken\n");
					       //echo("                    " . $listOrdersResult->getNextToken() . "\n");
echo "22222";   var_dump($listOrdersResult);exit;
							  $tokens =  $listOrdersResult->getNextToken();
						echo "111";   var_dump($tokens);exit;	 
							 
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
                    echo 'aaaaaaa';
                    if ($listOrdersResult->isSetCreatedBefore()) 
                    {
                 //       echo("                CreatedBefore\n");
                //        echo("                    " . $listOrdersResult->getCreatedBefore() . "\n");
                    }
                    if ($listOrdersResult->isSetLastUpdatedBefore()) 
                    {
                   //     echo("                LastUpdatedBefore\n");
                  //      echo("                    " . $listOrdersResult->getLastUpdatedBefore() . "\n");
                    }
                    if ($listOrdersResult->isSetOrders()) {echo "cccccccc"; 
                 //       echo("                Orders\n");
                        $orders = $listOrdersResult->getOrders();echo 'orders:';var_dump($orders);
                        $orderList = $orders->getOrder();echo 'order list :';var_dump($orderList);
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
							

                                        //comment by andy 20130518
							 if($order->isSetAmazonOrderId() && $orderstatus == '822' ) 
                             
                            {
                        
								 $val							= $order->getAmazonOrderId();
								 $request = new MarketplaceWebServiceOrders_Model_ListOrderItemsRequest();
								 $request->setSellerId(MERCHANT_ID);
								 $request->setAmazonOrderId($val);
								 if($val != '') invokeListOrderItems($service, $request,$val,$account); 
                            }

echo "22222";   var_dump($val);exit;	
							
							
							
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
					
                                       
                                        echo $sql.";<br>";
					
					
		
					

								
                        }
                    } 
                    echo "ddddddddd"; 
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
		 
		 
		 return 88;
		 
     }
 }
 
 
 
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
                                
                                $title = addslashes($title);
							
				$esql	 = "INSERT INTO `ebay_orderdetail` (`ebay_ordersn` ,`ebay_itemid` ,`ebay_itemtitle` ,`ebay_itemprice` ,";
				$esql    .= "`ebay_amount` ,`ebay_createdtime` ,`ebay_shiptype` ,`ebay_user`,`sku`,`shipingfee`,`ebay_account`,`addtime`,`ebay_itemurl`,`ebay_site`,`recordnumber`,`storeid`,`ListingType`,`ebay_tid`,`FeeOrCreditAmount`,`FinalValueFee`,`attribute`,`notes`,`goods_location`)
                                    VALUES ('$val', '$ebay_itemid' , '$title' , '$ebayitemprice' , 
                                        '$amount'";
				$esql	.= " , '$ctime' , '$shiptype' , '$user','$sku','$shipingfee','$account','$mctime','$pic','$site','$recordnumber','$storeid','$ListingType','$tid','$FeeOrCreditAmount','$FinalValueFee','$arrribute','$BuyerCheckoutMessage','$goods_location')";	
				
		
				echo $esql.";<br>";
							
							
					
				
				
				
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
	  global $user,$account,$dbcon;

      try {

              $response = $service->listOrdersByNextToken($request);
echo '我执行了,,,';

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
                                        
                                        
                                        echo $sql.";<br>";
				
					
		
					

								
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
 
 function countryname_change($Country){
	
		$UKshortCountryName=array(
				"United Kingdom"  =>"GB",
				"Germany"         =>"DE",
				"Ireland"         =>"IE",
				"Austria"         =>"AT",
				"Switzerland"     =>"CH",
				"Belgium"         =>"BE",
				"Denmark"         =>"DK",
				"France"          =>"FR",
				"Luxembourg"      =>"LU",
				"Monaco"          =>"MC",
				"Netherlands"     =>"NL",
				"Greece"          =>"GR",
				"Italy"           =>"IT",
				"Portugal"        =>"PT",
				"Spain"           =>"ES",
				"Albania"         =>"AL",
				"Armenia"         =>"AM",
				"Azerbaijan"      =>"AZ",
				"Belarus"         =>"BY",
				"Belgium"         =>"BE",
				"Bosnia & Herzegovina"=>"BA",
				"Bulgaria"        =>"BG",
				"Croatia"         =>"HR",
				"Cyprus"          =>"CY",
				"Czech Republic"  =>"CZ",
				"Denmark"         =>"DK",
				"Estonia"         =>"EE",
				"Finland"         =>"FI",
				"Georgia"         =>"GE",
				"Gibraltar"       =>"GI",
				"Greenland"       =>"GL",
				"UK"              =>"GG",
				"Faroe Islands"   =>"FO",
				"Isle of Man"     =>"IM",
				"Hungary"         =>"HU",
				"Iceland"         =>"IS",
				"Ireland"         =>"IE",
				"Kazakhstan"      =>"KZ",
				"Kosovo"          =>"XZ",
				"Kyrgyzstan"      =>"KG",
				"Latvia"          =>"LV",
				"Liechtenstein"   =>"LI",
				"Lithuania"       =>"LT",
				"Luxembourg"      =>"LU",
				"Macedonia"       =>"MK",
				"Malta"           =>"MT",
				"Moldova"         =>"MD",
				"Monaco"          =>"MC",
				"Montenegro"      =>"ME",
				"Norway"          =>"NO",
				"Poland"          =>"PL",
				"Portugal"        =>"PT",
				"Romania"         =>"RO",
				"Russian Federation"=>"RU",
				"San Marino"      =>"SM",
				"Serbia"          =>"RS",
				"Slovakia"        =>"SK",
				"Slovenia"        =>"SI",
				"Tajikistan"      =>"TJ",
				"Turkey"          =>"TR",
				"Turkmenistan"    =>"TM",
				"Ukraine"         =>"UA",
				"Uzbekistan"      =>"UZ",
				"Vatican City"    =>"VA",
				"Afghanistan"     =>"AF",
				"Algeria"         =>"DZ",
				"Angola"          =>"AO",
				"Anguilla"        =>"AI",
				"Antigua & Barbuda"=>"AG",
				"Belgium"         =>"BE",
				"Sweden"          =>"SE",
                                "Republic of Peru"=>"PE",
				"United States"		=> "US"
		);
								
		$Country_q = $Country;
		
		foreach( $UKshortCountryName as $key=>$ukcountry){
			
			if($Country == $ukcountry){
			
				$Country_q = $key;
			
			}
			
		
		}
		return $Country_q;
 
 }
?>