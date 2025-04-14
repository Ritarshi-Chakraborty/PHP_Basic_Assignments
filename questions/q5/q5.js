$(document).ready(function() {
    /**
     * Handles the validation and feedback for the email input field.
     */
    function handleEmailInput() {
        let message = $(".message-box p");

        /**
         * Submits the form and checks if the email input is empty.
         * If it is empty, it prevents form submission and displays a message.
         * 
         * @param {Event} e The form submit event.
         */
        $("#email-form").on("submit", function(e) {
            let email = $("input[name='email']").val().trim();
    
            if (email === "") {
                message.text('This field is required.');  
                message.addClass("show-message");
                e.preventDefault();
            }
        });

        /**
         * Removes the validation message when the user starts typing in the email input.
         */
        $('input[name="email"]').on('input', function() {
            message.removeClass("show-message");
        })
    }

    handleEmailInput();
}) 
