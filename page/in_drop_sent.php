<?php session_start();
  require '../actions/config_mysql_oop.php';
  $MsDb = new MSClass();
  $MsDb->ConnectMsDB();
  $txt_search=conv_utf_tis($_GET['txt_search']);
  $sql="SELECT
  dbo.web_document_doc.doc_no,
  dbo.web_document_doc.doc_name,
  dbo.web_document_tea.td_del,
  dbo.web_document_tea.td_update,
  dbo.web_document_doc.doc_update
  FROM         dbo.web_document_doc INNER JOIN
                        dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
  WHERE     (dbo.web_document_doc.tea_id = '".$_SESSION['OnlineService']."')
   AND
   dbo.web_document_doc.doc_name LIKE '%".$txt_search."%'
  GROUP BY
  dbo.web_document_doc.doc_no,
  dbo.web_document_doc.doc_name,
  dbo.web_document_doc.doc_update,
  dbo.web_document_tea.td_del,
  dbo.web_document_tea.td_update
  HAVING      (dbo.web_document_tea.td_del = '1')
  ORDER BY
  dbo.web_document_tea.td_update ASC
  ";
//   $sql = "SELECT     dbo.web_document_doc.doc_no,dbo.web_document_doc.doc_name, CONVERT(nvarchar(30), dbo.web_document_doc.doc_update, 120) AS update_date,dbo.web_document_tea.td_del,
//   dbo.web_document_doc.doc_update
// FROM         dbo.web_document_doc INNER JOIN
//                       dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
// WHERE     (dbo.web_document_doc.tea_id = '".$_SESSION['OnlineService']."')
// AND
// dbo.web_document_doc.doc_name LIKE '%".$txt_search."%'
// GROUP BY dbo.web_document_doc.doc_no,dbo.web_document_doc.doc_name, dbo.web_document_doc.doc_update, dbo.web_document_tea.td_del
// HAVING      (dbo.web_document_tea.td_del = '1') ORDER BY
// dbo.web_document_doc.doc_no DESC";
//echo $sql;
  //if($_SESSION['OnlineService']=='10422') 	echo $sql;

  $day_now   = date('Y-m-d');

  $db = $MsDb->MsQuery($sql);
  $numr=$MsDb->MsNumRows($db);
  $time_now   = date('Y/m/d H:i:s');

?>
        <div class="col-12 table-danger">
        <table class="table table-striped mb-0">
          <thead class="thead-dark">
            <tr class="row">
              <th class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12"><center>ชื่อเอกสาร</center></th>
              <th class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12"><center>วันที่ส่งเอกสาร</center></th>
              <th class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12"><center class="text-warning">ทั้งหมด <strong class="text-danger"><?php echo $numr; ?></strong> เอกสาร</center></th>
            </tr>
          </thead>
          <tbody>
          <?php
  if($numr==0){
                ?>
                <tr class="row border border-dark border-top-0 table-danger">
                  <th class="col-12"><h4 class="text-danger text-center">***ไม่มีเอกสาร***</h4></th>
                </tr>
                <?php
              }else{
                $j=0;
            while($res = $MsDb->MsResult($db)){


        ?>
            <tr class="row border border-dark border-top-0">
              <th class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">&nbsp;<?php echo conv_tis_utf($res['doc_name']);?></th>
              <td class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12"><center><?php echo thai_date(date_format($res['doc_update'],'Y-m-d H:i:s'),1,false);?></center></td>
              <td class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                  <a class="btn btn-success text-light float-right" data-toggle="modal" data-target="#showdetailModal" data-id="<?php echo $res['doc_no'];?>" onclick="sentdocid(this)">แสดง</a>
              </td>
            </tr>
        <?php
         $j++;
        }
        ?>
          </tbody>
                    <?php
    }
    ?>
          </div>
        </table>
