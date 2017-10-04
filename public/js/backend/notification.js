$(document).ready(function () {

    $(".notifications-menu").on("hide.bs.dropdown", function(event){

        $.ajax({
            type: 'GET',
            url: '/admin/notification/clearcurrentnotifications',
            dataType: "JSON",
            success: function(data){
                getNotifications();
            }
        });

    });

    getNotifications();
    setInterval(function () {
        getNotifications();
    }, 60000);
});

function getNotifications() {
    $.ajax({
        type: "GET",
        url: '/admin/notification/getlist',
        dataType: "JSON",
        success: function (result) {
            $(".notification-counter").text(result.count);
            $(".notification-menu-container").html(result.view);
        }
    });
}
