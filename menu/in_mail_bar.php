<?php session_start();
    require '../actions/config_mysql_oop.php';

    $MsDb = new MSClass();
    $MsDb->ConnectMsDB();
    // Query ไฟล์ที่ยังไม่ได้
    $txt_search=conv_utf_tis($_GET['txt_search']);
    if($_GET['st']=='1'){

    $Noread = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname,
    web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
    web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
    teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
    prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 0)
AND
dbo.web_document_doc.doc_name LIKE '%".$txt_search."%' ORDER BY
dbo.web_document_doc.doc_no DESC";
    $query = $MsDb->MsQuery($Noread);
    $numrNr1 = $MsDb->MsNumRows($query);

    // Query ไฟล์ที่อ่านแล้ว
    $Readed = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname,
    web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
    web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
    teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
    prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 1)
AND
dbo.web_document_doc.doc_name LIKE '%".$txt_search."%' ORDER BY
dbo.web_document_doc.doc_no DESC";
    $query2 = $MsDb->MsQuery($Readed);
    $numrRd = $MsDb->MsNumRows($query2);
        // echo $txt_search;
    }else if($_GET['st']=='2'){


        $Noread = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname,
    web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
    web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
    teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
    prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 0)
AND
dbo.teacher.tea_fname + dbo.teacher.tea_lname LIKE '%".$txt_search."%' ORDER BY
dbo.web_document_doc.doc_no DESC
";
    $query = $MsDb->MsQuery($Noread);
    $numrNr2 = $MsDb->MsNumRows($query);

    // Query ไฟล์ที่อ่านแล้ว
    $Readed = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname,
    web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
    web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
    teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
    prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 1)
AND
dbo.teacher.tea_fname + dbo.teacher.tea_lname LIKE '%".$txt_search."%' ORDER BY
dbo.web_document_doc.doc_no DESC
";
    $query2 = $MsDb->MsQuery($Readed);
    $numrRd = $MsDb->MsNumRows($query2);

    }else{
    $Noread = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname,
    web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
    web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
    teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
    prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 0) ORDER BY
  dbo.web_document_doc.doc_no DESC";
    $query = $MsDb->MsQuery($Noread);
    $numrNr3 = $MsDb->MsNumRows($query);

    // Query ไฟล์ที่อ่านแล้ว
    $Readed = "SELECT        web_document_doc.doc_no, web_document_doc.doc_name, web_document_doc.doc_detail, web_document_doc.tea_id, web_document_doc.doc_update, web_document_tea.user_idsen, teacher.tea_fname, teacher.tea_lname,
    web_document_tea.td_read, web_document_tea.td_no, prename.pre_prename
FROM            web_document_doc INNER JOIN
    web_document_tea ON web_document_doc.doc_no = web_document_tea.doc_no INNER JOIN
    teacher ON web_document_doc.tea_id = teacher.tea_id INNER JOIN
    prename ON teacher.pre_id = prename.pre_id
WHERE        (web_document_tea.user_idsen = '".$_SESSION['OnlineService']."') AND (web_document_tea.td_read = 1) ORDER BY
  dbo.web_document_doc.doc_no DESC";
    $query2 = $MsDb->MsQuery($Readed);
    $numrRd = $MsDb->MsNumRows($query2);

    }
?>


                <li class="list-group-item pl-3 pr-3 bg-warning pt-0 pb-0" style="font-size:22px;">
                    <div class="ml-3">
                        ยังไม่ได้อ่าน
                    </div>
                </li>

            <?php
            if($numrNr1 || $numrNr2 || $numrNr3 !=0){
                while($result = $MsDb->MsResult($query))
                {
            ?>
                <li class="list-group-item pl-3 pr-3" style="font-size:12px;background-color:rgba(255,255,255,0.8);" data-id="<?php echo $result["td_no"];?>" onclick="$('#leftBar').load('menu/in_mail_bar.php');openinboxdoc(this)">
                    <!-- <div class="float-left">
                        <img src="img/profile.jpg" class="rounded-circle" alt="profile" height="40px;">
                    </div> -->
                    <div class="ml-3">

                           <!-- <input type="hidden" value="<?php //echo $result["doc_no"];?>" name="docID"> -->
                            <p class="p-0 m-0" style="font-size:16px"><strong><?php echo conv_tis_utf($result["doc_name"]);?></strong></p>
                            <br>
                                <p><strong>จาก</strong>&nbsp;&nbsp;
                                    <i class="text-primary">
                                    <?php echo conv_tis_utf($result['pre_prename']);?>

                                    <?php echo conv_tis_utf($result["tea_fname"]);?>

                                    <?php echo conv_tis_utf($result["tea_lname"]);?>
                                    </i>
                                </p>
                    </div>
                </li>
            <?php
                }
            }else{
            ?>
                <br>
                <center><p><i class="">**ไม่มีเอกสาร**</i></p></center>
            <?php
            }
            ?>
                <li class="list-group-item pl-3 pr-3 bg-dark text-light pt-0 pb-0" style="font-size:22px;">
                    <div class="ml-3">
                        อ่านแล้ว
                    </div>
                </li>

            <?php
            if($numrRd!=0){
                while($result2 = $MsDb->MsResult($query2))
                {
            ?>
                <li class="list-group-item pl-3 pr-3" style="font-size:12px;background-color:rgba(100,100,100,0.3);" data-id="<?php echo $result2["td_no"];?>" onclick="openinboxdoc(this)">
                    <!-- <div class="float-left">
                        <img src="img/profile.jpg" class="rounded-circle" alt="profile" height="40px;">
                    </div> -->
                    <div class="ml-3">
                        <input type="hidden" value="<?php echo $result2["doc_no"];?>" name="docID">
                        <p class="p-0 m-0" style="font-size:16px" ><strong><?php echo conv_tis_utf($result2["doc_name"]);?></strong></p>
                        <br>
                            <p class="p-0 m-0"><strong>จาก</strong>&nbsp;&nbsp;
                                <i class="text-primary">
                                <?php echo conv_tis_utf($result2['pre_prename']);?>

                                <?php echo conv_tis_utf($result2["tea_fname"]);?>

                                <?php echo conv_tis_utf($result2["tea_lname"]);?>
                                </i>
                            </p>
                    </div>
                </li>
            <?php
                }
            }else{
            ?>
                <br>
                <center><p><i class="">**ไม่มีเอกสาร**</i></p></center>
            <?php
            }
            ?>

    <script>
    <?php if($numrNr1 || $numrNr2 || $numrNr3 !=0){
        ?>
        $('#alertinbox').load('menu/badges_inbox.php');
<?php } ?>
var x=window.matchMedia("(max-width: 1200px)")
if (x.matches) { // If media query matches

} else {
    $('#cardResponsive').collapse('show');
}


    </script>