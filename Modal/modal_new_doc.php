<div class="modal fade" id="newdocModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" name="createdoc" id="createdoc">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">สร้างเอกสารใหม่</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row">
        <div class="col-8">
          <input class="form-control" type="text" placeholder="หัวเรื่อง" id="nameDoc" name="nameDoc" value="">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <textarea class="form-control" placeholder="รายละเอียด" id="detailDoc" name="detailDoc" rows="3" type="text"></textarea>
        </div>
      </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="if($('#nameDoc').val()!=''&&$('#detailDoc').val()!=''){newdoc();}else{ swal('กรุณากรอกข้อมูลให้ครบถ้วน','','warning')}">บันทึก & ถัดไป</button>
        <button type="reset" class="btn btn-danger">รีเซ็ต</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--  -->
