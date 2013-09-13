$(function() {

});

function deletePost(id) {
    $.getJSON('/index/delete-post',
          {id: id},
          function(data) {
              if (data.result) {
                  $('#' + id).remove();
                  alert ('Post № ' + id + 'deleted Successfully!');
              }
          }
    );
}