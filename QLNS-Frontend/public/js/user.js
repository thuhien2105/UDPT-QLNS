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
                    "Authorization": `Bearer ${token}`
                },
                success: function (data) {
                    $("#name_0").val(data.employee.name || "");
                    $("#dob_0").val(data.employee.dob || "");
                    $("#address_0").val(data.employee.address || "");
                    $("#phone_number_0").val(data.employee.phone_number || "");
                },
                error: function () {
                    $("#activity-details").html(
                        "<p>An error occurred while fetching employee details.</p>"
                    );
                },
            });
        } else {
            $("#name_0").val("");
            $("#dob_0").val("");
            $("#address_0").val("");
            $("#phone_number_0").val("");
        }
    }
    populateFormFromCookies();
});