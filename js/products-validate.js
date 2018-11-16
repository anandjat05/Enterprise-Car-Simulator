/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('.add_cart').click(function () {
        var product_id = $(this).data("productid");
        var product_name = $(this).data("productname");
        var product_price = $(this).data("price"); 
        var prod_point = 0;
        if($(this).data('prodpoint')){
            prod_point = $(this).data('prodpoint');
        }                   
        var quantity = $('#qty'+product_id).val();
        var baseurl = $('#findbaseurl').val();
        if (quantity !== '' && quantity > 0) {
            $.ajax({
               url: baseurl+"index.php/page/addtocart",
               method: "POST",
               data:{product_id:product_id, product_name:product_name, product_price:product_price,
               quantity:quantity, paw_point:prod_point},
                success: function (data) {
                    window.location.replace(baseurl+"index.php/page/products");  
                    //alert(data);
                }
            });
            
        } else {
            alert("Please Enter Quantiry");
        }
    });
});
