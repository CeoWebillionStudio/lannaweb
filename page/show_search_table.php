<?php session_start();
    require '../actions/config_mysql_oop.php';
    $MsDb = new MSClass();
    $MsDb ->ConnectMsDB();
    $txt_search=conv_utf_tis($_REQUEST['txt_search']);
    $_SESSION['select_ses']=$_REQUEST['select'];
    $_SESSION['txt_search_ses']=$_REQUEST['txt_search'];
    if($_REQUEST['select']=='1'){
        $sql="SELECT dbo.sub_department_tea_position.tea_id,dbo.prename.pre_prename + dbo.teacher.tea_fname + ' ' + dbo.teacher.tea_lname AS tea_name,
        dbo.[position].pos_name,dbo.department_tea.dep_name
        FROM
        dbo.sub_department_tea_position INNER JOIN dbo.teacher ON dbo.sub_department_tea_position.tea_id = dbo.teacher.tea_id
        INNER JOIN dbo.[position] ON dbo.[position].pos_id = dbo.sub_department_tea_position.pos_id
        INNER JOIN dbo.department_tea ON dbo.department_tea.fac_id = dbo.sub_department_tea_position.fac_id
        AND dbo.sub_department_tea_position.dep_id = dbo.department_tea.dep_id
        INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
        WHERE (sub_department_tea_position.dep_id= '".$txt_search."') and (teacher.tea_id<>'".$_SESSION['OnlineService']."') AND (teacher.tea_cur_status = 'A')AND not teacher.tea_id in (SELECT     aa.user_idrec AS tea_id
        FROM web_document_tea as aa WHERE (aa.doc_no = '".$_SESSION['doc_id']."') UNION SELECT bb.user_idsen AS tea_id FROM web_document_tea as bb
        WHERE (bb.doc_no = '".$_SESSION['doc_id']."'))";
    }else if($_REQUEST['select']=='2'){
        $sql="SELECT dbo.sub_department_tea_position.tea_id,dbo.prename.pre_prename + dbo.teacher.tea_fname + ' ' + dbo.teacher.tea_lname AS tea_name,dbo.[position].pos_name,dbo.department_tea.dep_name
        FROM
        dbo.sub_department_tea_position INNER JOIN dbo.teacher ON dbo.sub_department_tea_position.tea_id = dbo.teacher.tea_id
        INNER JOIN dbo.[position] ON dbo.[position].pos_id = dbo.sub_department_tea_position.pos_id INNER JOIN dbo.department_tea ON dbo.department_tea.fac_id = dbo.sub_department_tea_position.fac_id
        AND dbo.sub_department_tea_position.dep_id = dbo.department_tea.dep_id INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
            WHERE
                (
                    teacher.tea_fname + teacher.tea_lname LIKE '%".$txt_search."%'
                )
            AND (teacher.tea_id <> '".$_SESSION['OnlineService']."')
            AND (teacher.tea_cur_status = 'A')
            AND NOT teacher.tea_id IN (
            SELECT
                aa.user_idrec AS tea_id
            FROM
                web_document_tea AS aa
            WHERE
                (aa.doc_no = '".$_SESSION['doc_id']."')
            UNION
                SELECT
                    bb.user_idsen AS tea_id
                FROM
                    web_document_tea AS bb
                WHERE
                    (bb.doc_no = '".$_SESSION['doc_id']."')
            )";
    }else if($_REQUEST['select']=='3'){
        $sql="SELECT teacher.tea_id, prename.pre_prename + teacher.tea_fname + '  ' + teacher.tea_lname AS tea_name, position.pos_name, department_tea.dep_name
        FROM teacher INNER JOIN department_tea_position ON teacher.tea_id = department_tea_position.tea_id INNER JOIN
        department_tea ON department_tea_position.dep_id = department_tea.dep_id AND department_tea_position.fac_id = department_tea.fac_id INNER JOIN
        prename ON teacher.pre_id = prename.pre_id INNER JOIN position ON department_tea_position.pos_id = position.pos_id
        WHERE (teacher.tea_id LIKE '%".$txt_search."%') and (teacher.tea_id<>'".$_SESSION['OnlineService']."')
        AND (teacher.tea_cur_status = 'A')AND not teacher.tea_id in (SELECT aa.user_idrec AS tea_id FROM web_document_tea as aa
        WHERE (aa.doc_no = '".$_SESSION['doc_id']."') UNION SELECT bb.user_idsen AS tea_id FROM web_document_tea as bb
        WHERE (bb.doc_no = '".$_SESSION['doc_id']."')) and not teacher.tea_id in (SELECT  teacher.tea_id
        FROM teacher INNER JOIN sub_department_tea_position ON teacher.tea_id = sub_department_tea_position.tea_id INNER JOIN
        sub_department_tea ON sub_department_tea_position.fac_id = sub_department_tea.fac_id AND
        sub_department_tea_position.dep_id = sub_department_tea.dep_id AND sub_department_tea_position.sdep_id = sub_department_tea.sdep_id INNER JOIN
        position ON sub_department_tea_position.pos_id = position.pos_id
        WHERE (teacher.tea_id LIKE '%".$txt_search."%') AND (teacher.tea_cur_status = 'A'))
        union SELECT teacher.tea_id, prename.pre_prename + teacher.tea_fname + '  ' + teacher.tea_lname AS tea_name, position.pos_name,sub_department_tea.sdep_name AS dep_name
        FROM teacher INNER JOIN prename ON teacher.pre_id = prename.pre_id INNER JOIN
        sub_department_tea_position ON teacher.tea_id = sub_department_tea_position.tea_id INNER JOIN
        sub_department_tea ON sub_department_tea_position.fac_id = sub_department_tea.fac_id AND
        sub_department_tea_position.dep_id = sub_department_tea.dep_id AND sub_department_tea_position.sdep_id = sub_department_tea.sdep_id INNER JOIN
        position ON sub_department_tea_position.pos_id = position.pos_id
        WHERE (teacher.tea_id LIKE '%".$txt_search."%') and (teacher.tea_id<>'".$_SESSION['OnlineService']."')
        AND (teacher.tea_cur_status = 'A')AND not teacher.tea_id in
        (SELECT     aa.user_idrec AS tea_id FROM web_document_tea as aa WHERE (aa.doc_no = '".$_SESSION['doc_id']."') UNION SELECT bb.user_idsen AS tea_id
        FROM web_document_tea as bb WHERE (bb.doc_no = '".$_SESSION['doc_id']."'))";
    }else if($_REQUEST['select']=='4'){
        $value_se = explode(':',$_GET['txt_search']);
		if($value_se[0]==1) $sql1 = " (dbo.std_secret.fac_id = '".$value_se[1]."') AND (dbo.class.cla_id = '".$value_se[2]."') AND ";
		if($value_se[0]==2) $sql1 = " (dbo.std_secret.fac_id = '".$value_se[1]."') AND (dbo.class.cla_id = '".$value_se[2]."') AND (dbo.teac_meet.tme_class =  '".$value_se[3]."') AND ";
		if($value_se[0]==3) $sql1 = " (dbo.std_secret.fac_id = '".$value_se[1]."') AND (dbo.class.cla_id = '".$value_se[2]."') AND (dbo.teac_meet.tme_class = '".$value_se[3]."') AND (dbo.sub_departmet_stu.dep_id = '".$value_se[4]."') AND (dbo.sub_departmet_stu.sdep_id = '".$value_se[5]."') AND ";
        $sql="SELECT dbo.teac_meet.tea_id, dbo.teacher.tea_fname + ' ' + dbo.teacher.tea_lname AS tea_name,dbo.class.cla_extname + ' ' + dbo.teac_meet.tme_class + ' / ' + dbo.xstdroom.room_ptl AS dep_name
        FROM
        dbo.teac_meet INNER JOIN
        dbo.class ON dbo.teac_meet.cla_id = dbo.class.cla_id INNER JOIN
        dbo.std_secret ON dbo.teac_meet.sch_id = dbo.std_secret.sch_id AND dbo.teac_meet.cla_id = dbo.std_secret.cla_id AND
        dbo.teac_meet.dep_id = dbo.std_secret.dep_id AND dbo.teac_meet.fac_id = dbo.std_secret.fac_id AND dbo.teac_meet.sdep_id = dbo.std_secret.sdep_id AND
        dbo.teac_meet.ver_id = dbo.std_secret.ver_id AND dbo.teac_meet.tme_class = dbo.std_secret.sec_class AND
        dbo.teac_meet.tme_room = dbo.std_secret.sec_room INNER JOIN
        dbo.view_studentcheck_now_student ON dbo.std_secret.stu_id = dbo.view_studentcheck_now_student.stu_id INNER JOIN
        dbo.sub_departmet_stu ON dbo.teac_meet.dep_id = dbo.sub_departmet_stu.dep_id AND dbo.teac_meet.fac_id = dbo.sub_departmet_stu.fac_id AND
        dbo.teac_meet.cla_id = dbo.sub_departmet_stu.cla_id AND dbo.teac_meet.sdep_id = dbo.sub_departmet_stu.sdep_id INNER JOIN
        dbo.teacher ON dbo.teac_meet.tea_id = dbo.teacher.tea_id INNER JOIN
        dbo.xstdroom ON dbo.teac_meet.cla_id = dbo.xstdroom.cla_id AND dbo.teac_meet.fac_id = dbo.xstdroom.fac_id AND
        dbo.teac_meet.dep_id = dbo.xstdroom.dep_id AND dbo.teac_meet.sdep_id = dbo.xstdroom.sdep_id AND dbo.teac_meet.ver_id = dbo.xstdroom.ver_id AND
        dbo.teac_meet.tme_class = dbo.xstdroom.sec_class AND dbo.teac_meet.tme_room = dbo.xstdroom.sec_room
        GROUP BY dbo.teac_meet.tme_class, dbo.sub_departmet_stu.dep_id, dbo.sub_departmet_stu.sdep_id, dbo.teacher.tea_fname, dbo.teacher.tea_lname, dbo.class.cla_id,
        dbo.class.cla_extname, dbo.sub_departmet_stu.sdep_name, dbo.xstdroom.room_ptl, dbo.teac_meet.tea_id, dbo.std_secret.fac_id
        HAVING ".$sql1." not dbo.teac_meet.tea_id in (SELECT aa.user_idrec AS tea_id FROM web_document_tea as aa WHERE (aa.doc_no = '".$_SESSION['doc_id']."')
        UNION SELECT bb.user_idsen AS tea_id FROM web_document_tea as bb WHERE (bb.doc_no = '".$_SESSION['doc_id']."')) ";
        $ns=1;
    }else if($_REQUEST['select']=='5'){
        $sql="SELECT dbo.sub_department_tea_position.tea_id,dbo.prename.pre_prename + dbo.teacher.tea_fname + ' ' + dbo.teacher.tea_lname AS tea_name,
        dbo.[position].pos_name,dbo.department_tea.dep_name
        FROM
        dbo.sub_department_tea_position INNER JOIN dbo.teacher ON dbo.sub_department_tea_position.tea_id = dbo.teacher.tea_id
        INNER JOIN dbo.[position] ON dbo.[position].pos_id = dbo.sub_department_tea_position.pos_id INNER JOIN dbo.department_tea ON dbo.department_tea.fac_id = dbo.sub_department_tea_position.fac_id
        AND dbo.sub_department_tea_position.dep_id = dbo.department_tea.dep_id INNER JOIN dbo.prename ON dbo.teacher.pre_id = dbo.prename.pre_id
        WHERE
        dbo.sub_department_tea_position.pos_id = '".$_GET['txt_search']."' AND dbo.teacher.tea_cur_status = 'A'";
        $ns=2;
    }else{
    $sql="ไม่พบข้อมูล";
    }
    $db     = $MsDb->MsQuery($sql);
    $numr   = $MsDb->MsNumRows($db);

