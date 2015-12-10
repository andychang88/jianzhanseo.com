<?php
set_time_limit(0);
error_reporting(E_ALL);
$end			= "2013-08-20 23:00:00";
$start			= "2013-08-18 10:00:00";
$account		= "everglcorpsales002@gmail.com";


$AWS_ACCESS_KEY_ID		= "AKIAJWV3E4ZQGNEQH2FQ";
$AWS_SECRET_ACCESS_KEY	= "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";
$MERCHANT_ID			= "A11S9UEFFS8HNW";
$MARKETPLACE_ID			= "ATVPDKIKX0DER";
$serviceUrl				= 'https://mws.amazonservices.com/Orders/2011-01-01';

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
 
 
  $request = new MarketplaceWebServiceOrders_Model_ListOrdersRequest();
  $request->setSellerId(MERCHANT_ID);
 
 
 
 
 
 
	
			  $start		= date('Y-m-d H:i:s',strtotime('-0 hour',strtotime($start)));
		$end		= date('Y-m-d H:i:s',strtotime('-0 hour',strtotime($end)));	
		
		
		


		
		 $marketplaceIdList = new MarketplaceWebServiceOrders_Model_MarketplaceIdList();
			 $marketplaceIdList->setId(array(MARKETPLACE_ID));
			 $request->setMarketplaceId($marketplaceIdList);
			 
			 
			  $orderStatuses = new MarketplaceWebServiceOrders_Model_OrderStatusList();
  $orderStatuses->setStatus(array('Unshipped','PartiallyShipped'));
  $request->setOrderStatus($orderStatuses);
 
 
		
			
			$astart	= date('Y-m-d',strtotime($start))." ".date('H:i:s',strtotime($start));
			$aend	= date('Y-m-d',strtotime($end))." ".date('H:i:s',strtotime($end));
		
			
			echo $astart.'<br>';
			echo $aend;



			
			$request->setCreatedAfter(new DateTime($astart, new DateTimeZone('UTC')));
			$request->setCreatedBefore(new DateTime($aend, new DateTimeZone('UTC')));
			
			$errorstatus	=  invokeListOrders($service, $request);
                        
                        
                        

 
 
 
 
  function invokeListOrders(MarketplaceWebServiceOrders_Interface $service, $request) 
  {
  echo "hi";
  	  
	 try {
                
                echo "in try";
                $response = $service->listOrderItems($request);
                echo "<pre>";
             var_dump($response);
			 
                         
                         
                         
                         
         } catch (MarketplaceWebServiceOrders_Exception $ex) {
                
                echo "in exception.";
                
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
		 print_r($ex);
		 
		 
		 return 88;
		 
     }

 }
            
            
            
            
?>
