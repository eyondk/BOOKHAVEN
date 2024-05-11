document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.button-delete');
    const deleteBookLink = document.getElementById('deleteBookLink');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const bookId = this.dataset.bookId;
            deleteBookLink.href = "<?=ROOT?>Books?delete=" + bookId;
        });
    });
});
