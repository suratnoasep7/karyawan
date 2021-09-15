var table = $('#tbl_kategori_asrama').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/kategori_asrama',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "kode_kategori_asrama" },
        { "data": "nama_kategori_asrama" },
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
                return '<a href="#" onclick="editKategoriAsrama(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteKategoriAsrama(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_kategori_asrama').click(function() {

    var $form = $("#kategori_asrama");
    var kategori_asrama = getDataForm($form);

    if(kategori_asrama.kode_asrama == "" || kategori_asrama.nama_asrama == "" ) {
        responseError();
    } else {
        if(kategori_asrama.mode == "tambah") {
            var tambahKategoriAsrama = ajaxPost("POST","api/kategori_asrama",kategori_asrama);
            if(!tambahKategoriAsrama.status) {
                responseError();
            }
            responseSuccess(tambahKategoriAsrama.message);
        } else {
            var updateKategoriAsrama = ajaxPost("PUT","api/kategori_asrama",kategori_asrama);
            if(!updateKategoriAsrama.status) {
                responseError();
            } 
            responseSuccess(updateKategoriAsrama.message);
        }    
    }
});

$('#btn_delete_kategori_asrama').click(function() {

    var idKategoriAsrama = $("#id_delete_kategori_asrama").val();
    if(idKategoriAsrama == null || idKategoriAsrama == "") {
        responseError();
    }
    var kategori_asrama = {
        id : idKategoriAsrama
    }
    var deleteKategoriAsrama = ajaxPost("DELETE","api/kategori_asrama",kategori_asrama);
    if(!deleteKategoriAsrama.status) {
        responseError();
    }
    responseSuccess(deleteKategoriAsrama.message);
});

function tambahKategoriAsrama() {
    $('#modalTambahKategoriAsrama').modal('show');
    $('#modalTambahKategoriAsrama .modal-title').text('Tambah Data Kategori Asrama');
}

function editKategoriAsrama(id) 
{
    $('#modalTambahKategoriAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalTambahKategoriAsrama .modal-title').text('Edit Data Kategori Asrama');

    var data = {
        id: id
    };

    var kategori_asrama = ajaxPost("POST","api/kategori_asrama/get_data_kategori_asrama",data);  
    if(kategori_asrama.data.length > 0) {
        for (var i = 0; i < kategori_asrama.data.length; i++) {
            $('#id').val(kategori_asrama.data[i].id);
            $('#kode_asrama').val(kategori_asrama.data[i].kode_kategori_asrama);
            $('#nama_asrama').val(kategori_asrama.data[i].nama_kategori_asrama);
            $('#status').val(kategori_asrama.data[i].status);
        }
    }
}

function deleteKategoriAsrama(id) 
{
    $('#modalDeleteKategoriAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteKategoriAsrama .modal-title').text('Delete Data Kategori Asrama');
    $('#id_delete_kategori_asrama').val(id);
}

function responseSuccess(message) {
    $('#modalTambahKategoriAsrama').modal('hide');
    $('#modalDeleteKategoriAsrama').modal('hide');
    $('#id_delete_kategori_asrama').val();
    $("#kategori_asrama")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
