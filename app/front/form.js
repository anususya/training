function handle_form_submission()
{
    const name = document.getElementById('name')
    var fd = new FormData();
    fd.append('search', name.value)
    fd.append('array', $('#sorted_array')[0].innerHTML)

    $.ajax({
        url: '/search/index/search',
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data){
            alert(data);
        }
    });
    return false;
}