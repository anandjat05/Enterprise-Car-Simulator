$(document).ready(function () {
    
    $('#frmCheckoutCart')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    txtNameOnCard: {
                        validators: {
                            notEmpty: {
                                message: 'The card name is required and cannot be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\ ]+$/,
                                message: 'The card name can only consist of alphabets'
                            }
                        }
                    },
                    pickupDate: {
                        validators: {
                            notEmpty: {
                                message: 'The Pick Up Date is required and cannot be notEmpty'
                            }
                        }
                    },
                    returnDate: {
                        validators: {
                            notEmpty: {
                                message: 'The Return Date is required and cannot be empty'
                            }
                        }
                    },
                     txtCardNum: {
                        validators: {
                            notEmpty: {
                                message: 'The Card number is required and cannot be empty'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'The card number can only consist of number'
                            },
                            stringLength: {
                                min: 12,
                                max: 12,
                                message: 'The Card number must contains be 12 numbers long'
                            }
                        }
                    },
                    slctExpMonth: {
                        validators: {
                            notEmpty: {
                                message: 'The Expiration month is required and cannot be empty'
                            }
                        }
                    },
                    txtExpYear: {
                        validators: {
                            notEmpty: {
                                message: 'The Expiration year is required and cannot be empty'
                            }
                        }
                    },
                    txtCardCCV: {
                        validators: {
                            notEmpty: {
                                message: 'The CCV number is required and cannot be empty'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'The CCV number can only consist of number'
                            },
                            stringLength: {
                                min: 3,
                                max: 3,
                                message: 'The CCV number must contains be 3 numbers long'
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

    // var today = new Date().toISOString().split('T')[0];
    // document.getElementsByName("pickupDate")[0].setAttribute('min', today);
    // document.getElementsByName("returnDate")[0].setAttribute('min', today);


    // Validate the form manually
    $('#btnSubmittoCheckout').click(function () {
        $('#frmCheckoutCart').bootstrapValidator('validate');
    });

    $('#btnRedeemCode').click(function () {
        if ($('#txtPlaceHolder').val() === 'LOGINPROMO') {
            var initid = $(this).data("initid");
            var totalamnt = $(this).data("totalamnt");
            var baseurl = $('#findbaseurl').val();

            //alert('Id' + initid + ' Total:' + totalamnt + ' Base URL: ' + baseurl);
            if (totalamnt !== '' && totalamnt > 0) {
                $.ajax({
                    url: baseurl + "index.php/page/applyredeemcode",
                    method: "POST",
                    data: {initId: initid, initTotal: totalamnt},
                    success: function (data) {
                        $('#success_couponcode').html(data);
                        alert(data);
                        window.location.replace(baseurl + "index.php/page/checkout");
                    }
                });
            }
        } else {
            alert('Enter a valid Promo code');
        }
    });
//ajax for calling data
       
    document.getElementById("pickupDate").addEventListener("change", function(){
       returnDateChnage();
}, false);
    
    document.getElementById("returnDate").addEventListener("change", function(){
       returnDateChnage();
}, false);

//     document.getElementById("pickup").addEventListener("change", function(){
//        returnDateChnage();
// }, false);

    $('#btnApplyCarPoints').click(function () {
        var totalPoints = $('#myTotalCarPoints').val();
        var availPoint = $('#txtApplyCarpoints').val();
        var initId = $(this).data("initid");
        var totalamnt = $(this).data('totalamnt');
        var baseurl = $('#findbaseurl').val();

        /*alert('Total Point: '+totalPoints+' Avail Point '+ availPoint);
         if (availPoint > totalPoints || availPoint <= 0) {
         alert('Total Point: '+totalPoints+' Avail Point '+ availPoint);
         }else{
         alert('Working else part');
         }
         */
        alert('Total '+totalPoints);
        alert('Availed '+availPoint);

        

        if (totalPoints > availPoint) {
            
            if (availPoint > 0) {
                $.ajax({
                    url: baseurl + "index.php/page/applycarpoints",
                    method: "POST",
                    data: {totalpoint: totalPoints, availpoint: availPoint, initId: initId, totalamnt: totalamnt},
                    
                    success: function (data) {
                        $('#success_couponcode').html(data);
                        alert(data);
                        window.location.replace(baseurl + "index.php/page/checkout");
                    }
                });
            } else {
                $('#showNotifications').html('Enter a valid point. Which should be grater than 0');
            }
        } else {
            
            $('#showNotifications').html('Enter a valid car point. Which should be less than ' + totalPoints + ' also multiples of 10');
        }
    });

    $("#txtApplyCarpoints").keypress(function () {
        $('#showNotifications').html('');
    });
    //ajax request for retrieving return dat data from data base
//.....
});

function returnDateChnage()
{
    var carType = document.getElementById("carType").value;
    var retDate = document.getElementById("returnDate").value;
    var pickDate = document.getElementById("pickupDate").value;
        if(retDate !=''){//carType
            var baseurl = $('#findbaseurl').val();
            $.ajax({
                url: baseurl+"index.php/page/returnDateCheck/",
                method: "POST",
                data:{carType:carType, retDate:retDate, pickDate: pickDate},
                dataType:'json',
                success:function(data){
                    $('#showDate').html(data.message);
                    //alert("data: "+data);
                }

            })
    }//end if-else
}