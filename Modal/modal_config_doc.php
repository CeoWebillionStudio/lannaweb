<?php session_start();
  $_SESSION['doc_no']=$_POST['doc_id'];
    require '../actions/config_mysql_oop.php';
    $MsDb = new MSClass();
    $MsDb ->ConnectMsDB();
    $sql="SELECT
    dbo.web_document_doc.doc_detail,
    dbo.web_document_doc.doc_name,
    dbo.web_document_doc.doc_update
    
    FROM
    dbo.web_document_doc
    WHERE
    dbo.web_document_doc.doc_no = '".$_SESSION['doc_no']."'";
    $db=$MsDb->MsQuery($sql);
    $res=$MsDb->MsResult($db);
    $doc_update= date_format($res['doc_update'],'d/m/Y');
?>

    <form method="post" name="configdoc" id="configdoc">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขเอกสารแบบร่าง ที่ <?php echo $_SESSION['doc_no']; ?></h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-group row">
        <div class="col-8">
          <input class="form-control" type="text" id="nameDoc" name="nameDoc" value="<?php echo conv_tis_utf($res['doc_name']);?>">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <textarea class="form-control" id="detailDoc" name="detailDoc" rows="3" type="text"><?php echo conv_tis_utf($res['doc_detail']);?></textarea>
        </div>
      </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <div class="container text-danger">
           <?php echo "สร้างเมื่อ : ".$doc_update;?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary text-light" data-id="<?php echo $_SESSION['doc_no']; ?>" onclick="condoc(this)">บันทึก & ถัดไป</a>
        <button type="reset" class="btn btn-danger">รีเซ็ต</button>
      </div>
      </form>
     