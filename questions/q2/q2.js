$(document).ready(function() {
    // Validating the Image
    function validateImage() {
        let fileInput = $('input[name="image"]')[0];
        let messageBox = $('.message-box p');
    
        // On form submission
        $('form').on('submit', function (e) {
            let file = fileInput.files[0];

            if (!file) {
                e.preventDefault();
                messageBox.text("Please select an image.").css('display', 'block');
            } 
            else if (file.size > 1048576) { 
                // 1MB = 1048576 bytes
                e.preventDefault();
                messageBox.text("File size is too large. Please select images which are less than 1mb.").css('display', 'block');
            } 
            else {
                messageBox.css('display', 'none');
            }
        });
    
        // On image selection
        $('input[name="image"]').on('change', function () {
            if (fileInput.files && fileInput.files.length > 0) {
                // Hide message immediately when file is selected
                messageBox.css('display', 'none');
            }
        });
    }

    validateImage();
})
