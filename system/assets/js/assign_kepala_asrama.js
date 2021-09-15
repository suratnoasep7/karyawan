$("#nomor").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/assign_jabatan_pegawai/get_data_kepala_asrama',
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

$("#kode_asrama").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/asrama/get_asrama',
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
                        text: item.kode_asrama,
                        id: item.kode_asrama
                    }
                })
            };
        }
    }
});

var table = $('#tbl_assign_kepala_asrama').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/assign_kepala_asrama',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "kode_asrama" },
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
                return '<a href="#" onclick="deleteAssignKepalaAsrama(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_assign_kepala_asrama').click(function() {

    var $form = $("#assign_kepala_asrama");
    var assign_kepala_asrama = getDataForm($form);

    if(assign_kepala_asrama.nomor == "" || assign_kepala_asrama.kode_asrama == "") {
        responseError();
    } else {
        if(assign_kepala_asrama.mode == "tambah") {
            var tambahAssignKepalaAsrama = ajaxPost("POST","api/assign_kepala_asrama",assign_kepala_asrama);
            if(!tambahAssignKepalaAsrama.status) {
                responseError();
            }
            responseSuccess(tambahAssignKepalaAsrama.message);
        } else {
            var updateAssignKepalaAsrama = ajaxPost("PUT","api/assign_kepala_asrama",assign_kepala_asrama);
            if(!updateAssignKepalaAsrama.status) {
                responseError();
            } 
            responseSuccess(updateAssignKepalaAsrama.message);
        }    
    }
});

$('#btn_delete_assign_kepala_asrama').click(function() {

    var idAssignKepalaAsrama = $("#id_delete_assign_kepala_asrama").val();
    if(idAssignKepalaAsrama == null || idAssignKepalaAsrama == "") {
        responseError();
    }
    var assign_kepala_asrama = {
        id : idAssignKepalaAsrama
    }
    var deleteAssignKepalaAsrama = ajaxPost("DELETE","api/assign_kepala_asrama",assign_kepala_asrama);
    if(!deleteAssignKepalaAsrama.status) {
        responseError();
    }
    responseSuccess(deleteAssignKepalaAsrama.message);
});

function tambahAssignKepalaAsrama() {
    $('#modalTambahAssignKepalaAsrama').modal('show');
    $('#modalTambahAssignKepalaAsrama .modal-title').text('Tambah Data Assign Kepala Asrama');
}


function deleteAssignKepalaAsrama(id) 
{
    $('#modalDeleteAssignKepalaAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteAssignKepalaAsrama .modal-title').text('Delete Data Assign Kepala Asrama');
    $('#id_delete_assign_kepala_asrama').val(id);
}

function responseSuccess(message) {
    $('#modalTambahAssignKepalaAsrama').modal('hide');
    $('#modalDeleteAssignKepalaAsrama').modal('hide');
    $('#id_delete_assign_kepala_asrama').val();
    $("#assign_kepala_asrama")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
