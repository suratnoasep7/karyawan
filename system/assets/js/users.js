$("#nomor").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/assign_jabatan_pegawai/get_assign_jabatan',
        dataType: 'json',
        type: "GET",
        quietMillis: 50,
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        },
        processResults: function (data) {
            return {
                results: $.map(data.data, function (item) {
                    return {
                        text: item.nama,
                        id: item.nomor
                    }
                })
            };
        }
    }
});

$(document.body).on("change","#nomor",function(){
    var data = {
        nomor: this.value
    };

    var assign_jabatan_pegawai = ajaxPost("POST","api/assign_jabatan_pegawai/get_data_assign_jabatan_pegawai_nomor",data);
    $('#id_jabatan').val(assign_jabatan_pegawai.data[0].id_jabatan);
});

var table = $('#tbl_users').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/users',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "jabatan" },
        { "data": "nomor" },
        { 
            "data": null, 
            render:function(data) {
                if(data.status == "1") {
                    return "Aktif";
                } else {
                    return "Tidak Aktif";
                }     
            } 
        },
        { "data": null,
            "render": function (data) {
                return '<a href="#" onclick="editUsers(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteUsers(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_users').click(function() {

    var $form = $("#users");
    var users = getDataForm($form);

    if(users.nomor == "" || users.password == "" || users.status == "") {
        responseError();
    } else {
        if(users.mode == "tambah") {
            var tambahUsers = ajaxPost("POST","api/users",users);
            if(!tambahUsers.status) {
                responseError();
            }
            responseSuccess(tambahUsers.message);
        } else {
            var updateUsers = ajaxPost("PUT","api/users",users);
            if(!updateUsers.status) {
                responseError();
            } 
            responseSuccess(updateUsers.message);
        }    
    }
});

$('#btn_delete_users').click(function() {

    var idUsers = $("#id_delete_users").val();
    if(idUsers == null || idUsers == "") {
        responseError();
    }
    var users = {
        id : idUsers
    }
    var deleteUsers = ajaxPost("DELETE","api/users",users);
    if(!deleteUsers.status) {
        responseError();
    }
    responseSuccess(deleteUsers.message);
});

function tambahUsers() {
    $('#modalTambahUsers').modal('show');
    $('#modalTambahUsers .modal-title').text('Tambah Data Users');
}

function editUsers(id) 
{
    $('#modalTambahUsers').modal('show');
    $('#mode').val("edit");
    $('#modalTambahUsers .modal-title').text('Edit Data Users');

    var data = {
        id: id
    };

    var users = ajaxPost("POST","api/users/get_data_users",data);  
    if(users.data.length > 0) {
        for (var i = 0; i < users.data.length; i++) {
            $('#id').val(users.data[i].id);
            $('#nomor').val(users.data[i].nomor).trigger('change');
            $('#id_jabatan').val(users.data[i].id_jabatan);
            $('#status').val(users.data[i].status);
        }
    }
}

function deleteUsers(id) 
{
    $('#modalDeleteUsers').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteUsers .modal-title').text('Delete Data Users');
    $('#id_delete_users').val(id);
}

function responseSuccess(message) {
    $('#modalTambahUsers').modal('hide');
    $('#modalDeleteUsers').modal('hide');
    $('#id_delete_users').val();
    $("#users")[0].reset();
    $('#id_jabatan').val();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
