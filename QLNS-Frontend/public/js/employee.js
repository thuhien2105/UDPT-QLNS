$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    const type = urlParams.get("type");
    var token = Cookies.get("token");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (id != null) {
        if (type == "employee")
            $.ajax({
                url: `http://127.0.0.1:8000/api/employees/${id}`,
                method: "GET",
                headers: {
                    Authorization: "Bearer " + csrfToken,
                },
                dataType: "json",
                success: function (data) {
                    $("#employee-id").val(data.employee.employeeId);
                    $("#name_0").val(data.employee.name);
                    $("#title_0").text(data.employee.name);
                    $("#dob_0").val(data.employee.dob);
                    $("#address_0").val(data.employee.address);
                    $("#phone_number_0").val(data.employee.phone_number);
                    let rowsHtml = "";
                    if (data.orders && data.orders.length) {
                        data.orders.forEach((order) => {
                            rowsHtml += `
                                <tr class="o_data_row o_row_draggable o_is_false" data-id="${
                                    order.id
                                }">
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number o_handle_cell">
                                        <div name="sequence" class="o_field_widget o_field_handle">
                                            <span class="o_row_handle oi oi-draggable ui-sortable-handle"></span>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                        <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                            <span>${order.product_name}</span>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                        <div name="description" class="o_field_widget o_field_sol_product_many2one">
                                            <span>${order.description}</span>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number">
                                        ${order.quantity}
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number">
                                        ${order.unit_price}
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_many2many_tags_cell">
                                        <div name="tax_id" class="o_field_widget o_field_many2many_tags">
                                            <div class="o_field_tags d-inline-flex flex-wrap gap-1">
                                                ${order.taxes
                                                    .map(
                                                        (tax) => `
                                                    <span class="o_tag position-relative d-inline-flex align-items-center user-select-none mw-100 o_badge badge rounded-pill lh-1 o_tag_color_0">
                                                        <div class="o_tag_badge_text text-truncate">${tax}</div>
                                                    </span>
                                                `
                                                    )
                                                    .join("")}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number o_readonly_modifier">
                                        $ ${order.subtotal}
                                    </td>
                                    <td class="o_list_record_remove text-center">
                                        <button class="fa fa-trash-o" name="delete" aria-label="Delete row"></button>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        rowsHtml =
                            '<tr><td colspan="8">No orders found</td></tr>';
                    }

                    $("#data-table tbody").html(rowsHtml);
                },
                error: function () {
                    $("#activity-details").html(
                        "<p>An error occurred while fetching employee details.</p>"
                    );
                },
            });
    } else {
        if (type == "check-in-out")
            $.ajax({
                url: `http://localhost:5000/activities/${12229051364}`,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const activities = [
                        {
                            name: "RUN",
                            start_date: "",
                            end_date: "",
                            time: "08:00",
                        },
                    ];
                    let rowsHtml = "";
                    for (let i = 0; i < activities.length; i++) {
                        const activity = activities[i];
                        rowsHtml += `
                        <tr>
                            <td class="o_list_record_selector user-select-none" tabindex="-1">
                                <div class="o-checkbox form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-${
                                        activity.id
                                    }" />
                                    <label class="form-check-label" for="checkbox-${
                                        activity.id
                                    }"></label>
                                </div>
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" data-tooltip-delay="1000" tabindex="-1" name="name" data-tooltip="${
                                activity.name
                            }">
                                ${activity.name}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="start_date" data-tooltip="${new Date(
                                activity.start_date
                            ).toLocaleDateString()}">
                                ${new Date(
                                    activity.start_date
                                ).toLocaleDateString()}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="end_date" data-tooltip="${
                                activity.end_date
                                    ? new Date(
                                          activity.end_date
                                      ).toLocaleDateString()
                                    : ""
                            }">
                                ${
                                    activity.end_date
                                        ? new Date(
                                              activity.end_date
                                          ).toLocaleDateString()
                                        : ""
                                }
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_required_modifier" data-tooltip-delay="1000" tabindex="-1" name="type" data-tooltip="${
                                activity.time
                            }">
                                ${activity.time}
                            </td>
                        </tr>
                    `;
                    }
                    rowsHtml += `<tr>
                                <td colspan="5">​</td>
                            </tr>
                            <tr>
                                <td colspan="5">​</td>
                            </tr>
                            <tr>
                                <td colspan="5">​</td>
                            </tr>`;
                    $("#data-table").append(rowsHtml);
                },
                error: function () {
                    $("#data-table").html(
                        '<tr><td colspan="5">An error occurred while fetching details.</td></tr>'
                    );
                },
            });
        else if (type == "employee")
            $.ajax({
                url: `http://127.0.0.1:8000/api/employees/null/1`,
                method: "GET",
                dataType: "json",
                headers: {
                    Authorization: "Bearer " + csrfToken,
                },
                success: function (data) {
                    const employees = Array.isArray(data) ? data : [data];
                    let rowsHtml = "";
                    employees.forEach((employee) => {
                        rowsHtml += `
                            <tr onclick="window.location.href = '/employees/form?type=employee&id=${employee.employeeId}';" class="o_data_row text-info" data-id="datapoint_${employee.employeeId}">
                                <td class="o_list_record_selector user-select-none" tabindex="-1">
                                    <div class="o-checkbox form-check">
                                        <input type="checkbox" class="form-check-input" name="id" id="checkbox-${employee.employeeId}" value="${employee.employeeId}"/>
                                        <label class="form-check-label" for="checkbox-${employee.employeeId}"></label>
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
    $("#create-employee").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "/employees/add",
            method: "POST",
            data: formData,
            headers: {
                Authorization: "Bearer " + csrfToken,
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
                    // window.location.href = "/check-in-out";
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
        const userId = getCookie("userId");
        const currentDateTime = new Date().toISOString();
        $.ajax({
            url: "/check-out",
            method: "POST",
            data: JSON.stringify({
                employee_id: userId,
                requestType: "Check Out",
                date: currentDateTime,
            }),
            headers: {
                Authorization: "Bearer " + csrfToken,
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
            url: "/employees/edit/1",
            method: "PUT",
            data: formData,
            headers: {
                Authorization: "Bearer " + csrfToken,
            },
            success: function (response) {
                if (response.status) alert("Cập nhật thành công !!!");
            },
            error: function (xhr) {
                console.error("Request failed:", xhr.responseText);
            },
        });
    });
});
