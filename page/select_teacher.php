<?php session_start();
    require '../actions/config_mysql_oop.php';
    $MsDb = new MSClass();
    $MsDb->ConnectMsDB();
        if(@$_POST['tea_id'])
        {
                if(!@isset($_SESSION['tea_rec']))
                    $_SESSION['tea_rec'][0]=@$_POST['tea_id'];
                else
                {
                    $loop = @max(@array_keys($_SESSION['tea_rec']))+1;
                    $_SESSION['tea_rec'][$loop]=@$_POST['tea_id'];
                }
            //echo $loop;
        }

    if(@$_SESSION['tea_rec']||@$_POST['tea_id']){
        @$_SESSION['tea_rec'] = array_unique(@$_SESSION['tea_rec']);
    }

?>
<?php





/***********************************************************************************************/
if(!empty(@$_SESSION['tea_rec'])){
for($a=0;$a<count(@$_SESSION['tea_rec']);$a++){
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
            <th class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6"><center><?php echo conv_tis_utf($res['tea_id']);?></center></th>
            <td class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6"><?php echo conv_tis_utf($res['pre_prename']).conv_tis_utf($res['tea_fname'])." "." ".conv_tis_utf($res['tea_lname']) ?>
                <i class="text-success">(&nbsp;<?php echo conv_tis_utf($res['pos_name']) ?>&nbsp;)</i>
            </td>
            <td class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-9"><?php echo conv_tis_utf($res['dep_name']); ?></td>
            <td class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-3"><a class="btn btn-danger text-light" data-id="<?php echo $a;?>" onclick="unselectsenttea(this,'<?php echo  $_SESSION['select_ses']; ?>','<?php echo  $_SESSION['txt_search_ses']; ?>')">-</a></td>
        </tr>

    <?php
        }

    }
}else{
    ?>
    <tr class="row border border-dark border-top-0 table-danger">
        <th class="col-12 text-danger"><center>***ไม่มีรายชื่อผู้รับเอกสาร***</center></th>
    </tr>
<?php
}
?>

