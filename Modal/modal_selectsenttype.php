<div class="modal fade" id="selecttypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header table-success">
            <h2>ยืนยันการส่งเอกสาร</h2>
        </div>
        <div class="modal-body table-light">
            <div class="row">
                <div class="col-xl-12">

                    <?php
                        for($i=0;$i<count($_SESSION['tea_rec']);$i++){
                    ?>
                        <span class="badge badge-dark">

                            <?php 
                            $sql="SELECT
                            dbo.teacher.tea_id,
                            dbo.teacher.tea_fname,
                            dbo.teacher.tea_lname,
                            dbo.prename.pre_prename
                            FROM
                            dbo.teacher
                            INNER JOIN dbo.prename ON dbo.prename.pre_id = dbo.teacher.pre_id
                            WHERE
                            dbo.teacher.tea_id = '".$_SESSION['tea_rec'][$i]."';
                            ";
                            $db = $MsDb->MsQuery($sql);
                            $res =$MsDb->MsResult($db);
                            echo conv_tis_utf($res['pre_prename']).' '.conv_tis_utf($res['tea_fname']).' '.conv_tis_utf($res['tea_lname']);
                            ?>
                        </span>
                        <br>
                    <?php
                        }
                    ?>

                </div>
                <div class="col-xl-12">
                    <center>
                        <a class="btn btn-success col-xl-4 text-light" data-id="<?php echo $_POST['doc_id']; ?>" onclick="sentteadoc(this)"  data-dismiss="modal">
                            ส่งเอกสาร
                        </a>
                    </center>        
                </div>
            </div>
        </div>
        <div class="modal-footer table-light">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>