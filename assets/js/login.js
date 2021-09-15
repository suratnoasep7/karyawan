$(document).ready(function() {
    $('#btn-login').click(function() {
        var $form = $("#login");
        var dataLogin = getDataForm($form);
        if(dataLogin.nomor == "" || dataLogin.password == "") {
            toastr.error('Isi Data Dengan Baik Dan Benar');
        }
        var login =  ajaxPost("POST","api/auth/login",dataLogin);
        if(login.status) {
            toastr.success(login.message);
            window.location.href = base_url + login.data;
        } else {
            toastr.error(login.message);
        }
    });
});

function ajaxPost(type, url, data) {
    var json = {};
    $.ajax({
        async: false,
        global: false,
        url: base_url + url,
        type: type,
        data: data,
        complete: function (e) {
            if (e.status == 200) {
                json = JSON.parse(e.responseText);
            } else {
                json = JSON.parse(e.responseText);
            }
        }
    });
    return json;
}

function getDataForm($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}