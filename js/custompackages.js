$(document).ready(function () {
    $('#bookMyCustomPackage')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    txtOwnerName: {
                        validators: {
                            notEmpty: {
                                message: 'The name is required and cannot be empty'
                            },
                            stringLength: {
                                min: 3,
                                max: 60,
                                message: 'The username must be more than 3 and less than 60 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\.\ ]+$/,
                                message: 'The username can only consist of alphabetical, dot and Space'
                            },
                            different: {
                                field: 'password',
                                message: 'The username and password cannot be the same as each other'
                            }
                        }
                    },
                    txtEmailId: {
                        validators: {
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    txtContactNum: {
                        validators: {
                            notEmpty: {
                                message: 'The phone number is required and cannot be empty'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'The phone number can only consist of number'
                            },
                            stringLength: {
                                min: 10,
                                max: 10,
                                message: 'The phone number must contains be 10 numbers long'
                            }
                        }
                    },
                    txtAppoDate: {
                        validators: {
                            notEmpty: {
                                message: 'Date is required, cannot be empty!'
                            }
                        },
                    },
                    txtAppoTime: {
                        validators: {
                            notEmpty: {
                                message: 'Time is required, cannot be empty!'
                            }
                        }
                    }                                        
                }
            })
            .on('error.form.bv', function (e) {
                console.log('error.form.bv');

                // You can get the form instance and then access API
                var $form = $(e.target);
                console.log($form.data('bootstrapValidator').getInvalidFields());

                // If you want to prevent the default handler (bootstrapValidator._onError(e))
                // e.preventDefault();
            })
            .on('success.form.bv', function (e) {
                console.log('success.form.bv');

                // If you want to prevent the default handler (bootstrapValidator._onSuccess(e))
                // e.preventDefault();
            })
            .on('error.field.bv', function (e, data) {
                console.log('error.field.bv -->', data);
            })
            .on('success.field.bv', function (e, data) {
                console.log('success.field.bv -->', data);
            })
            .on('status.field.bv', function (e, data) {
                // I don't want to add has-success class to valid field container
                data.element.parents('.form-group').removeClass('has-success');

                // I want to enable the submit button all the time
                data.bv.disableSubmitButtons(false);
            });

    // Validate the form manually
    $('#btnSubmitForAppmnt').click(function () {
        $('#bookMyCustomPackage').bootstrapValidator('validate');
    });
});