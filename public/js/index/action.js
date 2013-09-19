$(function() {

});

function deletePost(id) {
    if (confirm('Are you sure you want to delete post №' + id)){
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
}