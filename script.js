$(document).ready(function () {
    // handling the Fullname input
    function handleName() {
        $('input[name="first_name"], input[name="last_name"]').on('input', function() {
            let fullName = $('input[name="first_name"]').val() + " " + $('input[name="last_name"]').val();
            $('input[name="full_name"]').val(fullName);
        })
    }

    handleName(); 
})
