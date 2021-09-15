var dataJabatan = ajaxGet("GET","api/jabatan");

var optionsJabatan = "";

optionsJabatan += "<option value=''>-- PILIH --</option>";
for (var i = 0; i < dataJabatan.data.length; i++) {
    optionsJabatan += "<option value='"+dataJabatan.data[i].id+"'>"+dataJabatan.data[i].nama+"</option>";
}

$('#id_jabatan').append(optionsJabatan);


$("#nomor").select2({
    theme: 'bootstrap',
    ajax: {
        url: base_url + 'api/pegawai/get_pegawai',
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

var table = $('#tbl_assign_jabatan_pegawai').DataTable({
    "ajax": {
        "type": "GET",
        "url": base_url + 'api/assign_jabatan_pegawai',
        "beforeSend" : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
        }
    },
    "columns": [
        { "data": "jabatan" },
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
                return '<a href="#" onclick="editAssignJabatanPegawai(\'' + data.id + '\')"><i class="fa fa-pencil-alt"></i></a> <a href="#" onclick="deleteAssignJabatanPegawai(\'' + data.id + '\')"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ]
});
$('#btn_tambah_assign_jabatan_pegawai').click(function() {

    var $form = $("#assign_jabatan_pegawai");
    var assign_jabatan_pegawai = getDataForm($form);

    if(assign_jabatan_pegawai.id_jabatan == "" || assign_jabatan_pegawai.nomor == "") {
        responseError();
    } else {
        if(assign_jabatan_pegawai.mode == "tambah") {
            var tambahAssignJabatanPegawai = ajaxPost("POST","api/assign_jabatan_pegawai",assign_jabatan_pegawai);
            if(!tambahAssignJabatanPegawai.status) {
                responseError();
            }
            responseSuccess(tambahAssignJabatanPegawai.message);
        } else {
            var updateAssignJabatanPegawai = ajaxPost("PUT","api/assign_jabatan_pegawai",assign_jabatan_pegawai);
            if(!updateAssignJabatanPegawai.status) {
                responseError();
            } 
            responseSuccess(updateAssignJabatanPegawai.message);
        }    
    }
});

$('#btn_delete_assign_jabatan_pegawai').click(function() {

    var idAssignJabatanPegawai = $("#id_delete_assign_jabatan_pegawai").val();
    if(idAssignJabatanPegawai == null || idAssignJabatanPegawai == "") {
        responseError();
    }
    var assign_jabatan_pegawai = {
        id : idAssignJabatanPegawai
    }
    var deleteAssignJabatanPegawai = ajaxPost("DELETE","api/assign_jabatan_pegawai",assign_jabatan_pegawai);
    if(!deleteAssignJabatanPegawai.status) {
        responseError();
    }
    responseSuccess(deleteAssignJabatanPegawai.message);
});

function tambahAssignJabatanPegawai() {
    $('#modalTambahAssignJabatanPegawai').modal('show');
    $('#modalTambahAssignJabatanPegawai .modal-title').text('Tambah Data Assign Jabatan Pegawai');
}

function editAssignJabatanPegawai(id) 
{
    $('#modalTambahAssignJabatanPegawai').modal('show');
    $('#mode').val("edit");
    $('#modalTambahAssignJabatanPegawai .modal-title').text('Edit Data Assign Jabatan Pegawai');

    var data = {
        id: id
    };

    var assign_jabatan_pegawai = ajaxPost("POST","api/assign_jabatan_pegawai/get_data_assign_jabatan_pegawai",data);  
    if(assign_jabatan_pegawai.data.length > 0) {
        for (var i = 0; i < assign_jabatan_pegawai.data.length; i++) {
            $('#id').val(assign_jabatan_pegawai.data[i].id);
            $('#id_jabatan').val(assign_jabatan_pegawai.data[i].id_jabatan);
            $('#nomor').val(assign_jabatan_pegawai.data[i].nomor).trigger("change");
            $('#status').val(assign_jabatan_pegawai.data[i].status);
        }
    }
}

function deleteAssignJabatanPegawai(id) 
{
    $('#modalDeleteAssignJabatanPegawai').modal('show');
    $('#mode').val("edit");
    $('#modalDeleteAssignJabatanPegawai .modal-title').text('Delete Data Assign Jabatan Pegawai');
    $('#id_delete_assign_jabatan_pegawai').val(id);
}

function responseSuccess(message) {
    $('#modalTambahAssignJabatanPegawai').modal('hide');
    $('#modalDeleteAssignJabatanPegawai').modal('hide');
    $('#id_delete_assign_jabatan_pegawai').val();
    $("#assign_jabatan_pegawai")[0].reset();
    $("#mode").val("tambah");
    toastr.success(message);
    setTimeout(function(){ table.ajax.reload(); }, 3000);   
}
function responseError() 
{
    toastr.error('Data Di Isi Dengan Baik dan Benar');
}
