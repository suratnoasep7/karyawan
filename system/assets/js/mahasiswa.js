var table = $('#tbl_mahasiswa').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/mahasiswa',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "nomor" },
        { "data": "nama" },
        { 
            "data": null, 
            render:function(data) {
                if(data.jenis_kelamin == "L") {
                    return "Laki Laki";
                } else {
                    return "Perempuan";
                }     
            } 
        },
        { "data": "tempat_lahir" },
        { "data": "tanggal_lahir" },
        { "data": "alamat" },
        { "data": "nomor_telepon" },
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
                return '<a href="#" onclick="editMahasiswa(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteMahasiswa(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_mahasiswa').click(function() {

    var $form = $("#mahasiswa");
    var mahasiswa = getDataForm($form);

    if(mahasiswa.nim == "" || mahasiswa.nama == "" || mahasiswa.tempat_lahir == "" || 
        mahasiswa.tanggal_lahir == "" || mahasiswa.nomor_telepon == "" || mahasiswa.alamat == "" ||
        mahasiswa.status == "" || mahasiswa.jenis_kelamin == "") {
        responseError();
    } else {
        if(mahasiswa.mode == "tambah") {
            var tambahMahasiswa = ajaxPost("POST","api/mahasiswa",mahasiswa);
            if(!tambahMahasiswa.status) {
                responseError();
            }
            responseSuccess(tambahMahasiswa.message);
        } else {
            var updateMahasiswa = ajaxPost("PUT","api/mahasiswa",mahasiswa);
            if(!updateMahasiswa.status) {
                responseError();
            } 
            responseSuccess(updateMahasiswa.message);
        }    
    }
});

$('#btn_delete_mahasiswa').click(function() {

    var idMahasiswa = $("#id_delete_mahasiswa").val();
    if(idMahasiswa == null || idMahasiswa == "") {
        responseError();
    }
    var mahasiswa = {
        id : idMahasiswa
    }
    var deleteMahasiswa = ajaxPost("DELETE","api/mahasiswa",mahasiswa);
    if(!deleteMahasiswa.status) {
        responseError();
    }
    responseSuccess(deleteMahasiswa.message);
});

function tambahMahasiswa() {
    $('#modalTambahMahasiswa').modal('show');
    $('#modalTambahMahasiswa .modal-title').text('Tambah Data Mahasiswa');
}

function editMahasiswa(id) 
{
    $('#modalTambahMahasiswa').modal('show');
    $('#mode').val("edit");
    $('#modalTambahMahasiswa .modal-title').text('Edit Data Mahasiswa');

    var data = {
        id: id
    };

    var mahasiswa = ajaxPost("POST","api/mahasiswa/get_data_mahasiswa",data);  
    if(mahasiswa.data.length > 0) {
        for (var i = 0; i < mahasiswa.data.length; i++) {
            $('#id').val(mahasiswa.data[i].id);
            $('#nim').val(mahasiswa.data[i].nomor);
            $('#nama').val(mahasiswa.data[i].nama);
            $('#tempat_lahir').val(mahasiswa.data[i].tempat_lahir);
            $('#tanggal_lahir').val(mahasiswa.data[i].tanggal_lahir);
            $('#nomor_telepon').val(mahasiswa.data[i].nomor_telepon);
            $('#status').val(mahasiswa.data[i].status);
            $('#alamat').val(mahasiswa.data[i].alamat);
            $('#jenis_kelamin').val(mahasiswa.data[i].jenis_kelamin);
        }
    }
}

function deleteMahasiswa(id) 
{
    $('#modalDeleteMahasiswa').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteMahasiswa .modal-title').text('Delete Data Mahasiswa');
    $('#id_delete_mahasiswa').val(id);
}

function responseSuccess(message) {
    $('#modalTambahMahasiswa').modal('hide');
    $('#modalDeleteMahasiswa').modal('hide');
    $('#id_delete_mahasiswa').val();
    $("#mahasiswa")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
