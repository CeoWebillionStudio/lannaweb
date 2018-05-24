<?php session_start();
$numr=0;
require_once ('../actions/config_mysql_oop.php');
$MsDb = new MSClass;
$MsDb->ConnectMsDB(); 
$sql = "SELECT
dbo.web_document_doc.doc_no,
dbo.web_document_doc.doc_name,
dbo.web_document_tea.td_del,
dbo.web_document_tea.td_update,
dbo.web_document_doc.doc_update

FROM         dbo.web_document_doc INNER JOIN
                      dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
WHERE     (dbo.web_document_doc.tea_id = '".$_SESSION['OnlineService']."')
GROUP BY
dbo.web_document_doc.doc_no,
dbo.web_document_doc.doc_name,
dbo.web_document_doc.doc_update,
dbo.web_document_tea.td_del,
dbo.web_document_tea.td_update
HAVING      (dbo.web_document_tea.td_del = '1')
ORDER BY
dbo.web_document_tea.td_update ASC
";
   //echo $sql;


   $time_now   = date('Y/m/d H:i:s');
	 $db = $MsDb->MsQuery($sql);
    while($res = $MsDb->MsResult($db)){
      $time_left = strtotime($time_now)-strtotime(date_format($res['td_update'],'Y/m/d H:i:s'));
      if($time_left>=432000){
        //echo conv_tis_utf($res['doc_no']).'->ลบแล้ว<br>';
        $sqlselect = "SELECT dbo.web_document_file.file_path FROM dbo.web_document_file WHERE doc_id='".$res['doc_no']."'";
        $dbselect = $MsDb->MsQuery($sqlselect);
          while($resselect = $MsDb->MsResult($dbselect)){
               unlink('../'.$resselect['file_path']);
          }
        $sqlselecttd ="SELECT dbo.web_document_tea.td_no,dbo.web_document_doc.doc_no FROM dbo.web_document_doc INNER JOIN dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
                    WHERE dbo.web_document_doc.doc_no = '".$res['doc_no']."'";
        $dbselecttd = $MsDb->MsQuery($sqlselecttd);
          while($resselecttd = $MsDb->MsResult($dbselecttd)){
              $sqldeltd = "DELETE FROM dbo.web_document_tea WHERE td_no='".$resselecttd['td_no']."'";
              $MsDb->MsQuery($sqldeltd);
          }
          $sqldel = "DELETE FROM dbo.web_document_doc WHERE doc_no='".$res['doc_no']."'";
          $dbdel = $MsDb->MsQuery($sqldel);
      }
    }
    $sql2 = "SELECT
dbo.web_document_doc.doc_no,
dbo.web_document_doc.doc_name,
dbo.web_document_tea.td_del,
dbo.web_document_tea.td_update,
dbo.web_document_doc.doc_update

FROM         dbo.web_document_doc INNER JOIN
                      dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
WHERE     (dbo.web_document_doc.tea_id = '".$_SESSION['OnlineService']."')
GROUP BY
dbo.web_document_doc.doc_no,
dbo.web_document_doc.doc_name,
dbo.web_document_doc.doc_update,
dbo.web_document_tea.td_del,
dbo.web_document_tea.td_update
HAVING      (dbo.web_document_tea.td_del = '1')
ORDER BY
dbo.web_document_tea.td_update ASC
";
  $db2 = $MsDb->MsQuery($sql2);
  $numr =$MsDb->MsNumRows($db2);
  echo $numr;
?>
