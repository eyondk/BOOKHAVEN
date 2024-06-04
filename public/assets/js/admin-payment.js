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


        $(".transaction-details").hide();
        $("#transaction_id").show();
        $("#search_id").show();
    }

    $('#modal-pay').on('show.bs.modal', function() {
 
        resetModal();
    });

    $('#search_id').on('click', function() {
    //    alert('jaha');
        var transactionId = $("#transaction_id").val();
        alert(transactionId);
        $.ajax({
            url: '../app/Models/payments.php',  
            type: 'POST',
            data: { transaction_id: transactionId, action: 'getPayment' },
            dataType: 'json',
            success: function(data) {
                    
                    
                    $("#title").text(data.B_TITLE);
                    $("#author").text(data.B_AUTHOR);
                    $("#genre").text(data.B_GENRE);
                    $("#year_published").text(data.B_YR_PUB);
                  ;
                    $("#cus_id").text(data.CUS_ID);
                    $("#pickup_date").text(data.R_PICKUP_DATE);
                    $("#return_date").text(data.R_RETURN_DATE);
                    $("#price").text("P" + parseFloat(data.B_PRICE).toFixed(2));
                    $("#total").text("P" + parseFloat(data.R_TOTAL).toFixed(2));

                    
                    $(".transaction-details").show();

                  
                    $("#transaction_id").hide();
                    $("#search_id").hide();
                },
            error: function(xhr, status, error) {
                    console.log("An error occurred: " + xhr.responseText);
                }
            
            
        
        });
    });

    $('#enter_button').on('click', function() {
    
        var amountTendered = parseFloat($("#amount").val());


        if (isNaN(amountTendered) || amountTendered <= 0) {
            alert("Please enter a valid amount.");
            return; 
        }


        var total = parseFloat($("#total").text().substring(1));


        if (amountTendered < total) {
            alert("Amount tendered is not enough.");
            return; 
        }

        var change = amountTendered - total;


        $("#change").text("P" + change.toFixed(2));
    });

 
    $("#addPay").on('click', function() {
        

        var transactionId = $("#transaction_id").val();
        var customerId = $("#cus_id").text();
        var amountTendered = $("#amount").val();
        var amountToBePaid = parseFloat($("#total").text().substring(1));
        $.ajax({
            url: '../app/models/payments.php',
            type: 'POST',
            data: { 
                transaction_id: transactionId, 
                customer_id: customerId,
                amount_tendered: amountTendered, 
                amount_to_be_paid: amountToBePaid,
                action: 'addPayment'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert("SUCCUES");
                    
                } else {
                     alert("Error: " + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.log("An error occurred: " + xhr.responseText);
            }
        });


    });


    $('#modal-pay').on('hidden.bs.modal', function() {

        resetModal();
    });
});