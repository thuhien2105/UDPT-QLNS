// $(document).ready(function () {
//     function populateFormFromCookies() {
//         var token = Cookies.get("token");
//         var id = Cookies.get("id");
//         var name = Cookies.get("name");
//         var dob = Cookies.get("dob");
//         var address = Cookies.get("address");
//         var phone_number = Cookies.get("phone_number");
//         $("#name_0").val(name || "");
//         $("#dob_0").val(dob || "");
//         $("#address_0").val(address || "");
//         $("#phone_number_0").val(phone_number || "");
//     }
//     populateFormFromCookies();
// });
$(document).ready(function () {
    function populateFormFromCookies() {
        var token = Cookies.get("token");
        var id = Cookies.get("id");

        if (id) {
            $.ajax({
                url: `http://127.0.0.1:8000/api/employees/${id}`,
                method: "GET",
                dataType: "json",
                headers: {
                    Authorization: `Bearer ${token}`,
                },
                success: function (data) {
                    $("#name_0").val(data.employee.name || "");
                    $("#title_0").text(data.employee.name || "");
                    $("#dob_0").val(data.employee.dob || "");
                    $("#address_0").val(data.employee.address || "");
                    $("#phone_number_0").val(data.employee.phone_number || "");
                    $("#email_0").val(data.employee.email || "");
                    $("#position_0").val(data.employee.position || "");
                    $("#tax_code_0").val(data.employee.tax_code || "");
                    $("#bank_account_0").val(data.employee.bank_account || "");
                    $("#identity_card_0").val(data.employee.identity_card || "");
                    $("#role_0").val(data.employee.role || "");
                },
                error: function () {
                    $("#activity-details").html(
                        "<p>An error occurred while fetching employee details.</p>"
                    );
                },
            });
        } else {
            $("#name_0").val("");
            $("#title_0").text("");
            $("#dob_0").val("");
            $("#address_0").val("");
            $("#phone_number_0").val("");
            $("#email_0").val("");
            $("#position_0").val("");
            $("#tax_code_0").val("");
            $("#bank_account_0").val("");
            $("#identity_card_0").val("");
            $("#role_0").val("");
        }
    }
    populateFormFromCookies();
});
