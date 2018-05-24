<?php session_start();
 require_once '../actions/config_mysql_oop.php';
//  require_once '../myjs.js';
               $MsDb = new MSClass();
                 $MsDb->ConnectMsDB();
                $sql0 = "select * from web_document_doc where doc_no=".$_POST['doc_id'];
                // echo $sql0;
                // exit;
			    $sql = "select * from web_document_file where tea_id='".$_SESSION['OnlineService']."' and tfile_id=3 and doc_id=".$_POST['doc_id'];
                $db0 = $MsDb->MsQuery($sql0);
                $res0 =$MsDb->MsResult($db0);
                $db = $MsDb->MsQuery($sql);
                $numr = $MsDb->MsNumRows($db);
                //  echo date_format($res0['doc_update'],'d/m/Y');
                //  exit;

                $sqlselect = "SELECT
                dbo.web_document_tea.doc_no,
                dbo.web_document_tea.user_idrec,
                dbo.teacher.tea_id,
                dbo.teacher.tea_lname,
                dbo.teacher.tea_fname,
                dbo.prename.pre_prename,
                dbo.web_document_tea.td_read,
                dbo.department_tea.dep_name,
                dbo.web_document_tea.td_comment,
                dbo.web_document_tea.td_no,
                dbo.teacher.tea_picture
                FROM
                dbo.web_document_tea
                INNER JOIN dbo.teacher ON dbo.teacher.tea_id = dbo.web_document_tea.user_idsen
                INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
                INNER JOIN dbo.department_tea ON dbo.teacher.dep_id = dbo.department_tea.dep_id
                WHERE
                dbo.web_document_tea.user_idrec = '".$_SESSION['OnlineService']."' AND
                dbo.web_document_tea.doc_no = '".$_POST['doc_id']."'";
                $dbselect = $MsDb->MsQuery($sqlselect);

?>
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="exampleModalLabel2">รายละเอียดเอกสาร เลขที่&nbsp;<?php echo $_POST['doc_id']; ?> </h5>
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
                            <p class="float-right">วันที่ส่ง:</p>
                        </div>
                        <div class="col">
                            <p><?php echo thai_date(date_format($res0['doc_update'],'Y-m-d H:i'),0,true).' น.'; ?></p>
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
                                                ดาวน์โหลด
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
                                                        <a target="_blank" href="<?php echo $res['file_path'];?>" class="">
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
                    <div class="row">
                        <div class="container">
                        <div class="container">
                            <p class="text-center">ผู้รับเอกสาร</p>
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr class="row">
                                            <th class="col-6">
                                                ชื่อ-นามสกุล
                                            </th>
                                            <th class="col-6">
                                                สังกัด
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cou = 0;
                                        while ($resselect =$MsDb->MsResult($dbselect)) {
                                            $tea_id= substr($resselect['tea_id'],0, 5);
                                            if($resselect['td_read']=='0'){
                                                $Readbgstatus="table-warning";
                                                $Readtxtstatus="text-dark";
                                            }else if($resselect['td_read']=='1'){
                                                $Readbgstatus="table-success";
                                                $Readtxtstatus="text-success";
                                            }else if($resselect['td_read']=='3'){
                                                $Readbgstatus="table-danger";
                                                $Readtxtstatus="text-danger";
                                            }
                                        ?>
                                        <tr class="<?php echo $Readbgstatus; ?> row border border-dark border-top-0">
                                            <th class="col-6">

                                                    <?php
                                                    echo conv_tis_utf($resselect['pre_prename']).''.conv_tis_utf($resselect['tea_fname']).'  '.conv_tis_utf($resselect['tea_lname']);
                                                    ?>


                                            </th>
                                            <td class="col-6">

                                                <?php
                                                    echo conv_tis_utf($resselect['dep_name']);
                                                ?>

                                            </td>
                                            <td class="col-6 border-top-0">
                                                <p class="<?php echo $Readtxtstatus;?>">สถานะ:&nbsp;
                                                    <?php
                                                    if($resselect['td_read']=='0'){
                                                        echo 'ยังไม่ได้เปิดอ่าน';
                                                    }else if($resselect['td_read']=='1'){
                                                        echo 'เปิดอ่านแล้ว';
                                                    }
                                                    else if($resselect['td_read']=='3'){
                                                        echo 'ลบเอกสารแล้ว';
                                                    }
                                                    ?>
                                                </p>
                                            </td>
                                            <td class="col-6 border-top-0">
                                                <center>
                                                    <?php if($resselect['td_comment']!=NULL){?>
                                                    <a class="btn btn-outline-light w-100 text-primary" data-toggle="collapse" data-target="<?php echo '#collapsetdcomment'.$cou;?>" aria-expanded="false" aria-controls="<?php echo 'collapsetdcomment'.$cou;?>">ตอบกลับ</a>
                                                    <?php
                                                    }else{
                                                        echo "<p class='text-danger'>***ไม่มีข้อความตอบกลับ***</p>";
                                                    }
                                                    ?>
                                                </center>
                                            </td>
                                            <td class="col-12 border-top-0">
                                                <div class="collapse" id="<?php echo 'collapsetdcomment'.$cou;?>">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-4 float-right">
                                                                <img src="<?php echo 'img/Tea_picture/'.$tea_id.'.jpg'; ?>" style="height:50px" alt="No Image"  class="rounded-circle w-100">
                                                                <!--<img src="<?php echo $resselect['tea_picture']; ?>" style="height:50px;" alt="No Image" class="rounded-circle w-100">-->
                                                            </div>
                                                            <div class="col float-left">
                                                                <p><?php   echo '<b class="text-warning">ข้อความ:</b><br>'.conv_tis_utf($resselect['td_comment']); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $cou++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="modal-footer bg-dark">

                </div>
<div class="modal modal2 fade" id="TDcommentModal" tabindex="-1" role="dialog" aria-labelledby="TDcommentModal" aria-hidden="true">
  <div class="modal-dialog" role="document" id="show_tdcomment">
    
  </div>
</div>
