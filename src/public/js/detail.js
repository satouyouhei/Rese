document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll('.rating__star');

    stars.forEach(star => {
    const rate = parseFloat(star.getAttribute('data-rate'));
    const width = Math.floor((rate / 5) * 100);
    star.style.setProperty('--star-width', `${width}%`);
    });
});