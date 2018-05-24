<?php session_start();

?>
    <!-- LannaPoly Logo -->
    <img src="img/logo.gif" alt="" style="height:40px;" class="m-2">
    <!-- LannaPoly Page Name -->
    <a class="navbar-brand m-2 text-light" onclick="backtomain()">
        <?php echo $_SESSION['TitleName']; ?>
    </a>
    <!-- Responsive Dropdown -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- Responsive Dropdown -> Target -->
        <ul class="navbar-nav ml-auto navbar-dark bg-dark slide-top pl-1 mr-2 pr-1" style="">
            <!-- Draft Document Btn -->
            <li class="nav-item ml-1 mr-1">
                <a class="nav-link btn btn-success p-2 text-light m-1" name="draftdoc" value="DraftDocPage" onclick="btndraft()">
                    <!-- <button type="button"  class="btn btn-success" > -->
                        แบบร่างเอกสาร&nbsp;
                        <span class="badge badge-light" id="draftbadges">
                        </span>
                    <!-- </button> -->
                </a>
            </li>

            <!-- Sent History Document Btn -->
            <li class="nav-item ml-1 mr-1">
                <a class="nav-link btn btn-info p-2 text-light m-1" name="sentdoc" value="SentDocPage" onclick="btnsent()">
                        เอกสารส่งออก&nbsp;
                        <span class="badge badge-light" id="sentbadges">
                        </span>
                </a>
            </li>

            <!-- Delete History Document Btn -->
            <li class="nav-item ml-1 mr-1 text-light">
                <div class=" dropdown">
                    <a class="nav-link btn btn-danger p-2 text-light m-1 dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        เอกสารที่ลบ&nbsp;
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" onclick="btndropin()">เอกสารที่ลบ (รับเข้า)&nbsp;
                            <span class="badge badge-dark" id="dropinboxbadges">
                            </span>
                        </a>
                        <a class="dropdown-item" onclick="btndropout()">เอกสารที่ลบ (ส่งออก)&nbsp;
                            <span class="badge badge-dark" id="dropsentbadges">
                            </span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Event Calender Icon -->
            <li class="nav-item mt-auto mb-auto ml-1 mr-1">
                <a class="nav-link btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal">
                    <!-- <i class="material-icons">event</i> -->
                    <i class="far fa-calendar-alt"></i>
                </a>
            </li>

            <!-- Contact Icon -->
            <li class="nav-item mt-auto mb-auto ml-1 mr-1">
                <a target="_blank" href="http://www.lannapoly.ac.th/online/information/personal_new/index.php" class="nav-link btn btn-dark">
                    <!-- <i class="material-icons">people</i> -->
                    <i class="fas fa-users"></i>
                </a>
            </li>

            <!-- Home Icon -->
            <li class="nav-item active mt-auto mb-auto ml-1 mr-1">
                <a class="nav-link btn btn-dark" onclick="backtomain()">
                    <!-- <i class="material-icons">home</i> -->
                    <i class="fas fa-home"></i>
                </a>
            </li>
        </ul>
    </div>

<script>
 $('#draftbadges').load('menu/badges_draft.php');
 $('#sentbadges').load('menu/badges_sent.php');
 $('#dropsentbadges').load('menu/badges_dropsent.php');
 $('#dropinboxbadges').load('menu/badges_dropinbox.php');
</script>
