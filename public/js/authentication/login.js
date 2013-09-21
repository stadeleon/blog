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
                $('#wrong_password').hide();
                $('#no_username').hide();
                $('#no_password').hide();
                wrong_passwordDiv = $('<div />',
                    {'class' : "error",
                        id     : "wrong_password",
                        style  : "display:none",
                        text   : "Username or password is wrong!"
                    });

                no_usernameDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_username",
                        style  : "display:none",
                        text   : "Username Required!"
                    });

                no_passwordDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_password",
                        style  : "display:none",
                        text   : "Password Required!"
                    });

                if (data.result) {
                   alert(data.message);
                   location.href = '/';
                }else{
                    alert('there are some errors');
                    for(var key in data){
                        if ((key != 'result') && (key != 'error') && (key != 'wrong_password')){
                            eval(key + 'Div' + ".insertAfter('#' + data[key])");
                            $('#' + key).show();
                        } else if (key == 'wrong_password'){
                            eval(key + 'Div' + ".insertBefore('#' + data[key])");
                            $('#' + key).show();
                    //alert(data.message);
                        }
                    }
                }
            }
        );
        return false;
    });
});
