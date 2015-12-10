<?php
set_time_limit(0);
ini_set('memory_limit','800M');

if(strpos($_SERVER['HTTP_HOST'],'113')){
  include "../../include/dbconnect.php";
  $agency_host = "http://113.108.97.88:90/glv3/";
}else{
  include "db_connect.php";
  $agency_host = "http://".$_SERVER['HTTP_HOST']."/";
}



$dbcon	= new DBClass();


$defaultstoreid = 12;
$user = "vipwang";

$ss				= "select ebay_account from ebay_account where ebay_account like '%@%' and ebay_user ='$user' ";
$ss				= $dbcon->execute($ss);
$ss				= $dbcon->getResultArray($ss);

$options_str = "";



//$agency_host = "http://113.108.97.88:90/glv3/";




foreach($ss as $key=>$val){
  $options_str .= '<option value="'.$val['ebay_account'].'">'.$val['ebay_account'].'</option>';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Amazon订单同步</title>
<script language="javascript" type="text/javascript" src="../../My97DatePicker/WdatePicker.js"></script>
</head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="10">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <form method="get" action="<?php echo $agency_host;?>MarketplaceWebServiceOrders/Samples/ListOrdersSample_gl.php" target="_blank">
        <fieldset>
        <legend>订单同步</legend>
        <p>订单付款时间：
        开始时间<input type="text" name="date1"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd H:mm:ss'})" > &nbsp;&nbsp;&nbsp;
        结束时间<input type="text" name="date2"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd H:mm:ss'})" > &nbsp;&nbsp;&nbsp;
        订单所在amazon账号<select id="account" name="account">

                    <option value="">请选择...</option>
                    <?php echo $options_str;?>
                      
                                        </select>
                                        
                                        <input type="submit" value="开始同步"  name="submit">
        </p>
        </fieldset>
      </form>
      
    </td>
  </tr>

    <tr>
    <td><br><br><br><br>
      <form method="get" action="<?php echo $agency_host;?>MarketplaceWebServiceOrders/Samples/ListOrdersSample_detail.php?date1=2013-09-17%2000:00:01&date2=2013-09-17%2003:50:59" target="_blank">
        <fieldset>
        <legend>同步订单内容</legend>
          <p>
            
            订单所在amazon账号<select id="account" name="account">

                    <option value="">请选择...</option>
                      <?php echo $options_str;?>
                                        </select>
                                        &nbsp;&nbsp;&nbsp;
                                        
            <input type="submit" value="开始同步"  name="submit">
            
          </p>
  
          </fieldset>
      </form>
      
    </td>
  </tr>
    
    
    
        <tr>
    <td><br><br><br><br>
      <form method="get" action="<?php echo $agency_host;?>MarketplaceWebServiceOrders/Samples/GetOrderSample_gl.php?date1=2013-09-17%2000:00:01&date2=2013-09-17%2003:50:59" target="_blank">
        <fieldset>
        <legend>同步单个订单</legend>
          <p>请输入amazon订单号：<input type="text" name="id"  > &nbsp;&nbsp;&nbsp;
          
          订单所在amazon账号<select id="account" name="account">

                    <option value="">请选择...</option>
                      <?php echo $options_str;?>
                                        </select>
                                        &nbsp;&nbsp;&nbsp;
            <input type="submit" value="开始同步"  name="submit">
            
          </p>
  
          </fieldset>
      </form>
      
    </td>
  </tr>
    
    
    
    
    
    
    
        <tr>
    <td><br><br><br><br>
      <form method="post" action="<?php echo $agency_host;?>MarketplaceWebServiceOrders/Samples/GetOrderSample_gl.php?date1=2013-09-17%2000:00:01&date2=2013-09-17%2003:50:59" target="_blank">
        <fieldset>
        <legend>同步多单个订单</legend>
          <p>请输入amazon订单：<textarea value="" name="orders_from" style="width:800px;height:150px;" ></textarea>
          
          
          &nbsp;&nbsp;&nbsp;<br>
          
          订单所在amazon账号<select id="account" name="account">

                    <option value="">请选择...</option>
                      <?php echo $options_str;?>
                                        </select>
                                        &nbsp;&nbsp;&nbsp;<br>
            <input type="submit" value="开始同步"  name="submit">
            
          </p>
  
          </fieldset>
      </form>
      
    </td>
  </tr>
    
    
    
    
        <tr>
    <td><br><br><br><br>
      <form method="post" action="<?php echo $agency_host;?>MarketplaceWebServiceOrders/Samples/GetOrderSample_gl.php?update_addr=1" target="_blank">
        <fieldset>
        <legend>同步地址1和地址2，州和城市一样</legend>
         
          
          订单所在amazon账号<select id="account" name="account">

                    <option value="">请选择...</option>
                     
                    
                      <?php echo $options_str;?>

                                        </select>
                                        &nbsp;&nbsp;&nbsp;<br>
            <input type="submit" value="开始同步"  name="submit">
            
          </p>
  
          </fieldset>
      </form>
      
    </td>
  </tr>
    
    
    
    
    
    
    
    
    
</table>
</body>
</html>
