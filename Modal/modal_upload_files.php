<?php session_start();
//require 'actions/config_mysql_oop.php';
              $MsDb = new MSClass();
              $MsDb->ConnectMsDB();
							$sql_doc = "select * from web_document_doc where doc_no='".$_SESSION['doc_id']."' and tea_id='".$_SESSION['OnlineService']."'";
              // print_r($_SESSION);
              // echo $sql_doc;
              // exit;
              //echo $sql_doc;
							$db_doc = $MsDb->MsQuery($sql_doc);
             $res_doc = $MsDb->MsResult($db_doc);					
             
?>
<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">แนบไฟล์ที่เกี่ยวข้องกับเอกสาร</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="addfile" name="addfile" >
        <div id="uploadbody">
          
        </div>
      </form>
    </div>
  </div>
</div>
