@extends('layout.master')

@section('content')
@include('page.approvals.header')

<div class="o_action_manager">
    <div class="o_list_view o_view_controller o_action">
        <div class="o_control_panel d-flex flex-column gap-3 gap-lg-1 px-3 pt-2 pb-3" data-command-category="actions">
            <div
                class="o_control_panel_main d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-lg-start gap-3 flex-grow-1">
                <div class="o_control_panel_breadcrumbs d-flex align-items-center gap-1 order-0 h-lg-100">
                    <div class="o_control_panel_main_buttons d-flex gap-1 d-empty-none d-print-none">
                        <div class="d-xl-none o_control_panel_collapsed_create">
                            <button type="button"
                                class="btn btn-primary dropdown-toggle dropdown-toggle-split o_control_panel_collapsed_create d-none"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu o_control_panel_collapsed_create d-none">
                                <div class="o_list_buttons d-flex gap-1 d-empty-none align-items-baseline"
                                    role="toolbar" aria-label="Main actions"></div>
                            </ul>
                        </div>
                        <div class="d-none d-xl-inline-flex gap-1">
                            <div class="o_list_buttons d-flex gap-1 d-empty-none align-items-baseline" role="toolbar"
                                aria-label="Main actions"></div>
                        </div>
                    </div>
                    <div class="o_breadcrumb d-flex gap-1 text-truncate">
                        <div class="o_last_breadcrumb_item active d-flex fs-4 min-w-0 align-items-center">
                            <span class="min-w-0 text-truncate" id="title_0">My Requests</span>
                        </div>
                        <div class="o_control_panel_breadcrumbs_actions d-inline-flex">
                            <div class="o_cp_action_menus d-flex align-items-center pe-2 gap-1">
                                <div class="o-dropdown dropdown lh-1 o-dropdown--no-caret">
                                    <button type="button"
                                        class="dropdown-toggle d-print-none btn p-0 ms-1 lh-sm border-0" tabindex="0"
                                        aria-expanded="false">
                                        <i class="fa fa-cog" data-hotkey="u" data-tooltip="Actions"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="d-none d-xl-block me-auto"></span>
                </div>

                <!-- Thêm phần chọn tháng và năm -->
                <div class="d-flex align-items-center gap-3">
                    <div class="input-group">
                        <span class="input-group-text">Month & Year:</span>
                        <input type="month" class="form-control" id="monthYearPicker" name="monthYearPicker">
                    </div>
                </div>

                <div
                    class="o_control_panel_actions d-empty-none d-flex align-items-center justify-content-start justify-content-lg-around order-2 order-lg-1 w-100 w-lg-auto">
                    <div class="o_cp_searchview d-flex input-group" role="search">
                        <div class="o_searchview form-control d-print-contents d-flex align-items-center py-1"
                            role="search" aria-autocomplete="list">
                            <i class="o_searchview_icon d-print-none fa fa-search me-2" role="img"
                                aria-label="Search..." title="Search..."></i>
                            <div class="o_searchview_input_container d-flex flex-grow-1 flex-wrap gap-1">
                                <input type="text"
                                    class="o_searchview_input o_input d-print-none flex-grow-1 w-auto border-0"
                                    placeholder="Search..." role="searchbox" data-hotkey="Q" />
                            </div>
                        </div>
                        <div class="o-dropdown dropdown o-dropdown--no-caret">
                            <button type="button"
                                class="dropdown-toggle o_searchview_dropdown_toggler d-print-none btn btn-outline-secondary o-no-caret rounded-start-0 h-100"
                                tabindex="0" aria-expanded="false">
                                <i class="fa fa-caret-down" aria-hidden="true" data-hotkey="shift+q"
                                    title="Toggle Search Panel"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="o_control_panel_navigation d-flex flex-wrap flex-md-nowrap justify-content-end gap-3 gap-lg-1 gap-xl-3 order-1 order-lg-2 flex-grow-1">
                    <div class="o_cp_pager text-nowrap" role="search">
                        <nav class="o_pager d-flex gap-2 h-100" aria-label="Pager">
                            <span class="o_pager_counter align-self-center">
                                <span
                                    class="o_pager_value d-inline-block border-bottom border-transparent mb-n1">1</span>
                                <span>/</span>
                                <span class="o_pager_limit">1</span>
                                <span class="btn-group d-print-none" aria-atomic="true">
                                    <button type="button"
                                        class="fa fa-chevron-left btn btn-secondary o_pager_previous px-2 rounded-start"
                                        aria-label="Previous" data-tooltip="Previous" tabindex="-1" data-hotkey="p"
                                        title=""></button>
                                    <button type="button"
                                        class="fa fa-chevron-right btn btn-secondary o_pager_next px-2 rounded-end"
                                        aria-label="Next" data-tooltip="Next" tabindex="-1" data-hotkey="n"></button>
                                </span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="o_content">
            <div class="o_list_renderer o_renderer table-responsive o_list_renderer_1" tabindex="-1">
                <table
                    class="o_list_table table table-sm table-hover position-relative mb-0 o_list_table_ungrouped table-striped"
                    id="request_data-table" style="table-layout: fixed">
                    <thead>
                        <tr>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="name"
                                class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover"
                                style="width: 256px">
                                <div class="d-flex">Name</div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="request_owner_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer o_many2one_avatar_user_cell opacity-trigger-hover"
                                style="width: 302px">
                                <div class="d-flex">Request Type</div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="request_owner_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer o_many2one_avatar_user_cell opacity-trigger-hover"
                                style="width: 302px">
                                <div class="d-flex">Reason</div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="category_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover"
                                style="width: 203px">
                                <div class="d-flex">
                                    <span class="d-block min-w-0 text-truncate flex-grow-1">Date</span>
                                </div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="category_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover"
                                style="width: 203px">
                                <div class="d-flex">
                                    <span class="d-block min-w-0 text-truncate flex-grow-1">Start Time</span>
                                </div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="category_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover"
                                style="width: 203px">
                                <div class="d-flex">
                                    <span class="d-block min-w-0 text-truncate flex-grow-1">End Time</span>
                                </div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="category_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover"
                                style="width: 203px">
                                <div class="d-flex">
                                    <span class="d-block min-w-0 text-truncate flex-grow-1">Status</span>
                                </div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                            <th data-tooltip-delay="1000" tabindex="-1" data-name="category_id"
                                class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover"
                                style="width: 203px">
                                <div class="d-flex">
                                    <span class="d-block min-w-0 text-truncate flex-grow-1">Manage</span>
                                </div>
                                <span
                                    class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable" id="request_data-table tbody">
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                    <tfoot class="o_list_footer cursor-default">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="o-main-components-container">
    <div class="o-discuss-CallInvitations position-absolute top-0 end-0 d-flex flex-column p-2"></div>
    <div class="o-mail-ChatWindowContainer"></div>
    <div class="o-overlay-container"></div>
    <div></div>
    <div class="o_notification_manager o_upload_progress_toast"></div>
    <div class="o_notification_manager"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date
        const today = new Date();

        // Extract the current year and month
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based

        // Set the value of the monthYearPicker input
        const monthYearPicker = document.getElementById('monthYearPicker');

        // Check if monthYearPicker exists and is of type 'month'
        if (monthYearPicker && monthYearPicker.type === 'month') {
            monthYearPicker.value = `${year}-${month}`;
        } else {
            console.error('Month Year Picker input is missing or not of type month.');
        }
    });
</script>

@endsection