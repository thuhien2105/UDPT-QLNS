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
                    const employee = response.response.employee.employee
                    Cookies.set('token', response.response.employee.token, { expires: 7, secure: true });
                    Cookies.set('id', employee.employeeId, { expires: 7 });
                    Cookies.set('name', employee.name, { expires: 7 });
                    Cookies.set('dob', employee.dob, { expires: 7 });
                    Cookies.set('address', employee.address, { expires: 7 });
                    Cookies.set('phone_number', employee.phoneNumber || '', { expires: 7 });
                    Cookies.set('email', employee.email || '', { expires: 7 });
                    Cookies.set('position', employee.position || '', { expires: 7 });
                    Cookies.set('role', employee.role || '', { expires: 7 });
                    Cookies.set('tax_code', employee.taxCode || '', { expires: 7 });
                    Cookies.set('bank_account', employee.bankAccount || '', { expires: 7 });
                    Cookies.set('identity_card', employee.identityCard || '', { expires: 7 });
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
