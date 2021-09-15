function ajaxPost(type, url, data) {
    var json = {};
    $.ajax({
        async: false,
        global: false,
        url: base_url + url,
        type: type,
        data: data,
        beforeSend : function(xhr) {
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
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
          xhr.setRequestHeader('Authorization','b1ca0f1aa805a4327f56c0fb53f4bf180655d0121c59116a0c0a7b72df68e24579389798f1b7bd811f6d801b7be038554cc2cfc27cd583ce48dcebf204fbb3e707d4f85a9a6000e7f0b544ebeeb2f16a');
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