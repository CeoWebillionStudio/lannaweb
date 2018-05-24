<?php session_start();
 require_once '../actions/config_mysql_oop.php';
               $MsDb = new MSClass();
                 $MsDb->ConnectMsDB();
                // $sql = "";
                // $db = $MsDb->MsQuery($sql);		
                // print_r($_GET);
                // exit;
?>
<div class="modal-body">
<form method="post" name="addfile" id="addfile">
        <label for="exampleFormControlFile1">เอกสารที่ต้องการแนบ</label>
        <input class="form-control" type="text" placeholder="ชื่อไฟล์ที่ต้องการแนบ" id="nameFile" name="nameFile"><br>
        <input type="file" class="form-control-file" name="file_doc" id="file_doc"><br>
        <button type="button" class="btn btn-success" onclick="funaddfilesforans()">เพิ่มไฟล์แนบ</button>
        <button type="reset" class="btn btn-danger">ยกเลิก</button>
    </form>
<div class="container">       
    <div class="row mt-3">
        <div class="col-xl-12">
            <table class="table" style="height:20vh;overflow-y:scroll;">
                <thead class="thead-dark">
                    <tr class="row">
                        <th class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2"><center>ลำดับ</center></th>
                        <th class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-10">ชื่อไฟล์</th>
                        <th class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-8">ดาวน์โหลด</th>
                        <th class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4"><center>ลบไฟล์</center></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $sql3 = "SELECT
                    dbo.web_document_doc.doc_no,
                    dbo.web_document_doc.doc_name,
                    dbo.web_document_doc.doc_detail,
                    dbo.web_document_doc.tea_id,
                    dbo.web_document_doc.doc_update,
                    dbo.web_document_file.file_name,
                    dbo.web_document_file.file_path,
                    dbo.web_document_file.file_id
                    
                    FROM
                    dbo.web_document_doc
                    INNER JOIN dbo.web_document_file ON dbo.web_document_doc.doc_no = dbo.web_document_file.doc_id
                    WHERE
                    dbo.web_document_doc.doc_no = '".$_GET['doc_id']."' AND
                    dbo.web_document_file.tfile_id = 4";
                    $db3 = $MsDb->MsQuery($sql3);
                    $i=0;
                    while($res3 = $MsDb->MsResult($db3)){
                ?>
                    <tr class="row border border-dark border-top-0">
                        <th class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                            <center>  
                                <?php echo ++$i; ?>
                            </center>
                        </th>
                        <td class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-10"><?php echo conv_tis_utf($res3['file_name']);?></td>
                        <td class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-8"><a target="_blank" href="<?php echo $res3['file_path'];?>"><center><i class="fa fa-download">&nbsp;ดาวน์โหลด</i></center></a></td>
                        <form method="post" name="delfile" id="delfile">    
                            <td class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                <center>
                                <a class="btn btn-danger text-light" data-id="<?php echo $res3['file_id'];?>" onclick="fundelfilesforans(this)">
                                    x
                                </a>
                                </center>
                            </td>
                        </form>
                        </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  
 </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info text-light" data-id="<?php echo $_GET['doc_id'];?>" onclick="funanswermail(this)">ถัดไป</button>
            </div>   
<script>
function funanswermail(ele){

$('#showansdoc').load('Modal/modal_mail_answer.php',{doc_id:$(ele).data('id')});

}
function funaddfilesforans() {
    var form = $("#addfile");
    var formData = new FormData(form[0]);
    $.ajax({
        type: "POST",
        url: 'actions/update_file.php?st=4&doc_id=<?php echo $_GET['doc_id'];?>',
        data: formData,
        contentType: false, 
        processData: false,
        success: function (data) {
            // alert(data);
            
            $('#showansdoc').load('Modal/modal_upload_files_answer.php?doc_id=<?php echo $_GET['doc_id'];?>');
        }
    });
}
function fundelfilesforans(ele){
   swal({
        title: "คุณต้องการลบไฟล์แนบใช่หรือไม่?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            $.ajax({
                type: "POST",
                url: 'actions/update_file.php?st=3',
                data: {file_id:$(ele).data('id')},
                success: function (data){
                    $('#showansdoc').load('Modal/modal_upload_files_answer.php?doc_id=<?php echo $_GET['doc_id'];?>');
                }
            });
      swal("ทำการลบไฟล์แนบเสร็จสิ้น!!!", {
                icon: "success",
            });
        }else{
            swal("ยกเลิกการลบไฟล์แนบของท่านแล้ว!!");
        }
    });     
}
</script>

