

$("document").ready(function(){
    $("#new_partner").on("pjax:end", function() {
        $.get('/api/get_partner_create', function ($data) {
            if($data){
                $.pjax.defaults.timeout = false;
                $.pjax.reload({container:"#partnerId"});
                $('#myModal').modal("hide");
                swal(
                    'Контрагент создан!',
                    '',
                    'success'
                )
            }
        });

    //            $("#agenda-prospect_id").select2("data", {id: results.prospect_id, text: results.prospect_nome});

    });
});

function select2() {
    alert($.session.get("partner_create"));
}