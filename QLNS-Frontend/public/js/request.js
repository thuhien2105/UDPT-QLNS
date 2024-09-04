$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get("type");
    const id = urlParams.get("id");
    function formatRequestType(requestType) {
        const mappings = {
            WFH: "Work From Home",
            LEAVE: "Leave",
        };
        return (
            mappings[requestType] ||
            requestType.replace(/_/g, " ").toUpperCase()
        );
    }
    function formatDate(date) {
        return date ? new Date(date).toLocaleDateString() : "";
    }

    function formatTime(date) {
        return date ? new Date(date).toLocaleTimeString() : "";
    }
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
        //console.log("Request URL:", url);
        // console.log("Request Params:", {
        //     employeeId: employeeId,
        //     page: page,
        //     month: month,
        //     year: year,
        // });

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
                //console.log("API Response Data:", data); // Kiểm tra dữ liệu từ API

                let rowsHtml = "";
                const requests = Array.isArray(data.requests)
                    ? data.requests
                    : [data.requests];
                const max_page = data.totalPages; // Cập nhật tổng số trang
                $(".o_pager_limit").text(max_page);

                let hasData = false; // Cờ kiểm tra có dữ liệu hay không

                requests.forEach((item) => {
                    const request = item.request;
                    const employee = item.employee;
                    if (employee.employee_id === employeeId) {
                        console.log("Employee ID matches. Adding row.");

                        // Tạo HTML cho hàng
                        const rowHtml = `
                            <tr class="o_data_row text-info" data-id="datapoint_${
                                request.id
                            }">
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="employee_name">
                                    ${employee ? employee.name : ""}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="type">
                                    ${formatRequestType(request.request_type)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="reason">
                                    ${request.reason ? request.reason : ""}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_date" tabindex="-1" name="date">
                                    ${formatDate(request.request_date)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_time" tabindex="-1" name="start_time">
                                    ${formatTime(request.start_time)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_time" tabindex="-1" name="end_time">
                                    ${formatTime(request.end_time)}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="status">
                                    ${request.status ? request.status : ""}
                                </td>
                               <td>
            <button class="btn btn-primary btn-update" data-id="${
                request.id
            }">Update</button>
            <button class="btn btn-danger btn-delete" data-id="${
                request.id
            }">Delete</button>
        </td>
                            </tr>
                        `;

                        //onsole.log("Rows HTML to be inserted:", rowsHtml);
                        // Xem HTML của hàng

                        rowsHtml += rowHtml;
                        hasData = true; // Có dữ liệu phù hợp
                    } else {
                        console.log(
                            "Employee ID does not match. Skipping row."
                        );
                    }
                });

                if (!hasData) {
                    rowsHtml =
                        '<tr><td colspan="9">Không có dữ liệu.</td></tr>';
                }

                // Thay thế nội dung của bảng bằng rowsHtml
                $("#request_data-table tbody").html(rowsHtml);
                // console.log(
                //     "Table body HTML after update:",
                //     $("#request_data-table tbody").html()
                // );
            },
        });
    }

    if (type) {
        $("#request_type").text(formatRequestType(type));
    }
    // Xử lý sự kiện thay đổi trên phần chọn tháng và năm
    $("#monthYearPicker").change(function () {
        const monthYear = $(this).val();
        loadMyApprovals(monthYear);
    });

    // Gọi loadMyApprovals lần đầu tiên khi trang được tải
    const initialMonthYear = new Date().toISOString().slice(0, 7); // YYYY-MM format
    loadMyApprovals(initialMonthYear);

    // Event listener for the Update button
    $(document).on("click", ".btn-update", function () {
        const id = $(this).data("id");
        const url = `/approvals/form?id=${id}`;
        window.location.href = url; // Redirect to the form page
    });

    // Event listener for the Delete button
    $(document).on("click", ".btn-delete", function () {
        const id = $(this).data("id");
        if (confirm("Bạn xác nhận xóa chứ?")) {
            deleteRequest(id);
        }
    });

    // Function to handle the deletion of a request
    function deleteRequest(id) {
        const token = Cookies.get("token");
        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `http://127.0.0.1:8000/api/request/${id}`,
            method: "DELETE",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                alert("Request deleted successfully.");
                // Reload the table data after deletion
                const monthYear = $("#monthYearPicker").val();
                loadMyApprovals(monthYear);
            },
            error: function (xhr, status, error) {
                alert("Failed to delete the request. Please try again.");
            },
        });
    }

    // Event listener for form submission on the form page (Edit operation)
    $("#formSubmitButton").on("click", function (e) {
        e.preventDefault();

        const id = $("#id").val(); // Assuming you have a hidden input to hold the requestId
        const formData = {
            request_type: $("#requestType").val(),
            request_date: $("#requestDate").val(),
            start_time: $("#startTime").val(),
            end_time: $("#endTime").val(),
            reason: $("#reason").val(),
            approver_id: $("#approverId").val(),
            status: $("#status").val(),
        };

        const token = Cookies.get("token");
        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `http://127.0.0.1:8000/api/request/${id}`,
            method: "PUT",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            data: formData,
            success: function (response) {
                alert("Request updated successfully.");
                window.location.href = "/approvals/request_list"; // Redirect back to the request list page
            },
            error: function (xhr, status, error) {
                alert("Failed to update the request. Please try again.");
            },
        });
    });

    // Function to populate form fields on the edit page
    function loadRequestData(id) {
        const token = Cookies.get("token");
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        const url = `http://127.0.0.1:8000/api/request/${id}`;

        console.log("Request ID:", id);
        console.log("URL:", url);

        $.ajax({
            url: url,
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            dataType: "json",
            success: function (data) {
                console.log("Response Data:", data);
                $("#category_id_0").val(data.request_type);
                $("#date_start_0").val(data.start_date);
                $("#date_end_0").val(data.end_date);
                $("#reason").text(data.reason); // Sử dụng .text() thay vì .val() cho thẻ <span>
                $("#request_owner_id_0").val(data.request_owner_id);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Failed to load the request data. Please try again."
                );
                console.error("Status:", status);
                console.error("Error:", error);
            },
        });
    }

    if (id) {
        loadRequestData(id);
    }
});
