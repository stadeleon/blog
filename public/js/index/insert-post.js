/**
 * Created by Mrakobes on 15.09.13.
 */
$(function() {
    $("#insert-post").submit(function(){
        $.getJSON('/index/insert-post',
            {
                cat_id: $('#cat_id').val(),
                title: $('#title').val(),
                url: $('#url').val(),
                blog_post: $('#blog_post').val()
            },
            function(data) {
                if (data.result) {
                    alert('Post ' + data.insertId + ' ' + data.message);
                    location.href = '/index/post/id/'+data.insertId+'new/1';
                }else{
                    alert(data.message);
                }
            }
        );
        return false;
    });
});