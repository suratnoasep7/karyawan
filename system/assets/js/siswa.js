var table = $('#tbl_siswa').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/siswa',
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
                return '<a href="#" onclick="editSiswa(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteSiswa(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_siswa').click(function() {

    var $form = $("#siswa");
    var siswa = getDataForm($form);

    if(siswa.nis == "" || siswa.nama == "" || siswa.tempat_lahir == "" || 
        siswa.tanggal_lahir == "" || siswa.nomor_telepon == "" || siswa.alamat == "" ||
        siswa.status == "" || siswa.jenis_kelamin == "") {
        responseError();
    } else {
        if(siswa.mode == "tambah") {
            var tambahSiswa = ajaxPost("POST","api/siswa",siswa);
            if(!tambahSiswa.status) {
                responseError();
            }
            responseSuccess(tambahSiswa.message);
        } else {
            var updateSiswa = ajaxPost("PUT","api/siswa",siswa);
            if(!updateSiswa.status) {
                responseError();
            } 
            responseSuccess(updateSiswa.message);
        }    
    }
});

$('#btn_delete_siswa').click(function() {

    var idSiswa = $("#id_delete_siswa").val();
    if(idSiswa == null || idSiswa == "") {
        responseError();
    }
    var siswa = {
        id : idSiswa
    }
    var deleteSiswa = ajaxPost("DELETE","api/siswa",siswa);
    if(!deleteSiswa.status) {
        responseError();
    }
    responseSuccess(deleteSiswa.message);
});

function tambahSiswa() {
    $('#modalTambahSiswa').modal('show');
    $('#modalTambahSiswa .modal-title').text('Tambah Data Siswa');
}

function editSiswa(id) 
{
    $('#modalTambahSiswa').modal('show');
    $('#mode').val("edit");
    $('#modalTambahSiswa .modal-title').text('Edit Data Siswa');

    var data = {
        id: id
    };

    var siswa = ajaxPost("POST","api/siswa/get_data_siswa",data);  
    if(siswa.data.length > 0) {
        for (var i = 0; i < siswa.data.length; i++) {
            $('#id').val(siswa.data[i].id);
            $('#nis').val(siswa.data[i].nomor);
            $('#nama').val(siswa.data[i].nama);
            $('#tempat_lahir').val(siswa.data[i].tempat_lahir);
            $('#tanggal_lahir').val(siswa.data[i].tanggal_lahir);
            $('#nomor_telepon').val(siswa.data[i].nomor_telepon);
            $('#status').val(siswa.data[i].status);
            $('#alamat').val(siswa.data[i].alamat);
            $('#jenis_kelamin').val(siswa.data[i].jenis_kelamin);
        }
    }
}

function deleteSiswa(id) 
{
    $('#modalDeleteSiswa').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteSiswa .modal-title').text('Delete Data Siswa');
    $('#id_delete_siswa').val(id);
}

function responseSuccess(message) {
    $('#modalTambahSiswa').modal('hide');
    $('#modalDeleteSiswa').modal('hide');
    $('#id_delete_siswa').val();
    $("#siswa")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
