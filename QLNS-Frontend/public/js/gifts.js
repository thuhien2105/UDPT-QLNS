$(document).ready(function () {
    // var currentPath = window.location.pathname;
    // if (currentPath !== '/login') {
    //     if (!Cookies.get('token') || !Cookies.get('id') || !Cookies.get('name') || !Cookies.get('dob') || !Cookies.get('address') || !Cookies.get('phone_number')) {
    //         window.location.href = '/login';
    //     }
    // }
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
        window.location.href = "/login";
    });
});