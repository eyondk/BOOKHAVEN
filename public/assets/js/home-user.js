const container = document.querySelectorAll('.container');
const prebtn = document.querySelectorAll('.pre-btn');
const nxtbtn = document.querySelectorAll('.nxt-btn');

container.forEach((item, i)=> {
    const containerDimensions = item.getBoundingClientRect();
    const containerWidth = containerDimensions.width;

    nxtbtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth - 200;
    })

    prebtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth + 200;
    })

});


// document.querySelector('.search-section form').addEventListener('submit', function(event) {
//     event.preventDefault();

//     // Hide genre sections
//     document.querySelectorAll('.cat1, .cat2, .cat3').forEach(function(section) {
//         section.style.display = 'none';
//     });

//     // Perform the search and display results (you may need to use AJAX here)
//     const searchKeyword = document.querySelector('input[name="search"]').value;

//     fetch('<?= ROOT ?>/home/index', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: new URLSearchParams({
//             'search': searchKeyword
//         })
//     })
//     .then(response => response.text())
//     .then(html => {
//         document.body.innerHTML = html;
//     })
//     .catch(error => console.error('Error:', error));
// });