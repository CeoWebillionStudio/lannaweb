<?php session_start();
require_once ('../actions/config_mysql_oop.php');
$numr=0;
$MsDb = new MSClass;
$MsDb->ConnectMsDB(); 
$sql = "SELECT        aa.user_idrec
FROM            web_document_tea AS aa INNER JOIN
                         web_document_doc ON aa.doc_no = web_document_doc.doc_no
GROUP BY aa.doc_no, aa.user_idrec, web_document_doc.doc_update, web_document_doc.doc_name, aa.td_del
HAVING        (aa.td_del IS NULL OR
                         aa.td_del <> '1') AND (aa.user_idrec = '".$_SESSION['OnlineService']."')
ORDER BY aa.doc_no DESC
";
	 //echo $sql;
	$db = $MsDb->MsQuery($sql);
    $numr =$MsDb->MsNumRows($db);
    echo $numr;


  ?>