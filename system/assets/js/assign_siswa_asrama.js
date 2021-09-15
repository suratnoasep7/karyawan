$("#kode_asrama").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/asrama/get_data_asrama_siswa',
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

$("#nis").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/siswa/search_siswa',
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


var table = $('#tbl_assign_siswa_asrama').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/assign_siswa_asrama',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "kode_asrama" },
        { "data": "nim" },
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
                return '<a href="#" onclick="editAssignSiswaAsrama(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteAssignSiswaAsrama(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_assign_siswa_asrama').click(function() {

    var $form = $("#assign_siswa_asrama");
    var assign_siswa_asrama = getDataForm($form);

    if(assign_siswa_asrama.ni == "" || assign_siswa_asrama.kode_asrama == "") {
        responseError();
    } else {
        if(assign_siswa_asrama.mode == "tambah") {
            var tambahAssignSiswaAsrama = ajaxPost("POST","api/assign_siswa_asrama",assign_siswa_asrama);
            if(!tambahAssignSiswaAsrama.status) {
                responseError();
            }
            responseSuccess(tambahAssignSiswaAsrama.message);
        } else {
            var updateAssignSiswaAsrama = ajaxPost("PUT","api/assign_siswa_asrama",assign_siswa_asrama);
            if(!updateAssignSiswaAsrama.status) {
                responseError();
            } 
            responseSuccess(updateAssignSiswaAsrama.message);
        }    
    }
});

$('#btn_delete_assign_siswa_asrama').click(function() {

    var idAssignSiswaAsrama = $("#id_delete_assign_siswa_asrama").val();
    if(idAssignSiswaAsrama == null || idAssignSiswaAsrama == "") {
        responseError();
    }
    var assign_siswa_asrama = {
        id : idAssignSiswaAsrama
    }
    var deleteAssignSiswaAsrama = ajaxPost("DELETE","api/assign_siswa_asrama",assign_siswa_asrama);
    if(!deleteAssignSiswaAsrama.status) {
        responseError();
    }
    responseSuccess(deleteAssignSiswaAsrama.message);
});

function tambahAssignSiswaAsrama() {
    $('#modalTambahAssignSiswaAsrama').modal('show');
    $('#modalTambahAssignSiswaAsrama .modal-title').text('Tambah Data Assign Siswa Asrama');
}

function editAssignSiswaAsrama(id) 
{
    $('#modalTambahAssignSiswaAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalTambahAssignSiswaAsrama .modal-title').text('Edit Data Assign Siswa Asrama');

    var data = {
        id: id
    };

    var assign_siswa_asrama = ajaxPost("POST","api/assign_siswa_asrama/get_data_assign_siswa_asrama",data);  
    if(assign_siswa_asrama.data.length > 0) {
        for (var i = 0; i < assign_siswa_asrama.data.length; i++) {
            $('#id').val(assign_siswa_asrama.data[i].id);
            $('#nis').val(assign_siswa_asrama.data[i].nis).trigger("change");
            $('#kode_asrama').val(assign_siswa_asrama.data[i].kode_asrama).trigger("change");
            $('#status').val(assign_siswa_asrama.data[i].status);
        }
    }
}

function deleteAssignSiswaAsrama(id) 
{
    $('#modalDeleteAssignSiswaAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteAssignSiswaAsrama .modal-title').text('Delete Data Assign Siswa Asrama');
    $('#id_delete_assign_siswa_asrama').val(id);
}

function responseSuccess(message) {
    $('#modalTambahAssignSiswaAsrama').modal('hide');
    $('#modalDeleteAssignSiswaAsrama').modal('hide');
    $('#id_delete_assign_siswa_asrama').val();
    $("#assign_siswa_asrama")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
