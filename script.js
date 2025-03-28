$(document).ready(function handleName() {


    function handleName() {
        // Handling the Fullname input field
        $('input[name="first_name"]').on('input', function() {
            let fullName = $('input[name="first_name"]').val() + " " + $('input[name="last_name"]').val();
            $('input[name="full_name"]').val(fullName);
        })
        $('input[name="last_name"]').on('input', function() {
            let fullName = $('input[name="first_name"]').val() + " " + $('input[name="last_name"]').val();
            $('input[name="full_name"]').val(fullName);
        })
    }

})
