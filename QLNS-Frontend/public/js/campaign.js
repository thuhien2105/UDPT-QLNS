$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    var token = Cookies.get("token");
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (id != null)
        $.ajax({
            url: `http://localhost:5000/activities/${id}`,
            method: "GET",
            dataType: "json",
            success: function (data) {
                $("#name_0").val(data.name);
                const activity = data;
                const fields = [
                    { label: "Type", value: activity.localized_sport_type },
                    { label: "Sport Type", value: activity.sport_type },
                    { label: "Participants", value: activity.member_count },
                ];

                let html = "";
                fields.forEach((field) => {
                    html += `
                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                            <div class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                <label class="o_form_label o_form_label_empty o_form_label_readonly" for="${field.label
                                    .toLowerCase()
                                    .replace(/ /g, "_")}">${field.label}</label>
                            </div>
                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break" style="width: 100%;">
                                <div class="o_field_widget o_readonly_modifier o_field_empty o_field_datetime">
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="text-truncate">${
                                            field.value
                                        }</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $("#activity-details").append(html);

                const participants = data.participants || [];

                var participantsHtml = "";

                participants.forEach((participant) => {
                    participantsHtml += `
                        <tr class="o_data_row o_row_draggable o_is_false" data-id="${participant.athlete.id}">
                            <td class="o_data_cell">${participant.name}</td>
                            <td class="o_data_cell">${participant.athlete.firstname} ${participant.athlete.lastname}</td>
                            <td class="o_data_cell" style="text-align: center;">${participant.total_elevation_gain}</td>
                            <td class="o_data_cell" style="text-align: center;">${participant.moving_time} seconds</td>
                            <td class="o_data_cell">${participant.elapsed_time} seconds</td>
                            <td class="o_data_cell" style="text-align: center;">${participant.distance} meters</td>
                        </tr>
                    `;
                });
                participantsHtml += `
                <tr><td colspan="6">​</td></tr>`;
                $("#data-table").html(participantsHtml);
            },
            error: function () {
                $("#activity-details").html(
                    "<p>An error occurred while fetching activity details.</p>"
                );
            },
        });
    else
        $.ajax({
            url: `http://localhost:5000/activities`,
            method: "GET",
            dataType: "json",
            success: function (data) {
                let rowsHtml = "";
                for (let i = 0; i < data.length; i++) {
                    const activity = data[i];
                    rowsHtml += `
                        <tr onclick="window.location.href = '/campaign/form?id=${activity.id}';" class="o_data_row text-info" data-id="${activity.id}">
                            <td class="o_list_record_selector user-select-none" tabindex="-1">
                                <div class="o-checkbox form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-${activity.id}" />
                                    <label class="form-check-label" for="checkbox-${activity.id}"></label>
                                </div>
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_char" data-tooltip-delay="1000" tabindex="-1" name="name" data-tooltip="${activity.name}">
                                ${activity.name}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_required_modifier" data-tooltip-delay="1000" tabindex="-1" name="type" data-tooltip="${activity.type}">
                                ${activity.id}
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
                    '<tr><td colspan="5">An error occurred while fetching activity details.</td></tr>'
                );
            },
        });
        $("#create-campaign").on("submit", function (event) {
            event.preventDefault();
            var formData = $(this).serializeArray();
            var data = {};
            $(formData).each(function(index, obj){
                data[obj.name] = obj.value;
            });

            $.ajax({
                url: "http://127.0.0.1:5000/activities",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(data),
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function (response) {
                    window.location.href = "/campaign";
                },
                error: function (xhr) {
                    console.error("Request failed:", xhr.responseText);
                },
            });
        });

});
