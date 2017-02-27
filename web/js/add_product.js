/**
 * Created by Listat on 20.02.2017.
 */
$(document).ready(function() {
    /*$(".select-on-check-all").click(function () {
        console.log(this.checked);
        if(this.checked)
            $('#delete_prod').show();
        else
            $('#delete_prod').hide();
        })*/

});

function show_delete_bt() {
    console.log('1')
}

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

function delete_products() {
    var delete_p = false;
    $('.checkboxes').each(function() {
        if(this.checked){
            $.post( "/api/delete_product",{ id:$(this).val() });
            delete_p=true;
        }
    });

    if (delete_p){
        $.pjax.defaults.timeout = false;
        $.pjax.reload({container:"#productItems"});
    }
}

function add_product_up(id, doc_id) {
    $.post( "/api/add_product_up",{ id:id, count: $('#count-'+id).val(), doc_id:doc_id , price: $('#price-'+id).val() }, function( data ) {
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