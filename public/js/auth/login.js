//== Class Definition
var SnippetLogin = function () {

    var login = $('#m_login');

    var showErrorMsg = function (form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        alert.find('span').html(msg);
    };

    //== Private Functions

    var handleSignInFormSubmit = function () {
        $('#kt_sign_in_submit').click(function (e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            form.ajaxSubmit({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, status, xhr, $form) {
                    console.log(response);
                    console.log(status);
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    //every thing is okk, redirect to dashboard
                    window.location.href = '/home';
                },
                error: function (xhr, response, status) {
                    console.log(response);
                    console.log(status);
                    var err = eval("(" + xhr.responseText + ")");

                    console.log(err);



                    showErrorMsg(form, 'danger', err.message);
                }
            });
        });
    };

    //== Public Functions
    return {
        // public functions
        init: function () {
            handleSignInFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function () {
    SnippetLogin.init();
});