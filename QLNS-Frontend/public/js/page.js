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
                    Cookies.set('token', response.data.token, { expires: 7, secure: true });
                    Cookies.set('id', response.data.id, { expires: 7 });
                    Cookies.set('name', response.data.name, { expires: 7 });
                    Cookies.set('dob', response.data.dob, { expires: 7 });
                    Cookies.set('address', response.data.address, { expires: 7 });
                    window.location.href = '/'
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
