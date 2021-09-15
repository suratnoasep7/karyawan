$("#kode_asrama").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/asrama/get_data_asrama_mahasiswa',
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
                        id: item.id
                    }
                })
            };
        }
    }
});

$("#nim").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/mahasiswa/search_mahasiswa',
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
                        id: item.id
                    }
                })
            };
        }
    }
});


var table = $('#tbl_assign_mahasiswa_asrama').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/assign_mahasiswa_asrama',
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
                return '<a href="#" onclick="editAssignMahasiswaAsrama(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteAssignMahasiswaAsrama(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_assign_mahasiswa_asrama').click(function() {

    var $form = $("#assign_mahasiswa_asrama");
    var assign_mahasiswa_asrama = getDataForm($form);

    if(assign_mahasiswa_asrama.nim == "" || assign_mahasiswa_asrama.kode_asrama == "") {
        responseError();
    } else {
        if(assign_mahasiswa_asrama.mode == "tambah") {
            var tambahAssignMahasiswaAsrama = ajaxPost("POST","api/assign_mahasiswa_asrama",assign_mahasiswa_asrama);
            if(!tambahAssignMahasiswaAsrama.status) {
                responseError();
            }
            responseSuccess(tambahAssignMahasiswaAsrama.message);
        } else {
            var updateAssignMahasiswaAsrama = ajaxPost("PUT","api/assign_mahasiswa_asrama",assign_mahasiswa_asrama);
            if(!updateAssignMahasiswaAsrama.status) {
                responseError();
            } 
            responseSuccess(updateAssignMahasiswaAsrama.message);
        }    
    }
});

$('#btn_delete_assign_mahasiswa_asrama').click(function() {

    var idAssignMahasiswaAsrama = $("#id_delete_assign_mahasiswa_asrama").val();
    if(idAssignMahasiswaAsrama == null || idAssignMahasiswaAsrama == "") {
        responseError();
    }
    var assign_mahasiswa_asrama = {
        id : idAssignMahasiswaAsrama
    }
    var deleteAssignMahasiswaAsrama = ajaxPost("DELETE","api/assign_mahasiswa_asrama",assign_mahasiswa_asrama);
    if(!deleteAssignMahasiswaAsrama.status) {
        responseError();
    }
    responseSuccess(deleteAssignMahasiswaAsrama.message);
});

function tambahAssignMahasiswaAsrama() {
    $('#modalTambahAssignMahasiswaAsrama').modal('show');
    $('#modalTambahAssignMahasiswaAsrama .modal-title').text('Tambah Data Assign Mahasiswa Asrama');
}

function editAssignMahasiswaAsrama(id) 
{
    $('#modalTambahAssignMahasiswaAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalTambahAssignMahasiswaAsrama .modal-title').text('Edit Data Assign Mahasiswa Asrama');

    var data = {
        id: id
    };

    var assign_mahasiswa_asrama = ajaxPost("POST","api/assign_mahasiswa_asrama/get_data_assign_mahasiswa_asrama",data);  
    if(assign_mahasiswa_asrama.data.length > 0) {
        for (var i = 0; i < assign_mahasiswa_asrama.data.length; i++) {
            $('#id').val(assign_mahasiswa_asrama.data[i].id);
            $('#nim').val(assign_mahasiswa_asrama.data[i].nim).trigger("change");
            $('#kode_asrama').val(assign_mahasiswa_asrama.data[i].kode_asrama).trigger("change");
            $('#status').val(assign_mahasiswa_asrama.data[i].status);
        }
    }
}

function deleteAssignMahasiswaAsrama(id) 
{
    $('#modalDeleteAssignMahasiswaAsrama').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteAssignMahasiswaAsrama .modal-title').text('Delete Data Assign Mahasiswa Asrama');
    $('#id_delete_assign_mahasiswa_asrama').val(id);
}

function responseSuccess(message) {
    $('#modalTambahAssignMahasiswaAsrama').modal('hide');
    $('#modalDeleteAssignMahasiswaAsrama').modal('hide');
    $('#id_delete_assign_mahasiswa_asrama').val();
    $("#assign_mahasiswa_asrama")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
