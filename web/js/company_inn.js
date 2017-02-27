$(document).ready(function() {

    $('#partner-inn').bind('paste', function (e) {
        console.log(e.originalEvent.clipboardData)
        console.log(e.originalEvent.clipboardData.getData('text').replace(/\s/g, ""));
        // e.originalEvent.clipboardData.setData('text', e.originalEvent.clipboardData.getData('text').replace(/\s/g, ""));

        // setTimeout(seveValue(e.originalEvent.clipboardData.getData('text')), 5000);
    });

    $('#partner-inn').keyup(function () {
        console.log(this.value);
        if (this.value>0){
            $('#btn_inn').prop('disabled', false);
        } else {
            $('#btn_inn').prop('disabled', true);
        }
    })

});

function seveValue(str) {
    $('#partner-inn').val(str.replace(/\s/g, ""));
}

function search_company() {
    console.log($('#partner-inn').val());
    var promise = dadata_request($('#partner-inn').val());
    promise
        .done(function(response) {
            console.log(response);
            if (response.suggestions.length === 0) {
                swal(
                    'Ничево не найдено!',
                    '',
                    'error'
                )
            }else {
                var party = response.suggestions[0].data;
                $('#partner-kpp').val(party.kpp);
                $("#partner-name").val(party.name.full_with_opf);
                $("#partner-business_address").val(party.address.value);
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
            swal(
                'Ничево не найдено!',
                '',
                'error'
            )
        });
};

function dadata_request(query) {
    var serviceUrl = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party",
        token = "2cd76ecb85cf7c3b31b345293fa20176d36afc81";
    var request = {
        "query": query
    };
    var params = {
        type: "POST",
        contentType: "application/json",
        headers: {
            "Authorization": "Token " + token
        },
        data: JSON.stringify(request)
    }

    return $.ajax(serviceUrl, params);
}