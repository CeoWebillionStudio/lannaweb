<?php session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');
    ini_set('display_error',1);
    error_reporting(~0);
    require 'config_mysql_oop.php';
    $MsDb = new MSClass();
    $MsDb ->ConnectMsDB();
    $time_now   = date('Y/m/d H:i:s');
    $NAME = conv_utf_tis($_POST['nameDoc']);
    $DETAIL = conv_utf_tis($_POST['detailDoc']);

    /*Create Draft*/
    if($_GET['st']=='1'){
        $sql = "insert into web_document_doc (doc_name,doc_detail,doc_update,tea_id) values
                ('".$NAME."','".$DETAIL."','".$time_now."','".$_SESSION['OnlineService']."')";
        $stmt = $MsDb->MsQuery($sql);
        $sql2 = "select doc_no from web_document_doc where tea_id ='".$_SESSION['OnlineService']."' and doc_update='".$time_now."' ";
        $db = $MsDb->MsQuery($sql2);
        $res = $MsDb->MsResult($db);
        $_SESSION['doc_no']=$res['doc_no'];
        $_SESSION['doc_id']=$_SESSION['doc_no'];
    }

    /*Update Draft*/
    else if($_GET['st']=='2'){
        print_r($_POST);$sql="UPDATE [dbo].[web_document_doc] SET [doc_name] = '".$NAME."', [doc_detail] = '".$DETAIL."' WHERE [doc_no] = '".$_SESSION['doc_id']."'";
        $MsDb->MsQuery($sql);
    }

    /*Del draft*/
    else if($_GET['st']=='3'){
        $sqlselect = "SELECT dbo.web_document_file.file_path FROM dbo.web_document_file WHERE doc_id='".$_POST['doc_id']."'";
	    $dbselect = $MsDb->MsQuery($sqlselect);
        while($resselect = $MsDb->MsResult($dbselect)){
            unlink('../'.$resselect['file_path']);
        }
        $sqldel = "DELETE FROM dbo.web_document_doc WHERE doc_no='".$_POST['doc_id']."'";
        $dbdel = $MsDb->MsQuery($sqldel);
    }

    /*Del doc to Recyclebin*/
    else if($_GET['st']=='4'){
        $MsDb->MsQuery("update web_document_tea set td_del='1' , td_update='".$time_now."' where doc_no='".$_POST['doc_id']."'");

    }

    /*Sent inbox -> to -> recycleinboxbin*/
    else if($_GET['st']=='5'){
        $sqldelinbox = "update web_document_tea SET td_read = '3' , td_update='".$time_now."' where (td_no = '".$_POST['td_no']."')";
        $MsDb->MsQuery($sqldelinbox);
    }

    /*Sent recycleinboxbin -> to -> inbox*/
    else if($_GET['st']=='6'){
        // echo $_POST['td_no'];
        $sqlrecover = "update web_document_tea SET td_read = '1' , td_update='".$time_now."' where (td_no = '".$_POST['td_no']."')";
        // echo $sqlrecover;
        $MsDb->MsQuery($sqlrecover);
        // $sql = "UPDATE [CMS].[dbo].[web_document_tea] SET [td_read]='1' WHERE ([td_no]='".$_POST['td_no']."')";
        // $MsDb->MsQuery($sql);
    }

    /*Sent recyclesentbin -> to -> hissent*/
    else if($_GET['st']=='7'){
        $sql = "update web_document_tea SET td_del = null, td_update='".$time_now."' where (doc_no = ".$_POST['doc_no'].")";
        $MsDb->MsQuery($sql);
    }
    else if($_GET['st']=='8'){
        for($a=0;$a<count($_SESSION['tea_rec']);$a++){
            $sqlsent = "INSERT INTO [CMS].[dbo].[web_document_tea] ([user_idrec], [user_idsen], [doc_no], [td_stat], [td_read], [sms_sending], [sms_send_complete]) VALUES ('".$_SESSION['OnlineService']."','".$_SESSION['tea_rec'][$a]."','".$_POST['doc_id']."', '0', '0', '0', '1')";
            $dbsent = $MsDb->MsQuery($sqlsent);
        }
        $sqltd = "SELECT dbo.web_document_doc.doc_no,dbo.web_document_tea.td_no FROM dbo.web_document_doc
        INNER JOIN dbo.web_document_tea ON dbo.web_document_doc.doc_no = dbo.web_document_tea.doc_no
        WHERE
        dbo.web_document_doc.doc_no = '".$_POST['doc_id']."'";
        $dbtd = $MsDb->MsQuery($sqltd);
        $sqlupdatedoc="UPDATE [CMS].[dbo].[web_document_doc] SET [doc_update]='".$time_now."' WHERE ([doc_no]='".$_POST['doc_id']."')";
        $MsDb->MsQuery($sqlupdatedoc);
        while($res = $MsDb->MsResult($dbtd)){
            $sqlupdatetime = "UPDATE [CMS].[dbo].[web_document_tea] SET [td_update]='".$time_now."'
            WHERE ([td_no]='".$res['td_no']."')";
            $MsDb->MsQuery($sqlupdatetime);
        }
    }else if($_GET['st']=='9'){
        $ans = conv_utf_tis($_POST['ansarea']);
        $sql="UPDATE [CMS].[dbo].[web_document_tea] SET [td_stat]='2', [td_comment]='".$ans."' WHERE ([td_no]='".$_POST['td_no']."')";
        $MsDb->MsQuery($sql);
        // echo $_POST['ansarea'].'<br>';
        // echo $_POST['td_no'].'<br>';
        // echo 'Status 9';
    }
?>

