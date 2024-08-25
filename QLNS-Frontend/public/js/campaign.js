$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id')
    if(id!=null)
        $.ajax({
            url: `http://localhost:5000/activities/${id}`,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#name_0').val(data.name);
                $('#type').val(data.sport_type);
                $('#sport_type').val(data.sport_type);
                $('#start_date').val(new Date(data.start_date).toISOString().split('T')[0]);
                $('#end_date').val(new Date(data.start_date).toISOString().split('T')[0]);
                $('#elapsed_time').val(`${Math.floor(data.elapsed_time / 3600)}h ${Math.floor((data.elapsed_time % 3600) / 60)}m`);
                $('#description').val(data.description);
                $('#distance').val(data.distance);
                const activity = data;
                const fields = [
                    { label: 'Calories', value: activity.calories },
                    { label: 'Average Speed (km/h)', value: activity.average_speed },
                    { label: 'Max Speed (km/h)', value: activity.max_speed },
                    { label: 'Comments Count', value: activity.comment_count },
                    { label: 'Kudos Count', value: activity.kudos_count },
                    { label: 'Photos Count', value: activity.photos.count },
                    { label: 'Visibility', value: activity.visibility }
                ];

                let html = '';
                fields.forEach(field => {
                    html += `
                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                            <div class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                <label class="o_form_label o_form_label_empty o_form_label_readonly" for="${field.label.toLowerCase().replace(/ /g, '_')}">${field.label}</label>
                            </div>
                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break" style="width: 100%;">
                                <div class="o_field_widget o_readonly_modifier o_field_empty o_field_datetime">
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="text-truncate">${field.value}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $('#activity-details').append(html);
            },
            error: function() {
                $('#activity-details').html('<p>An error occurred while fetching activity details.</p>');
            }
        });
    else
        $.ajax({
            url: `http://localhost:5000/activities/${12229051364}`,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // const activities = Array.isArray(data) ? data : [data];
                const activities = [
                    {
                        id:12229051364,
                        name:"RUN",
                        type:"RUN",
                        start_date:"",
                        end_date:""
                    }
                ];
                let rowsHtml = '';
                for (let i = 0; i < activities.length; i++) {
                    const activity = activities[i];
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
                                ${activity.type}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="start_date" data-tooltip="${new Date(activity.start_date).toLocaleDateString()}">
                                ${new Date(activity.start_date).toLocaleDateString()}
                            </td>
                            <td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="end_date" data-tooltip="${activity.end_date ? new Date(activity.end_date).toLocaleDateString() : ''}">
                                ${activity.end_date ? new Date(activity.end_date).toLocaleDateString() : ''}
                            </td>
                        </tr>
                    `;
                }
                rowsHtml+=`<tr>
                                <td colspan="5">​</td>
                            </tr>
                            <tr>
                                <td colspan="5">​</td>
                            </tr>
                            <tr>
                                <td colspan="5">​</td>
                            </tr>`
                $('#data-table').append(rowsHtml);
            },
            error: function() {
                $('#data-table').html('<tr><td colspan="5">An error occurred while fetching activity details.</td></tr>');
            }
        });
});
