$(document).ready(function() {
    $('#frmPackage')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                pkgname: {
                    validators: {
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                pkgcost: {
                    validators: {
                        notEmpty: {
                            message: 'The last name is required and cannot be empty'
                        }
                    }
                },
                pkgType: {
                    validators: {
                        notEmpty: {
                            message: 'The Type is required'
                        }
                    }
                },
                pkgDescription: {
                    validators: {
                        notEmpty: {
                            message: 'The Description is required'
                        }
                    }
                }
            }
        })
        .on('error.form.bv', function(e) {
            console.log('error.form.bv');

            // You can get the form instance and then access API
            var $form = $(e.target);
            console.log($form.data('bootstrapValidator').getInvalidFields());

            // If you want to prevent the default handler (bootstrapValidator._onError(e))
            // e.preventDefault();
        })
        .on('success.form.bv', function(e) {
            console.log('success.form.bv');

            // If you want to prevent the default handler (bootstrapValidator._onSuccess(e))
            // e.preventDefault();
        })
        .on('error.field.bv', function(e, data) {
            console.log('error.field.bv -->', data);
        })
        .on('success.field.bv', function(e, data) {
            console.log('success.field.bv -->', data);
        })
        .on('status.field.bv', function(e, data) {
            // I don't want to add has-success class to valid field container
            data.element.parents('.form-group').removeClass('has-success');

            // I want to enable the submit button all the time
            data.bv.disableSubmitButtons(false);
        });

    // Validate the form manually
    $('#pkgSubmit').click(function() {
        $('#frmPackage').bootstrapValidator('validate');
    });
});