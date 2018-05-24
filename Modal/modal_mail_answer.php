<?php session_start();
 require_once '../actions/config_mysql_oop.php';
               $MsDb = new MSClass();
                 $MsDb->ConnectMsDB();
                // $sql = "";
                // $db = $MsDb->MsQuery($sql);
                // print_r($_POST);
                // exit;
?>
    <div class="modal-body">
        <p>ข้อความ</p>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info text-light" onclick="">เลือกผู้ส่งต่อ</button>
    </div>
<!-- <script>
$('#showfilesuploadforans').load('Modal/modal_show_answer.php?doc_id=<?php echo $_POST['doc_id'];?>');
</script> -->