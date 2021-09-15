
var dataKategoriAsrama = ajaxGet("GET","api/kategori_asrama");

var optionsKategoriAsrama = "";

optionsKategoriAsrama += "<option value=''>-- PILIH --</option>";
for (var i = 0; i < dataKategoriAsrama.data.length; i++) {
    optionsKategoriAsrama += "<option value='"+dataKategoriAsrama.data[i].kode_kategori_asrama+"'>"+dataKategoriAsrama.data[i].nama_kategori_asrama+"</option>";
}

$('#kode_asrama').append(optionsKategoriAsrama);

var table = $('#tbl_asrama').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/asrama',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "kode_asrama" },
        { "data": "lantai" },
        { "data": "hall" },
        { "data": "nomor_kamar" },
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
                return '<a href="#" onclick="editAsrama(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteAsrama(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_asrama').click(function() {

    var $form = $("#asrama");
    var asrama = getDataForm($form);

    if(asrama.kode_asrama == "" || asrama.lantai == "" || asrama.hall == "" || asrama.nomor_kamar == "") {
        responseError();
    } else {
        if(asrama.mode == "tambah") {
            var tambahAsrama = ajaxPost("POST","api/asrama",asrama);
            if(!tambahAsrama.status) {
                responseError();
            }
            responseSuccess(tambahAsrama.message);
        } else {
            var updateAsrama = ajaxPost("PUT","api/asrama",asrama);
            if(!updateAsrama.status) {
                responseError();
            } 
            responseSuccess(updateAsrama.message);
        }    
    }
});

$('#btn_delete_asrama').click(function() {

    var idAsrama = $("#id_delete_asrama").val();
    if(idAsrama == null || idAsrama == "") {
        responseError();
    }
    var asrama = {
        id : idAsrama
    }
    var deleteAsrama = ajaxPost("DELETE","api/asrama",asrama);
    if(!deleteAsrama.status) {
        responseError();
    }
    responseSuccess(deleteAsrama.message);
});

function tambahAsrama() {
    $('#modalTambahAsrama').modal('show');
    $('#modalTambahAsrama .modal-title').text('Tambah Data Asrama');
}

function editAsrama(id) 
{
    $('#modalTambahAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalTambahAsrama .modal-title').text('Edit Data Asrama');

    var data = {
        id: id
    };

    var asrama = ajaxPost("POST","api/asrama/get_data_asrama",data);  
    if(asrama.data.length > 0) {
        for (var i = 0; i < asrama.data.length; i++) {
            $('#id').val(asrama.data[i].id);
            $('#kode_asrama').val(asrama.data[i].kode_asrama);
            $('#hall').val(asrama.data[i].hall);
            $('#lantai').val(asrama.data[i].lantai);
            $('#nomor_kamar').val(asrama.data[i].nomor_kamar);
            $('#status').val(asrama.data[i].status);
        }
    }
}

function deleteAsrama(id) 
{
    $('#modalDeleteAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteAsrama .modal-title').text('Delete Data Asrama');
    $('#id_delete_asrama').val(id);
}

function responseSuccess(message) {
    $('#modalTambahAsrama').modal('hide');
    $('#modalDeleteAsrama').modal('hide');
    $('#id_delete_asrama').val();
    $("#asrama")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
