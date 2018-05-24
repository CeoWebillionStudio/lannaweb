<?php session_start();
require_once ('../actions/config_mysql_oop.php');
$MsDb = new MSClass;
$MsDb->ConnectMsDB(); 
?>
<?php
if($_GET['select']==1){
echo "<input type='text' class='form-control' id='mail_search' placeholder='ค้นหาด้วยชื่อเอกสาร' onKeyUp='searchmail1()'>";
}else if($_GET['select']==2){
echo "<input type='text' class='form-control' id='sentmail_search' placeholder='ค้นหาด้วยชื่อผู้ส่ง' onKeyUp='searchmail2()'>";
}else{
echo "<input type='text' class='form-control text-danger' placeholder='เลือกประเภทการค้นหา' readonly>";
}
?>
<script>
if(window.matchMedia('(max-width: 1200px)').matches) {
        $('#cardResponsive').collapse('show');
    }else{}

</script>

