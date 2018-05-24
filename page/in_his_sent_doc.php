<?php session_start();

      require '../actions/config_mysql_oop.php';
      $MsDb = new MSClass();
      $MsDb->ConnectMsDB();
      $txt_search=conv_utf_tis($_GET['txt_search']);
    $sql = "SELECT
    aa.doc_no,
    aa.user_idrec,
    dbo.web_document_doc.doc_update,
    ISNULL
                                  ((SELECT     COUNT(*) AS count_st
                                      FROM         web_document_tea AS a1
                                      GROUP BY doc_no, user_idrec
                                      HAVING      (user_idrec = aa.user_idrec) AND (doc_no = aa.doc_no)), 0) AS cou1,
    ISNULL
                                  ((SELECT     COUNT(*) AS count_st
                                      FROM         web_document_tea AS a1
                                      WHERE     (td_read >= 1)
                                      GROUP BY doc_no, user_idrec
                                      HAVING      (user_idrec = aa.user_idrec) AND (doc_no = aa.doc_no)), 0) AS cou2,
    ISNULL
                                  ((SELECT     COUNT(*) AS count_st
                                      FROM         web_document_tea AS a1
                                      WHERE     (td_stat = 2)
                                      GROUP BY doc_no, user_idrec
                                      HAVING      (user_idrec = aa.user_idrec or user_idrec = aa.user_idrec) AND (doc_no = aa.doc_no)), 0) AS cou3,
    ISNULL
                                  ((SELECT     COUNT(*) AS count_st
                                      FROM         web_document_tea AS a1
                                      WHERE     (td_stat = 2)
                                      GROUP BY doc_no, user_idsen
                                      HAVING      (user_idsen = aa.user_idrec) AND (doc_no = aa.doc_no)), 0) AS cou32,
    ISNULL
                                  ((SELECT     COUNT(*) AS count_st
                                      FROM         web_document_tea AS a1
                                      WHERE     (td_read >= 2)
                                      GROUP BY doc_no, user_idrec
                                      HAVING      (user_idrec = aa.user_idrec) AND (doc_no = aa.doc_no)), 0) AS cou4,
    dbo.web_document_doc.doc_name,
    (SELECT     TOP 1 td_ddate
                                    FROM          web_document_tea
                                    WHERE      (user_idrec = aa.user_idrec) AND (doc_no = aa.doc_no)
                                    GROUP BY td_ddate
                                    HAVING      (NOT (td_ddate IS NULL))) AS stat_re
    FROM
    dbo.web_document_tea AS aa
    INNER JOIN dbo.web_document_doc ON aa.doc_no = dbo.web_document_doc.doc_no
    WHERE
    dbo.web_document_doc.doc_name LIKE '%".$txt_search."%'
    GROUP BY
    aa.doc_no,
    aa.user_idrec,
    dbo.web_document_doc.doc_update,
    dbo.web_document_doc.doc_name,
    aa.td_del
    HAVING
    (aa.user_idrec = '".$_SESSION['OnlineService']."') AND
    (aa.td_del IS NULL OR
    aa.td_del <> '1')
    ORDER BY
    dbo.web_document_doc.doc_update DESC
    ";

                          $db = $MsDb->MsQuery($sql);
                          $numr = $MsDb->MsNumRows($db);
?>
      <div class="col-12 table-light">
        <table class="table table-striped mb-0">
          <thead class="thead-dark">
            <tr class="row">
              <th class="col-xl-4 col-sm-5"><center>ชื่อเอกสาร</center></th>
              <th class="col-xl-2 col-sm-3"><center>วันที่ส่ง</center></th>
              <div class="row">
              <th class="col-xl-1 col-sm-1 col-3"><center>ส่ง</center></th>
              <th class="col-xl-1 col-sm-1 col-3"><center>เปิด</center></th>
              <th class="col-xl-1 col-sm-1 col-3"><center>ตอบ</center></th>
              <th class="col-xl-1 col-sm-1 col-3"><center>ลบ</center></th>
              </div>
                <th class="col"><center class="text-warning">ทั้งหมด <strong class="text-danger"><?php echo $numr; ?></strong> เอกสาร</center></th>
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
while($res = $MsDb->MsResult($db)){
        ?>
              <tr class="row border border-dark border-top-0">
                <th scope="row" class="col-xl-4 col-sm-5">
                  &nbsp;<?php echo conv_tis_utf($res['doc_name']);?>
                </th>
                <td class="col-xl-2 col-sm-3 ">
                  <center><?php echo date_format($res['doc_update'],'d/m/Y'); ?></center>
                </td>
                <div class="row">
                <td class="col-xl-1 col-sm-1 col-3 table-warning border-0"><center><?php echo $res['cou1']; ?></center></td>
                <td class="col-xl-1 col-sm-1 col-3 table-info border-0"><center><?php echo $res['cou2']; ?></center></td>
                <td class="col-xl-1 col-sm-1 col-3 table-success border-0">
                  <center>
                    <?php
                      if($stat_re || $res['cou3']>0)
                      {
                        echo	$res['cou3']+$res['cou32'];
                      }
                      else
                      {
                        echo '-';
                      }
                    ?>
                  </center>
                </td>
                <td class="col-xl-1 col-sm-1 col-3 table-danger border-0"><center><?php echo $res['cou4']; ?></center></td>
                </div>

                  <td class="col">
                    <center>
                      <a class="btn btn-success text-light" data-toggle="modal" data-target="#showdetailModal" data-id="<?php echo $res['doc_no'];?>" onclick="sentdocid(this)">แสดง</a>
                      <a class="btn btn-danger text-light" data-id="<?php echo $res['doc_no'];  ?>" onclick="delhissentdoc(this)" >ลบ</a>
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
     <hr>

        </div>

      <hr>
    </div>
    <!--container-2-->
  </div>
  <!--container-1-->
</div>
<!--col-lg-9-->

<!-- his_sent_doc.php -->
<div class="modal fade bd-example-modal-lg" id="showdetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div id="showdocid">
        </div>
    </div>
</div>
<script>
  function sentdocid(ele){
    // alert($(ele).data('id'));
    $('#showdetailModal').modal('show');
    $('#showdocid').load('Modal/modal_doc_detail.php',{doc_id:$(ele).data('id')});
  }
</script>