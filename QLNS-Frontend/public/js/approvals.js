$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get("type");
    var token = Cookies.get("token");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var page = 1;
    var max_page = 1;

    function minutesToHHMM(minutes) {
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;
        return `${String(hours).padStart(2, '0')}:${String(mins).padStart(2, '0')}`;
    }

    function formatDate(date) {
        return date ? new Date(date).toLocaleDateString() : "";
    }

    function formatTime(date) {
        return date ? new Date(date).toLocaleTimeString() : "";
    }

    function formatRequestType(requestType) {
        return requestType
            .replace(/_/g, ' ') // Thay thế dấu gạch dưới bằng khoảng trắng
            .toLowerCase()     // Chuyển tất cả ký tự thành chữ thường
            .replace(/(^\w|\s\w)/g, m => m.toUpperCase()); // Viết hoa chữ cái đầu mỗi từ
    }

    function loadRequests(monthYear, status) {
        $('.o_pager_value').text(page);
        let [year, month] = monthYear.split('-');
        let url = `http://127.0.0.1:8000/api/requests/timesheet/${page}/${month}/${year}?status=${status}`;

        $.ajax({
            url: url,
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                let rowsHtml = "";
                const requests = Array.isArray(data.requests) ? data.requests : [data.requests];
                max_page = data.totalPages;
                $(".o_pager_limit").text(max_page);

                requests.forEach((item) => {
                    const request = item.request;
                    const employee = item.employee;

                    rowsHtml += `
                    <tr class="o_data_row text-info" data-id="datapoint_${request.id}">
                        <td class="o_list_record_selector user-select-none" tabindex="-1">
                            <div class="o-checkbox form-check">
                                <input type="checkbox" class="form-check-input" name="id" value="${request.id}"/>
                                <label class="form-check-label"></label>
                            </div>
                        </td>
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
                        <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="actions">
                            <button class="btn btn-success approve-btn" data-id="${request.id}">Approve</button>
                        </td>
                    </tr>
                `;
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
                    '<tr><td colspan="9">An error occurred while fetching requests.</td></tr>'
                );
            },
        });
    }

    // Set initial value for request type if 'type' is present in URL
    if (type) {
        $('#request_type').text(formatRequestType(type));
    }

    // Load initial requests for current month, year, and default status (Pending)
    const initialMonthYear = new Date().toISOString().slice(0, 7); // YYYY-MM format
    const initialStatus = $('#statusPicker').val();
    loadRequests(initialMonthYear, initialStatus);

    // Handle month-year picker change
    $('#monthYearPicker').on('change', function () {
        const selectedMonthYear = $(this).val();
        const selectedStatus = $('#statusPicker').val();
        loadRequests(selectedMonthYear, selectedStatus);
    });

    // Handle status picker change
    $('#statusPicker').on('change', function () {
        const selectedStatus = $(this).val();
        const selectedMonthYear = $('#monthYearPicker').val();
        loadRequests(selectedMonthYear, selectedStatus);
    });

    $(".o_pager_previous").click(function () {
        if (page > 1) {
            page -= 1;
            loadRequests($('#monthYearPicker').val(), $('#statusPicker').val());
        }
    });

    $(".o_pager_next").click(function () {
        if (page < max_page) {
            page += 1;
            loadRequests($('#monthYearPicker').val(), $('#statusPicker').val());
        }
    });

    $("#data-table").on("click", ".approve-btn", function () {
        const requestId = $(this).data("id");

        $.ajax({
            url: `http://127.0.0.1:8000/api/request/approve/${requestId}`,
            method: "POST",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.status) {
                    alert("Request approved successfully!");
                    loadRequests($('#monthYearPicker').val(), $('#statusPicker').val());
                } else {
                    alert("Failed to approve request.");
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });

    $('#create-request-form').on('submit', function (e) {
        e.preventDefault(); // Ngăn chặn gửi form mặc định

        // Thu thập dữ liệu từ form
        const requestData = {
            request_type: $('#request_type').val(),
            start_time: $('#start_time').val(),
            end_time: $('#end_time').val(),
            reason: $('#reason').val()
        };

        createRequest(requestData);
    });

    function createRequest(data) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/request/create',
            method: 'POST',
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            data: data,
            success: function (response) {
                if (response.error) {
                    alert("Error: " + response.error);
                } else {
                    alert("Request created successfully!");
                    // Cập nhật danh sách yêu cầu nếu cần
                    loadRequests($('#monthYearPicker').val(), $('#statusPicker').val());
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            }
        });
    }
    function formatDateTime(dateTimeString) {
        // Chuyển đổi định dạng từ 'yyyy-MM-dd HH:mm:ss' thành 'yyyy-MM-ddTHH:mm:ss'
        return dateTimeString.replace(' ', 'T');
    }
    
    $('#submit-request').click(function () {
        const requestData = {
            request_type: $('#request_type').text(),
            start_time: formatDateTime($('#start_time').val()),
            end_time: formatDateTime($('#end_time').val()),
            reason: $('#reason').val()
        };
    
        createRequest(requestData);
    });
});
