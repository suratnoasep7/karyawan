var table = $('#tbl_pegawai').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/pegawai',
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
                return '<a href="#" onclick="editPegawai(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deletePegawai(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_pegawai').click(function() {

    var $form = $("#pegawai");
    var pegawai = getDataForm($form);

    if(pegawai.nip == "" || pegawai.nama == "" || pegawai.tempat_lahir == "" || 
        pegawai.tanggal_lahir == "" || pegawai.nomor_telepon == "" || pegawai.alamat == "" ||
        pegawai.status == "" || pegawai.jenis_kelamin == "") {
        responseError();
    } else {
        if(pegawai.mode == "tambah") {
            var tambahPegawai = ajaxPost("POST","api/pegawai",pegawai);
            if(!tambahPegawai.status) {
                responseError();
            }
            responseSuccess(tambahPegawai.message);
        } else {
            var updatePegawai = ajaxPost("PUT","api/pegawai",pegawai);
            if(!updatePegawai.status) {
                responseError();
            } 
            responseSuccess(updatePegawai.message);
        }    
    }
});

$('#btn_delete_pegawai').click(function() {

    var idPegawai = $("#id_delete_pegawai").val();
    if(idPegawai == null || idPegawai == "") {
        responseError();
    }
    var pegawai = {
        id : idPegawai
    }
    var deletePegawai = ajaxPost("DELETE","api/pegawai",pegawai);
    if(!deletePegawai.status) {
        responseError();
    }
    responseSuccess(deletePegawai.message);
});

function tambahPegawai() {
    $('#modalTambahPegawai').modal('show');
    $('#modalTambahPegawai .modal-title').text('Tambah Data Pegawai');
}

function editPegawai(id) 
{
    $('#modalTambahPegawai').modal('show');
    $('#mode').val("edit");
    $('#modalTambahPegawai .modal-title').text('Edit Data Pegawai');

    var data = {
        id: id
    };

    var pegawai = ajaxPost("POST","api/pegawai/get_data_pegawai",data);  
    if(pegawai.data.length > 0) {
        for (var i = 0; i < pegawai.data.length; i++) {
            $('#id').val(pegawai.data[i].id);
            $('#nip').val(pegawai.data[i].nomor);
            $('#nama').val(pegawai.data[i].nama);
            $('#tempat_lahir').val(pegawai.data[i].tempat_lahir);
            $('#tanggal_lahir').val(pegawai.data[i].tanggal_lahir);
            $('#nomor_telepon').val(pegawai.data[i].nomor_telepon);
            $('#status').val(pegawai.data[i].status);
            $('#alamat').val(pegawai.data[i].alamat);
            $('#jenis_kelamin').val(pegawai.data[i].jenis_kelamin);
        }
    }
}

function deletePegawai(id) 
{
    $('#modalDeletePegawai').modal('show');
    $('#mode').val("edit");
    $('#modalDeletePegawai .modal-title').text('Delete Data Pegawai');
    $('#id_delete_pegawai').val(id);
}

function responseSuccess(message) {
    $('#modalTambahPegawai').modal('hide');
    $('#modalDeletePegawai').modal('hide');
    $('#id_delete_pegawai').val();
    $("#pegawai")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
