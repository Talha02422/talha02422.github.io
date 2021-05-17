(function ($) {
    "use strict";
    $("#contactForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            formError();
            submitMSG(false, "Did you fill up the form properly?");
        } else {
            event.preventDefault(); submitForm();
        }
    });
    function submitForm() {
        var formData = $('#contactForm').serialize();
        $.ajax({
            type: "POST",
            url: 'sendcontactmail.php',
            dataType: 'json',
            cache: false,
            data: formData,
            success: function (data) {
                if (data.success) {
                    $('#msgSubmit').html('<span class="py-3 text-success">' + data.msg + '</span>');
                    $("#contactForm")[0].reset();
                } else {
                    $('#msgSubmit').html('<span class="py-3 text-danger">' + data.msg + '</span>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    function formSuccess() { $("#contactForm")[0].reset(); submitMSG(true, "Message Submitted!") }
    function formError() { $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () { $(this).removeClass(); }); }
    function submitMSG(valid, msg) {
        if (valid) { var msgClasses = "h4 tada animated text-success"; } else { var msgClasses = "h4 text-danger"; }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }
}(jQuery));