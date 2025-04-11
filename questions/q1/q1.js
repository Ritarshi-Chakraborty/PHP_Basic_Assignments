$(document).ready(function () {
    /**
     * Handle the login form behavior including input validation.
     *
     * This function listens for input events on the username and password fields.
     * It clears the validation messages when the user starts typing and validates
     * the form on submission.
     */
    function handleLoginForm() {
        /**
         * Event listener for input fields to hide the validation messages
         * when the user starts typing.
         * 
         * @param {Event} event The input event triggered on the form fields
         */
        $('input[name="username"], input[name="password"]').on('input', function () {
            let fieldName = $(this).attr('name');
            
            /**
             * When the username field is being edited and the input is not empty, remove the validation message
             */
            if (fieldName === 'username') {
                if ($(this).val().trim()) {
                    $('.username-message').text('').removeClass('show-message');
                }
            } 
            /**
             * When the password field is being edited and the input is not empty, remove the validation message
             */
            else if (fieldName === 'password') {
                if ($(this).val().trim()) {
                    $('.password-message').text('').removeClass('show-message');
                }
            }
        });

        /**
         * Event listener for form submission.
         * Validates the username and password fields before allowing form submission.
         * 
         * @param {Event} event The form submit event
         */
        $('form').on('submit', function (event) {
            let first_name = $('input[name="username"]').val().trim();
            let last_name = $('input[name="password"]').val().trim();
            let valid = true;

            /**
             * If the username field is empty, display a validation message
             */
            if (!first_name) {
                $('.username-message').text('This field is required.').addClass('show-message');
                valid = false;
            } else {
                $('.username-message').hide();
            }

            /**
             * If the password field is empty, display a validation message
             */
            if (!last_name) {
                $('.password-message').text('This field is required.').addClass('show-message');
                valid = false;
            } else {
                $('.password-message').hide();
            }

            /**
             * If any field is invalid, prevent form submission
             */
            if (!valid) {
                event.preventDefault(); 
            }
        });
    }

    /**
     * Calculate and set the dimensions of the image wrapper based on a desired width
     * while maintaining the aspect ratio.
     *
     * The desired width is 40rem (which equals 640px), and the height is adjusted
     * accordingly based on the original aspect ratio.
     */
    function getImageDimensions() {
        /**
         * 1rem = 16px, therefore 40rem = 640px
         */
        let desiredWidth = 40 * 16;
        let imgWidth = $('.image-wrapper').data('width');
        let imgHeight = $('.image-wrapper').data('height');

        /**
         * Calculate the aspect ratio height based on the desired width.
         * 
         * The aspect ratio height is calculated using the formula:
         * aspectHeight = (desiredWidth / imgWidth) * imgHeight
         */
        let aspectHeight = Math.round((desiredWidth / imgWidth) * imgHeight);
        console.log(aspectHeight);

        /**
         * Assign the desired width and calculated height to the image wrapper
         */
        $('.image-wrapper').css({
            'width': desiredWidth,
            'height': aspectHeight
        })
    }

    handleLoginForm();
    getImageDimensions();
});
