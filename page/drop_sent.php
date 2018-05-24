<?php session_start();
  require '../actions/config_mysql_oop.php';
  $MsDb = new MSClass();
  $MsDb->ConnectMsDB(); 
?>
<!-- Post Content Column -->
<div class="col-lg-12 hmainpage" id="page_dropsent">
  <!-- Title -->
  <div class="container">
    <div class="row"><!--Header Row-->
      <div class="col-xl-1 col-sm-1 col-3">
        <img src="img/icon/recycledoc.png" alt="" class="mt-3" style="height:80px;">
      </div>
      <div class="col-xl-5 col-lg-5 col-sm-7 col-12">
        <p class="fhead mt-4 text-info">เอกสารที่ลบ (ส่งออก)</p>
      </div>
      <div class="col-xl-6 col-lg-6 mt-3">
        <div class="row">
          <div class="col-12">
            <input type="text" class="form-control" id="search_drop_sent" placeholder="กรอกชื่อเอกสารที่ต้องการค้นหา" onKeyUp='searchdropsent()'>
          </div>
        </div>                        
      </div>
    </div>
<!-- Author -->
<hr><!--/////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- Detail  -->
    <div class="container">
      <div class="row" id="load_drop_sent_table"> 
        <div class="col-12">
          <center>
            <div class="loader"></div>
            <br>
            <p style="font-size:25px;">กำลังโหลดข้อมูล</p>
          </center>
        </div>
      </div>
    </div> <!--container-2-->
  </div> <!--container-1-->
</div> <!--col-lg-9-->

<div class="modal fade" id="showdetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div id="showdraftid">
        </div>
    </div>
</div>

<script>
function sentdocid(ele){
            // alert($(ele).data('id'));
            $('#showdetailModal').modal('show');
            $('#showdraftid').load('Modal/modal_drop_sent_detail.php',{doc_id:$(ele).data('id')});
        }
$('#load_drop_sent_table').load('page/in_drop_sent.php');
</script>