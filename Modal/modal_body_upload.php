<?php session_start();
  require '../actions/config_mysql_oop.php';
  $MsDb = new MSClass();
  $MsDb->ConnectMsDB();
  $sql_doc  = "select * from web_document_doc where doc_no='".$_SESSION['doc_no']."' and tea_id='".$_SESSION['OnlineService']."'";
  $sqlforid = "";
  $db_doc   = $MsDb->MsQuery($sql_doc);
  $res_doc  = $MsDb->MsResult($db_doc);					
?>
<?php if($_GET['st']==1) {?>
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">แก้ไขเอกสารแบบร่าง ที่ <?php echo $_SESSION['doc_no']; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<div class="modal-body">
      <form method="post" name="addfile" id="addfile">
            <label for="">ชื่อเรื่อง:<a class="text-warning"> <?php 	echo conv_tis_utf($res_doc['doc_name'])?></a></label><br>
                  <label for="exampleFormControlFile1">เอกสารที่ต้องการแนบ</label>
                  <input class="form-control" type="text" placeholder="ชื่อไฟล์ที่ต้องการแนบ" id="nameFile" name="nameFile"><br>
                  <input type="file" class="form-control-file" name="file_doc" id="file_doc"><br>
                  <button type="button" class="btn btn-success" onclick="<?php if($_GET['st']==1){echo "funaddfilesforconfig()";}else{echo "funaddfiles()";} ?>">เพิ่มไฟล์แนบ</button>
                  <button type="reset" class="btn btn-danger">ยกเลิก</button>
      </form>
      </div>
      <div class="modal-body" style="height:45vh;overflow-y:scroll;">
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
                      $sql  = "select * from web_document_file where tea_id='".$_SESSION['OnlineService']."' and tfile_id=3 and doc_id=".$_SESSION['doc_no'];
                      $db   = $MsDb->MsQuery($sql);
                      $numr = $MsDb->MsNumRows($db);
                      $i=0;
                      if($numr==0){
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
                    <tr class="row border border-dark border-top-0">
                      <th class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                        <center>  
                          <?php echo ++$i; ?>
                        </center>
                      </th>
                        <td class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-10"><?php echo conv_tis_utf($res['file_name']);?></td>
                        <td class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-8"><a href="<?php echo $res['file_path'];?>"><center><i class="fa fa-download">&nbsp;ดาวน์โหลด</i></center></a></td>
                        <form method="post" name="delfile" id="delfile">
                        <!-- <input type="" name="file_id" value=""> -->
                        <td class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                          <center>
                            <button type="button" class="btn btn-danger" data-id="<?php echo $res['file_id'];?>" onclick="<?php if($_GET['st']==1){echo "fundelfileforconfig(this)";}else{echo "fundelfile(this)";} ?>">
                              x
                            </button>
                          </center>
                        </td>
                        </form>
                    </tr>
                    
                    <?php
                        }
                      }
                    ?>
                   
                  </tbody>
                </table>
      </div>
      <div class="modal-footer"> <!--onclick="newdoc()" id="nextmodal" -->
     
      <?php if($_GET['st']==1) {?>
        <button type="button" class="btn btn-primary" data-id="<?php echo $_SESSION['doc_no']?>" onclick="backtoselect(this)">บันทึกการเปลี่ยนแปลง</button>
<?php }else{ ?>
      <button type="button" class="btn btn-primary" data-id="<?php echo $_SESSION['doc_id']?>" onclick="opensentselect(this)">บันทึก & ถัดไป</button>
    <?php }?>
      </div>
