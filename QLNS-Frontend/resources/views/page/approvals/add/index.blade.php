@extends('layout.master')
@section('content')
@include('page.approvals.header')

<div class="o_action_manager">
    <div class="o_form_view o_view_controller o_action">
        <div class="o_form_view_container">
            <div class="o_control_panel d-flex flex-column gap-3 gap-lg-1 px-3 pt-2 pb-3"
                data-command-category="actions">
                <div
                    class="o_control_panel_main d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-lg-start gap-3 flex-grow-1">
                    <div class="o_control_panel_breadcrumbs d-flex align-items-center gap-1 order-0 h-lg-100">
                        <div class="o_control_panel_main_buttons d-flex gap-1 d-empty-none d-print-none">
                            <div class="d-xl-none o_control_panel_collapsed_create"><button type="button"
                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split o_control_panel_collapsed_create d-none"
                                    data-bs-toggle="dropdown" aria-expanded="false"><span class="visually-hidden">Toggle
                                        Dropdown</span></button>
                                <ul class="dropdown-menu o_control_panel_collapsed_create d-none"></ul>
                            </div>
                            <div class="d-none d-xl-inline-flex gap-1"></div>
                        </div>
                        <div
                            class="o_breadcrumb d-flex flex-row flex-md-column align-self-stretch justify-content-between min-w-0">
                            <ol class="breadcrumb flex-nowrap text-nowrap small lh-sm">
                                <li class="breadcrumb-item d-inline-flex min-w-0 o_back_button" data-hotkey="b"><a
                                        href="#" class="fw-bold text-truncate"
                                        data-tooltip="Back to &quot;My Requests&quot;">My Requests</a></li>
                            </ol>
                        </div>
                        <div class="o_form_status_indicator d-md-flex align-items-center align-self-md-end me-auto">
                            <div class="o_form_status_indicator_buttons d-flex invisible"><button type="button"
                                    class="o_form_button_save btn btn-light px-1 py-0 lh-sm" data-hotkey="s"
                                    data-tooltip="Save manually" aria-label="Save manually"><i
                                        class="fa fa-cloud-upload fa-fw"></i></button><button type="button"
                                    class="o_form_button_cancel btn btn-light px-1 py-0 lh-sm" data-hotkey="j"
                                    data-tooltip="Discard changes" aria-label="Discard changes"><i
                                        class="fa fa-undo fa-fw"></i></button></div>
                        </div><span class="d-none d-xl-block me-auto"></span>
                    </div>
                    <div
                        class="o_control_panel_actions d-empty-none d-flex align-items-center justify-content-start justify-content-lg-around order-2 order-lg-1 w-100 w-lg-auto">
                        <div class="o-form-buttonbox position-relative d-flex w-md-auto o_not_full"></div>
                    </div>
                    <div
                        class="o_control_panel_navigation d-flex flex-wrap flex-md-nowrap justify-content-end gap-3 gap-lg-1 gap-xl-3 order-1 order-lg-2 flex-grow-1">
                        <div class="o_cp_pager text-nowrap " role="search">
                            <nav class="o_pager d-flex gap-2 h-100" aria-label="Pager"><span
                                    class="o_pager_counter align-self-center"><span
                                        class="o_pager_value d-inline-block border-bottom border-transparent mb-n1">1</span><span>
                                        / </span><span class="o_pager_limit">1</span></span><span
                                    class="btn-group d-print-none" aria-atomic="true"><button type="button"
                                        class="fa fa-chevron-left btn btn-secondary o_pager_previous px-2 rounded-start"
                                        aria-label="Previous" data-tooltip="Previous" tabindex="-1" data-hotkey="p"
                                        title=""></button><button type="button"
                                        class="fa fa-chevron-right btn btn-secondary o_pager_next px-2 rounded-end"
                                        aria-label="Next" data-tooltip="Next" tabindex="-1"
                                        data-hotkey="n"></button></span></nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="o_content">
                <div class="o_form_renderer o_form_editable d-flex flex-column o_form_saved">
                    <div class="o_form_sheet_bg">
                        <div
                            class="o_form_statusbar position-relative d-flex justify-content-between mb-0 mb-md-2 pb-2 pb-md-0">
                            <div
                                class="o_statusbar_buttons d-flex align-items-center align-content-around flex-wrap gap-1">
                                <button id="submit-request" class="btn btn-primary" type="button"><span>Create
                                        Request</span></button>
                            </div>
                        </div>
                        <div class="o_form_sheet position-relative">
                            <div class="oe_title">
                                <h1>
                                    <div name="name" class="o_field_widget o_required_modifier o_field_char">
                                        <span id="request_type" class="o_field_display">Request Type Placeholder</span>
                                    </div>
                                </h1>
                            </div>
                            <div class="o_group row align-items-start">
                                <div class="o_inner_group grid col-lg-6">
                                    <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                        <div
                                            class="o_cell flex-grow-1 flex-sm-grow-0 o_wrap_label w-100 text-break text-900">
                                            <label class="o_form_label" for="start_time">Start Time</label>
                                        </div>
                                        <div class="o_cell flex-grow-1 flex-sm-grow-0" style="width: 100%;">
                                            <input type="datetime-local" class="o_input" id="start_time"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                        <div
                                            class="o_cell flex-grow-1 flex-sm-grow-0 o_wrap_label w-100 text-break text-900">
                                            <label class="o_form_label" for="end_time">End Time</label>
                                        </div>
                                        <div class="o_cell flex-grow-1 flex-sm-grow-0" style="width: 100%;">
                                            <input type="datetime-local" class="o_input" id="end_time"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                        <div
                                            class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                            <label class="o_form_label" for="reason">Reason</label>
                                        </div>
                                        <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                            style="width: 100%;">
                                            <input type="text" class="o_input" id="reason" placeholder="Enter reason">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Notification and overlay containers -->
    <div class="o-main-components-container">
        <div class="o-discuss-CallInvitations position-absolute top-0 end-0 d-flex flex-column p-2"></div>
        <div class="o-mail-ChatWindowContainer"></div>
        <div class="o-overlay-container"></div>
        <div class="o_notification_manager o_upload_progress_toast"></div>
        <div class="o_notification_manager"></div>
    </div>
</div>
@endsection