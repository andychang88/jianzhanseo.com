<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>

<script>
  $(document).ready(function(){
  	
  	});
</script>

<?php
set_time_limit(0);

	$img_save_path = 'E:/Data/Pictures/'.date('md').'/';
	$product_img_url = '';
	$product_img_arr = array();
	
	if(count($_POST)>0){
		$product_img_url = $_POST['product_img_url'];
		$save_path = $_POST['save_path'];
		if(!empty($save_path)){
			$save_path = $save_path.date('md').'/';
		}
		
		$cache_file = crc32($product_img_url);
		if(is_file($cache_file) ){
			$html_content = file_get_contents($cache_file);
		}else{
			$html_content = file_get_contents($product_img_url);
			file_put_contents($cache_file, $html_content);
		}
		
		if((time()-filectime($cache_file))>180){
			unlink($cache_file);
		}
		$preg = '#<input\s+type="hidden"\s+name="bigurl"\s+value="(.+?)"#';
		preg_match_all($preg, $html_content, $product_img_arr);
		//echo '<pre>';print_r($product_img_arr);
	}
?>
<h1>url生成图片</h1>
<p><form action="?" method="post">
	文件保存根目录：<input type="text" name="save_path" width="200px" value="E:/Data/Pictures/" /><br>
	文件保存后的路径是：<input type="text" name="tmp_saved_path" onclick="this.select()" width="200px" value="<?php echo $save_path;?>" /><br>
	
	<textarea name="product_img_url" style="width:600px;height:200px;"><?php echo $product_img_url;?></textarea>
	&nbsp;&nbsp;&nbsp;
	<input type="submit" name="submit" value="submit & save image" />
	<br>
</form>
<?php 
if(!empty($product_img_arr[1])){
	
	$tip_info = '<br>';
	echo '<div>';
	foreach($product_img_arr[1] as $img_url){
		echo '<img src="'.$img_url.'" width="160px" height="160px" />&nbsp;&nbsp;&nbsp;';
		
		 
		if(!empty($save_path)){
			$save_file = $save_path.basename( $img_url);
			
			if(is_file($save_file)){
				$tip_info .= $img_url.' has exists...<br>';
			}else{
				file_put_contents($save_file,file_get_contents($img_url));
				$tip_info .= $img_url.' saved.<br>';
			}
			
			
			
		}
	}
	
	echo $tip_info;
	echo '</div>';
}


?>
</p>

</body>
</html>