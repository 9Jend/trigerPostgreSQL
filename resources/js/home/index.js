
$('.addToBasket').submit(function () {
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $(this).addClass('visually-hidden');
            $(this).parent().find('.removeFromBusket').removeClass('visually-hidden');
            $("#busketCount").text("("+response.countBasketProduct+")");
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
            if($needAlert)
                alert('Error');
        },
    });
    return false;
});
$('.removeFromBusket').submit(function () {
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $(this).addClass('visually-hidden');
            $(this).parent().find('.addToBasket').removeClass('visually-hidden');
            $("#busketCount").text("("+response.countBasketProduct+")");
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
            if($needAlert)
                alert('Error');
        },
    });
    return false;
});
