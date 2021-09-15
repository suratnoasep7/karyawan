function ajaxPost(type, url, data) {
    var json = {};
    $.ajax({
        async: false,
        global: false,
        url: base_url + url,
        type: type,
        data: data,
        beforeSend : function(xhr) {
          xhr.setRequestHeader('Authorization',access_token);
        },
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
function ajaxGet(type, url) {
    var json = {};
    $.ajax({
        async: false,
        global: false,
        url: base_url + url,
        type: type,
        beforeSend : function(xhr) {
          xhr.setRequestHeader('Authorization',access_token);
        },
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