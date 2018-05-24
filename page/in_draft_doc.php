<?php session_start();
    require '../actions/config_mysql_oop.php';
    $MsDb = new MSClass();
    $MsDb->ConnectMsDB();
    // print_r($_GET);
    // exit;
    $txt_search=conv_utf_tis($_GET['txt_search']);
    $sql =  "SELECT * FROM dbo.web_document_doc AS aa WHERE (aa.tea_id = '".$_SESSION['OnlineService']."') AND ((SELECT COUNT(a1.td_stat) AS c1 FROM web_document_tea AS a1
            WHERE (a1.doc_no = aa.doc_no)) = 0) AND aa.doc_name LIKE '%".$txt_search."%' ORDER BY aa.doc_no DESC";
	//echo $sql;
	$db = $MsDb->MsQuery($sql);
    $numr =$MsDb->MsNumRows($db);

?>
    <div class="col-12 table-info">
        <table class="table table-striped mb-0">
            <thead class="thead-dark">
                <tr class="row">
                  <th class="col-xl-6 col-lg-6 col-md-6 col-sm-4 col-12"><center>ชื่อเอกสาร</center></th>
                  <th class="col-xl-4 col-lg-4 col-md-3 col-sm-4 col-12"><center>สร้างเมื่อ</center></th>
                  <th class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 table-warning"><center class="text-warning">ทั้งหมด <strong class="text-danger"><?php echo $numr; ?></strong> แบบร่าง</center></th>
                </tr>
            </thead>
            <tbody>
              <?php 
              if($numr==0){
                ?>
                <tr class="row border border-dark border-top-0 table-danger">
                  <th class="col-12"><h4 class="text-danger text-center">***ไม่มีแบบร่างเอกสาร***</h4></th>
                </tr>
                <?php
              }else{
                while($res = $MsDb->MsResult($db))
                {
    ?>
              <tr class="row border border-dark border-top-0">
                <th class="col-xl-6 col-lg-6 col-md-6 col-sm-4 col-12">&nbsp;
                  <?php echo conv_tis_utf($res['doc_name']); ?>
                </th>
                <td class="col-xl-4 col-lg-4 col-md-3 col-sm-4 col-12">
                  <center><?php echo date_format($res['doc_update'],'d/m/Y'); ?></center>
                </td>
                <td class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12">
                  <center>
                  <a class="btn btn-success text-light" data-toggle="modal" data-target="#showdetailModal" data-id="<?php echo $res['doc_no'];?>" onclick="sentdocid(this)">แสดง</a>
                  <a class="btn btn-danger text-light" data-id="<?php echo $res['doc_no'];  ?>" onclick="deldraft(this)" >ลบ</a>
                  </center>
                </td>
                
              </tr>
              
              <?php
    } 
    ?>
    
            </tbody>
            <?php
            }
            ?>
            
          </table>
          </div>
        
        </div>
      
      <hr>
