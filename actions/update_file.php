<?php session_start();
	require 'config_mysql_oop.php';
	$MsDb = new MSClass();
	$MsDb->ConnectMsDB();
	  
	/*ถ้ามีไฟล์เข้ามา*/
	if($_FILES['file_doc']['name']!=""){
		$last_file = explode('.',$_FILES['file_doc']['name']);
		$name_filenew = date('YmdHis_').trim($_SESSION['OnlineService']).trim($_SESSION['TeacherDep']);
		$file_path = '../file_doc/'.$name_filenew.'.'.substr(end($last_file),0,3);
		$file_path_download = 'file_doc/'.$name_filenew.'.'.substr(end($last_file),0,3);
		copy($_FILES['file_doc']['tmp_name'],$file_path);
	}

	/*เพิ่มไฟล์ที่จะส่ง*/
	if(@$_GET['st']==1){
		$sql = "insert into web_document_file (file_name,file_path,file_update,tfile_id,doc_id,tea_id) 
		values ('".conv_utf_tis($_POST['nameFile'])."','".$file_path_download."','".date('Y-m-d G:i:s')."',3,".$_SESSION['doc_id'].",'".$_SESSION['OnlineService']."')";
		$db = $MsDb->MsQuery($sql);	
	}

	/*ลบไฟล์*/
	if(@$_GET['st']==3){
		$sqlselect = "SELECT dbo.web_document_file.file_path FROM dbo.web_document_file WHERE dbo.web_document_file.file_id='".$_POST['file_id']."'";
		$dbselect = $MsDb->MsQuery($sqlselect);
		$resselect = $MsDb->MsResult($dbselect);
		unlink('../'.$resselect['file_path']);
		$sqldel = "delete from web_document_file where file_id='".$_POST['file_id']."'";
		$dbdel = $MsDb->MsQuery($sqldel);
	}

	/*เพิ่มไฟล์ที่จะส่งต่อ*/
	if(@$_GET['st']==4){
		$sql = "insert into web_document_file (file_name,file_path,file_update,tfile_id,doc_id,tea_id) values ('".conv_utf_tis($_POST['nameFile'])."','".$file_path_download."','".date('Y-m-d G:i:s')."',4,".$_GET['doc_id'].",'".$_SESSION['OnlineService']."')";
		$db = $MsDb->MsQuery($sql);	
	}
?>