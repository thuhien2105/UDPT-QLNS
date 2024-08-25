@extends('layout.master')
@section('content')
    @include('page.employees.header')

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
                                        <span class="min-w-0 text-truncate">Business trip to London</span>
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
                                                <label class="o_form_label" for="location_0">DOB</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="location"
                                                    class="o_field_widget o_required_modifier o_field_char"><input
                                                        class="o_input" id="location_0" type="text"
                                                        autocomplete="off" placeholder="e.g. Brussels"></div>
                                            </div>
                                        </div>

                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="location_0">Address</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="location"
                                                    class="o_field_widget o_required_modifier o_field_char"><input
                                                        class="o_input" id="location_0" type="text"
                                                        autocomplete="off" placeholder="e.g. Brussels"></div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="location_0">Phone_number</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="location"
                                                    class="o_field_widget o_required_modifier o_field_char"><input
                                                        class="o_input" id="location_0" type="text"
                                                        autocomplete="off" placeholder="e.g. Brussels"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="o_inner_group grid col-lg-6"></div>
                                </div>
                                <div class="o_notebook d-flex w-100 horizontal flex-column">
                                    <div class="o_notebook_headers">
                                        <ul class="nav nav-tabs flex-row flex-nowrap">
                                            <li class="nav-item flex-nowrap cursor-pointer">
                                                <div class="nav-link active" role="tab" tabindex="0"
                                                    name="description">Requests</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o_notebook_content tab-content">
                                        <div class="tab-pane active">
                                            <div name="order_line"
                                                class="o_field_widget o_field_section_and_note_one2many o_field_one2many">
                                                <div class="o_list_view o_field_x2many o_field_x2many_list">
                                                    <div class="o_x2m_control_panel d-empty-none mb-4"></div>
                                                    <div class="o_list_renderer o_renderer table-responsive o_list_renderer_8"
                                                        tabindex="-1">
                                                        <table
                                                            class="o_section_and_note_list_view o_list_table table table-sm table-hover position-relative mb-0 o_list_table_ungrouped table-striped"
                                                            style="table-layout: fixed;">
                                                            <thead>
                                                                <tr>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="sequence"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th o_handle_cell opacity-trigger-hover"
                                                                        style="min-width: 33px; width: 33px;"></th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="product_template_id"
                                                                        class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                        style="width: 180px;">
                                                                        <div class="d-flex"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1">Product</span><i
                                                                                class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="name"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_section_and_note_text_cell opacity-trigger-hover"
                                                                        style="width: 176px;">
                                                                        <div class="d-flex"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1">Description</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="product_uom_qty"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th opacity-trigger-hover"
                                                                        style="min-width: 92px; width: 131px;">
                                                                        <div class="d-flex flex-row-reverse"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1 o_list_number_th">Quantity</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="price_unit"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th opacity-trigger-hover"
                                                                        style="min-width: 92px; width: 131px;">
                                                                        <div class="d-flex flex-row-reverse"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1 o_list_number_th">Unit
                                                                                Price</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="tax_id"
                                                                        class="align-middle cursor-default o_many2many_tags_cell opacity-trigger-hover"
                                                                        style="width: 213px;">
                                                                        <div class="d-flex"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1">Taxes</span><i
                                                                                class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="price_subtotal"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th opacity-trigger-hover"
                                                                        style="min-width: 104px; width: 148px;">
                                                                        <div class="d-flex flex-row-reverse"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1 o_list_number_th">Tax
                                                                                excl.</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th
                                                                        class="o_list_controller o_list_actions_header position-sticky end-0">
                                                                        <div
                                                                            class="o-dropdown dropdown o_optional_columns_dropdown text-center border-top-0 o-dropdown--no-caret">
                                                                            <button type="button"
                                                                                class="dropdown-toggle btn p-0"
                                                                                tabindex="-1" aria-expanded="false"><i
                                                                                    class="o_optional_columns_dropdown_toggle oi oi-fw oi-settings-adjust"></i></button>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="ui-sortable">
                                                                <tr class="o_data_row o_row_draggable o_is_false"
                                                                    data-id="datapoint_616">
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number o_handle_cell"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="sequence">
                                                                        <div name="sequence"
                                                                            class="o_field_widget o_field_handle"><span
                                                                                class="o_row_handle oi oi-draggable ui-sortable-handle"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell o_required_modifier"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="product_template_id"
                                                                        data-tooltip="Customizable Desk">
                                                                        <div name="product_template_id"
                                                                            class="o_field_widget o_required_modifier o_field_sol_product_many2one">
                                                                            <span><span>Customizable Desk</span></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_sol_product_many2one_cell o_required_modifier"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="product_template_id"
                                                                        data-tooltip="Customizable Desk">
                                                                        <div name="product_template_id"
                                                                            class="o_field_widget o_required_modifier o_field_sol_product_many2one">
                                                                            <span><span>Customizable Desk</span></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number o_required_modifier"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="product_uom_qty">10.00</td>
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number o_required_modifier"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="price_unit">123.00</td>
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_many2many_tags_cell"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="tax_id">
                                                                        <div name="tax_id"
                                                                            class="o_field_widget o_field_many2many_tags">
                                                                            <div
                                                                                class="o_field_tags d-inline-flex flex-wrap gap-1">
                                                                                <span
                                                                                    class="o_tag position-relative d-inline-flex align-items-center user-select-none mw-100 o_badge badge rounded-pill lh-1 o_tag_color_0"
                                                                                    tabindex="-1" title="15%">
                                                                                    <div
                                                                                        class="o_tag_badge_text text-truncate">
                                                                                        15%</div>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="o_data_cell cursor-pointer o_field_cell o_list_number o_readonly_modifier"
                                                                        data-tooltip-delay="1000" tabindex="-1"
                                                                        name="price_subtotal">$&nbsp;1,230.00</td>
                                                                    <td class="o_list_record_remove text-center"
                                                                        tabindex="-1"><button class="fa fa-trash-o"
                                                                            name="delete" aria-label="Delete row"
                                                                            tabindex="-1"></button></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">​</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">​</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot class="o_list_footer cursor-default">
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
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
                                    </div>
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
