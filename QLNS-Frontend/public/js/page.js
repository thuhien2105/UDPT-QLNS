$(document).ready(function () {
    $("#loginForm").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ route("login.check") }}',
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    console.log("Login successful:", response.data);
                } else {
                    console.error("Login failed:", response.error);
                }
            },
            error: function (xhr) {
                console.error("Request failed:", xhr.responseText);
            },
        });
    });
    $("#signupForm").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "/signup",
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    console.log("Signup successful:", response.data);
                } else {
                    console.error("Signup failed:", response.error);
                }
            },
            error: function (xhr) {
                console.error("Request failed:", xhr.responseText);
            },
        });
    });
});
