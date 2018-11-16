$(document).ready(function () {
    $('#regForm')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
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
                    email: {
                        validators: {
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 60,
                                message: 'The password must be more than 6 and less than 60 characters long'
                            },
                            identical: {
                                field: 'confirmPassword',
                                message: 'The password and its confirm are not the same'
                            },
                            different: {
                                field: 'username',
                                message: 'The password cannot be the same as username'
                            }
                        }
                    },
                    conf_password: {
                        validators: {
                            notEmpty: {
                                message: 'The confirm password is required and cannot be empty'
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            },
                            different: {
                                field: 'username',
                                message: 'The password cannot be the same as username'
                            }
                        }
                    },
                    phone: {
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
                    gender: {
                        validators: {
                            notEmpty: {
                                message: 'The gender is required'
                            }
                        }
                    },
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
                        },
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
                    },
                    petname: {
                        validators: {
                            notEmpty: {
                                message: 'The pet name is required and cannot be empty'
                            }
                        }
                    },
                    petbreed: {
                        validators: {
                            notEmpty: {
                                message: 'The pet breed is required and cannot be empty'
                            }
                        }
                    },
                    tandc: {
                        validators: {
                            notEmpty: {
                                message: 'Please agree terms and conditions'
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
    $('#regisSumbit').click(function() {
        $('#regForm').bootstrapValidator('validate');
    });
});