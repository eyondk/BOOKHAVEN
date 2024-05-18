$(document).ready(function() {
    

    function resetModal() {
       
        $("#transaction_id").val("");
        $("#title").text("");
        $("#genre").text("");
        $("#year_published").text("");
        $("#customer_id").text("");
        $("#pickup_date").text("");
        $("#return_date").text("");
        $("#price").text("");
        $("#total").text("");
        $("#amount").val("");
        $("#change").text("");

        // Reset display
        $(".transaction-details").hide();
        $("#transaction_id").show();
        $("#search_id").show();
    }

    // Event listener for the modal show event
    $('#modal-pay').on('show.bs.modal', function() {
        // Reset the modal content when the modal is shown
        resetModal();
    });

    $('#search_id').on('click', function() {
        // Get the entered transaction ID
        var transactionId = $("#transaction_id").val();
        alert(transactionId);
        $.ajax({
            url: '../app/Models/payment.php', 
            type: 'POST',
            data: { transaction_id: transactionId },
            dataType: 'json',
            success: function(data) {
               
                    
                    $("#title").text(data.book_title);
                    $("#genre").text(data.book_genre);
                    $("#year_published").text(data.book_year);
                    $("#customer_id").text(data.book_id);
                    // $("#pickup_date").text(response.pickup_date);
                    // $("#return_date").text(response.return_date);
                    // $("#price").text("P" + parseFloat(response.price).toFixed(2));
                    // $("#total").text("P" + parseFloat(response.total).toFixed(2));

                    
                    $(".transaction-details").show();

                    // Hide search input and button
                    $("#transaction_id").hide();
                    $("#search_id").hide();
                },
            error: function(xhr, status, error) {
                    alert("An error occurred: " + xhr.responseText);
                }
            
            
        
        });
    });

    $('#enter_button').on('click', function() {
        // Get the amount tendered
        var amountTendered = parseFloat($("#amount").val());

        // Check if amount tendered is empty or not a number
        if (isNaN(amountTendered) || amountTendered <= 0) {
            alert("Please enter a valid amount.");
            return; // Exit the function if amount is not valid
        }

        // Calculate change
        var total = parseFloat($("#total").text().substring(1));

        // Check if amount tendered is enough
        if (amountTendered < total) {
            alert("Amount tendered is not enough.");
            return; // Exit the function if amount is not enough
        }

        var change = amountTendered - total;

        // Display change
        $("#change").text("P" + change.toFixed(2));
    });

    // Event listener for the "Add Payment" button
    $("#modal-pay .modal-footer .btn-dark").on('click', function() {
        // Perform any actions needed here

        // Reset modal content
        resetModal();
    });

    // Event listener for the modal close event
    $('#modal-pay').on('hidden.bs.modal', function() {
        // Reset modal content when the modal is closed
        resetModal();
    });
});
