$(document).ready(function () {
    function populateUserName() {
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
                    // Lấy tên đầy đủ từ dữ liệu API
                    var fullName = data.employee.name || "";

                    // Điền tên đầy đủ vào phần tử HTML tương ứng
                    $("#user_name").text(fullName);
                },
                error: function () {
                    $("#activity-details").html(
                        "<p>An error occurred while fetching employee details.</p>"
                    );
                },
            });
        }
    }
    populateUserName();
});
