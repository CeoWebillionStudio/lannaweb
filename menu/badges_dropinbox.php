<?php session_start();
  require_once ('../actions/config_mysql_oop.php');
  $numr=0;
  $MsDb = new MSClass;
  $MsDb->ConnectMsDB();
  $sql = "SELECT
  dbo.web_document_tea.td_no,
  dbo.web_document_tea.td_update,
  dbo.web_document_tea.td_ddate
  FROM
    dbo.web_document_doc
    INNER JOIN dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
    INNER JOIN dbo.teacher ON dbo.web_document_doc.tea_id = dbo.teacher.tea_id
    INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
  WHERE
    (dbo.web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND
    (dbo.web_document_tea.td_read = '3' or  dbo.web_document_tea.td_read = '2')
    AND
dbo.web_document_tea.td_ddate IS NULL
  ORDER BY
    dbo.web_document_tea.td_update DESC";
  $time_now   = date('Y-m-d H:i:s');
  $db = $MsDb->MsQuery($sql);
    while($res = $MsDb->MsResult($db)){
      $time_left=strtotime($time_now)-strtotime(date_format($res['td_update'],'Y-m-d H:i:s'));
      if($time_left>=432000){
        $sqlselect = "UPDATE [CMS].[dbo].[web_document_tea] SET [td_ddate]='".$time_now."' WHERE ([td_no]='".$res['td_no']."')";
        $MsDb->MsQuery($sqlselect);
      }
    }
  $sql2 = "SELECT
    dbo.web_document_tea.td_no,
    dbo.web_document_tea.td_update,
    dbo.web_document_tea.td_ddate
    FROM
      dbo.web_document_doc
      INNER JOIN dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
      INNER JOIN dbo.teacher ON dbo.web_document_doc.tea_id = dbo.teacher.tea_id
      INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
    WHERE
      (dbo.web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND
      (dbo.web_document_tea.td_read = '3' or  dbo.web_document_tea.td_read = '2')
      AND
  dbo.web_document_tea.td_ddate IS NULL
    ORDER BY
      dbo.web_document_tea.td_update DESC";
  $db2 = $MsDb->MsQuery($sql2);
  $numr =$MsDb->MsNumRows($db2);
  echo $numr;
?>