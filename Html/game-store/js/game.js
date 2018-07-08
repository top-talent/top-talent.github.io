$(function () {
    // products tab
    $(".products-tab > div:gt(0)").hide();
    $(".products-tab ul a:first").addClass('selected');
    
    $('.products-tab ul a').click(function () {
        
        var newDiv = "div.products-tab > div" + $(this).attr('href');
        
    $(".some").removeClass('active').fadeOut('normal', function () {
         $(newDiv).addClass('active').fadeIn('slow');
    });

    $('div.products-tab ul a').removeClass('selected');
        $(this).addClass('selected');
    return false;
    });

    // button popover
    $('.global-button').popover({ 
        html: true,
        placement : 'right',
        trigger: "hover",
        content:'<div class="global-button-content">Activation can be done </br>from any country</div>'
    });
    
    $('.payment-button').popover({ 
        html: true,
        placement : 'bottom',
        trigger: "hover",
        title:"<div class='payment-button-content'>Payments available</div>",
        content: '<div class="payments"><div class="pay-methods"><span class="payment-paypal"></span><span class="payment-paysafecard"></span><span class="payment-mobile-payment"></span><span class="payment-skrill"></span><span class="payment-visa"></span><span class="payment-mastercard"></span><span class="payment-bitcoins"></span></div></div>'
    });
    $('.product-price').popover({ 
        html: true,
        placement : 'auto',
        trigger: "hover",
        content:'<div class="product-price-content">Updated at 03/07/2018 10:21:06</div>'
    });
    // loadmore button
    $(".table-list-2").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".table-list-2:hidden").slice(0, 400).slideDown();
        // $('html,body').animate({
        //     scrollTop: $(this).offset().top
        // });
        $(".load").hide();
    });
});