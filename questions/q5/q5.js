$(document).ready(function() {
    
    function handleEmailInput() {
        let message = $(".message-box p");
        $("form").on("submit", function(e) {
            let email = $("input[name='email']").val().trim();
    
            if (email === "") {
                message.text('This field is required.');  
                message.addClass("show-message");
                e.preventDefault();
            }
        });

        $('input[name="email"]').on('input', function() {
            message.removeClass("show-message");
        })
    }

    handleEmailInput();
})
