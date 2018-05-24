<?php session_start();
    require '../actions/config_mysql_oop.php';
    $MsDb = new MSClass();
    $MsDb->ConnectMsDB();
    if($_GET['select']=='1'){
?>
    <div class="row">
<?php 
    echo '<select class="custom-select" id="select1" onchange="searchtable1()">';
        $sql = "SELECT TOP 100 PERCENT dbo.department_tea.dep_id, dbo.department_tea.dep_name, dbo.faculty_tea.fac_id, dbo.faculty_tea.fac_name
                FROM dbo.department_tea INNER JOIN dbo.teacher ON dbo.department_tea.dep_id = dbo.teacher.dep_id AND dbo.department_tea.fac_id = dbo.teacher.fac_id INNER JOIN
                dbo.faculty_tea ON dbo.teacher.fac_id = dbo.faculty_tea.fac_id WHERE (dbo.teacher.tea_cur_status = 'A')
                GROUP BY dbo.department_tea.dep_id, dbo.department_tea.dep_name, dbo.faculty_tea.fac_id, dbo.faculty_tea.fac_name ORDER BY dbo.department_tea.dep_id";
        $db     = $MsDb->MsQuery($sql);
        $fac_id ='a';
        while($res = $MsDb->MsResult($db)){
            if(trim($res['dep_id'])==trim($_SESSION['TeacherDep']))
                $sel = "selected";
            else
                $sel='';
            if($fac_id!=$res['fac_name']){
                echo'<optgroup label="'.conv_tis_utf($res['fac_name']).'"></optgroup>';
                $fac_id=$res['fac_name'];
            }
            echo"<option ".$sel." value='".$res['dep_id']."'>&nbsp;&nbsp;".conv_tis_utf($res['dep_name'])."</option>";
        }
        echo '</select>';
?>
    </div>
<?php 
}

/**************************************************************************************************************************************************/

else if($_GET['select']=='2'){
?>
    <div class="row">
        <input type="text" id="txt_search" class="form-control col-12" placeholder="ค้นหาด้วย ชื่อ-สกุล"  onKeyUp="searchtable2()">
    </div>
<?php 
}

/**************************************************************************************************************************************************/

else if($_GET['select']=='3'){
?>
    <div class="row">
        <input type="text" id="id_search" class="form-control col-12" placeholder="ค้นหาด้วย รหัสบุคลากร"  onKeyUp="searchtable3()">
    </div>
<?php 
}

/**************************************************************************************************************************************************/

