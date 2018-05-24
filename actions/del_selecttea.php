<?php session_start();

		unset($_SESSION['tea_rec'][@$_GET['tea_sno']]);
		sort($_SESSION['tea_rec']);
		//echo	$_SESSION['user_rec'][@$_GET['user_sno']];
		//print_r($_SESSION['user_rec']);exit;

    if(count($_SESSION['tea_rec'])==0){
        unset($_SESSION['tea_rec']);
    }
?>