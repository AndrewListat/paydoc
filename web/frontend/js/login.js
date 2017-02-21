/**
 * Created by Listat on 21.02.2017.
 */
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).ready(function() {
    $( "#login_email" ).click(function() {
        if (isEmail($('#email').val())){
            $.post('/api/login',{email: $('#email').val()},function (data) {
                if(data){
                    swal(
                        '',
                        'Код одправлен на email!',
                        'success'
                    );
                    $('#write_email').hide();
                    $('#write_kod').show();
                }
                else
                    swal(
                        '',
                        'Email не найдено!',
                        'error'
                    )
            });
        } else {
            swal(
                '',
                'Неверно заполнено поле email!',
                'error'
            )
        }
    });

    $( "#login_kod" ).click(function(){
        if($( "#kod" ).val()){
            $.post('/api/login_kod',{email: $('#email').val(), kod: $('#kod').val() },function (data) {
                console.log('login',data);
                if(data){
                    window.location.reload(false);
                } else {
                    swal(
                        '',
                        'Koд не знайдено!',
                        'error'
                    )
                }
            });
        }else{
            swal(
                '',
                'Koд не введено!',
                'error'
            )
        }
    });
});