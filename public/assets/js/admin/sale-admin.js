document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll(".clickable-row");
    rows.forEach(row => {
        row.addEventListener("click", function () {
            const href = this.dataset.href;
            if (href) {
                window.location.href = href;
            }
        });
    });
});
