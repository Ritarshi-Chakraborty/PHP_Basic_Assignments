$(document).ready(function () {
    /**
     * Check if the email has been sent by reading the hidden div's value
     */
    let emailSent = $('#emailSentFlag').text();
    /**
     * Display the sweet alert if the email has been sent
     */
    if (emailSent === 'true') {
        Swal.fire({
            title: "Email sent!",
            text: "Thank you for sharing your details.",
            icon: "success",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
            backdrop: true
        });
    }

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
         */
        $('input[name="username"], input[name="password"]').on('input', function () {
            /**
             * Hide the message once the user starts typing
             */
            let fieldName = $(this).attr('name');
            if (fieldName === 'username') {
                if ($(this).val().trim()) {
                    $('.username-message').text('').removeClass('show-message');
                }
            } 
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

            if (!first_name) {
                $('.username-message').text('This field is required.').addClass('show-message');
                valid = false;
            } else {
                $('.username-message').hide();
            }

            if (!last_name) {
                $('.password-message').text('This field is required.').addClass('show-message');
                valid = false;
            } else {
                $('.password-message').hide();
            }
            /**
             * Prevent form submission if fields are invalid
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
         * Calculate aspect ratio height based on desired width
         */
        let aspectHeight = Math.round((desiredWidth / imgWidth) * imgHeight);
        console.log(aspectHeight);

        /**
         * Assigning the calculated dimensions to the image wrapper
         */
        $('.image-wrapper').css({
            'width': desiredWidth,
            'height': aspectHeight
        })
    }

    handleLoginForm();
    getImageDimensions();
});
