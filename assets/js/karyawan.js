var table = $('#tbl_karyawan').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/karyawan',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization',access_token);
        }
    },
    "columns": [
        { "data": "nik" },
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
                return '<a href="#" onclick="editKaryawan(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteKaryawan(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_karyawan').click(function() {

    var $form = $("#karyawan");
    var karyawan = getDataForm($form);

    if(karyawan.nik == "" || karyawan.nik == "" ) {
        responseError();
    } else {
        if(karyawan.mode == "tambah") {
            var tambahKaryawan = ajaxPost("POST","api/karyawan",karyawan);
            if(!tambahKaryawan.status) {
                responseError();
            }
            responseSuccess(tambahKaryawan.message);
        } else {
            var updateKaryawan = ajaxPost("PUT","api/karyawan",karyawan);
            if(!updateKaryawan.status) {
                responseError();
            } 
            responseSuccess(updateKaryawan.message);
        }    
    }
});

$('#btn_delete_karyawan').click(function() {

    var idKaryawan = $("#id_delete_karyawan").val();
    if(idKaryawan == null || idKaryawan == "") {
        responseError();
    }
    var karyawan = {
        id : idKaryawan
    }
    var deleteKaryawan = ajaxPost("DELETE","api/karyawan",karyawan);
    if(!deleteKaryawan.status) {
        responseError();
    }
    responseSuccess(deleteKaryawan.message);
});

function tambahKaryawan() {
    $('#modalTambahKaryawan').modal('show');
    $('#modalTambahKaryawan .modal-title').text('Tambah Data Karyawan');
}

function editKaryawan(id) 
{
    $('#modalTambahKaryawan').modal('show');
    $('#mode').val("edit");
    $('#modalTambahKaryawan .modal-title').text('Edit Data Karyawan');

    var data = {
        id: id
    };

    var karyawan = ajaxPost("POST","api/karyawan/get_data_karyawan",data);  
    if(karyawan.data.length > 0) {
        for (var i = 0; i < karyawan.data.length; i++) {
            $('#id').val(karyawan.data[i].id);
            $('#nik').val(karyawan.data[i].nik);
            $('#nama').val(karyawan.data[i].nama);
            $('#status').val(karyawan.data[i].status);
        }
    }
}

function deleteKaryawan(id) 
{
    $('#modalDeleteKaryawan').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteKaryawan .modal-title').text('Delete Data Karyawan');
    $('#id_delete_karyawan').val(id);
}

function responseSuccess(message) {
    $('#modalTambahKaryawan').modal('hide');
    $('#modalDeleteKaryawan').modal('hide');
    $('#id_delete_karyawan').val();
    $("#karyawan")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ location.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
