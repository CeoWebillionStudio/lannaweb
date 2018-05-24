<?php session_start();
require '../actions/config_mysql_oop.php';
$MsDb = new MSClass();
$MsDb->ConnectMsDB();

?>
<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
<div class="container">       
    <div class="row mt-3">
        <div class="col-xl-6">
        
        </div>
        <div class="col-xl-6">
            <table class="table">
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
                    dbo.web_document_doc.doc_no = '".$_GET['doc_no']."' AND
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
                        <td class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-8"><a href="<?php echo $res3['file_path'];?>"><center><i class="fa fa-download">&nbsp;ดาวน์โหลด</i></center></a></td>
                        <form method="post" name="delfile" id="delfile">    
                            <td class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                <center>
                                <a class="btn btn-danger" data-id="<?php echo $res3['file_id'];?>" onclick="fundelfilesforans(this)">
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