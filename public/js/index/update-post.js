/**
 * Created by Mrakobes on 15.09.13.
 */
$(function() {
    $("#update-post").submit(function(){
        $.getJSON('/index/update-post',
            {
                id: $('#id').val(),
                cat_id: $('#cat_id').val(),
                post_title: $('#post_title').val(),
                url: $('#url').val(),
                date: $('#date').val(),
                blog_post: $('#blog_post').val()
            },
            function(data) {
//                alert (data.result);
                hackDiv = $('<div />',
                    {'class' : "error",
                        id     : "hack",
                        style  : "display:block",
                        text   : "ERROR! Hacking attempt!"
                    });

                no_idDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_id",
                        style  : "display:block",
                        text   : "ERROR! There is no post id specified"
                    });

                no_int_idDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_int_id",
                        style  : "display:block",
                        text   : "ERROR! post id must be numeric"
                    });

                no_cat_idDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_cat_id",
                        style  : "display:block",
                        text   : "ERROR! There is no category id specified"
                    });

                no_int_cat_idDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_int_cat_id",
                        style  : "display:block",
                        text   : "ERROR! category id must be numeric"
                    });

                no_post_titleDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_post_title",
                        style  : "display:block",
                        text   : "Title is Required! There is no title specified"
                    });


                no_dateDiv = $('<div />',
                    {'class' : "error",
                        id     : "no_date",
                        style  : "display:block",
                        text   : "Date is Required! There is no date specified"
                    });
                if (data.result) {
                    //alert('Post ' + data.status + data.message);
                }else{
                    for(var key in data){
                        if ((key != 'result') && (key != 'error') && (key != 'message')){
                            eval(key+'Div'+".insertBefore('#' + data[key])");
/*
                            // eval(key+'Div'+".insertAfter('#post_title')"); // на память
                            // no_post_titleDiv.insertAfter('#post_title');  //работает
                            //--------------------------------------------------------
                            a = $("<div/>", {                       // работает
                                text: "Нажми на меня!"
                                }
                            );
                            a.insertAfter('#post_title');
                            //--------------------------------------------------------
                            a = $('<div id="one-and-half">Полтора</div>');  //работает
                            a.insertAfter('#post_title');
                            //--------------------------------------------------------
*/

                          // list = (key + ".insertBefore('#'" + data[key] + ")");
                          //  $('#' + key).show();

                        }
                    }
                }
            }
        );
        return false;
    });
});