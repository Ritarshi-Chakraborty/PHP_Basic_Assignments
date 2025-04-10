$(document).ready(function() {
    // handling the Fullname input
    function handleFullName() {
        let fullName = $('input[name="first_name"]').val() + " " + $('input[name="last_name"]').val();
        $('input[name="full_name"]').val(fullName);
    }

    // Validating input fields
    function validateInputs() {
        $('input[name="first_name"], input[name="last_name"]').on('input', function () {
            let inputValue = $(this).val();
            let validInput = inputValue.replace(/[^a-zA-Z\s]/g, '');
            $(this).val(validInput);

            handleFullName();

            // Hide the message once the user starts typing
            let fieldName = $(this).attr('name');
            if (fieldName === 'first_name') {
                $('.firstname-message').toggle(!$(this).val().trim());
            } else if (fieldName === 'last_name') {
                $('.lastname-message').toggle(!$(this).val().trim());
            }
        });

        $('input[name="first_name"], input[name="last_name"]').on('paste', function (event) {
            let pastedData = event.originalEvent.clipboardData.getData('text');
            if (!/^[a-zA-Z\s]+$/.test(pastedData)) {
                event.preventDefault();
            }
        });

        $('form').on('submit', function (event) {
            let first_name = $('input[name="first_name"]').val().trim();
            let last_name = $('input[name="last_name"]').val().trim();

            let valid = true;

            if (!first_name) {
                $('.firstname-message').show();
                valid = false;
            } else {
                $('.firstname-message').hide();
            }

            if (!last_name) {
                $('.lastname-message').show();
                valid = false;
            } else {
                $('.lastname-message').hide();
            }

            if (!valid) {
                // Stop form submission
                event.preventDefault();
            }
        });
    }

    validateInputs();
})
