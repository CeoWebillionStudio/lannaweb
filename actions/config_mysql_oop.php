<?php session_start();
date_default_timezone_set('Asia/Bangkok');


//---------------------------------------------------------- ติดต่อฐานข้อมูล sqlsrv
class MSClass{

    private $conn;    
    function ConnectMsDB(){
        $server = "poly-cms";
        $connectinfo = array("Database"=>"CMS","UID"=>"UserWinApp","PWD"=>"dblanna2558");
        $this->conn = sqlsrv_connect($server,$connectinfo);// or die(Write_LogNotConnect());
        if(!$this->conn){
	        sqlsrv_free_stmt($this->conn);
            sqlsrv_close($this->conn);
        	$this->ConnectMsDB();
		}                      
    }

	private $db;
    private $sql;
    
    function MsQuery($sql){
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$this->db=sqlsrv_query($this->conn,$sql,$params,$options);
		$this->sql=$sql;
        return $this->db;
    }
    
	function MsResult($db=NULL){
		if($db)
			$db1 =  $db;
		else
			$db1 = $this->db;
		return sqlsrv_fetch_array($db1,SQLSRV_FETCH_ASSOC);// or die($this->ShowError());
    }
    
	function MsResultObj(){
		return sqlsrv_fetch_object($this->db);
    }
    
    function MsNumRows($db=NULL){
        if($db)
			$db1 =  $db;
		else
			$db1 = $this->db;
			$a=sqlsrv_num_rows($db1);
        return $a;
    }

    function MsHasRows(){
        if($db){
			$db1 =  $db;
		}else{
			$db1 = $this->db;
		return sqlsrv_has_rows($db1);
		}
    }

}

    function conv_utf_tis($str){
		return iconv('UTF-8','TIS-620',$str);	
	}
	
	function conv_tis_utf($str){
        return iconv('TIS-620','UTF-8',$str);	
	}
	

//---------------------------------------------------------- ติดต่อฐานข้อมูล sqlsrv
class function_php{
	
public function fulldelete($location) {   
    if (is_dir($location)) {   
        $currdir = opendir($location);   
        while ($file = readdir($currdir)) {   
            if ($file  <> ".." && $file  <> ".") {   
                $fullfile = $location."/".$file;   
                if (is_dir($fullfile)) {   
                    if (!fulldelete($fullfile)) {   
                        return false;   
                    }   
                } else {   
                    if (!unlink($fullfile)) {   
                        return false;   
                    }   
                }   
            }   
        }   
        closedir($currdir);   
        if (! rmdir($location)) {   
            return false;   
        }   
    } else {   
        if (!unlink($location)) {   
            return false;   
        }   
    }   
    return true;   
} 	
	
	
public function case_dayTH($num) //1-7 1=Mon ,7=Sun
    {
        switch ($num)
        {
            case "1" :$day_str="จันทร์";break;
            case "2" :$day_str="อังคาร";break;
            case "3" :$day_str="พุธ";break;
            case "4" :$day_str="พฤหัสบดี";break;
            case "5" :$day_str="ศุกร์";break;
            case "6" :$day_str="เสาร์";break;
            case "7" :$day_str="อาทิตย์";break;
        }
       return $day_str.' ';
    }
public function case_month($num)
    {
        switch ($num)
        {
            case "01" :$month_str="มกราคม";break;
            case "02" :$month_str="กุมภาพันธ์";break;
            case "03" :$month_str="มีนาคม";break;
            case "04" :$month_str="เมษายน";break;
            case "05" :$month_str="พฤษภาคม";break;
            case "06" :$month_str="มิถุนายน";break;
            case "07" :$month_str="กรกฎาคม";break;
            case "08" :$month_str="สิงหาคม";break;
            case "09" :$month_str="กันยายน";break;
            case "10" :$month_str="ตุลาคม";break;
            case "11" :$month_str="พฤศจิกายน";break;
            case "12" :$month_str="ธันวาคม";break;
        }
       return $month_str;
    }
public function case_month_shot($num)
    {
        switch ($num)
        {
            case "01" :$month_str="ม.ค.";break;
            case "02" :$month_str="ก.พ.";break;
            case "03" :$month_str="มี.ค.";break;
            case "04" :$month_str="เม.ย.";break;
            case "05" :$month_str="พ.ค.";break;
            case "06" :$month_str="มิ.ย.";break;
            case "07" :$month_str="ก.ค.";break;
            case "08" :$month_str="ส.ค.";break;
            case "09" :$month_str="ก.ย.";break;
            case "10" :$month_str="ต.ค.";break;
            case "11" :$month_str="พ.ย.";break;
            case "12" :$month_str="ธ.ค.";break;
        }
       return $month_str;
    }
public function IcoFile($filename)
	{
		//echo $filename;
		list($file_name,$last_filename)=explode('.',$filename);
		switch (strtolower($last_filename))
		{
			case 'jpg' : $last_name = 'pic'; break;
			case 'gif' : $last_name = 'pic'; break;
			case 'gif' : $last_name = 'pic'; break;
			case 'png' : $last_name = 'pic'; break;
			case 'jpeg' : $last_name = 'pic'; break;
			case 'tif' : $last_name = 'pic'; break;
			case 'bmp' : $last_name = 'pic'; break;

			case 'docx' : $last_name = 'doc'; break;
			case 'doc' : $last_name = 'doc'; break;

			case 'ppt' : $last_name = 'ppt'; break;
			case 'pptx' : $last_name = 'ppt'; break;

			case 'xlsx' : $last_name = 'xls'; break;
			case 'xls' : $last_name = 'xls'; break;

			case 'mdb' : $last_name = 'mdb'; break;

			case 'rar' : $last_name = 'rar'; break;
			case 'zip' : $last_name = 'rar'; break;
			case '7p' : $last_name = 'rar'; break;

			case 'mp3' : $last_name = 'mp3'; break;
			case 'wma' : $last_name = 'mp3'; break;

			case 'pdf' : $last_name = 'pdf'; break;

			default: $last_name = 'oth';
		}
		//echo $filename.'-';
		if(file_exists('ico/'.$last_name.'.png')==false)
			return 'ico/oth.png';
		else
			return 'ico/'.$last_name.'.png';
	}
}
function random_Hex($len)
    {
        rand(0,(double)microtime()*10000000);
        $chars = "ABCDEFabcdef0123456789";
        $ret_str = "";
        $num = strlen($chars);
        for($i = 0; $i < $len; $i++)
            {
            $ret_str.= $chars[rand()%$num];
            $ret_str.="";
            }
        return $ret_str;
    }
    
    function thai_date($datetime,$format,$clock){
 
        list($date,$time) = split(' ',$datetime);
        list($H,$i,$s) = split(':',$time);
        list($Y,$m,$d) = split('-',$date);
        $Y = $Y+543;
        
        $month = array(
         '0' => array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฏาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤษจิกายน','12'=>'ธันวาคม'),
         '1' => array('01'=>'ม.ค.','02'=>'ก.พ.','03'=>'มี.ค.','04'=>'เม.ย.','05'=>'พ.ค.','06'=>'มิ.ย.','07'=>'ก.ค.','08'=>'ส.ค.','09'=>'ก.ย.','10'=>'ต.ค.','11'=>'พ.ย.','12'=>'ธ.ค.')
        );
        if ($clock == false)
         return $d.' '.$month[$format][$m].' '.$Y;
        else
         return $d.' '.$month[$format][$m].' '.$Y.' '.$time;
       }
	
	
?>