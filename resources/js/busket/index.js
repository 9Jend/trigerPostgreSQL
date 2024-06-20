$('.changeProductCount').on('change', function () {

    if (+$(this).attr('max') < $(this).val()) {
        $(this).val($(this).attr('max'));
    }
    if (+$(this).attr('min') > $(this).val()) {
        $(this).val($(this).attr('min'));
    }

    $.ajax({
        type: "POST",
        url: $(this).parent().attr('action'),
        data: $(this).parent().serialize(),
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $(this).parent().find('.total-price').text($(this).val() * $(this).parent().find('.price').data('price') + " $");
            $(this).parent().find('.total-price').attr('data-total-price', $(this).val() * $(this).parent().find('.price').data('price'));
            $("#order-price").text(response.totalBusketPrice);
        }.bind($(this)),
        error: function (jqXHR, exception) {
            console.log(jqXHR);
            var $needAlert = true;
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.error(msg);
            if ($needAlert)
                alert('Error');
        },
    });
    return false;
})

$('.removeProductFromBusket').submit(function () {
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $(this).closest('.col-md-4').remove();
            $("#busketCount").text("(" + $('.col-md-4').length + ")");
            $("#order-price").text(response.totalBusketPrice);
            if(response.countBasketProduct == 0){
                $('.checkoutContainer').remove();
                $('.visually-hidden').removeClass('visually-hidden');
            }
        }.bind($(this)),
        error: function (jqXHR, exception) {
            console.log(jqXHR);
            var $needAlert = true;
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.error(msg);
            if ($needAlert)
                alert('Error');
        },
    });
    return false;
});
