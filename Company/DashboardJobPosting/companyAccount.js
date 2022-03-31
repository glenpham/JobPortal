$(document).ready(function() {

    $('.delete-anchor-nn').click(function(e){
        var job_id =  $(this).data('id')
        e.preventDefault();
        var confirm_status =  confirm("Are you sure?");

        if(confirm_status == true) {
            $.ajax({
                type: "POST",
                url: 'delete.php',
                data: {job_id:job_id},
                success: function (response) {
                    $('#myTable').html(''); 
                    $('#myTable').html(response);
                }
            });
        }
    });


    $('.submit-search-btn').click(function(e){
        e.preventDefault();
        var search_keyword =  $('#search-id-nn').val();
        console.log(search_keyword);

        $.ajax({
            type: "POST",
            url: 'search.php',
            data: {search_keyword:search_keyword},
            success: function (response) {
                $('#myTable').html(''); 
                $('#myTable').html(response); 
            }
        });
    });
});