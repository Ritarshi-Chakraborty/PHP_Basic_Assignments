$(document).ready(function() {
    /**
     * Handles the concatenation of the first name and last name
     * and updates the full_name input field.
     */
    function handleFullName() {
        let fullName = $('input[name="first_name"]').val() + " " + $('input[name="last_name"]').val();
        $('input[name="full_name"]').val(fullName);
    }

    /**
     * Validates the input fields for first name and last name.
     * - Filters out non-alphabetical characters.
     * - Shows/hides validation messages depending on whether the fields are empty or not.
     * - Prevents form submission if the fields are empty.
     */
    function validateInputs() {
        /**
         * Handles input event for first name and last name fields.
         * Ensures that only alphabetical characters and spaces are allowed.
         * Updates the full name field and manages validation messages.
         */
        $('input[name="first_name"], input[name="last_name"]').on('input', function () {
            let inputValue = $(this).val();
            let validInput = inputValue.replace(/[^a-zA-Z\s]/g, '');
            $(this).val(validInput);

            handleFullName();

            let fieldName = $(this).attr('name');
            if (fieldName === 'first_name') {
                $('.firstname-message').hide(!$(this).val().trim());
            } else if (fieldName === 'last_name') {
                $('.lastname-message').hide(!$(this).val().trim());
            }
        });

        /**
         * Handles paste event to prevent pasting non-alphabetical characters into the first name and last name fields.
         * 
         * @param {Event} event The paste event triggered by the user.
         */
        $('input[name="first_name"], input[name="last_name"]').on('paste', function (event) {
            let pastedData = event.originalEvent.clipboardData.getData('text');
            if (!/^[a-zA-Z\s]+$/.test(pastedData)) {
                event.preventDefault();
            }
        });

        /**
         * Validates the form upon submission. If any required fields are empty, it prevents form submission 
         * and shows the appropriate validation messages.
         * 
         * @param {Event} event The submit event triggered when the form is submitted.
         */
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
                event.preventDefault();
            }
        });
    }

    validateInputs();
})
