$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $("#loginForm").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/login',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: formData,
            success: function (response) {
                if (response.response && response.response.status === 'Login successful') {
                    Cookies.set('token', response.response.employee.token, { expires: 7, secure: true });
                    Cookies.set('id', response.response.employee.employee.id, { expires: 7 });
                    Cookies.set('name', response.response.employee.employee.name, { expires: 7 });
                    Cookies.set('dob', response.response.employee.employee.dob, { expires: 7 });
                    Cookies.set('address', response.response.employee.employee.address, { expires: 7 });
                    Cookies.set('phone_number', response.response.employee.employee.phone_number, { expires: 7 });
                    window.location.href = '/';
                } else {
                    console.error("Login failed:", response.response.message || 'Unknown error');
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
