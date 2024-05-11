// Function to reset the modal content
function resetModal() {
    // Reset input fields
    document.getElementById("transaction_id").value = "";
    document.getElementById("title").textContent = "";
    document.getElementById("genre").textContent = "";
    document.getElementById("year_published").textContent = "";
    document.getElementById("customer_id").textContent = "";
    document.getElementById("pickup_date").textContent = "";
    document.getElementById("return_date").textContent = "";
    document.getElementById("price").textContent = "";
    document.getElementById("total").textContent = "";
    document.getElementById("amount").value = "";
    document.getElementById("change").textContent = "";

    // Reset display
    document.querySelector(".transaction-details").style.display = "none";
    document.getElementById("transaction_id").style.display = "block";
    document.getElementById("search_id").style.display = "block";
}

// Event listener for the modal show event
document.getElementById("modal-pay").addEventListener("show.bs.modal", function () {
    // Reset the modal content when the modal is shown
    resetModal();
});

document.getElementById("search_id").addEventListener("click", function() {
    // Get the entered transaction ID
    var transactionId = document.getElementById("transaction_id").value;

    // Check if the entered transaction ID matches the sample ID
    if (transactionId === "ABC123456") {
        // Sample transaction details
        var transactionDetails = {
            title: "Harry Potter and the Philosopher's Stone",
            genre: "Fantasy",
            year_published: "1997",
            customer_id: "123456789",
            pickup_date: "2024-05-10",
            return_date: "2024-05-15",
            price: 10.00,
            total: 12.00
        };

        // Display transaction details
        document.getElementById("title").textContent = transactionDetails.title;
        document.getElementById("genre").textContent = transactionDetails.genre;
        document.getElementById("year_published").textContent = transactionDetails.year_published;
        document.getElementById("customer_id").textContent = transactionDetails.customer_id;
        document.getElementById("pickup_date").textContent = transactionDetails.pickup_date;
        document.getElementById("return_date").textContent = transactionDetails.return_date;
        document.getElementById("price").textContent = "P" + transactionDetails.price.toFixed(2);
        document.getElementById("total").textContent = "P" + transactionDetails.total.toFixed(2);

        // Show transaction details section
        document.querySelector(".transaction-details").style.display = "block";

        // Hide search input and button
        document.getElementById("transaction_id").style.display = "none";
        document.getElementById("search_id").style.display = "none";
    } else {
        // Handle case when transaction ID is not found
        alert("Transaction ID not found. Please enter a valid ID.");
    }
});

document.getElementById("enter_button").addEventListener("click", function() {
 // Get the amount tendered
 var amountTendered = parseFloat(document.getElementById("amount").value);

// Check if amount tendered is empty or not a number
if (isNaN(amountTendered) || amountTendered <= 0) {
alert("Please enter a valid amount.");
return; // Exit the function if amount is not valid
}

 // Calculate change
 var total = parseFloat(document.getElementById("total").textContent.substring(1));

// Check if amount tendered is enough
if (amountTendered < total) {
alert("Amount tendered is not enough.");
return; // Exit the function if amount is not enough
}

 var change = amountTendered - total;

 // Display change
 document.getElementById("change").textContent = "$" + change.toFixed(2);
});

// Event listener for the "Add Payment" button
document.querySelector("#modal-pay .modal-footer .btn-dark").addEventListener("click", function() {
    // Perform any actions needed here

    // Reset modal content
    resetModal();
});

// Event listener for the modal close event
document.getElementById("modal-pay").addEventListener("hidden.bs.modal", function () {
    // Reset modal content when the modal is closed
    resetModal();
});


