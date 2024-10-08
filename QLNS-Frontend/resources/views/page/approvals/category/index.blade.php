@extends('layout.master')
@section('content')
@include('page.approvals.header')

<div class="o_action_manager">
    <div class="o_kanban_view o_modules_kanban o_view_controller o_action">
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
                                <div class="o_cp_buttons d-empty-none d-flex align-items-baseline gap-1" role="toolbar"
                                    aria-label="Main actions"></div>
                            </ul>
                        </div>
                        <div class="d-none d-xl-inline-flex gap-1">
                            <div class="o_cp_buttons d-empty-none d-flex align-items-baseline gap-1" role="toolbar"
                                aria-label="Main actions"></div>
                        </div>
                    </div>
                    <div class="o_breadcrumb d-flex gap-1 text-truncate">
                        <div class="o_last_breadcrumb_item active d-flex fs-4 min-w-0 align-items-center">
                            <span class="min-w-0 text-truncate" id="title_0">Dashboard</span>
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
                    <div class="o_cp_pager text-nowrap " role="search">
                        <nav class="o_pager d-flex gap-2 h-100" aria-label="Pager"><span
                                class="o_pager_counter align-self-center"><span
                                    class="o_pager_value d-inline-block border-bottom border-transparent mb-n1">1-80</span><span>
                                    / </span><span class="o_pager_limit">1356</span></span><span
                                class="btn-group d-print-none" aria-atomic="true"><button type="button"
                                    class="fa fa-chevron-left btn btn-secondary o_pager_previous px-2 rounded-start"
                                    aria-label="Previous" data-tooltip="Previous" tabindex="-1" data-hotkey="p"
                                    title=""></button><button type="button"
                                    class="fa fa-chevron-right btn btn-secondary o_pager_next px-2 rounded-end"
                                    aria-label="Next" data-tooltip="Next" tabindex="-1" data-hotkey="n"></button></span>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <div class="o_content">
            <div
                class="o_kanban_renderer o_renderer d-flex o_kanban_ungrouped align-content-start flex-wrap justify-content-start">
                <div role="article" class="o_kanban_record d-flex flex-grow-1 flex-md-shrink-1 flex-shrink-0"
                    data-id="datapoint_180" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy" src="/image/wfh.png" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Work From Home</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=WFH';"
                                    data-id="datapoint_${employee.employee_id}"
                                    class="btn btn-primary btn-sm oe_kanban_action oe_kanban_action_button"
                                    style="margin-left: auto" name="create_request" type="object"
                                    data-tooltip-template="views.ViewButtonTooltip"
                                    data-tooltip-info='{"debug":true,"button":{"context":"{&apos;category_id&apos;:id}","type":"object","name":"create_request"},"context":{"lang":"en_US","tz":"Asia/Saigon","uid":2,"allowed_company_ids":[1]},"model":"approval.category"}'>
                                    New Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="article" class="o_kanban_record d-flex flex-grow-1 flex-md-shrink-1 flex-shrink-0"
                    data-id="datapoint_181" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy" src="/image/leave.png" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Leave</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=LEAVE';"
                                    data-id="datapoint_${employee.employee_id}"
                                    class="btn btn-primary btn-sm oe_kanban_action oe_kanban_action_button"
                                    style="margin-left: auto" name="create_request" type="object"
                                    data-tooltip-template="views.ViewButtonTooltip"
                                    data-tooltip-info='{"debug":true,"button":{"context":"{&apos;category_id&apos;:id}","type":"object","name":"create_request"},"context":{"lang":"en_US","tz":"Asia/Saigon","uid":2,"allowed_company_ids":[1]},"model":"approval.category"}'>
                                    New Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="o_kanban_record o_kanban_ghost flex-grow-1 flex-md-shrink-1 flex-shrink-0 my-0"></div>
                <div class="o_kanban_record o_kanban_ghost flex-grow-1 flex-md-shrink-1 flex-shrink-0 my-0"></div>
                <div class="o_kanban_record o_kanban_ghost flex-grow-1 flex-md-shrink-1 flex-shrink-0 my-0"></div>
                <div class="o_kanban_record o_kanban_ghost flex-grow-1 flex-md-shrink-1 flex-shrink-0 my-0"></div>
                <div class="o_kanban_record o_kanban_ghost flex-grow-1 flex-md-shrink-1 flex-shrink-0 my-0"></div>
                <div class="o_kanban_record o_kanban_ghost flex-grow-1 flex-md-shrink-1 flex-shrink-0 my-0"></div>
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
@endsection