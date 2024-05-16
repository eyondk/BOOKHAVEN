function openCustomNav() {
    var customSidebar = document.getElementById("customSidebar");
    if (window.innerWidth <= 468) {
        customSidebar.style.width = "40%";
    } else {
        customSidebar.style.width = "250px";
    }
    var openBtns = document.getElementsByClassName("custom-openbtn");
    for (var i = 0; i < openBtns.length; i++) {
        openBtns[i].style.display = "none";
    }
}

function closeCustomNav() {
    document.getElementById("customSidebar").style.width = "0";
    var openBtns = document.getElementsByClassName("custom-openbtn");
    for (var i = 0; i < openBtns.length; i++) {
        openBtns[i].style.display = "block"; 
    }
}

function openNav() {
    var mySidebar = document.getElementById("mySidebar");
    if (window.innerWidth <= 468) {
        mySidebar.style.width = "40%";
    } else {
        mySidebar.style.width = "250px";
    }
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
}