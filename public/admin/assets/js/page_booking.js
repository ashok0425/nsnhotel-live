(function ($) {
    'use strict';

    $(document).on("click", ".booking_approve, .booking_cancel", function () {
        if (confirm('Are you sure?'))
            $(this).parent().submit();
    });

    $(document).on("click", ".booking_detail", function (e) {
        let booking_name = e.currentTarget.getAttribute('data-name'),
            booking_email = e.currentTarget.getAttribute('data-email'),
            booking_phone = e.currentTarget.getAttribute('data-phone'),
            booking_place = e.currentTarget.getAttribute('data-place'),
            booking_start = e.currentTarget.getAttribute('data-booking-start'),
            booking_end = e.currentTarget.getAttribute('data-booking-end'),
            booking_numberofadult = e.currentTarget.getAttribute('data-adult'),
            booking_numberofchildren = e.currentTarget.getAttribute('data-children'),
            booking_message = e.currentTarget.getAttribute('data-message'),
            booking_status = e.currentTarget.getAttribute('data-status'),
            booking_at = e.currentTarget.getAttribute('data-bookingat'),
            address = e.currentTarget.getAttribute('data-address'),
            amount = e.currentTarget.getAttribute('data-amount'),
            room = e.currentTarget.getAttribute('data-room'),
            id = e.currentTarget.getAttribute('data-id')
        ;

var today = booking_end;
today = new Date(today.split('/')[2],today.split('/')[1]-1,today.split('/')[0]);
var date2 = booking_start;
date2 = new Date(date2.split('/')[2],date2.split('/')[1]-1,date2.split('/')[0]);
var timeDiff = Math.abs(today.getTime() - date2.getTime());
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        $('#booking_name').text(booking_name);
        $('#booking_email').text(booking_email);
        $('#booking_phone').text(booking_phone);
        $('#booking_place').text(booking_place);
        $('#booking_start').text(booking_start);
        $('.booking_starts').text(booking_start);
        $('#booking_end').text(booking_end);
        $('#booking_numberofadult').text(booking_numberofadult);
        $('#booking_numberofchildren').text(booking_numberofchildren);
        $('#booking_message').text(booking_message);
        $('#booking_status').text(booking_status);
        $('#booking_at').text(booking_at);
        $('#address').text(address);
        $('#amount').text(amount);
        $('#amount1').text(amount);
        $('#amount2').text(amount);
        $('#room').text(room);
        $('#room1').text(room);
        $('#room2').text(room);
        $('#id').text(id);
        $('#id1').text(id);
            $('#nights').text(diffDays);
        $('#modal_booking_detail').modal('show');
    });

})(jQuery);