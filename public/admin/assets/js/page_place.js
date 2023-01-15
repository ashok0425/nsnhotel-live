$(document).on("click", ".place_delete", function () {
    if (confirm('Are you sure? The place that deleted can not restore!'))
        $(this).parent().submit();
});

$(document).on("change", ".place_status", function () {
    let place_id = $(this).attr('data-id');
    let status = $(this).is(':checked');
    updateStatusPlace(place_id, status);
});

$(document).on("click", ".place_approve", function () {
    let place_id = $(this).attr('data-id');
    if (confirm('Are you sure?')) {
        updateStatusPlace(place_id, 1);
        location.reload();
    }
});

function updateStatusPlace(place_id, status) {
    let data_resp = callAPI({
        url: getUrlAPI('/places/status', 'api'),
        method: "put",
        body: {
            "place_id": place_id,
            "status": status
        }
    });
    data_resp.then(res => {
        if (res.code === 200) {
            notify(res.message);
        } else {
            console.log(res);
            notify('Error!', 'error');
        }
    });
}

 function fetch_data(query,page)
 {
  $.ajax({
       url:"custom-search?page="+page+"&query="+query,
       success:function(data)
       {
        $('tbody').html(data);
       }
      });
 }
 
  $(document).on('keyup', '#serach', function(){
        var query = $('#serach').val();
        var page = $('#hidden_page').val();
        fetch_data(query,page);
 });
 
   $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var query = $('#serach').val();
        $('li').removeClass('active');
        $(this).parent().addClass('active');
        fetch_data(query,page);
   });


