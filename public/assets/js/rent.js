$(document).ready(function() {
    $('.update-status').change(function() {
        var reservationId = $(this).data('rid');
        var status = $(this).val();
        console.log("Reservation ID:", reservationId);
        console.log("Status:", status);
        $.ajax({
            url: '../app/Models/rent.php',
            type: 'POST',
            data: { r_id: reservationId, status: status },
            success: function(response) {
                if (response.success) {
                    alert('Status updated successfully!');
                    location.reload();
                } else {
                    console.log(response);
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log("An error occurred: " + xhr.responseText);
            }
        });
    });
});
