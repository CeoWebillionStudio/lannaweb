$('#leftBar').load('menu/in_mail_bar.php');
$('#pageMain').load('page/dashboard.php');
$('#topbar_area').load('menu/top_bar.php');
function reloadleftbar(){
    $('#leftBar').load('menu/in_mail_bar.php');
}

function selectsenttype(ele){
    $.ajax({
        type: "POST",
        url: 'Modal/modal_selectsenttype.php',
        data: {doc_id:$(ele).data('id')},
        success: function (data) {
            $('#selecttypeModal').modal('show');
        }
    });
}

function dontselectsenttype() {
    swal({
        title: "ยังไม่มีผู้รับเอกสาร!!",
        text: "กรุณาเพิ่มชื่อผู้รับเอกสาร",
        icon: "warning"
    })
}
function sentteadoc(ele) {
            $.ajax({
                type: "POST",
                url: 'actions/update_doc.php?st=8',
                data: {doc_id:$(ele).data('id')},
                success: function (data) {
                    // alert(data);
                   $('#pageMain').load('page/his_sent_doc.php');
                   $('#draftbadges').load('menu/badges_draft.php')
                    swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'ส่งเอกสารเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
            });
}

function searchmail1() {

    var x = document.getElementById("mail_search");
    var s = x.value;

    $('#leftBar').load('menu/in_mail_bar.php?st=1&txt_search='+s);



}

function searchmail2() {

    var x = document.getElementById("sentmail_search");
    var s = x.value;

    $('#leftBar').load('menu/in_mail_bar.php?st=2&txt_search='+s);

    // alert("ชื่อผู้ส่ง=>");
    // alert(s);
}

function searchdraft() {

    var x = document.getElementById("search_draft");
    var s = x.value;
    $('#load_draft_table').load('page/in_draft_doc.php?txt_search='+s);



}

function searchhissent() {
    var x = document.getElementById("search_his_sent");
    var s = x.value;
    //  alert(s);
    $('#load_his_sent_table').load('page/in_his_sent_doc.php?txt_search='+s);
}

function searchdropin() {
    var x = document.getElementById("search_drop_in");
    var s = x.value;
    //  alert(s);
    $('#load_drop_in_table').load('page/in_drop_inbox.php?txt_search='+s);
}

function searchdropsent() {
    var x = document.getElementById("search_drop_sent");
    var s = x.value;
    //  alert(s);
    $('#load_drop_sent_table').load('page/in_drop_sent.php?txt_search='+s);
}

function noreadopen() {
    $('#cardResponsive').collapse('show');
}

function saveforselectteasent(ele){
    $('#searchmodal').modal('hide');
    setTimeout(function(){$('#pageMain').load('page/select_sent.php',{doc_id:$(ele).data('id')});},500);
}

function backtomain(){
        $('#pageMain').load('page/dashboard.php');
        if(window.matchMedia('(max-width: 1200px)').matches) {
            $('#cardResponsive').collapse('hide');
            $('#navbarResponsive').collapse('hide');
        }else{}
}
function slidemailbar(){
    if (window.matchMedia('(max-width: 1200px)').matches) {
        $('#newdocModal').modal('show');
    }else{
        $('#newdocModal').modal('show');
    }
}

function openinboxdoc(ele){
    $('#pageMain').load('page/inbox.php',{td_no:$(ele).data('id')});
    if(window.matchMedia('(max-width: 1200px)').matches) {
        $('#cardResponsive').collapse('hide');
    }else{}
}

function opensentselect(ele){
    $('#uploadModal').modal('hide');
    swal("Good job!", "บันทึกแล้ว!", "success");
    $('#pageMain').load('page/select_sent.php',{doc_id:$(ele).data('id')});
}

function func_update_tdcomment(){
    $.ajax({
        type: "POST",
        url: 'actions/update_doc.php?st=9',
        data: $("#ans_tdcomment").serialize(),
        success: function (data) {
           //alert(data);
           swal("ส่งข้อความตอบกลับแล้ว",{
            icon: "success",
        });
        $('#pageMain').load('page/dashboard.php');
        }
    });
}

function newdoc() {
    $.ajax({
        type: "POST",
        url: 'actions/update_doc.php?st=1',
        data: $("#createdoc").serialize(),
        success: function (data) {
            // swal("Good job!", "สร้างแบบร่างแล้ว!", "success");
            $('#newdocModal').modal('hide');
            $('#uploadModal').modal('show');
            $('#uploadbody').load('Modal/modal_body_upload.php');
            $('#draftbadges').load('menu/badges_draft.php');
        }
    });
}

function condoc() {
    $.ajax({
        type: "POST",
        url: 'actions/update_doc.php?st=2',
        data: $("#configdoc").serialize(),
        success: function (data) {
            $('#showconfigdoc').load('Modal/modal_body_upload.php?st=1');
            swal("Good job!", "แก้ไขเอกสารสำเร็จแล้ว!", "success");
        }
    });
}

function delinboxdoc(ele){
    swal({
        title: "คุณต้องการลบเอกสารของท่านใช่หรือไม่?",
        text: "เมื่อลบเอกสารจะสามารถกู้คืนได้ภายใน 5 วัน",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            $.ajax({
                type: "POST",
                url: 'actions/update_doc.php?st=5',
                data: {td_no:$(ele).data('id')},
                success: function (data) {
                    $('#leftBar').load('menu/in_mail_bar.php');
                    $('#pageMain').load('page/drop_inbox.php');
                    $('#dropinboxbadges').load('menu/badges_dropinbox.php');
                    swal("ทำการลบเอกสารเสร็จสิ้น!!!",{
                        icon: "success",
                    });
                }
            });
        }else{
            swal("ยกเลิกการลบเอกสารของท่านแล้ว!!");
        }
    });
}

