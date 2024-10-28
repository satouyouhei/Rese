document.addEventListener("DOMContentLoaded", function () {

    function confirmReservation() {
        return confirm('本当に予約しますか？');
    }

    let reservationButton = document.querySelector('.reservation__button-btn');
    if (reservationButton) {
        reservationButton.addEventListener('click', function (event) {
            if (!confirmReservation()) {
                event.preventDefault();
            }
        });
    };

    function confirmCancel() {
        return confirm('本当に予約をキャンセルしますか？');
    }

    let cancelButtons = document.querySelectorAll('.form__button--cancel');
    cancelButtons.forEach(function (cancelButton) {
        cancelButton.addEventListener('click', function (event) {
            if (!confirmCancel()) {
                event.preventDefault();
            }
        });
    })

    function confirmEdit() {
        return confirm('予約内容を変更しますか？');
    }

    let editButtons = document.querySelectorAll('.form__button--edit');
    editButtons.forEach(function (editButton) {
        editButton.addEventListener('click', function (event) {
            if (!confirmEdit()) {
                event.preventDefault();
            }
        });
    })

    function confirmUpdate() {
        return confirm('予約を更新しますか？');
    }

    let updateButtons = document.querySelectorAll('.update__button');
        updateButtons.forEach(function (updateButtons) {
        updateButtons.addEventListener('click', function (event) {
            if (!confirmUpdate()) {
                event.preventDefault();
            }
        });
    })

    function confirmDelete() {
        return confirm('本当に予約をキャンセルしますか？');
    }

    let deleteButtons = document.querySelectorAll('.delete__button');
        deleteButtons.forEach(function (deleteButtons) {
        deleteButtons.addEventListener('click', function (event) {
            if (!confirmDelete()) {
                event.preventDefault();
            }
        });
    })
});