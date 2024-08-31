$(document).ready(function () {
    var currentPath = window.location.pathname;
    if (currentPath !== '/login') {
        if (!Cookies.get('token') || !Cookies.get('id')) {
            window.location.href = '/login';
        }
    }

    $(".nav-link").click(function () {
        $(".nav-link").removeClass("active");
        $(".tab-pane").removeClass("active");
        $(this).addClass("active");
        var index = $(this).parent().index();
        $(".tab-pane").eq(index).addClass("active");
    });
    $(".dropdown-toggle").click(function () {
        var $dropdownMenu = $(this).siblings(".o-dropdown--menu");
        var $button = $(this);

        // Toggle the display property
        if ($dropdownMenu.is(":visible")) {
            $dropdownMenu.hide();
        } else {
            var offset = $button.offset();
            var buttonHeight = $button.outerHeight();
            $dropdownMenu.css({
                display: "block",
                position: "absolute",
                top: offset.top + buttonHeight,
                right: "20px",
            });
        }
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".o-dropdown").length) {
            $(".o-dropdown--menu").hide();
        }
    });
    $("#logoutLink").on("click", function (event) {
        event.preventDefault();
        Cookies.remove("token");
        Cookies.remove("id");
        Cookies.remove("name");
        Cookies.remove("dob");
        Cookies.remove("address");
        Cookies.remove("phone_number");
        Cookies.remove("email");
        Cookies.remove("position");
        Cookies.remove("role");
        Cookies.remove("tax_code");
        Cookies.remove("bank_account");
        Cookies.remove("identity_card");
        window.location.href = "/login";
        // var token = Cookies.get("token");
        // var csrfToken = $('meta[name="csrf-token"]').attr("content");
        // $.ajax({
        //     url: 'http://127.0.0.1:8000/api/signout',
        //     method: "POST",
        //     data: {
        //         token: token
        //     },
        //     success: function (response) {
        //         if (response.success) {
        //             Cookies.remove("token");
        //             Cookies.remove("id");
        //             Cookies.remove("name");
        //             Cookies.remove("dob");
        //             Cookies.remove("address");
        //             Cookies.remove("phone_number");
        //             Cookies.remove("email");
        //             Cookies.remove("position");
        //             Cookies.remove("role");
        //             Cookies.remove("tax_code");
        //             Cookies.remove("bank_account");
        //             Cookies.remove("identity_card");
        //             window.location.href = "/login";
        //         } else {
        //             console.error("Logout failed:", response.response.message || 'Unknown error');
        //         }
        //     },
        //     error: function (xhr) {
        //         console.error("Request failed:", xhr.responseText);
        //     },
        // });

    });
});
document.addEventListener("DOMContentLoaded", function () {
    var notifications = document.querySelectorAll(
        "#notification-container .notification"
    );

    function showNotification(index) {
        if (index >= notifications.length) return; // Nếu đã hiển thị hết thông báo

        var notification = notifications[index];
        notification.style.display = "block";

        // Ẩn thông báo sau 3 giây
        setTimeout(function () {
            notification.style.opacity = "0";
            setTimeout(function () {
                notification.remove(); // Xóa thông báo khỏi DOM
                // Gửi yêu cầu AJAX để xóa thông báo khỏi session
                if (index === notifications.length - 1) {
                    clearNotifications(); // Chỉ gọi khi thông báo cuối cùng đã được xử lý
                }
                // Hiển thị thông báo tiếp theo sau khi thông báo hiện tại bị xóa
                showNotification(index + 1);
            }, 300); // Thời gian fade out
        }, 3000); // Thời gian hiển thị
    }

    function clearNotifications() {
        fetch("/clear-notifications", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({}),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    console.log("Notifications cleared from session.");
                } else {
                    console.error("Failed to clear notifications.");
                }
            });
    }
    showNotification(0);
});
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
}
