$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    const type = urlParams.get("type");
    if (id != null) {
        if (type == "employee")
            $.ajax({
                url: `http://localhost:5000/employees/${id}`, // Giả sử đây là URL API của bạn
                method: "GET",
                dataType: "json",
                success: function (data) {
                    // Cập nhật thông tin vào các trường trên giao diện
                    $("#name_0").val(data.name);
                    $("#location_0").val(data.dob); // Ngày sinh
                    $("#address_0").val(data.address); // Địa chỉ
                    $("#phone_number_0").val(data.phone_number); // Số điện thoại

                    // Cập nhật bảng (nếu có) với dữ liệu từ API
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

                    $("#data-table tbody").html(rowsHtml); // Cập nhật nội dung bảng
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
                url: `http://localhost:5000/employee`,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const employees = Array.isArray(data) ? data : [data];
                    let rowsHtml = "";
                    employees.forEach((employee) => {
                        rowsHtml += `
                            <tr onclick="window.location.href = '/employees/form?type=employee&id=${employee.id}';" class="o_data_row text-info" data-id="datapoint_${employee.id}">
                                <td class="o_list_record_selector user-select-none" tabindex="-1">
                                    <div class="o-checkbox form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-${employee.id}" />
                                        <label class="form-check-label" for="checkbox-${employee.id}"></label>
                                    </div>
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_char" data-tooltip-delay="1000" tabindex="-1" name="name" data-tooltip="${employee.name}">
                                    ${employee.name}
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell" data-tooltip-delay="1000" tabindex="-1" name="job" data-tooltip="${employee.job}">
                                    <div name="job" class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="o_avatar o_m2o_avatar"><img class="rounded" src="${employee.avatar}" /></span>
                                            <span><span>${employee.job}</span></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_required_modifier" data-tooltip-delay="1000" tabindex="-1" name="position" data-tooltip="${employee.position}">
                                    ${employee.position}
                                </td>
                            </tr>
                        `;
                    });

                    // Thêm các hàng trống vào bảng
                    rowsHtml += `
                        <tr><td colspan="4">​</td></tr>
                        <tr><td colspan="4">​</td></tr>
                        <tr><td colspan="4">​</td></tr>
                    `;

                    $("#data-table").html(rowsHtml); // Thay thế nội dung bảng
                },
                error: function () {
                    $("#data-table").html(
                        '<tr><td colspan="4">An error occurred while fetching employee details.</td></tr>'
                    );
                },
            });
    }
});

$("form#check-in").on("submit", function (event) {
    event.preventDefault();
    const userId = getCookie("userId");
    $.ajax({
        url: "/check-in",
        method: "POST",
        data: JSON.stringify({
            id: userId,
        }),
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
$("form#check-out").on("submit", function (event) {
    event.preventDefault();
    const userId = getCookie("userId");
    $.ajax({
        url: "/check-out",
        method: "POST",
        data: JSON.stringify({
            id: userId,
        }),
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
