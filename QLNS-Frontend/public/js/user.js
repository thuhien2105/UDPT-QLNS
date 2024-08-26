$(document).ready(function () {
    function populateFormFromCookies() {
        var token = Cookies.get("token");
        var id = Cookies.get("id");
        var name = Cookies.get("name");
        var dob = Cookies.get("dob");
        var address = Cookies.get("address");
        var phone_number = Cookies.get("phone_number");
        $("#name_0").val(name || "");
        $("#dob_0").val(dob || "");
        $("#address_0").val(address || "");
        $("#phone_number_0").val(phone_number || "");
    }
    populateFormFromCookies();
});