//     print_r($_SESSION['tea_id_ses'][0]);


// exit;
    ?>

        <?php
        if($numr!=0){
            $k=0;
            while($res = $MsDb->MsResult($db)){
            // while($i<$numr){
                // for($i=0;$i<=$numr;$i++){
                    $checked = 0;
                    for($i=0;$i<count($_SESSION['tea_rec']);$i++){
                        if($res['tea_id']==$_SESSION['tea_rec'][$i]){
                            $checked+=1;
                        }else{
                            $checked+=0;
                        }
                    }
                    if($checked==0){
                    $_SESSION['tea_all'][$k]=$res['tea_id'];
                ?>
                    <tr class="row border border-dark border-top-0">
                            <th class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6"><center><?php echo conv_tis_utf($res['tea_id']); ?></center></th>
                            <td class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <?php
                                if($ns==1){
                                    echo "อ. ";
                                }
                                echo conv_tis_utf($res['tea_name']); ?>
                            <?php
                                if($ns!=1){
                            ?>
                                    <i class="text-success">(&nbsp;<?php echo conv_tis_utf($res['pos_name']); ?>&nbsp;)</i>
                            <?php
                                }
                            ?>
                            </td>
                            <td class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-9"><?php echo conv_tis_utf($res['dep_name']); ?></td>
                            <td class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-3"><a class="btn btn-success text-light" data-id="<?php echo conv_tis_utf($res['tea_id']);?>" onclick="selectsenttea(this,'<?php echo $_REQUEST['select'];?>','<?php echo $_REQUEST['txt_search'];?>')">+</a></td>
                        </tr>
        <?php
                    }else{

                    }
                    $k++;
            }
        }else{
        ?>
            <tr class="row border border-dark border-top-0 table-danger">
                <th class="col-12 text-danger"><center>***ไม่พบข้อมูล***</center></th>
            </tr>
        <?php
        }
        ?>





