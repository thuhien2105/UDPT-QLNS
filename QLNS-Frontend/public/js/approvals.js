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
        return `${String(hours).padStart(
            2,
            "0"
        )}:${String(mins).padStart(2, "0")}`;
    }

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

    function loadRequests(monthYear, status) {
        $(".o_pager_value").text(page);
        let [year, month] = monthYear.split("-");
        let url = `http://127.0.0.1:8000/api/requests/${page}/${month}/${year}?status=${status}`;

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
                    '<tr><td colspan="8">Loading...</td></tr>'
                );
            },
            success: function (data) {
                let rowsHtml = "";
                const requests = Array.isArray(data.requests)
                    ? data.requests
                    : [data.requests];
                max_page = data.totalPages;
                $(".o_pager_limit").text(max_page);

                requests.forEach((item) => {
                    const request = item.request;
                    const employee = item.employee;

                    rowsHtml += `
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
                        <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="actions">
                            ${
                                request.status !== "REJECTED" &&
                                request.status !== "APPROVED"
                                    ? `
                                <button class="btn btn-success approve-btn me-2" data-id="${request.id}">Approve</button>
                                <button class="btn btn-danger reject-btn" data-id="${request.id}">Reject</button>
                            `
                                    : ""
                            }
                        </td>
                    </tr>
                `;
                });

                // Add empty rows for spacing
                rowsHtml += `
                    <tr><td colspan="8">​</td></tr>
                    <tr><td colspan="8">​</td></tr>
                    <tr><td colspan="8">​</td></tr>
                `;

                $("#data-table tbody").html(rowsHtml);
            },
            error: function () {
                $("#data-table tbody").html(
                    '<tr><td colspan="8">An error occurred while fetching requests.</td></tr>'
                );
            },
        });
    }

    if (type) {
        $("#request_type").text(formatRequestType(type));
    }

    const initialMonthYear = new Date().toISOString().slice(0, 7); // YYYY-MM format
    const initialStatus = $("#statusPicker").val();
    loadRequests(initialMonthYear, initialStatus);

    $("#monthYearPicker").on("change", function () {
        const selectedMonthYear = $(this).val();
        const selectedStatus = $("#statusPicker").val();
        loadRequests(selectedMonthYear, selectedStatus);
    });

    $("#statusPicker").on("change", function () {
        const selectedStatus = $(this).val();
        const selectedMonthYear = $("#monthYearPicker").val();
        loadRequests(selectedMonthYear, selectedStatus);
    });

    $(".o_pager_previous").click(function () {
        if (page > 1) {
            page -= 1;
            loadRequests($("#monthYearPicker").val(), $("#statusPicker").val());
        }
        updatePaginationButtons();
    });

    $(".o_pager_next").click(function () {
        if (page < max_page) {
            page += 1;
            loadRequests($("#monthYearPicker").val(), $("#statusPicker").val());
        }
        updatePaginationButtons();
    });

    function updatePaginationButtons() {
        $(".o_pager_previous").prop("disabled", page <= 1);
        $(".o_pager_next").prop("disabled", page >= max_page);
    }

    $("#data-table").on("click", ".approve-btn", function () {
        const requestId = $(this).data("id");

        $.ajax({
            url: `http://127.0.0.1:8000/api/request/approve/${requestId}`,
            method: "POST",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            data: {
                status: "APPROVED",
            },
            success: function (response) {
                if (response.response) {
                    alert("Request approved successfully!");
                    loadRequests(
                        $("#monthYearPicker").val(),
                        $("#statusPicker").val()
                    );
                } else {
                    alert("Failed to approve request.");
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });

    $("#data-table").on("click", ".reject-btn", function () {
        const requestId = $(this).data("id");

        $.ajax({
            url: `http://127.0.0.1:8000/api/request/approve/${requestId}`,
            method: "POST",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            data: {
                status: "REJECTED",
            },
            success: function (response) {
                if (response.response) {
                    alert("Request rejected successfully!");
                    loadRequests(
                        $("#monthYearPicker").val(),
                        $("#statusPicker").val()
                    );
                } else {
                    alert("Failed to reject request.");
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });

    $("#create-request-form").on("submit", function (e) {
        e.preventDefault();

        const requestData = {
            request_type: $("#request_type").val(),
            start_time: $("#start_time").val(),
            end_time: $("#end_time").val(),
            reason: $("#reason").val(),
        };

        if (validateDates(requestData.start_time, requestData.end_time)) {
            createRequest(requestData);
        } else {
            alert("Start date must be earlier than end date.");
        }
    });

    function validateDates(startDate, endDate) {
        return new Date(startDate) < new Date(endDate);
    }

    function createRequest(data) {
        $.ajax({
            url: "http://127.0.0.1:8000/api/request/create",
            method: "POST",
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
                    loadRequests(
                        $("#monthYearPicker").val(),
                        $("#statusPicker").val()
                    );
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    }

    function formatDateTime(dateTimeString) {
        return dateTimeString.replace(" ", "T");
    }

    function validateDates(startDate, endDate) {
        return new Date(startDate) < new Date(endDate);
    }

    $("#submit-request").click(function () {
        const requestData = {
            request_type:
                $("#request_type").text() === "Work From Home"
                    ? "WFH"
                    : "LEAVE",
            start_time: formatDateTime($("#start_time").val()),
            end_time: formatDateTime($("#end_time").val()),
            reason: $("#reason").val(),
        };

        if (validateDates(requestData.start_time, requestData.end_time)) {
            createRequest(requestData);
        } else {
            alert("Start date must be earlier than end date.");
        }
    });
});
