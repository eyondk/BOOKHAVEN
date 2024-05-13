$(document).ready(function() {
    $('.button-update').on('click',function() {

       $('#editmodal').modal('show');
       $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

                console.log(data);

                $('#update_cover').val(data[0]);
                $('#update_id').val(data[1]);
                $('#update_title').val(data[2]);
                $('#update_genre').val(data[3]);
                $('#update_year').val(data[4]);
                $('#update_description').val(data[5]);
                $('#update_price').val(data[6]);
                

    });

    $('.button-delete').on('click',function() {

        $('#modal-delete').modal('show');
        $tr = $(this).closest('tr');
 
         var data = $tr.children("td").map(function () {
             return $(this).text();
         }).get();
 
                 console.log(data);
 
               
                 $('#delete_id').val(data[1]);
                
 
     });
});