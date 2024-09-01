$(document).ready(function () {
    // Hàm tải các request của bản thân
    function loadMyApprovals(monthYear, status) {
        const employeeId = Cookies.get("id"); // Lấy employee ID từ cookie
        console.log("Employee ID:", employeeId); // Ghi log để kiểm tra giá trị của employeeId

        if (!employeeId) {
            console.error("Employee ID không có trong cookie.");
            $("#data-table tbody").html(
                '<tr><td colspan="9">Không thể lấy Employee ID.</td></tr>'
            );
            return;
        }

        const token = Cookies.get("token");
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        const page = 1; // Bạn có thể thay đổi trang nếu cần

        // Tách tháng và năm từ giá trị monthYear
        const [year, month] = monthYear.split("-");

        // Đảm bảo tháng có một chữ số không được tự thêm số 0
        const formattedMonth = month.startsWith("0")
            ? month.substring(1)
            : month;

        // Chỉnh sửa URL để không có tham số status
        let url = `http://127.0.0.1:8000/api/request/timesheet/${employeeId}/${page}/${formattedMonth}/${year}`;

        // Ghi log URL và tham số để kiểm tra
        console.log("Request URL:", url);
        console.log("Request Params:", {
            employeeId: employeeId,
            page: page,
            month: formattedMonth,
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
                $("#data-table tbody").html(
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
                            <td class="o_list_record_selector user-select-none" tabindex="-1">
                                <div class="o-checkbox form-check">
                                    <input type="checkbox" class="form-check-input" name="id" value="${
                                        timeSheet.id
                                    }"/>
                                    <label class="form-check-label"></label>
                                </div>
                            </td>
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
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="actions">
                                <button class="btn btn-success approve-btn" data-id="${
                                    timeSheet.id
                                }">Approve</button>
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

                $("#data-table tbody").html(rowsHtml);
            },
            error: function () {
                $("#data-table tbody").html(
                    '<tr><td colspan="9">An error occurred while fetching time sheets.</td></tr>'
                );
            },
        });
    }

    // Xử lý sự kiện click trên nút "Apply"
    $("#filterButton").click(function () {
        const monthYear = $("#monthYearPicker").val();
        const status = $("#statusPicker").val();

        loadMyApprovals(monthYear, status);
    });

    // Xử lý sự kiện click trên nút "My Approvals"
    $("#myApprovalsButton").click(function () {
        const monthYear = $("#monthYearPicker").val();
        loadMyApprovals(monthYear); // Status không được truyền vào hàm này
    });

    // Gọi loadMyApprovals lần đầu tiên khi trang được tải
    const initialMonthYear = new Date().toISOString().slice(0, 7); // YYYY-MM format
    loadMyApprovals(initialMonthYear); // Status không được truyền vào hàm này
});
