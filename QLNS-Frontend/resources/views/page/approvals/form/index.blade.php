@extends('layout.master')
@section('content')
    @include('page.approvals.header')

    <div class="o_action_manager">
        <div class="o_form_view o_view_controller o_action">
            <div class="o_form_view_container">
                <div class="o_control_panel d-flex flex-column gap-3 gap-lg-1 px-3 pt-2 pb-3" data-command-category="actions">
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
                                <div class="d-flex gap-1 text-truncate">
                                    <div
                                        class="o_last_breadcrumb_item active d-flex gap-2 align-items-center min-w-0 lh-sm">
                                        <span class="min-w-0 text-truncate" id="title_0" id="title_0">Business trip to London</span>
                                    </div>
                                    <div class="o_control_panel_breadcrumbs_actions d-inline-flex">
                                        <div class="o_cp_action_menus d-flex align-items-center pe-2 gap-1">
                                            <div class="o-dropdown dropdown lh-1 o-dropdown--no-caret"><button
                                                    type="button"
                                                    class="dropdown-toggle d-print-none btn p-0 ms-1 lh-sm border-0"
                                                    tabindex="0" aria-expanded="false"><i class="fa fa-cog"
                                                        data-hotkey="u" data-tooltip="Actions"></i></button></div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="o_control_panel_navigation d-flex flex-wrap flex-md-nowrap justify-content-end gap-3 gap-lg-1 gap-xl-3 order-1 order-lg-2 flex-grow-1"><div class="o_cp_pager text-nowrap " role="search"><nav class="o_pager d-flex gap-2 h-100" aria-label="Pager"><span class="o_pager_counter align-self-center"><span class="o_pager_value d-inline-block border-bottom border-transparent mb-n1">1</span><span> / </span><span class="o_pager_limit">1</span></span><span class="btn-group d-print-none" aria-atomic="true"><button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous px-2 rounded-start" aria-label="Previous" data-tooltip="Previous" tabindex="-1" data-hotkey="p" title=""></button><button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next px-2 rounded-end" aria-label="Next" data-tooltip="Next" tabindex="-1" data-hotkey="n"></button></span></nav></div></div>
                    </div>
                </div>
                <div class="o_content">
                    <div class="o_form_renderer o_form_editable d-flex flex-column o_form_saved">
                        <div class="o_form_sheet_bg">
                            <div
                                class="o_form_statusbar position-relative d-flex justify-content-between mb-0 mb-md-2 pb-2 pb-md-0">
                                <div
                                    class="o_statusbar_buttons d-flex align-items-center align-content-around flex-wrap gap-1">
                                    <button invisible="not approver_ids or request_status != 'new'" data-hotkey="q"
                                        class="btn btn-primary" name="action_confirm"
                                        type="object"><span>Save</span></button>
                                </div>
                            </div>
                            <div class="o_form_sheet position-relative">
                                <div class="oe_title">
                                    <h1>
                                        <div name="name" class="o_field_widget o_required_modifier o_field_char"><input
                                                class="o_input" id="name_0" type="text" autocomplete="off"
                                                placeholder="E.g: Expenses Paris business trip"></div>
                                    </h1>
                                </div>
                                <div class="o_group row align-items-start">
                                    <div class="o_inner_group grid col-lg-6">

                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="category_id_0">Type</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div class="o_field_widget o_required_modifier o_field_many2one">
                                                    <select id="category_id_0" name="category_id"
                                                        class="form-control no-outline">
                                                        <!-- Add <option> elements here -->
                                                        <option value="1">Category 1</option>
                                                        <option value="2">Category 2</option>
                                                        <!-- Example options -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div class="o_cell flex-grow-1 flex-sm-grow-0 o_wrap_label w-100 text-break text-900"
                                                style=""><label class="o_form_label"
                                                    for="date_start_0">Date</label></div>
                                            <div class="o_cell flex-grow-1 flex-sm-grow-0" style="width: 100%;">
                                                    <div name="date_end"
                                                        class="o_field_widget o_required_modifier o_field_datetime oe_inline">
                                                        <div class="d-flex gap-2 align-items-center"><input type="date"
                                                                class="o_input cursor-pointer" autocomplete="off"
                                                                id="date_end_0" data-field="date_end"></div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="request_owner_id_0">Manager</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="request_owner_id"
                                                    class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                    <div class="d-flex align-items-center gap-1"
                                                        data-tooltip="Mitchell Admin">
                                                        <div class="o_field_many2one_selection">
                                                            <div class="o_input_dropdown">
                                                                <div class="o-autocomplete dropdown"><input type="text"
                                                                        class="o-autocomplete--input o_input"
                                                                        autocomplete="off" id="request_owner_id_0"
                                                                        placeholder=""></div><span
                                                                    class="o_dropdown_button"></span>
                                                            </div><button type="button"
                                                                class="btn btn-link text-action fa o_external_button fa-arrow-right"
                                                                tabindex="-1" draggable="false"
                                                                aria-label="Internal link"
                                                                data-tooltip="Internal link"></button>
                                                        </div>
                                                        <div class="o_field_many2one_extra"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="request_owner_id_0">Employee</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="request_owner_id"
                                                    class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                    <div class="d-flex align-items-center gap-1"
                                                        data-tooltip="Mitchell Admin">
                                                        <div class="o_field_many2one_selection">
                                                            <div class="o_input_dropdown">
                                                                <div class="o-autocomplete dropdown"><input type="text"
                                                                        class="o-autocomplete--input o_input"
                                                                        autocomplete="off" id="request_owner_id_0"
                                                                        placeholder=""></div><span
                                                                    class="o_dropdown_button"></span>
                                                            </div><button type="button"
                                                                class="btn btn-link text-action fa o_external_button fa-arrow-right"
                                                                tabindex="-1" draggable="false"
                                                                aria-label="Internal link"
                                                                data-tooltip="Internal link"></button>
                                                        </div>
                                                        <div class="o_field_many2one_extra"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="o_inner_group grid col-lg-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
