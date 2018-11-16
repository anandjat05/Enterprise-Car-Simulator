/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $('.update_cart').click(function () {
        var cartid = $(this).data("cartid");
        //var price = $(this).data("price");             
        var quantity = $('#txtCartQty' + cartid).val();
        var baseurl = $('#findbaseurl').val();

        if (quantity !== '' && quantity > 0) {
            $.ajax({
                url: baseurl + "index.php/page/updateCartQty",
                method: "POST",
                data: {cartid: cartid, quantity: quantity},
                success: function (data) {
                    //$('#cart_details').html(data);  
                    alert('Cart quantity updated successfully');
                    window.location.reload();
                }
            });

        } else {
            alert("Please Enter Quantiry");
        }
    });

    $('.btn_initcart').click(function () {
        var cartid = $(this).data("cartid");
        var total = $(this).data("total");
        var prodId = $(this).data("productid");
        var baseurl = $('#findbaseurl').val();
        
        if (total !== '' && total > 0) {
            $.ajax({
                url: baseurl + "index.php/page/InitiateCheckout",
                method: "POST",
                data: {cartid: cartid, total: total, prodId: prodId},
                success: function (data) {
                    //$('#cart_details').html(data);  
                    //alert(data);
                    //window.location.reload();
                    window.location.replace(baseurl+"index.php/page/checkout");
                    
                }
            });

        }
    });
});
