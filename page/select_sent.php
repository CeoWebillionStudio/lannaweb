<?php session_start();
    require '../actions/config_mysql_oop.php';
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
    $_SESSION['doc_id']=$_POST['doc_id'];
    ?>
<!-- Post Content Column -->
<div class="col-lg-12" id="page_sentdoc" style="background-color:rgba(255,255,255,0.8);overflow-y:scroll;height:93vh;">

    <!-- Title -->
    <div class="container">
        <div class="row">
            <!--Header Row-->
            <div class="col-xl-1 col-sm-1 col-3">
                <img src="img/icon/select_mail.png" alt="" class="mt-3" style="height:80px;">
            </div>
            <div class="col">
                <h1 class="fhead mt-4">เลือกผู้รับเอกสาร</h1>
            </div>
        </div>
        <hr><!-- ******************************************************************************************* -->
        <div class="row">
            <div class="col-xl-5 col-md-12 col-sm-12 col-12 p-0 m-0">
                    <div class="row">
                        <div class="col-xl-4 col-lg-2 col-md-2 col-sm-2 col-5">
                            <p class="float-right">หัวข้อ:</p>
                        </div>
                        <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 col-7">
                            <p><?php echo conv_tis_utf($res0['doc_name']); ?></p>
                        </div>
                        <div class="col-xl-4 col-lg-2 col-md-2 col-sm-2 col-5">
                            <p class="float-right">รายละเอียด:</p>
                        </div>
                        <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 col-7">
                            <p><?php echo conv_tis_utf($res0['doc_detail']); ?></p>
                        </div>
                        <div class="col-xl-4 col-lg-2 col-md-2 col-sm-2 col-5">
                            <p class="float-right">วันที่สร้าง:</p>
                        </div>
                        <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 col-7">
                            <p><?php echo date_format($res0['doc_update'],'d/m/Y'); ?></p>
                        </div>
                        <div class="col-xl-4 col-lg-2 col-md-2 col-sm-2 col-5">
                            <p class="float-right">ไฟล์แนบ:</p>
                        </div>
                        <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 col-7">
                        </div>
                    </div>
                        <div class="container fixedheightselectsent-doc">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr class="row">
                                        <th class="col-2">
                                            <center>ลำดับ</center>
                                        </th>
                                        <th class="col-6">
                                            ชื่อเอกสาร
                                        </th>
                                        <th class="col-4">
                                            <center>ดาวน์โหลด</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if($numr==0){
                                ?>
                                        <tr class="row border border-dark border-top-0 table-danger">
                                            <th class="col-12">
                                                <center class="text-danger">***ไม่มีไฟล์แนบ***</center>
                                            </th>
                                        </tr>
                                <?php
                                    }else{
                                        while($res = $MsDb->MsResult($db)){
                                ?>
                                            <tr class="row border border-dark border-top-0">
                                                <th class="col-2">
                                                    <center><?php echo ++$i; ?></center>
                                                </th>
                                                <td class="col-6">
                                                    <?php echo conv_tis_utf($res['file_name']);?>
                                                </td>
                                                <td class="col-4">
                                                    <center>

                                                        <a target="_blank" href="<?php echo $res['file_path'];?>" class="">
                                                            <i class="fa fa-download">&nbsp;ดาวน์โหลด</i>
                                                        </a>

                                                    </center>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                <a class="btn btn-warning float-right text-light" data-id="<?php echo $_POST['doc_id']; ?>" onclick="showconfigmodal(this)">แก้ไขแบบร่าง</a>

                   <br><br><hr><br>

            </div><!--/col-->

                <div class="col-xl-7 col-12">
                <h4>รายชื่อผู้รับเอกสาร</h4>
                    <div class="container fixedheightselectsent">     <!--mteacherselect-->
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr class="row">
                                        <th class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3">
                                            <center>รหัส</center>
                                        </th>
                                        <th class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-9">
                                            ชื่อ
                                        </th>
                                        <th class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                            <center>สาขางาน</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($_SESSION['tea_rec'])){
                                        for($a=0;$a<count(@$_SESSION['tea_rec']);$a++)
                                        {
                                        $sql="SELECT
                                        dbo.teacher.tea_id,
                                        dbo.teacher.tea_fname,
                                        dbo.teacher.tea_lname,
                                        dbo.department_tea.dep_name,
                                        dbo.prename.pre_prename,
                                        dbo.[position].pos_name
                                        FROM
                                        dbo.teacher
                                        INNER JOIN dbo.department_tea ON dbo.teacher.dep_id = dbo.department_tea.dep_id
                                        INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
                                        INNER JOIN dbo.sub_department_tea_position ON dbo.teacher.tea_id = dbo.sub_department_tea_position.tea_id
                                        INNER JOIN dbo.[position] ON dbo.sub_department_tea_position.pos_id = dbo.[position].pos_id
                                        WHERE
                                        dbo.teacher.tea_id = '".@$_SESSION['tea_rec'][$a]."'
                                        ";
                                        $db = $MsDb->MsQuery($sql);
                                        $numr = $MsDb->MsNumRows($db);
                                            while($res = $MsDb->MsResult($db)){
                                    ?>
                                        <tr class="row border border-dark border-top-0 table-warning">
                                            <th class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3">
                                                <center><?php echo conv_tis_utf($res['tea_id']) ?></center>
                                            </th>
                                            <td class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-9">
                                            <?php echo conv_tis_utf($res['pre_prename'])." ".conv_tis_utf($res['tea_fname'])." "." ".conv_tis_utf($res['tea_lname'])."<br>"; ?>
                                                <i class="text-success">(&nbsp;<?php echo conv_tis_utf($res['pos_name']) ?>&nbsp;)</i>
                                            </td>
                                            <td class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                                <center><?php echo conv_tis_utf($res['dep_name']) ?></center>
                                            </td>
                                        </tr>
                                    <?php
                                            }
                                        }
                                    }else{
                                    ?>
                                <tr class="row border border-dark border-top-0">
                                    <th class="col-12 text-danger table-danger">
                                        <center>***ไม่มีรายชื่อผู้รับเอกสาร***</center>
                                    </th>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#searchmodal">
                        แก้ไขรายชื่อผู้รับเอกสาร
                    </button>
                </div>
            </div><!--/col-md-6-->
            <div class="col-12">
                <hr>
                <a class="btn btn-success text-light float-right" data-id="<?php echo $_POST['doc_id'];?>" onclick="<?php if(!empty($_SESSION['tea_rec'])){echo "selectsenttype(this)";}else{echo "dontselectsenttype()";} ?>">
                    ส่งเอกสาร
                </a>
            </div>
        </div><!--/row-->
    </div><!--container-1-->
</div><!--col-lg-9-->
<script>
function showconfigmodal(ele){
                $('#configdocModal').modal('show');
                $('#showconfigdoc').load('Modal/modal_config_doc.php',{doc_id:$(ele).data('id')});
            }

</script>
<!-- Modal************************************************************************************************************************-->
<!-- The Modal -->
<div class="modal fade" id="searchmodal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">


            <!-- Modal Header -->
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">จัดการรายชื่อผู้รับเอกสาร</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="container mb-3" style="overflow-y:scroll;height:30vh;">
                                    <table class="table table-striped">
                                        <thead class="thead-dark text-light">
                                            <tr class="row">
                                                <th class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6"><center>รหัส</center></th>
                                                <th class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">ชื่อ</th>
                                                <th class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-9"><center>สาขางาน</center></th>
                                                <th class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-3">ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selectteacher">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xl-6 mb-2 mt-2">
                                    <select class="custom-select" id="searchgroup" onchange="selectsearchgroup()">
                                        <option value="0">เลือกประเภทการค้นหา
                                        <option value="1">ค้นหาตามสังกัด
                                        <option value="2">ค้นหาตามชื่อ-นามสกุล
                                        <option value="3">ค้นหาตามรหัสบุคลากร
                                        <option value="4">ค้นหาตามที่ปรึกษาตามชั้นปี
                                        <option value="5">ค้นหาตามตำแหน่ง
                                    </select>
                                </div>

                                <div class="col-xl-6 mb-2 mt-2">
                                    <div class="container">
                                        <div id="search_group">
                                            <center class="text-danger">***กรุณาเลือกประเภทการค้นหา***</center>
                                        </div>
                                    </div>
                                </div>
                                <div class="container" style="overflow-y:scroll;height:30vh;">
                                    <table class="table table-striped">
                                        <thead class="thead-dark text-light">
                                            <tr class="row">
                                                <th class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6"><center>รหัส</center></th>
                                                <th class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">ชื่อ</th>
                                                <th class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-9"><center>สาขางาน</center></th>
                                                <th class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-3">เพิ่ม</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show_table">
                                            <tr class="row border border-dark border-top-0 table-danger">
                                                <th class="col-12 text-danger"><center>***ยังไม่ได้เลือกรูปแบบการค้นหา***</center></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /col-md-6 -->


                    </div><!-- /row -->
                </div><!-- /container-fluid -->
            </div><!-- /modal-body -->

            <!-- Modal footer -->
            <div class="modal-footer">
                <a class="btn btn-success text-light" data-id="<?php echo $_POST['doc_id'];?>" onclick="saveforselectteasent(this)">บันทึก</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div><!-- /Modal footer -->


        </div><!-- /modal-content -->
    </div><!-- /modal-dialog -->
</div><!-- /modal fade -->

<div class="modal fade" id="configdocModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="showconfigdoc">

        </div>
    </div>
  </div>
</div>

<?php require_once('../Modal/modal_selectsenttype.php'); ?>
<!--  -->
<script>
$('#selectteacher').load('page/select_teacher.php');
</script>