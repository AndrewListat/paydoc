

$("document").ready(function(){
    $("#new_partner").on("pjax:end", function() {
               $.pjax.defaults.timeout = false;
               $.pjax.reload({container:"#partnerId"});

        // $.get('/api/get_partner_create', function () {
        //     $("#partnerId").select2("data", {id: 1, text: 'sdsd'});
        // });
        $('#myModal').modal("hide");
    //            $("#agenda-prospect_id").select2("data", {id: results.prospect_id, text: results.prospect_nome});
        swal(
                  'Контрагент создан!',
                  '',
                  'success'
        )
    });
});

function select2() {
    alert($.session.get("partner_create"));
}