$(document).ready(function() {

    // Validating the Firstname & Lastname inputs
    function validateNumber() {
        let input = $('input[name="number"]');
        let message = $('.message-box p');

        function checkNumber(number) {
            console.log(/^[6-9]\d{9}$/.test(number));
            return /^[6-9]\d{9}$/.test(number);
        }
        // Handling the input and the message when the user starts typing
        input.on('input', function () {
            let number = $(this).val().replace(/[^0-9]/g, '').slice(0, 10);
            $(this).val(number);
            message.hide();
        });
        // Handling the input and the message when the user pastes something on the input field
        input.on('paste', function () {
            let inputEl = $(this);
                let number = $(this).val().replace(/[^0-9]/g, '').slice(0, 10);
                inputEl.val(number);
                message.hide()
        });

        $('form').on('submit', function(e) {
            let number = input.val();
            if (!checkNumber(number)) {
                e.preventDefault();
                message.show();
            }
        });
    }

    validateNumber();
})
