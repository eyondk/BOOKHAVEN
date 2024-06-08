function getDayOfWeek() {
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const date = new Date();
    const dayIndex = date.getDay();
    return days[dayIndex];
}
var dt = new Date();

document.getElementById("day").innerHTML = getDayOfWeek();
document.getElementById("date").innerHTML = dt.toLocaleDateString();
document.getElementById("time").innerHTML = dt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

function showModal(targetModal) {
    var userModal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
    userModal.hide();
    var target = new bootstrap.Modal(document.querySelector(targetModal));
    target.show();
}

document.getElementById('view-profile').addEventListener('hidden.bs.modal', function () {
    reopenUserModal();
});

document.getElementById('change-password').addEventListener('hidden.bs.modal', function () {
    reopenUserModal();
});

function reopenUserModal() {
    var userModal = new bootstrap.Modal(document.getElementById('userModal'));
    userModal.show();
}