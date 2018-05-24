<?php session_start();

  require_once ('../actions/config_mysql_oop.php');
  $numr['num_doc']=0;
  $MsDb = new MSClass;
  $MsDb->ConnectMsDB(); 
  $sql = "SELECT count(doc_no) as num_doc FROM web_document_doc aa WHERE ( tea_id = '".$_SESSION['OnlineService']."' ) 
          AND (( SELECT COUNT ( a1.td_stat ) AS c1 FROM web_document_tea AS a1 WHERE ( a1.doc_no = aa.doc_no )) = 0 ) ";
	$db = $MsDb->MsQuery($sql);
  $numr =$MsDb->MsResult($db);
  echo $numr['num_doc'];
  
?>