else if($_GET['select']=='4'){
?>
    <div class="row">
    <?php
        echo '<select class="custom-select" id="select4" onchange="searchtable4()">';
        $sql = "SELECT TOP (100) PERCENT dbo.class.cla_id, dbo.class.cla_extname, dbo.teac_meet.tme_class, dbo.sub_departmet_stu.sdep_name, dbo.sub_departmet_stu.dep_id, 
                dbo.sub_departmet_stu.sdep_id, dbo.sub_departmet_stu.fac_id FROM dbo.teac_meet INNER JOIN dbo.class ON dbo.teac_meet.cla_id = dbo.class.cla_id INNER JOIN
                dbo.std_secret ON dbo.teac_meet.sch_id = dbo.std_secret.sch_id AND dbo.teac_meet.cla_id = dbo.std_secret.cla_id AND 
                dbo.teac_meet.dep_id = dbo.std_secret.dep_id AND dbo.teac_meet.fac_id = dbo.std_secret.fac_id AND dbo.teac_meet.sdep_id = dbo.std_secret.sdep_id AND 
                dbo.teac_meet.ver_id = dbo.std_secret.ver_id AND dbo.teac_meet.tme_class = dbo.std_secret.sec_class AND 
                dbo.teac_meet.tme_room = dbo.std_secret.sec_room INNER JOIN
                dbo.view_studentcheck_now_student ON dbo.std_secret.stu_id = dbo.view_studentcheck_now_student.stu_id INNER JOIN
                dbo.sub_departmet_stu ON dbo.teac_meet.dep_id = dbo.sub_departmet_stu.dep_id AND dbo.teac_meet.fac_id = dbo.sub_departmet_stu.fac_id AND 
                dbo.teac_meet.cla_id = dbo.sub_departmet_stu.cla_id AND dbo.teac_meet.sdep_id = dbo.sub_departmet_stu.sdep_id INNER JOIN
                dbo.faculty_stu ON dbo.std_secret.fac_id = dbo.faculty_stu.fac_id AND dbo.std_secret.cla_id = dbo.faculty_stu.cla_id
                GROUP BY dbo.class.cla_extname, dbo.teac_meet.tme_class, dbo.sub_departmet_stu.sdep_name, dbo.class.cla_id, dbo.sub_departmet_stu.dep_id, 
                dbo.sub_departmet_stu.sdep_id, dbo.sub_departmet_stu.fac_id ORDER BY dbo.class.cla_extname";
        $db     = $MsDb->MsQuery($sql);
        $fac_id ='a';
        echo'<option value="0" style="background-color:CCFF00;">เลือกข้อมูลที่ปรึกษาตามระบบชั้นปี</option>';	
        while($res = $MsDb->MsResult($db)){    
            if($cla_id!=$res['cla_id']){
                echo'<option value="1:'.trim($res['fac_id']).':'.$res['cla_id'].'" style="background-color:FFFF00;">>'.conv_tis_utf($res['cla_extname']).conv_tis_utf($res['fac_name']).'</option>';
                $cla_id=$res['cla_id'];
            }
            if($class_id!=($res['tme_class'].$res['cla_id'])){
                echo'<option value="2:'.trim($res['fac_id']).':'.$res['cla_id'].':'.$res['tme_class'].':'.$res['tme_class'].'" style="background-color:FF9900;"><i>&nbsp;->&nbsp;ปีที่ '.$res['tme_class'].'</i></option>';
                $class_id=$res['tme_class'].$res['cla_id'];
            }
            if($sdep_id!=($res['tme_class'].$res['cla_id'].$res['dep_id'].$res['sdep_id'])){
                echo'<option value="3:'.trim($res['fac_id']).':'.$res['cla_id'].':'.$res['tme_class'].':'.$res['dep_id'].':'.$res['sdep_id'].':'.$res['tme_class'].'" style="background-color:FFCCFF;">&nbsp;&nbsp;-->&nbsp;'.conv_tis_utf($res['sdep_name']).'</option>';
                $sdep_id=$res['tme_class'].$res['cla_id'].$res['dep_id'].$res['sdep_id'];
            }
        }
        echo'</select>';
    ?>
    </div>
<?php 
}

/**************************************************************************************************************************************************/

else if($_GET['select']=='5'){
?>
    <div class="row">
        <?php 
            echo '<select class="custom-select" id="select5" onchange="searchtable5()">';
            $sql = "SELECT position.pos_id, position_type.pot_name + '- (' + position.pos_name + ')' AS pos_name FROM position INNER JOIN
                    sub_department_tea_position ON position.pos_id = sub_department_tea_position.pos_id INNER JOIN position_type ON position.pos_group = position_type.pot_id
                    GROUP BY position.pos_id, position_type.pot_name + '- (' + position.pos_name + ')' union SELECT position.pos_id, position_type.pot_name + '- (' + position.pos_name + ')' AS pos_name
                    FROM position INNER JOIN department_tea_position ON position.pos_id = department_tea_position.pos_id INNER JOIN position_type ON position.pos_group = position_type.pot_id
                    GROUP BY position.pos_id, position_type.pot_name + '- (' + position.pos_name + ')'";
            $db     = $MsDb->MsQuery($sql);
            $fac_id ='a';
            echo'<option value="0">เลือกข้อมูลตามตำแหน่ง</option>';	
            while($res = $MsDb->MsResult($db)){              
                echo'<option value="'.$res['pos_id'].'" >&nbsp;->&nbsp;'.conv_tis_utf($res['pos_name']).'</option>';
            }
            echo '</select>';
        ?>
    </div>
<?php 
}

/**************************************************************************************************************************************************/

else{
?>
    <center class="text-danger">***กรุณาเลือกประเภทการค้นหา***</center>
<?php
}
?>
<br>