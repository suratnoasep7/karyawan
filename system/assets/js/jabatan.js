var table = $('#tbl_jabatan').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/jabatan',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "nama" },
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
                return '<a href="#" onclick="editJabatan(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteJabatan(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_jabatan').click(function() {

    var $form = $("#jabatan");
    var jabatan = getDataForm($form);

    if(jabatan.nama == "") {
        responseError();
    } else {
        if(jabatan.mode == "tambah") {
            var tambahJabatan = ajaxPost("POST","api/jabatan",jabatan);
            if(!tambahJabatan.status) {
                responseError();
            }
            responseSuccess(tambahJabatan.message);
        } else {
            var updateJabatan = ajaxPost("PUT","api/jabatan",jabatan);
            if(!updateJabatan.status) {
                responseError();
            } 
            responseSuccess(updateJabatan.message);
        }    
    }
});

$('#btn_delete_jabatan').click(function() {

    var idJabatan = $("#id_delete_jabatan").val();
    if(idJabatan == null || idJabatan == "") {
        responseError();
    }
    var jabatan = {
        id : idJabatan
    }
    var deleteJabatan = ajaxPost("DELETE","api/jabatan",jabatan);
    if(!deleteJabatan.status) {
        responseError();
    }
    responseSuccess(deleteJabatan.message);
});

function tambahJabatan() {
    $('#modalTambahJabatan').modal('show');
    $('#modalTambahJabatan .modal-title').text('Tambah Data Jabatan');
}

function editJabatan(id) 
{
    $('#modalTambahJabatan').modal('show');
    $('#mode').val("edit");
    $('#modalTambahJabatan .modal-title').text('Edit Data Jabatan');

    var data = {
        id: id
    };

    var jabatan = ajaxPost("POST","api/jabatan/get_data_jabatan",data);  
    if(jabatan.data.length > 0) {
        for (var i = 0; i < jabatan.data.length; i++) {
            $('#id').val(jabatan.data[i].id);
            $('#nama').val(jabatan.data[i].nama);
            $('#status').val(jabatan.data[i].status);
        }
    }
}

function deleteJabatan(id) 
{
    $('#modalDeleteJabatan').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteJabatan .modal-title').text('Delete Data Jabatan');
    $('#id_delete_jabatan').val(id);
}

function responseSuccess(message) {
    $('#modalTambahJabatan').modal('hide');
    $('#modalDeleteJabatan').modal('hide');
    $('#id_delete_jabatan').val();
    $("#jabatan")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
