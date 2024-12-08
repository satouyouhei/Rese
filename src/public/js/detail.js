document.addEventListener("DOMContentLoaded", function () {
    let dateInput = document.querySelector('input[name="date"]');
    let timeSelect = document.querySelector('select[name="time"]');
    let numberSelect = document.querySelector('select[name="number"]');

    let dateId = document.getElementById('dateId');
    let timeId = document.getElementById('timeId');
    let numberId = document.getElementById('numberId');

    dateInput.addEventListener('change', function () {
        dateId.textContent = dateInput.value;
    });

    timeSelect.addEventListener('change', function () {
        timeId.textContent = timeSelect.options[timeSelect.selectedIndex].text;
    });

    numberSelect.addEventListener('change', function () {
        numberId.textContent = numberSelect.options[numberSelect.selectedIndex].text;
    });
})


document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll('.rating__star');

    stars.forEach(star => {
    const rate = parseFloat(star.getAttribute('data-rate'));
    const width = Math.floor((rate / 5) * 100);
    star.style.setProperty('--star-width', `${width}%`);
    });
});


window.onload = function () {
    var today = new Date().toISOString().split("T")[0];
    document.getElementById("datePicker").setAttribute("min", today);
};