function delhissentdoc(ele){
    swal({
        title: "คุณต้องการลบเอกสารส่งออกนี้ใช่หรือไม่?",
        text: "เมื่อลบเอกสารจะสามารถกู้คืนได้ภายใน 5 วัน",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            $.ajax({
                type: "POST",
                url: 'actions/update_doc.php?st=4',
                data: {doc_id:$(ele).data('id')},
                success: function (data) {
                    $('#pageMain').load('page/his_sent_doc.php');
                    $('#topbar_area').load('menu/top_bar.php');
                }
            });
            swal("ทำการลบเอกสารเสร็จสิ้น!!!", {
                icon: "success",
            });
        }else{
            swal("ยกเลิกการลบเอกสารของท่านแล้ว!!");
        }
    });
}

function deldraft(ele) {
    swal({
        title: "คุณต้องการลบแบบร่างใช่หรือไม่?",
        text: "เมื่อลบแบบร่างจะไม่สามารถกู้แบบร่างคืนได้",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            $.ajax({
                type: "POST",
                url: 'actions/update_doc.php?st=3',
                data: {doc_id:$(ele).data('id')},
                success: function (data) {
                    $('#pageMain').load('page/draft_doc.php');
                    $('#draftbadges').load('menu/badges_draft.php');
                }
            });
            swal("ทำการลบแบบร่างเสร็จสิ้น!!!", {
                icon: "success",
            });
        }else{
            swal("ยกเลิกการลบแบบร่างของท่านแล้ว!!");
        }
    });
}

function funaddfiles(){
    var form = $("#addfile");
    var formData = new FormData(form[0]);
    $.ajax({
        type: "POST",
        url: 'actions/update_file.php?st=1',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#uploadbody').load('Modal/modal_body_upload.php');
        }
    });
}

function funaddfilesforconfig() {
    var form = $("#addfile");
    var formData = new FormData(form[0]);
    $.ajax({
        type: "POST",
        url: 'actions/update_file.php?st=1',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#showconfigdoc').load('Modal/modal_body_upload.php?st=1');
        }
    });
}

function funaddfilesforans() {
    var form = $("#addfile");
    var formData = new FormData(form[0]);
    $.ajax({
        type: "POST",
        url: 'actions/update_file.php?st=4',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            alert(data);
            // $('#showconfigdoc').load('Modal/modal_body_upload.php?st=1');
        }
    });
}
function fundelfile(ele){
    swal({
        title: "คุณต้องการลบไฟล์แนบใช่หรือไม่?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            $.ajax({
                type: "POST",
                url: 'actions/update_file.php?st=3',
                data: {file_id:$(ele).data('id')},
                success: function (data){
                    $('#uploadbody').load('Modal/modal_body_upload.php');
                }
            });
            swal("ทำการลบไฟล์แนบเสร็จสิ้น!!!", {
                icon: "success",
            });
        }else{
            swal("ยกเลิกการลบไฟล์แนบของท่านแล้ว!!");
        }
    });
}

function fundelfileforconfig(ele){
    swal({
        title: "คุณต้องการลบไฟล์แนบใช่หรือไม่?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if(willDelete){
            $.ajax({
                type: "POST",
                url: 'actions/update_file.php?st=3',
                data: {file_id:$(ele).data('id')},
                success: function (data){
                    $('#showconfigdoc').load('Modal/modal_body_upload.php?st=1');
                }
            });
            swal("ทำการลบไฟล์แนบเสร็จสิ้น!!!", {
                icon: "success",
            });
        }else{
            swal("ยกเลิกการลบไฟล์แนบของท่านแล้ว!!");
        }
    });
}



function recoverydocin(ele){
    $.ajax({
        type: "POST",
        url: 'actions/update_doc.php?st=6',
        data: {td_no:$(ele).data('id')},
        success: function (data){
            //alert(data);
            swal("Good job!", "กู้เอกสารแล้ว!!!!", "success");
            $('#showdetailModal').modal('hide');
            setTimeout(function(){$('#pageMain').load('page/drop_inbox.php');},500);
            $('#leftBar').load('menu/in_mail_bar.php');
            $('#dropinboxbadges').load('menu/badges_dropinbox.php');
        }
    });
}

