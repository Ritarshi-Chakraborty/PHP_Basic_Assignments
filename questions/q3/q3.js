$(document).ready(function() {
    // Validating the textarea
    function validateTextarea() {
        let message = $('.message-box p');

        // Handle the textarea when the user starts typing
        $('textarea').on('input', function () {
            let cleanedLines = [];

            // Get the current textarea value and split it into lines
            let lines = $(this).val().split('\n');

            // Loop through each line to clean it
            for (let line of lines) {
                let parts = line.split('|');

                // Clean the subject part (only letters and spaces)
                let subject = parts[0].replace(/[^A-Za-z]/g, '');

                // Clean the marks part (only numbers)
                let marks = parts[1] ? parts[1].replace(/[^0-9]/g, '') : '';

                // Reconstruct the line
                let cleanedLine = subject;
                if (line.includes('|')) {
                    cleanedLine += '|' + marks;
                }

                cleanedLines.push(cleanedLine);
            }

            // Update the textarea with cleaned input
            $(this).val(cleanedLines.join('\n'));

            // Hide the error message while typing
            message.hide();
        });

        $('form').on('submit', function(e) {
            let isValid = true;
            let value = $('textarea').val();

            // Check if the textarea is empty
            if (value === '') {
                isValid = false;
                message.text("This field is required.");
            } 
            else {
                let lines = value.split('\n');
                let regex = /^[A-Za-z]+\|[0-9]+$/;

                for (let i = 0; i < lines.length; i++) {
                    let line = lines[i];

                    // Check if the line is completely empty
                    if (line === '') {
                        isValid = false;
                        message.text(`Line ${i + 1} is empty.`);
                        break;
                    }

                    // Check format
                    if (!regex.test(line)) {
                        isValid = false;
                        message.text(`Invalid format in line ${i+1}. Please use the following format: Subject|Marks`);
                        break;
                    }

                    // Check marks > 100
                    let parts = line.split('|');
                    let marks = parseInt(parts[1]);
                    if (marks > 100) {
                        isValid = false;
                        message.text(`Error on line ${i + 1}. Maximum marks can be 100.`);
                        break;
                    }
                }
            }

            if (!isValid) {
                e.preventDefault();
                $('.message-box p').show();
            }
        });
    }

    validateTextarea();
})
