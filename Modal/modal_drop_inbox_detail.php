<?php session_start();
 require_once '../actions/config_mysql_oop.php';
               $MsDb = new MSClass();
                 $MsDb->ConnectMsDB();
                $sql = "SELECT
                dbo.web_document_doc.doc_detail,
                dbo.web_document_doc.doc_name,
                dbo.web_document_doc.doc_no,
                dbo.web_document_doc.doc_update,
                dbo.web_document_doc.tea_id,
                dbo.web_document_tea.td_no,
                dbo.web_document_tea.td_update
                FROM
                dbo.web_document_doc
                INNER JOIN dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
                WHERE
                dbo.web_document_doc.doc_no = '".$_POST['doc_id']."'
                AND
                dbo.web_document_tea.user_idsen = '".$_SESSION['OnlineService']."';
                ";
                $db = $MsDb->MsQuery($sql); 
                $res =$MsDb->MsResult($db);
                // echo $sql0;
                // exit;
			    $sql2 = "select * from web_document_file where tea_id='".$_SESSION['OnlineService']."' and doc_id=".$_POST['doc_id'];
                $db2 = $MsDb->MsQuery($sql2);	
                $numr = $MsDb->MsNumRows($db2);		
                //  echo date_format($res0['doc_update'],'d/m/Y');
                //  exit;	        
                $time1 = date_format($res['doc_update'],'Y-m-d H:i');
                $time2 = date_format($res['td_update'],'Y-m-d H:i');
                $timethai1 = thai_date($time1,0,true);
                $timethai2 = thai_date($time2,0,true);
?>
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="exampleModalLabel1">รายละเอียดเอกสาร เลขที่&nbsp;<?php echo $_POST['doc_id'];?> </h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body col-lg-12">
          
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-5">
                            <p class="float-right">หัวข้อ:</p>
                        </div>
                        <div class="col">
                            <p><?php echo conv_tis_utf($res['doc_name']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-5">
                            <p class="float-right">รายละเอียด:</p>
                        </div>
                        <div class="col">
                            <p><?php echo conv_tis_utf($res['doc_detail']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-5">
                            <p class="float-right">รับเอกสาร:</p>
                        </div>
                        <div class="col">
                            <p><?php echo $timethai1.' น.'; ?></p>
                        </div>
                    </div>
                    <div class="row text-danger">
                        <div class="col-md-3 col-sm-4 col-5">
                            <p class="float-right">วันที่ลบ:</p>
                        </div>
                        <div class="col">
                            <p><?php echo $timethai2.' น.'; ?></p>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
                            <p class="addfileinmodal">ไฟล์แนบ:</p>
                        </div>
                        <div class="col">
                        <div class="container">
                            <table class="table table-striped">
                                <thead class="thead-dark text-light">
                                    <tr class="row">
                                        <th class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3">
                                            <center>ลำดับ</center>
                                        </th>
                                        <th class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9">
                                            <center>ชื่อเอกสาร</center>
                                        </th>
                                        <th class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <center>ดาวน์โหลด</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if($numr==0){
                                ?>
                                    <tr class="border border-dark border-top-0 row table-danger">
                                        <th  class="col-12">
                                            <center class="text-danger">***ไม่มีไฟล์แนบ***</center>
                                        </th>
                                    </tr>        
                                <?php
                                    }else{
                                        while($res2 = $MsDb->MsResult($db2)){
                                ?>
                                        <tr class="border border-dark border-top-0 row">
                                            <th  class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3">
                                                <?php echo ++$i; ?>
                                            </th>
                                            <td  class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9">
                                                <?php echo conv_tis_utf($res2['file_name']);?>
                                            </td>
                                            <td  class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                                <a href="<?php echo $res2['file_path'];?>" class="">
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
                <div class="modal-footer">
                    <!--onclick="newdoc()" id="nextmodal" -->
                    <button type="button" class="btn btn-warning" data-id="<?php echo $res['td_no'];?>" onclick="recoverydocin(this)">กู้คืนเอกสาร</button>
                </div>
