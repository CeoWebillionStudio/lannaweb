<div class="container">
    <div class="row mt-5">
        <!-- <a class="btn btn-primary" onclick="reloadleftbar()">ReloadLeftbar</a> -->
        <div id="inboxbuttonformobile" class="w-100">
        </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-tile bg-gradient text-center p-0 addho" onclick="btndraft()">
                    <div class="card-body row p-4 text-success ">
                        <div class="col-3">
                            <center>
                                <i class="fas fa-pencil-alt fa-3x"></i>
                            </center>
                        </div>
                        <div class="col-9">
                        <div class="float-right">
                            <div class="tile-number">
                                <h4 class="count1">
                                    <center>
                                        <div class="loader"></div>
                                    </center>
                                </h4>
                            </div>
                            <div class="tile-description">แบบร่างเอกสาร</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-tile bg-gradient text-center p-0 addho" onclick="btnsent()">
                <div class="card-body row p-4 text-primary ">
                    <div class="col-3">
                        <center>
                            <i class="fas fa-sign-in-alt fa-3x"></i>
                        </center>
                    </div>
                    <div class="col-9">
                        <div class="float-right">
                            <div class="tile-number">
                                <h4 class="count2">
                                    <center>
                                        <div class="loader"></div>
                                    </center>
                                </h4>
                            </div>
                            <div class="tile-description">เอกสารที่ส่งออก</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-tile bg-gradient text-center p-0 addho" onclick="btndropin()">
                <div class="card-body row p-4 text-danger ">
                    <div class="col-3">
                        <center>
                            <i class="fas fa-trash-alt fa-3x"></i>
                        </center>
                    </div>
                    <div class="col-9">
                        <div class="float-right">
                            <div class="tile-number">
                                <h4 class="count4">
                                    <center>
                                        <div class="loader"></div>
                                    </center>
                                </h4>
                            </div>
                            <div class="tile-description">ถังขยะ(รับเข้า)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-tile bg-gradient text-center p-0 addho" onclick="btndropout()">
                <div class="card-body row p-4 text-secondary">
                    <div class="col-3">
                        <center>
                            <i class="fas fa-trash fa-3x"></i>
                        </center>
                    </div>
                    <div class="col-9">
                        <div class="float-right">
                            <div class="tile-number">
                                <h4 class="count3">
                                    <center>
                                        <div class="loader"></div>
                                    </center>
                                </h4>
                            </div>
                            <div class="tile-description">ถังขยะ(ส่งออก)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if(window.matchMedia('(max-width: 576px)').matches) {
        $('#inboxbuttonformobile').load('menu/noreadbutton.php');
    }
    $('.count1').load('menu/badges_draft.php');
    $('.count1').load('menu/badges_draft.php');
    $('.count2').load('menu/badges_sent.php');
    $('.count3').load('menu/badges_dropsent.php');
    $('.count4').load('menu/badges_dropinbox.php');
</script>