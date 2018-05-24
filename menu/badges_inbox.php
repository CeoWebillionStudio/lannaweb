<?php session_start();
require_once ('../actions/config_mysql_oop.php');
$MsDb = new MSClass;
$MsDb->ConnectMsDB(); 
$sql = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname, 
web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 0)
";
	 //echo $sql;
	$db = $MsDb->MsQuery($sql);
    $numr =$MsDb->MsNumRows($db);
    

  ?>
<span class="badge badge-danger text-light">
    <?php echo $numr; ?>                      
</span>