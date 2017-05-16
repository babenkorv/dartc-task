$(document).ready(function () {

    $('.status-form-message-close').on('click', function () {
        $('.status-form-message-close').hide();
        $('.status-form-message').hide();
    });

    function validateFormEmail(email) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            return true;
        }

        return false;
    }

    function validateUrl(url) {
        if (url.length == 0) {
            return true;
        }

        var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;


        if (RegExp.test(url)) {
            return true;
        }

        return false;
    }

    function validateOnRequired(fieldValue) {
        if (fieldValue.length != 0) {
            return true;
        }

        return false;
    }

    function formValidate() {
        var error = '';
        if (!validateOnRequired($('#userName').val())) {
            error += 'not valid name; ';
        }
        if (!validateOnRequired($('#userText').val())) {
            error += 'input message; ';
        }
        if (!validateFormEmail($('#userEmail').val())) {
            error += 'not valid email; ';
        }
        if (!validateUrl($('#userHomepage').val())) {
            error += 'not valid homepage url; ';
        }

        if(error.length!= 0) {
            $('.status-form-message').text(error);
            $('.status-form-message').show();
            $('.status-form-message').addClass('bg-danger');
            $('.status-form-message').removeClass('bg-success');
            $('.status-form-message-close ').show();
            return false;
        } else {
            $('.status-form-message-close ').hide();
            $('.status-form-message').hide();
            return true;
        }

    }

    $('#feedbackButton').on('click', function (e) {
        e.preventDefault();
        if (formValidate()) {

            $.ajax({
                url: '/main/sendFeedbackMessage',
                method: 'post',
                data: {
                    name: $('#userName').val(),
                    email: $('#userEmail').val(),
                    homepage: $('#userHomepage').val(),
                    text: $('#userText').val(),
                    captcha: $('#userCaptcha').val(),
                },
                success: function (data) {
                    $('.status-form-message').show();
                    $('.status-form-message-close ').show();
                    if (data == 'ok') {
                        $('.status-form-message').text('feedback message is send');
                        $('.status-form-message').addClass('bg-success');
                        $('.status-form-message').removeClass('bg-danger');
                        $("#feedback-form input").val('');
                    } else {
                        $('.status-form-message').text('not correct captcha');
                        $('.status-form-message').addClass('bg-danger');
                        $('.status-form-message').removeClass('bg-success');
                    }
                },
                error: function () {
                    console.log('ERROR ')
                }
            });
        }
    });
});