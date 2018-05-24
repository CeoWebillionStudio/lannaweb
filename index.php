<?php session_start();
    $_SESSION['TitleName']='LANNAWEB';
    $_SESSION['OnlineService']="00428";
    // $_SESSION['Tea_Img_Path']="Tea_picture/";
    //10422
    //10431 อ.บอล
    //00427 อ้ายโบ๊ท
    //10467 อ.บี คนงาม
    require 'actions/config_mysql_oop.php';
    $MsDb = new MSClass;
    $MsDb ->ConnectMsDB();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="Mystyle/Mystyle.css?<?php echo time(); ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <title><?php echo $_SESSION['TitleName']; ?></title>
    </head>
    <body>
        <div class="bg-blur"></div>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top p-0 pl-2" id="topbar_area">
        </nav>
            <?php // require 'menu/top_bar.php';?>
        <div class="row" style="margin:0px;">
            <div class="col-xl-3 lbpadmar">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="float-left collapsed" data-toggle="collapse" data-target="#cardResponsive" aria-controls="cardResponsive" aria-expanded="true" aria-label="Toggle navigation">
                            <p style="font-size:22px" class="p-0 m-1 ml-0">กล่องข้อความ&nbsp;<i id="alertinbox"></i></p>
                        </div>
                        <div class="float-right"><!-- $('#pageMain').load('page/new_doc.php') -->
                            <button type="button" class="btn btn-success"  onclick="slidemailbar()">
                                สร้างเอกสาร
                            </button>
                        </div>
                    </li>
                </ul>
                <div class="card navbar-expand-lg" style="background-color:rgba(255,255,255,0.5)">
                    <div class="collapse" id="cardResponsive">
                        <li class="list-group-item bg-dark">
                            <div class="row">
                                <div class="col-5">
                                    <select class="custom-select" id="searchmailgroup" onchange="searchmail()">
                                        <option value="0">ค้นหา</option>
                                        <option value="1">ชื่อเอกสาร</option>
                                        <option value="2">ชื่อผู้ส่ง</option>
                                    </select>
                                </div>
                                <div class="col-7">
                                    <div id="search_mail_group">
                                        <input type='text' class='form-control' placeholder='เลือกประเภทการค้นหา' readonly>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <ul class="list-group list-group-flush" style="overflow-y:scroll;height:77vh;">
                            <div id="leftBar">
                                <center>
                                    <div class="loader"></div>
                                </center>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 p-0 m-0">
                <div id="pageMain" class="col-12 p-0 m-0">
                    <center>
                        <div class="loader"></div>
                    </center>
                </div>
            </div>
            <?php require ('Modal/modal_all.php')?>
        </div>
        <!-- /.row -->
        <script src="myjs.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>