$(document).ready(function () {
    // Hàm tải các request của bản thân
    function loadMyApprovals(monthYear, status) {
        const employeeId = Cookies.get("id"); // Lấy employee ID từ cookie
        console.log("Employee ID:", employeeId); // Ghi log để kiểm tra giá trị của employeeId

        if (!employeeId) {
            console.error("Employee ID không có trong cookie.");
            $("#request_data-table tbody").html(
                '<tr><td colspan="9">Không thể lấy Employee ID.</td></tr>'
            );
            return;
        }

        const token = Cookies.get("token");
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        const page = 1; // Bạn có thể thay đổi trang nếu cần

        // Tách tháng và năm từ giá trị monthYear
        const [year, month] = monthYear.split("-");

        // Chỉnh sửa URL theo yêu cầu của bạn
        let url = `http://127.0.0.1:8000/api/request/${employeeId}/${page}/${month}/${year}`;

        // Ghi log URL để kiểm tra
        console.log("Request URL:", url);
        console.log("Request Params:", {
            employeeId: employeeId,
            page: page,
            month: month,
            year: year,
        });

        $.ajax({
            url: url,
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            dataType: "json",
            beforeSend: function () {
                $("#request_data-table tbody").html(
                    '<tr><td colspan="9">Loading...</td></tr>'
                );
            },
            success: function (data) {
                console.log("API Response Data:", data); // Kiểm tra dữ liệu từ API

                let rowsHtml = "";
                const timeSheets = data.requests || []; // Đảm bảo requests có dữ liệu

                timeSheets.forEach((item) => {
                    const timeSheet = item.request;
                    const employee = item.employee;

                    if (employee.employee_id === employeeId) {
                        // Chỉ hiển thị yêu cầu của nhân viên hiện tại
                        rowsHtml += `
                            <tr class="o_data_row text-info" data-id="datapoint_${
                                timeSheet.id
                            }">
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="employee_name">
                                    ${employee ? employee.name : ""}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="type">
                                    ${formatRequestType(timeSheet.request_type)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="reason">
                                    ${timeSheet.reason ? timeSheet.reason : ""}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_date" tabindex="-1" name="date">
                                    ${formatDate(timeSheet.request_date)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_time" tabindex="-1" name="start_time">
                                    ${formatTime(timeSheet.start_time)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_time" tabindex="-1" name="end_time">
                                    ${formatTime(timeSheet.end_time)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="status">
                                    ${timeSheet.status ? timeSheet.status : ""}
                                </td>
                            </tr>
                        `;
                    }
                });

                rowsHtml += `
                    <tr><td colspan="9">​</td></tr>
                    <tr><td colspan="9">​</td></tr>
                    <tr><td colspan="9">​</td></tr>
                `;

                $("#request_data-table tbody").html(rowsHtml);
            },
        });
    }

    // Xử lý sự kiện thay đổi trên phần chọn tháng và năm
    $("#monthYearPicker").change(function () {
        const monthYear = $(this).val();
        loadMyApprovals(monthYear);
    });

    // Gọi loadMyApprovals lần đầu tiên khi trang được tải
    const initialMonthYear = new Date().toISOString().slice(0, 7); // YYYY-MM format
    loadMyApprovals(initialMonthYear);
});
