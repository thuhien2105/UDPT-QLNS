$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
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

    function loadRequests() {
        $('.o_pager_value').text(page);
        const cur_month = new Date().getUTCMonth() + 1;
        const cur_year = new Date().getUTCFullYear();
        let url = "";

        if (type === "timesheet") {
            url = `http://127.0.0.1:8000/api/requests/timesheet/${page}/${cur_month}/${cur_year}`;
        } else {
            url = `http://127.0.0.1:8000/api/requests/${page}/${cur_month}/${cur_year}`;
        }

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

                requests.forEach((request) => {
                    rowsHtml += `
                        <tr class="o_data_row text-info" data-id="datapoint_${request.id}">
                            <td class="o_list_record_selector user-select-none" tabindex="-1">
                                <div class="o-checkbox form-check">
                                    <input type="checkbox" class="form-check-input" name="id" value="${request.id}"/>
                                    <label class="form-check-label"></label>
                                </div>
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="type">
                                ${request.request_type}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_date" tabindex="-1" name="start_date">
                                ${request.start_time ? new Date(request.start_time).toLocaleString() : ""}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_date" tabindex="-1" name="end_date">
                                ${request.end_time ? new Date(request.end_time).toLocaleString() : ""}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="duration">
                                ${request.duration ? minutesToHHMM(request.duration) : "00:00"}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="status">
                                ${request.status}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" tabindex="-1" name="actions">
                                <button class="btn btn-success approve-btn" data-id="${request.id}">Approve</button>
                            </td>
                        </tr>
                    `;
                });

                rowsHtml += `
                    <tr><td colspan="7">​</td></tr>
                    <tr><td colspan="7">​</td></tr>
                    <tr><td colspan="7">​</td></tr>
                `;

                $("#data-table").html(rowsHtml);
            },
            error: function () {
                $("#data-table").html(
                    '<tr><td colspan="7">An error occurred while fetching requests.</td></tr>'
                );
            },
        });
    }

    loadRequests();

    $(".o_pager_previous").click(function () {
        if (page > 1) {
            page -= 1;
            loadRequests();
        }
    });

    $(".o_pager_next").click(function () {
        if (page < max_page) {
            page += 1;
            loadRequests();
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
                    loadRequests();
                } else {
                    alert("Failed to approve request.");
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });
});
