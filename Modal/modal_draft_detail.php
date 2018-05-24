<?php session_start();
 require_once '../actions/config_mysql_oop.php';
               $MsDb = new MSClass();
                 $MsDb->ConnectMsDB();
                $sql0 = "select * from web_document_doc where doc_no=".$_POST['doc_id'];
                // echo $sql0;
                // exit;
			    $sql    = "select * from web_document_file where tea_id='".$_SESSION['OnlineService']."' and tfile_id=3 and doc_id=".$_POST['doc_id'];
                $db0    = $MsDb->MsQuery($sql0); 
                $res0   = $MsDb->MsResult($db0);
                $db     = $MsDb->MsQuery($sql);	
                $nrow   = $MsDb->MsNumRows($db);	
                //  echo date_format($res0['doc_update'],'d/m/Y');
                //  exit;	        
?>
            <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="exampleModalLabel1">รายละเอียดเอกสาร เลขที่&nbsp;<?php echo $_POST['doc_id']; ?> </h5>
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
                            <p><?php echo conv_tis_utf($res0['doc_name']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-5">
                            <p class="float-right">รายละเอียด:</p>
                        </div>
                        <div class="col">
                            <p><?php echo conv_tis_utf($res0['doc_detail']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-5">
                            <p class="float-right">วันที่สร้าง:</p>
                        </div>
                        <div class="col">
                            <p><?php echo date_format($res0['doc_update'],'d/m/Y'); ?></p>
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
                                            ชื่อเอกสาร
                                        </th>
                                        <th class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <center>ดาวน์โหลด</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if($nrow==0){
                                ?>
                                    <tr class="border border-dark border-top-0 row table-danger">
                                        <th class="col-12">
                                            <center class="text-danger">***ไม่มีไฟล์แนบ***</center>
                                        </th>
                                    </tr>
                                <?php
                                }else{
                                    while($res = $MsDb->MsResult($db)){
                                ?>
                                    <tr class="border border-dark border-top-0 row">
                                        <th class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3">
                                            <center><?php echo ++$i; ?></center>
                                        </th>
                                        <td class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9">
                                            <?php echo conv_tis_utf($res['file_name']);?>
                                        </td>
                                        <td class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            
                                                <a target="_blank" href="<?php echo $res['file_path'];?>">
                                                    <center><i class="fa fa-download">&nbsp;ดาวน์โหลด</i></center>
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
                    <button type="button" class="btn btn-info text-light" data-id="<?php echo $_POST['doc_id'];?>" onclick="updatedraft(this)">จัดการแบบร่าง แก้ไข/ส่ง</button>
                </div>
