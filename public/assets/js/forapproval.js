$().ready(function() {
    $('#cancel-form').on('submit', function(event) {
        var result = window.confirm("Are you sure to cancel this reservation?");
        if (result) {
            $.ajax({
                type: "POST",
                url: "Forapproval",
                data: { index: true },
                success: function(response) {
                    console.log(data);
                    // alert(response); // Show response message
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        }
    });
   
});