function recoverydocsent(ele){
    $('#topbar_area').load('menu/top_bar.php');
    $.ajax({
        type: "POST",
        url: 'actions/update_doc.php?st=7',
        data: {doc_no:$(ele).data('id')},
        success: function (data){
            $('#pageMain').load('page/drop_sent.php');
            $('#leftBar').load('menu/in_mail_bar.php');
            swal("กู้เอกสารแล้ว!!!!", {
                icon: "success",
            });
        }
    });
}

function updatedraft(ele){
    $('#showdetailModal').modal('hide');
    setTimeout(function(){$('#pageMain').load('page/select_sent.php',{doc_id:$(ele).data('id')});},500);
}

function backtoselect(ele){
    $('#configdocModal').modal('hide');
    setTimeout(function(){$('#pageMain').load('page/select_sent.php',{doc_id:$(ele).data('id')});},500);
}
function searchmail() {
    var s = document.getElementById("searchmailgroup").value;
    $('#search_mail_group').load('menu/searchmailgroup.php?select='+s);
    $('#leftBar').load('menu/in_mail_bar.php?st=3');

}

function selectsearchgroup() {
    var x = document.getElementById("searchgroup").value;
    $('#search_group').load('page/searchgroup.php?select='+x);
}

function searchtable1() {
    var x = document.getElementById("select1").value;
    $('#show_table').load('page/show_search_table.php?select=1&txt_search='+x);
}

function searchtable2() {
    var x = document.getElementById("txt_search");
    var s = x.value;
    $('#show_table').load('page/show_search_table.php?select=2&txt_search='+s);
}

function searchtable3() {
    var x = document.getElementById("id_search");
    var s = x.value;
    $('#show_table').load('page/show_search_table.php?select=3&txt_search='+s);
}

function searchtable4() {
    var x = document.getElementById("select4").value;
    $('#show_table').load('page/show_search_table.php?select=4&txt_search='+x);
}

function searchtable5() {
    var x = document.getElementById("select5").value;
    $('#show_table').load('page/show_search_table.php?select=5&txt_search='+x);
}

function selectsenttea(ele,gselect,gtxt) {
    $('#selectteacher').load('page/select_teacher.php',{tea_id:$(ele).data('id')});
    $('#show_table').load('page/show_search_table.php',{select:gselect,txt_search:gtxt});
}

function unselectsenttea(ele,gselect,gtxt) {
    //$('#selectteacher').load('actions/del_selecttea.php',{user_sno:$(ele).data('id')});
    $.ajax({
        type: "GET",
        url: 'actions/del_selecttea.php',
        data: {tea_sno:$(ele).data('id')},
        success: function (data){
            $('#selectteacher').load('page/select_teacher.php');
            $('#show_table').load('page/show_search_table.php',{select:gselect,txt_search:gtxt});
            // alert(data);
            // swal("Good job!", "กู้เอกสารแล้ว!!!!", "success");
            // $('#showdetailModal').modal('hide');
            // setTimeout(function(){$('#pageMain').load('page/drop_sent.php');},500);
            // $('#leftBar').load('menu/in_mail_bar.php');
            // $('#dropsentbadges').load('menu/badges_dropsent.php');
        }
    });
}


function resetselecttea() {
    $('#selectteacher').load('page/select_teacher.php?type=1');
}
function btndraft(){
    if(window.matchMedia('(max-width: 1200px)').matches) {
        $('#pageMain').load('page/draft_doc.php');
        $('#cardResponsive').collapse('hide');
        $('#navbarResponsive').collapse('hide');
    }else{
        $('#pageMain').load('page/draft_doc.php');
    }
}

function btnsent(){
    if(window.matchMedia('(max-width: 1200px)').matches) {
        $('#pageMain').load('page/his_sent_doc.php');
        $('#cardResponsive').collapse('hide');
        $('#navbarResponsive').collapse('hide');
    }else{
        $('#pageMain').load('page/his_sent_doc.php');
    }
}

function btndropin(){
    if(window.matchMedia('(max-width: 1200px)').matches) {
        $('#pageMain').load('page/drop_inbox.php');
        $('#cardResponsive').collapse('hide');
        $('#navbarResponsive').collapse('hide');
    }else{
        $('#pageMain').load('page/drop_inbox.php');
    }
}

function btndropout(){
    if(window.matchMedia('(max-width: 1200px)').matches) {
        $('#pageMain').load('page/drop_sent.php');
        $('#cardResponsive').collapse('hide');
        $('#navbarResponsive').collapse('hide');
    }else{
        $('#pageMain').load('page/drop_sent.php');
    }
}
