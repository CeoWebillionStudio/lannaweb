<?php session_start();
  require '../actions/config_mysql_oop.php';
  $MsDb = new MSClass();
  $MsDb->ConnectMsDB();
  $sql = "SELECT
  dbo.web_document_doc.doc_no,
  dbo.web_document_doc.doc_name,
  dbo.web_document_doc.doc_detail,
  dbo.web_document_doc.tea_id,
  dbo.web_document_doc.doc_update,
  dbo.web_document_tea.user_idsen,
  dbo.teacher.tea_fname,
  dbo.teacher.tea_lname,
  dbo.web_document_tea.td_read,
  dbo.web_document_tea.td_no,
  dbo.teacher.tea_picture,
  dbo.prename.pre_prename,
  dbo.web_document_tea.td_ddate,
  dbo.web_document_tea.td_comment
  FROM
  dbo.web_document_doc
  INNER JOIN dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
  INNER JOIN dbo.teacher ON dbo.web_document_doc.tea_id = dbo.teacher.tea_id
  INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
  WHERE   (web_document_tea.td_no = '".$_POST['td_no']."')";
  $db = $MsDb->MsQuery($sql);
  $res = $MsDb->MsResult($db);

  if($res['td_read']==0){
      $sqlread = "UPDATE [CMS].[dbo].[web_document_tea] SET [td_read]='1' WHERE ([td_no]='".$_POST['td_no']."')";
      $dbread = $MsDb->MsQuery($sqlread);
  }
  $sql2 = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_file.file_name, web_document_file.file_path
  FROM            web_document_doc INNER JOIN
                           web_document_file ON web_document_doc.doc_no = web_document_file.doc_id
  WHERE        web_document_doc.doc_no = '".$res['doc_no']."'
  AND dbo.web_document_file.tfile_id = 3";
  $db2 = $MsDb->MsQuery($sql2);
  $nrow = $MsDb->MsNumRows($db2);


  $time = date_format($res['doc_update'],'Y-m-d H:i:s');
  $timethai = thai_date($time,0,true);
  $doc_no = $res['doc_no'];
  // echo $_POST['td_no'];
  // exit;
?>
<!-- Post Content Column -->
<div class="col-lg-12 hmainpage" id="page_inbox">
    <!-- Title -->
    <div class="container">
        <div class="row">
        <!--Header Row-->
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-3">
                <img src="img/icon/inbox.png" alt=s"" class="mt-3" style="height:80px;">
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-9">
                <p class="fhead mt-4"><?php echo conv_tis_utf($res['doc_name']);?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 pt-4">
                <a class="btn btn-danger text-light float-right" data-id="<?php echo $_POST['td_no'];?>" onclick="delinboxdoc(this)">ลบเอกสาร</a>
            </div>
        </div>
        <!-- Author -->
        <hr>
        <!--/////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- Detail  -->
        <div class="row">
            <div class="col-12 col-sm-1">
                <!--<center><img src="<?php echo $res['tea_picture']; ?>" alt="No Image" style="height:100px;" class="rounded-circle"></center>-->
                <center><img src="img/Tea_picture/<?php echo $res['tea_id'].'.jpg'; ?>" alt="No Image" style="height:100px;" class="rounded-circle"></center>
            </div>
            <div class="col-12 col-sm">
                <p class="text-primary col-xl-12 mb-0"><?php echo conv_tis_utf($res['pre_prename'])."  ".conv_tis_utf($res['tea_fname'])."  ".conv_tis_utf($res['tea_lname']);?></p>
                <p class="mt-0 pt-0 col-xl-12">วันที่รับเอกสาร:<i class="text-success">&nbsp;<?php echo $timethai; ?></i></p>
                <p class="col-xl-12">รายละเอียด&nbsp;:&nbsp;<b><?php echo conv_tis_utf($res['doc_detail']);?></b></p>
                <div class="row pl-3 pr-3">
                    <div class="col-xl-1 col-md-12">
                        <p>ไฟล์แนบ&nbsp;:&nbsp;</p>
                    </div>
                    <div class="col">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr class="row">
                                    <th class="col-xl-1 col-2">
                                        <center>ลำดับ</center>
                                    </th>
                                    <th class="col-xl col">
                                        ชื่อเอกสาร
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=0;
                                if($nrow==0){
                            ?>
                                    <tr class="row border border-dark border-top-0 table-danger">
                                        <th class="col-12">
                                            <center class="text-danger">***ไม่มีไฟล์แนบ***</center>
                                        </th>
                                    </tr>
                            <?php
                                }else{
                                    while($res2 = $MsDb->MsResult($db2)){
                                    ?>
                                    <tr class="row border border-dark border-top-0 table-primary">
                                        <th class="col-xl-1 col-2">
                                            <center><?php echo ++$i; ?></center>
                                        </th>
                                        <td class="col-xl col-10">
                                            <?php echo conv_tis_utf($res2['file_name']);?>
                                        </td>
                                        <td class="col">
                                                <a href="<?php echo $res2['file_path'];?>" class="float-right">
                                                    <i class="fa fa-download">&nbsp;ดาวน์โหลด</i>
                                                </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <center>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAns" aria-expanded="false" aria-controls="collapseAns">
                ตอบกลับไปยังผู้ส่ง
            </button>
            <hr>
            <form id="ans_tdcomment">
                <div class="form-group collapse" id="collapseAns">
                    <label for="exampleFormControlTextarea1" class="float-left">ข้อความตอบกลับ :</label>
                    <textarea class="form-control" id="ansarea" name="ansarea" rows="3"><?php echo conv_tis_utf($res['td_comment']);?></textarea>
                    <input type="hidden" name="td_no" value="<?php echo $res['td_no']; ?>">
                    <br>
                    <a class="btn btn-success text-light" onclick="func_update_tdcomment()">ตอบกลับเอกสาร</a>
                    <button type="reset" class="btn btn-danger">รีเซ็ต</button>
                </div>
            </form>
        </center>
    </div>
  <!--container-->
</div>
<script>
function sentansdocid(){
    $('#answer').modal('show');
    $('#showansdoc').load('Modal/modal_upload_files_answer.php?doc_id=<?php echo $res['doc_no'];?>');
}
</script>