<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// 定义你要存缩略图的路径
$targetFolder = '/uploads';

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    //获取临时上传来的路径
	$tempFile = $_FILES['Filedata']['tmp_name'];
	//设置移动的路径         根目录下的/uploads文件夹
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = move_uploaded_file($_FILES['Filedata']['name']);//移动文件到指定位置
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		 move_uploaded_file($tempFile,$targetFile);
		 echo 1;
	} else {
		echo 'Invalid file type.';
	}
}
?>