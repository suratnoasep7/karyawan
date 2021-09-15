var table = $('#tbl_pelangaran').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/pelanggaran',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "nama_pelanggaran" },
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
                return '<a href="#" onclick="editPelanggaran(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deletePelanggaran(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_pelanggaran').click(function() {

    var $form = $("#pelanggaran");
    var pelanggaran = getDataForm($form);

    if(pelanggaran.nama_pelanggaran == "" || pelanggaran.status == "" ) {
        responseError();
    } else {
        if(pelanggaran.mode == "tambah") {
            var tambahPelanggaran = ajaxPost("POST","api/pelanggaran",pelanggaran);
            if(!tambahPelanggaran.status) {
                responseError();
            }
            responseSuccess(tambahPelanggaran.message);
        } else {
            var updatePelanggaran = ajaxPost("PUT","api/pelanggaran",pelanggaran);
            if(!updatePelanggaran.status) {
                responseError();
            } 
            responseSuccess(updatePelanggaran.message);
        }    
    }
});

$('#btn_delete_pelanggaran').click(function() {

    var idPelanggaran = $("#id_delete_pelanggaran").val();
    if(idPelanggaran == null || idPelanggaran == "") {
        responseError();
    }
    var pelanggaran = {
        id : idPelanggaran
    }
    var deletePelanggaran = ajaxPost("DELETE","api/pelanggaran",pelanggaran);
    if(!deletePelanggaran.status) {
        responseError();
    }
    responseSuccess(deletePelanggaran.message);
});

function tambahPelanggaran() {
    $('#modalTambahPelanggaran').modal('show');
    $('#modalTambahPelanggaran .modal-title').text('Tambah Data Pelanggaran');
}

function editPelanggaran(id) 
{
    $('#modalTambahPelanggaran').modal('show');
    $('#mode').val("edit");
    $('#modalTambahPelanggaran .modal-title').text('Edit Data Pelanggaran');

    var data = {
        id: id
    };

    var pelanggaran = ajaxPost("POST","api/pelanggaran/get_data_pelanggaran",data);  
    if(pelanggaran.data.length > 0) {
        for (var i = 0; i < pelanggaran.data.length; i++) {
            $('#id').val(pelanggaran.data[i].id);
            $('#kode_asrama').val(pelanggaran.data[i].nama_pelanggaran);
            $('#status').val(pelanggaran.data[i].status);
        }
    }
}

function deletePelanggaran(id) 
{
    $('#modalDeletePelanggaran').modal('show');
    $('#mode').val("edit");
    $('#modalDeletePelanggaran .modal-title').text('Delete Data Pelanggaran');
    $('#id_delete_pelanggaran').val(id);
}

function responseSuccess(message) {
    $('#modalTambahPelanggaran').modal('hide');
    $('#modalDeletePelanggaran').modal('hide');
    $('#id_delete_pelanggaran').val();
    $("#pelanggaran")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
