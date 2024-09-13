$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    const q = urlParams.get("q");
    const type = urlParams.get("type");
    const category = urlParams.get("category");
    const brand = urlParams.get("brand");
    const token = Cookies.get("token");
    const userID = Cookies.get("id");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    var page = 1;
    var max_page = 1;

    const hasId = id !== null;
    const hasQ = q !== null;
    const hasType = type !== null;
    const hasCategory = category !== null;
    const hasBrand = brand !== null;

    $.ajax({
        url: `http://localhost:8000/api/reward/employee/${userID}`,
        method: "GET",
        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
        success: function (response) {
            const data = response.response
            $("#point_0").text(` - ${data.point} Points`);
        },
        error: function () {},
    });

    function load() {
        $(".o_pager_value").text(page);
        if (hasType) {
            if (type == "category") {
                var url = `http://localhost:8000/api/gift/category/list?page=${page}`;
                if (hasQ) {
                    url += `&q=${q}`;
                }
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        const data = response.response.items;
                        max_page = response.response.total_page;
                        $(".o_pager_limit").text(max_page);
                        let rowsHtml = "";
                        for (let i = 0; i < data.length; i++) {
                            const element = data[i];
                            rowsHtml += `
                                <tr class="o_data_row text-info" data-id="datapoint_${element.id}">
                                    <td class="o_list_record_selector user-select-none" tabindex="-1">
                                        <div class="o-checkbox form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-comp-${i}" /><label
                                                class="form-check-label" for="checkbox-comp-${i}"></label>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                        data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                        data-tooltip="${element.title}">
                                        <div name="request_owner_id"
                                            class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                            <div class="d-flex align-items-center gap-1" data-tooltip="${element.title}">
                                                <span class="o_avatar o_m2o_avatar"><img class="rounded"
                                                        src="${element.images}" /></span><span><span>${element.title}</span></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                        data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                        data-tooltip="${element.title}">
                                        <div name="request_owner_id"
                                            class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                            <div class="d-flex align-items-center gap-1" data-tooltip="${element.title}">
                                                <button onclick="window.location.href = '/gifts/gifts?category=${element.id}&type=gift';" class="btn btn-primary btn-sm oe_kanban_action oe_kanban_action_button"
                                                    name="create_request" type="object"
                                                    data-tooltip-template="views.ViewButtonTooltip"
                                                    data-tooltip-info='{"debug":true,"button":{"context":"{&apos;category_id&apos;:id}","type":"object","name":"create_request"},"context":{"lang":"en_US","tz":"Asia/Saigon","uid":2,"allowed_company_ids":[1]},"model":"approval.category"}'>
                                                    Go to Gifts</button>
                                            </div>
                                        </div>
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
                        $("#data-table").empty();
                        $("#data-table").append(rowsHtml);
                    },
                    error: function () {
                        $("#data-table").html(
                            '<tr><td colspan="5">An error occurred while fetching activity details.</td></tr>'
                        );
                    },
                });
            } else if (type == "brand") {
                if (hasId) {
                    $.ajax({
                        url: `http://localhost:8000/api/gift/brand/${id}`,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response
                            $("#name_0").val(data.title);
                            $("#title_0").text(data.title);
                            $("#description_0").val(data.mota);
                            $("#link_0").text(data.link);
                            $("#link_0").attr("href", data.link);
                            $("#image_1920").attr("src", data.image_src);
                            const office = data.office;
                            let rowsHtml = "";
                            if (office && office.length) {
                                office.forEach((element, index) => {
                                    rowsHtml += `
                                        <tr class="o_data_row o_row_draggable o_is_false" data-id="${
                                            element.id
                                        }">
                                        <td style="width='80px'" class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${index + 1}</span>
                                                </div>
                                            </td>
                                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${
                                                        element.address
                                                    }</span>
                                                </div>
                                            </td>
                                        </tr>
                                    `;
                                });
                            } else {
                                rowsHtml =
                                    '<tr><td colspan="8">No orders found</td></tr>';
                            }
                            $("#details").empty();
                            $("#details").append(rowsHtml);
                        },
                        error: function () {
                            $("#details").html(
                                "<p>An error occurred while fetching address details.</p>"
                            );
                        },
                    });
                } else {
                    var url = `http://localhost:8000/api/gift/brand/list?page=${page}`;
                    if (hasQ) {
                        url += `&q=${q}`;
                    }
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response.items;
                            max_page = response.response.total_page;
                            $(".o_pager_limit").text(max_page);
                            let rowsHtml = "";
                            for (let i = 0; i < data.length; i++) {
                                const element = data[i];
                                rowsHtml += `
                                    <tr class="o_data_row text-info" data-id="datapoint_${element.id}">
                                        <td class="o_list_record_selector user-select-none" tabindex="-1">
                                            <div class="o-checkbox form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-comp-${i}" /><label
                                                    class="form-check-label" for="checkbox-comp-${i}"></label>
                                            </div>
                                        </td>
                                        <td onclick="window.location.href = '/gifts/brands/form?id=${element.id}&type=brand';" class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${element.title}">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${element.title}">
                                                    <span class="o_avatar o_m2o_avatar"><img class="rounded"
                                                            src="${element.images}" /></span><span><span>${element.title}</span></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${element.title}">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${element.title}">
                                                    <button onclick="window.location.href = '/gifts/gifts?brand=${element.id}&type=gift';" class="btn btn-primary btn-sm oe_kanban_action oe_kanban_action_button"
                                                        name="create_request" type="object"
                                                        data-tooltip-template="views.ViewButtonTooltip"
                                                        data-tooltip-info='{"debug":true,"button":{"context":"{&apos;category_id&apos;:id}","type":"object","name":"create_request"},"context":{"lang":"en_US","tz":"Asia/Saigon","uid":2,"allowed_company_ids":[1]},"model":"approval.category"}'>
                                                        Go to Gifts</button>
                                                </div>
                                            </div>
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
                            $("#data-table").empty();
                            $("#data-table").append(rowsHtml);
                        },
                        error: function () {
                            $("#data-table").html(
                                '<tr><td colspan="5">An error occurred while fetching activity details.</td></tr>'
                            );
                        },
                    });
                }
            } else if (type == "gift") {
                if (hasId) {
                    $.ajax({
                        url: `http://localhost:8000/api/gift/${id}`,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response
                            $("#name_0").val(data.name);
                            $("#title_0").text(data.name);
                            $("#link_0").text(data.brand.title);
                            const office = data.office;
                            let rowsHtml = "";
                            if (office && office.length) {
                                office.forEach((element, index) => {
                                    rowsHtml += `
                                        <tr class="o_data_row o_row_draggable o_is_false" data-id="${
                                            element.id
                                        }">
                                        <td style="width='80px'" class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${index + 1}</span>
                                                </div>
                                            </td>
                                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${
                                                        element.address
                                                    }</span>
                                                </div>
                                            </td>
                                        </tr>
                                    `;
                                });
                            } else {
                                rowsHtml =
                                    '<tr><td colspan="8">No orders found</td></tr>';
                            }
                            $("#address").empty();
                            $("#address").append(rowsHtml);

                            rowsHtml = "";
                            const details = data.detail;
                            if (details && details.length) {
                                details.forEach((element, index) => {
                                    rowsHtml += `
                                        <tr class="o_data_row o_row_draggable o_is_false" data-id="${
                                            element.id
                                        }"
                                        onclick="window.location.href = '/gifts/gifts/sub-item/form?id=${
                                            element.id
                                        }&gift_id=${id}&type=sub-item';"
                                        >
                                            <td style="width='80px'" class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${index + 1}</span>
                                                </div>
                                            </td>
                                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${
                                                        element.title
                                                    }</span>
                                                </div>
                                            </td>
                                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${
                                                        element.price_format
                                                    }</span>
                                                </div>
                                            </td>
                                        </tr>
                                    `;
                                });
                            } else {
                                rowsHtml =
                                    '<tr><td colspan="8">No orders found</td></tr>';
                            }
                            $("#details").empty();
                            $("#details").append(rowsHtml);
                        },
                        error: function () {
                            $("#details").html(
                                "<p>An error occurred while fetching activity details.</p>"
                            );
                        },
                    });
                } else {
                    var url = `http://localhost:8000/api/gift/list?page=${page}`;
                    if (hasQ) {
                        url += `&q=${q}`;
                    }
                    if (hasCategory) {
                        url += `&category=${category}`;
                    }
                    if (hasBrand) {
                        url += `&brand=${brand}`;
                    }
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response.items;
                            max_page = response.response.total_page;
                            $(".o_pager_limit").text(max_page);
                            let rowsHtml = "";
                            for (let i = 0; i < data.length; i++) {
                                const element = data[i];
                                rowsHtml += `
                                    <tr onclick="window.location.href = '/gifts/gifts/form?id=${element.id}&type=gift';" class="o_data_row text-info" data-id="datapoint_${element.id}">
                                        <td class="o_list_record_selector user-select-none" tabindex="-1">
                                            <div class="o-checkbox form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-comp-${i}" /><label
                                                    class="form-check-label" for="checkbox-comp-${i}"></label>
                                            </div>
                                        </td>
                                        <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${element.name}">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${element.name}">
                                                    <span class="o_avatar o_m2o_avatar">
                                                    </span><span><span>${element.name}</span></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${element?.brand?.title}">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${element?.brand?.title}">
                                                    <span class="o_avatar o_m2o_avatar">
                                                    </span><span><span>${element?.brand?.title}</span></span>
                                                </div>
                                            </div>
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
                            $("#data-table").html("");
                            $("#data-table").append(rowsHtml);
                        },
                        error: function () {
                            $("#data-table").html(
                                '<tr><td colspan="5">An error occurred while fetching activity details.</td></tr>'
                            );
                        },
                    });
                }
            } else if (type == "sub-item") {
                if (hasId) {
                    const gift_id = urlParams.get("gift_id");
                    $.ajax({
                        url: `http://localhost:8000/api/gift/${gift_id}/${id}`,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response
                            $("#name_0").val(data.title);
                            $("#title_0").text(data.title);
                            $("#link_0").val(data.images);
                            $("#image_1920").attr("src", data.images);
                            $("#brand_0").val(data.brand.title);
                            $("#price_0").val(data.price_format);
                            let rowsHtml = "";
                            const details = data.detail;
                            if (details && details.length) {
                                details.forEach((element, index) => {
                                    rowsHtml += `
                                        <tr class="o_data_row o_row_draggable o_is_false" data-id="${
                                            element.id
                                        }"
                                        onclick="window.location.href = '/gifts/gifts/sub-item/form?id=${
                                            element.id
                                        }&gift_id=${id}&type=sub-item';">
                                        <td style="width='80px'" class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${index + 1}</span>
                                                </div>
                                            </td>
                                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${
                                                        element.title
                                                    }</span>
                                                </div>
                                            </td>
                                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell">
                                                <div name="product_template_id" class="o_field_widget o_field_sol_product_many2one">
                                                    <span>${
                                                        element.price_format
                                                    }</span>
                                                </div>
                                            </td>
                                        </tr>
                                    `;
                                });
                            } else {
                                rowsHtml =
                                    '<tr><td colspan="8">No orders found</td></tr>';
                            }
                            $("#details").empty();
                            $("#details").append(rowsHtml);
                        },
                        error: function () {
                            $("#details").html(
                                "<p>An error occurred while fetching activity details.</p>"
                            );
                        },
                        error: function () {
                            $("#details").html(
                                "<p>An error occurred while fetching address details.</p>"
                            );
                        },
                    });
                }
            } else if (type == "manager") {
                if (hasId) {
                    var url = `http://localhost:8000/api/reward/employee/${userID}/gift/${id}`;
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response
                            $("#name_0").val(data.gift_name);
                            $("#title_0").text(data.gift_name);
                            $("#image_1920").attr("src", data.gift_image);
                            $("#qr_0").attr(
                                "src",
                                "http://localhost:5000" + data.gift_qr
                            );
                            $("#code_0").text(data.gift_code);
                            $("#points_0").text(
                                data.gift_price_format.split(" ")[0]
                            );
                        },
                        error: function () {},
                    });
                } else {
                    var url = `http://localhost:8000/api/reward/employee/${userID}/gift?page=${2}`;
                    if (hasQ) {
                        url += `&q=${q}`;
                    }
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                    headers: {
                        Authorization: "Bearer " + token,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                        success: function (response) {
                            const data = response.response.items;
                            max_page = response.response.total_page;
                            $(".o_pager_limit").text(max_page);
                            let rowsHtml = "";
                            for (let i = 0; i < data.length; i++) {
                                const element = data[i];
                                rowsHtml += `
                                    <tr onclick="window.location.href = '/gifts/manager/form?id=${
                                        element.id
                                    }&type=manager';" class="o_data_row text-info" data-id="datapoint_${
                                    element.id
                                }">
                                        <td class="o_list_record_selector user-select-none" tabindex="-1">
                                            <div class="o-checkbox form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-comp-${i}" /><label
                                                    class="form-check-label" for="checkbox-comp-${i}"></label>
                                            </div>
                                        </td>
                                        <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${element.gift_name}">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${
                                                    element.gift_name
                                                }">
                                                    <span class="o_avatar o_m2o_avatar"><img class="rounded"
                                                            src="${
                                                                element.gift_image
                                                            }" /></span><span><span>${
                                    element.gift_name
                                }</span></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${element.gift_code}">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${
                                                    element.gift_code
                                                }"><span><span>${
                                    element.gift_code
                                }</span></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell"
                                            data-tooltip-delay="1000" tabindex="-1" name="request_owner_id"
                                            data-tooltip="${
                                                element.gift_price_format.split(
                                                    " "
                                                )[0]
                                            }">
                                            <div name="request_owner_id"
                                                class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                <div class="d-flex align-items-center gap-1" data-tooltip="${
                                                    element.gift_price_format.split(
                                                        " "
                                                    )[0]
                                                }"><span><span>${
                                    element.gift_price_format.split(" ")[0]
                                }</span></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                            }
                            rowsHtml += `<tr>
                                            <td colspan="4">​</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">​</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">​</td>
                                        </tr>`;
                            $("#data-table").empty();
                            $("#data-table").append(rowsHtml);
                        },
                        error: function () {
                            $("#data-table").html(
                                '<tr><td colspan="5">An error occurred while fetching activity details.</td></tr>'
                            );
                        },
                    });
                }
            }
        } else {
            window.location.href = "/";
        }
    }
    load();
    $(".o_pager_previous").click(function () {
        if (page > 1) {
            page -= 1;
            load();
        }
    });
    $(".o_pager_next").click(function () {
        if (page < max_page) {
            page += 1;
            load();
        }
    });
    $("#action_confirm").click(function () {
        const gift_id = urlParams.get("gift_id");
        $.ajax({
            url: `http://localhost:8000/api/gift/${gift_id}/${id}`,
            method: "POST",
            dataType: "json",
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            data: ({
                employee_id: userID,
                id,
            }),
            headers: {
                Authorization: "Bearer " + token,
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (data) {
                $("#point_0").text(` - ${data.point} Points`);
            },
            error: function () {},
        });
    });
});
