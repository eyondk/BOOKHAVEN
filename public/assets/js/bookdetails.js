function toggleWantToRead(event) {
    event.preventDefault();
    var button = event.target.closest('.button-want-to-read');
    if (button.classList.contains('clicked')) {
        button.innerHTML = '<i class="fas fa-bookmark"></i> Add to library';
    } else {
        button.innerHTML = '<i class="fas fa-check"></i> Added to library';
    }
    button.classList.toggle('clicked');
}

function toggleRentNow(event) {
    event.preventDefault();
    var button = event.target.closest('.rent-now');
    if (button.classList.contains('clicked')) {
        button.innerHTML = '<i class="fas fa-money-check-dollar"></i> Rent Now';
    } else {
        button.innerHTML = '<i class="fas fa-check"></i> Rented';
    }
    button.classList.toggle('clicked');
}


function showMore() {
    var paragraph = document.getElementById("paragraph");
    paragraph.innerHTML = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et metus ac dolor commodo viverra eget eget arcu. Ut augue tortor, tempor vitae facilisis at, semper vel augue. Suspendisse dictum interdum ligula, in malesuada dui mattis quis. Suspendisse quis dignissim metus. Proin ut gravida nulla. Phasellus faucibus bibendum neque nec tincidunt. Donec enim felis, pulvinar eu pretium nec, pellentesque sed massa. Cras pellentesque, tellus eu ultricies vehicula, ante turpis dictum magna, a porta enim erat a lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi aliquet rutrum risus. Aenean tempor nibh a mi consequat, quis semper dui iaculis. Sed interdum dolor nec ex maximus blandit. Pellentesque malesuada eros mattis porttitor accumsan. Mauris non dapibus mauris. Curabitur eu aliquet massa. Nulla et tristique eros. Praesent gravida cursus ligula, eu dignissim dolor rhoncus sit amet. Morbi pellentesque pretium mi, eget accumsan mi iaculis sit amet. Donec pharetra metus sed velit sagittis aliquam. Praesent ac tempus dolor, quis bibendum sapien. Maecenas placerat, leo in feugiat sollicitudin, metus lacus pulvinar turpis, vel iaculis ex dui at dui. Vestibulum ut mollis purus, a ornare nisi. Mauris lorem neque, eleifend vel vulputate in, ultrices vitae mi. Nunc nec diam a libero ullamcorper maximus eu eu elit. Donec at lectus ac felis tincidunt bibendum posuere quis nisl. Cras egestas ligula urna, a pretium sapien egestas ut. Ut sit amet orci eget purus cursus interdum quis quis turpis. Quisque nec sem ut metus lacinia convallis id a est. Cras a felis ut turpis semper pellentesque. Integer at turpis efficitur, gravida sapien a, venenatis metus. Morbi quis hendrerit justo, nec mattis sapien. Cras commodo, mauris non euismod commodo, diam odio pulvinar sem, ac feugiat est turpis eu est. Aliquam felis lorem, fringilla eu sagittis at, efficitur a magna. Donec molestie mattis lectus, nec maximus nisi commodo vel. Aliquam leo mi, luctus pharetra convallis ac, scelerisque ac erat.";
    
    var readmoreBtn = document.querySelector(".readmore-btn");
    var readlessBtn = document.querySelector(".readless-btn");


    
    if (readmoreBtn) {
        readmoreBtn.style.display = "none";
        readlessBtn.style.display = "flex";
    } else {
        readmoreBtn.style.display = "flex";
    }

}

function showLess() {
    var paragraph = document.getElementById("paragraph");
    paragraph.innerHTML = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et metus ac dolor commodo viverra eget eget arcu. Ut augue tortor, tempor vitae facilisis at, semper vel augue. Suspendisse dictum interdum ligula, in malesuada dui mattis quis. Suspendisse quis dignissim metus. Proin ut gravida nulla. Phasellus faucibus bibendum neque nec tincidunt. Donec enim felis, pulvinar eu pretium nec, pellentesque sed massa. Cras pellentesque, tellus eu ultricies vehicula, ante turpis dictum magna, a porta enim erat a lorem.";
    
    var readmoreBtn = document.querySelector(".readmore-btn");
    var readlessBtn = document.querySelector(".readless-btn");
    var gradient = document.querySelector(".gradient");

    if (readlessBtn) {
        readmoreBtn.style.display = "flex";
        readlessBtn.style.display = "none";
    } else {
        readlessBtn.style.display = "flex";
    }
}