$(document).ready(function() {

    $('#partner-inn').on('paste', function (e) {
        console.log(e.originalEvent.clipboardData)
        console.log(e.originalEvent.clipboardData.getData('text').replace(/\s/g, ""));
        // e.originalEvent.clipboardData.setData('text', e.originalEvent.clipboardData.getData('text').replace(/\s/g, ""));

        // setTimeout(seveValue(e.originalEvent.clipboardData.getData('text')), 5000);
        $('#btn_inn').prop('disabled', false);
        var $this = $(this);
        setTimeout(function () {
            $this.val($this.val().replace(/[^0-9]/g, ''));
            var promise = dadata_request($this.val());
            promise
                .done(function(response) {
                    console.log(response);
                    if (response.suggestions.length === 0) {
                        swal(
                            'По данному ИНН информации, не найдено!',
                            '',
                            'error'
                        )
                    }else {
                        var party = response.suggestions[0].data;
                        $('#partner-kpp').val(party.kpp);
                        $("#partner-name").val(party.name.full_with_opf);
                        $("#partner-business_address").val(party.address.value);
                        $("#partner-mail_address").val(party.address.value);
                    }

                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                    swal(
                        'По данному ИНН информации, не найдено!!',
                        '',
                        'error'
                    )
                });
        }, 5);
    });

    $('#partner-bik').on('paste', function (e) {
        console.log(e.originalEvent.clipboardData)
        console.log(e.originalEvent.clipboardData.getData('text').replace(/\s/g, ""));
        var $this = $(this);
        setTimeout(function () {
            $this.val($this.val().replace(/[^0-9]/g, ''));
            if($this.val()){
                $.post('/api/get_bank',{bik: $this.val()},function (res) {
                    if (res.status){
                        $('#ks').text(res.results.kor_rah);
                        $('#name_bank').text(res.results.name_bank);
                    }
                })
            }
        }, 5);
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
    var promise = dadata_request($('#partner-inn').val());
    promise
        .done(function(response) {
            console.log(response);
            if (response.suggestions.length === 0) {
                swal(
                    'По данному ИНН информации, не найдено!',
                    '',
                    'error'
                )
            }else {
                var party = response.suggestions[0].data;
                $('#partner-kpp').val(party.kpp);
                $("#partner-name").val(party.name.full_with_opf);
                $("#partner-business_address").val(party.address.value);
                $("#partner-mail_address").val(party.address.value);
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
            swal(
                'По данному ИНН информации, не найдено!!',
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