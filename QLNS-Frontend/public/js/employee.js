$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    const type = urlParams.get("type");
    var token = Cookies.get("token");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    function minutesToHHMM(minutes) {
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;
        return `${String(hours).padStart(2, '0')}:${String(mins).padStart(2, '0')}`;
    }
    var page = 1;
    var max_page = 1;



    function load() {
        $('.o_pager_value').text(page)
        if (id != null) {
            if (type == "employee")
                $.ajax({
                    url: `http://127.0.0.1:8000/api/employees/${id}`,
                    method: "GET",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    dataType: "json",
                    success: function (data) {
                        $("#employee-id").val(data.employee.employee_id || "");
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
            if (type == "check-in-out") {
                var userId = getCookie("id");
                const cur_month = new Date().getUTCMonth() + 1;
                const cur_year = new Date().getUTCFullYear();
                $.ajax({
                    url: `http://localhost:8000/api/request/timesheet/${userId}/1/${cur_month}/${cur_year}`,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (data) {
                        let rowsHtml = "";
                        var group_date = [];
                        for (let i = 0; i < data.requests.length; i++) {
                            const element = data.requests[i].request;
                            const request_date = new Date(element.request_date); // Ensure request_date is a Date object
                            const request_type = element.request_type;

                            const day = request_date.getUTCDate();
                            const month = request_date.getUTCMonth() + 1;
                            const year = request_date.getUTCFullYear();

                            let is_exists = false;

                            for (let index = 0; index < group_date.length; index++) {
                                if (group_date[index].key === `${year}/${month}/${day}`) {
                                    is_exists = true;

                                    if (request_type === "CHECK_IN") {
                                        group_date[index] = { ...group_date[index], start_date: request_date };
                                    } else if (request_type === "CHECK_OUT") {
                                        group_date[index] = { ...group_date[index], end_date: request_date };
                                    }

                                    if (group_date[index].start_date && group_date[index].end_date) {
                                        const startDate = new Date(group_date[index].start_date);
                                        const endDate = new Date(group_date[index].end_date);
                                        const diffTime = endDate - startDate;
                                        const diffMinutes = Math.floor(diffTime / (1000 * 60));
                                        group_date[index] = { ...group_date[index], time: diffMinutes };
                                    }
                                    break;
                                }
                            }
                            if (!is_exists) {
                                group_date.push({
                                    key: `${year}/${month}/${day}`,
                                    time: 0,
                                    start_date: request_type === "CHECK_IN" ? request_date : "",
                                    end_date: request_type === "CHECK_OUT" ? request_date : "",
                                });
                            }
                        }

                        for (let i = 0; i < group_date.length; i++) {
                            const element = group_date[i];
                            rowsHtml += `
                            <tr>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="start_date" data-tooltip="
                                ${element.start_date ? new Date(element.start_date).toLocaleString() : ""}">
                                ${element.start_date ? new Date(element.start_date).toLocaleString() : ""}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="end_date" data-tooltip="${
                                    element.end_date? new Date(element.end_date).toLocaleString(): ""}">
                                    ${element.end_date? new Date(element.end_date).toLocaleString(): ""}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_required_modifier" data-tooltip-delay="1000" tabindex="-1" name="type" data-tooltip="${
                                    element.time
                                }">
                                    ${element.time ? minutesToHHMM(element.time): "00:00"}
                                </td>
                            </tr>
                        `;
                        }
                        rowsHtml += `<tr>
                                    <td colspan="3">​</td>
                                </tr>
                                <tr>
                                    <td colspan="3">​</td>
                                </tr>
                                <tr>
                                    <td colspan="3">​</td>
                                </tr>`;
                        $("#data-table").append(rowsHtml);
                    },
                    error: function () {
                        $("#data-table").html(
                            '<tr><td colspan="5">An error occurred while fetching details.</td></tr>'
                        );
                    },
                });
            } else if (type == "employee")
                $.ajax({
                    url: `http://127.0.0.1:8000/api/employees/getAll/null/${page}`,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (data) {
                        const employees = Array.isArray(data.employees) ? data.employees : [data.employees];
                        let rowsHtml = "";
                        max_page = data.totalPages;
                        $(".o_pager_limit").text(max_page);
                        employees.forEach((employee) => {
                            rowsHtml += `
                                <tr onclick="window.location.href = '/employees/form?type=employee&id=${employee.employee_id}';" class="o_data_row text-info" data-id="datapoint_${employee.employee_id}">
                                    <td class="o_list_record_selector user-select-none" tabindex="-1">
                                        <div class="o-checkbox form-check">
                                            <input type="checkbox" class="form-check-input" name="id" id="checkbox-${employee.employee_id}" value="${employee.employee_id}"/>
                                            <label class="form-check-label" for="checkbox-${employee.employee_id}"></label>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_char" data-tooltip-delay="1000" tabindex="-1" name="name" data-tooltip="${employee.name}">
                                        ${employee.name}
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell" data-tooltip-delay="1000" tabindex="-1" name="job" data-tooltip="${employee.job}">
                                        <div name="job" class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                            <div class="d-flex align-items-center gap-1">
                                                <span><span>${employee.dob}</span></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_required_modifier" data-tooltip-delay="1000" tabindex="-1" name="position" data-tooltip="${employee.position}">
                                        ${employee.address}
                                    </td>
                                </tr>
                            `;
                        });

                        rowsHtml += `
                            <tr><td colspan="4">​</td></tr>
                            <tr><td colspan="4">​</td></tr>
                            <tr><td colspan="4">​</td></tr>
                        `;

                        $("#data-table").html(rowsHtml);
                    },
                    error: function () {
                        $("#data-table").html(
                            '<tr><td colspan="4">An error occurred while fetching employee details.</td></tr>'
                        );
                    },
                });
        }
    }
    load()
    $(".o_pager_previous").click(function () {
        if (page > 1) {
            page -= 1;
            load()
        }
    });
    $(".o_pager_next").click(function () {
        if (page < max_page) {
            page += 1;
            load()
        }
    });
    $("#create-employee").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "/employees/add",
            method: "POST",
            data: formData,
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                window.location.href = "/employees?type=employee";
            },
            error: function (xhr) {
                console.error("Request failed:", xhr.responseText);
            },
        });
    });
    $("form#check-in").on("submit", function (event) {
        event.preventDefault();
        const userId = getCookie("id");
        $.ajax({
            url: "/check-in",
            method: "POST",
            data: {
                employee_id: userId,
            },
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.success) {
                    const message = JSON.parse(response.message);
                    if (!message.message.includes("checked")) {
                        if (message.status.includes("successfully")) {
                            window.location.href = "/check-in-out?checked=1";
                        }
                    } else window.location.href = "/check-in-out?checked=1";
                } else {
                    alert("An error occurred: " + response.message);
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });
    $("form#check-out").on("submit", function (event) {
        event.preventDefault();
        const userId = getCookie("id");
        const currentDateTime = new Date().toISOString();
        $.ajax({
            url: "/check-out",
            method: "POST",
            data: {
                employee_id: userId,
            },
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = "/check-in-out";
                } else {
                    alert("An error occurred: " + response.message);
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });
    $("form#edit-employee").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: `http://127.0.0.1:8000/api/employees/${id}`,
            method: "PUT",
            data: formData,
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                console.log(response)
                if (response.status) alert("Cập nhật thành công !!!");
            },
            error: function (xhr) {
                console.error("Request failed:", xhr.responseText);
            },
        });
    });
});
