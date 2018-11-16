$(document).ready(function () {
    $('#frmAddMyAddress')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {                    
                    streetAddress: {
                        validators: {
                            notEmpty: {
                                message: 'Street Address is required, cannot be empty!'
                            },
                            stringLength: {
                                min: 6,
                                max: 100,
                                message: 'The address must be more than 6 and less than 100 characters long'
                            }
                        }
                    },
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'State is required, cannot be empty!'
                            }
                        }
                    },
                    country: {
                        validators: {
                            notEmpty: {
                                message: 'Country required, cannot be empty!'
                            }
                        }
                    },
                    zipcode: {
                        validators: {
                            notEmpty: {
                                message: 'Zipcode is required, cannot be empty!'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'The zipcode can only contain number'
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
    $('#btnAddMyAddress').click(function () {
        $('#frmAddMyAddress').bootstrapValidator('validate');
    });


    $('#frmEditMyAddress')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    txtEditstreetAddress: {
                        validators: {
                            notEmpty: {
                                message: 'Street Address is required, cannot be empty!'
                            },
                            stringLength: {
                                min: 6,
                                max: 100,
                                message: 'The address must be more than 6 and less than 100 characters long'
                            }
                        }
                    },
                    txtEditstate: {
                        validators: {
                            notEmpty: {
                                message: 'State is required, cannot be empty!'
                            }
                        }
                    },
                    txtEditcountry: {
                        validators: {
                            notEmpty: {
                                message: 'Country required, cannot be empty!'
                            }
                        }
                    },
                    txtEditzipcode: {
                        validators: {
                            notEmpty: {
                                message: 'Zipcode is required, cannot be empty!'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'The zipcode can only contain number'
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
    $('#btnEditMyAddress').click(function () {
        $('#frmEditMyAddress').bootstrapValidator('validate');
    });
});