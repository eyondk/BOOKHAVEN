$().ready(function () {
    $(".total-class").hide();

    function setMinimumDate() {
        let today = new Date().toISOString().split('T')[0];
        $('#pickup-date, #return-date').attr('min', today);
    }

    setMinimumDate();
    setInterval(setMinimumDate, 86400000);

    $('#calc_total').click(function() {
        var pickupdate = $("#pickup-date").val();
        var returndate = $("#return-date").val();
        var b_price = $("#b_pr").val();

        var result = window.confirm("Are you sure? \nPick-up Date: " + pickupdate + "\nReturn Date: " + returndate);
        if (result) {
            var days_borrowed = calculateTotal(pickupdate, returndate);

            var total = (days_borrowed * b_price).toFixed(2);
            $("#total").val(total);

            $("#pickup-date").prop('readonly', true);
            $("#return-date").prop('readonly', true);

            $(".total-class").show();
            $("#calc_total").hide();
        } else {
            $("#pickup-date").val('');
            $("#return-date").val('');
        }
    });

    $('#cancel').click(function () {
        $(".total-class").hide();
        $("#calc_total").show();

        $("#pickup-date").prop('readonly', false);
        $("#return-date").prop('readonly', false);

        $("#pickup-date").val('');
        $("#return-date").val('');
    });

    $('#rent-form').on('submit', function(event) {
        $(".total-class").show();
        $("#calc_total").hide();

        $("#total").prop('disabled', false);
        $("#pickup-date").prop('readonly', true);
        $("#return-date").prop('readonly', true);
    });

    function calculateTotal(pickup, returnDate) {
        var pickDate = new Date(pickup);
        var retDate = new Date(returnDate);
        var timeDiff = Math.abs(retDate - pickDate);
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        return diffDays;
    }
});
