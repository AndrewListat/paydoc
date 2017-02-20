/**
 * Created by Listat on 20.02.2017.
 */
$(document).ready(function() {

});

function add_product(id) {
    $.post( "/api/add_product",{ id:id, count: $('#count-'+id).val() }, function( data ) {
        console.log(data);
        if (data){
            $.pjax.defaults.timeout = false;
            $.pjax.reload({container:"#productItems"});
            swal(
                'Товар добавлен!',
                '',
                'success'
            )
        }
    });
}
function delete_product(id) {
    $.post( "/api/delete_product",{ id:id }, function( data ) {
        console.log(data);
        if (data){
            $.pjax.defaults.timeout = false;
            $.pjax.reload({container:"#productItems"});
        }
    });
}