$(document).ready(function () {
    // Handling the login page
    function handleLoginForm() {
        $('input[name="username"], input[name="password"]').on('input', function () {
            // Hide the message once the user starts typing
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

            if (!valid) {
                // Stop form submission
                event.preventDefault(); 
            }
        });
    }

    // Retrieve the dimensions of the image
    function getImageDimensions() {
        // 1rem = 16px therefore 40rem = (40*16)px
        let desiredWidth = 40*16;
        let imgWidth = $('.image-wrapper').data('width');
        let imgHeight = $('.image-wrapper').data('height');

        // Calculate aspect ratio height based on desired width
        let aspectHeight = Math.round((desiredWidth / imgWidth) * imgHeight);
        console.log(aspectHeight);

        // Assigning the desired dimensions to the image wrapper
        $('.image-wrapper').css({
            'width': desiredWidth,
            'height': aspectHeight
        })
    }

    handleLoginForm();
    getImageDimensions();
})
