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
                            height="64" loading="lazy"
                            src="https://www.itilite.com/wp-content/uploads/2023/03/first-business-trip-tips-1024x536-1.jpg" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Business Trip</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=business_trip';"
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
                            height="64" loading="lazy"
                            src="https://libapps-au.s3-ap-southeast-2.amazonaws.com/accounts/29022/images/26245.jpg" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Borrow Items</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=borrow_items';"
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
                    data-id="datapoint_182" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="https://img.freepik.com/free-vector/approved-sign-with-shield-gradient_78370-1025.jpg?semt=ais_hybrid" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>General Approval</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=general_approval';"
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
                    data-id="datapoint_183" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="https://thumbs.dreamstime.com/b/document-shield-checkmark-vector-icon-document-shield-checkmark-vector-icon-filled-flat-sign-mobile-322581526.jpg" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Contract Approval</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=contract_approval';"
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
                    data-id="datapoint_184" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="https://cdn3.vectorstock.com/i/1000x1000/44/12/payment-app-icon-mobile-application-vector-35444412.jpg" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Payment Application</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=payment_application';"
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
                    data-id="datapoint_185" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="data:image/png;base64,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" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Car Rental Application</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=car_rental_application';"
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
                    data-id="datapoint_186" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="data:image/jpeg;base64,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" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Job Referral Award</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=job_referral_award';"
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
                    data-id="datapoint_187" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="data:image/png;base64,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" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Procurement</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=procurement';"
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
                    data-id="datapoint_188" tabindex="0">
                    <div class="oe_module_vignette">
                        <img alt="Approvals Types Image" class="oe_kanban_avatar float-start me-3" width="64"
                            height="64" loading="lazy"
                            src="data:image/jpeg;base64,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" />
                        <div class="oe_module_desc">
                            <h4 class="o_kanban_record_title">
                                <span>Create RFQ's</span>
                            </h4>
                            <p class="oe_module_name"><span></span></p>
                            <div class="oe_module_action" style="display: flex">
                                <button onclick="window.location.href = '/approvals/add?type=rfqs';"
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