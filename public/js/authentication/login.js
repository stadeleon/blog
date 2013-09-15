/**
 * Created by Mrakobes on 15.09.13.
 */

$(function() {
    $("#login-form").submit(function(){
        $.getJSON('/authentication/auth',
            {
                username: $('#username').val(),
                password: $('#password').val()
            },
            function(data) {
                if (data.result) {
                   alert(data.message);
                   location.href = '/';
                }else{
                    alert(data.message);
                }
            }
        );
        return false;
    });
});
