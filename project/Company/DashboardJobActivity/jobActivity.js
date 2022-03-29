$(document).ready(function() {
    $('.submit-search-btn').click(function(e){
        e.preventDefault();
        var search_keyword =  $('#search-id-nn').val();
        console.log(search_keyword);

        $.ajax({
            type: "POST",
            url: 'search.php',
            data: {search_keyword:search_keyword},
            success: function (response) {
                $('#customers').html(''); 
                $('#customers').html(response); 
            }
        });
    });

    $('.accept-nn').click(function(e){
        var job_id =  $(this).data('id')
        e.preventDefault();
        var confirm_status =  confirm("Are you sure?");

        if(confirm_status == true) {
            $.ajax({
                type: "POST",
                url: 'accept.php',
                data: {job_id:job_id},
                success: function (response) {
                    $('#customers').html(''); 
                    $('#customers').html(response);
                }
            });
        }
    });

    
    $('.reject-nn').click(function(e){
        var job_id =  $(this).data('id')
        e.preventDefault();
        var confirm_status =  confirm("Are you sure?");

        if(confirm_status == true) {
            $.ajax({
                type: "POST",
                url: 'reject.php',
                data: {job_id:job_id},
                success: function (response) {
                    $('#customers').html(''); 
                    $('#customers').html(response);
                }
            });
        }
    });

});