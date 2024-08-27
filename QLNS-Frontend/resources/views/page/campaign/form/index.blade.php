@extends('layout.master')
@section('content')
    @include('page.campaign.header')

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
                                            data-tooltip="Back to &quot;My Requests&quot;">Campaign</a></li>
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
                            <div class="o_form_sheet position-relative">
                                <div class="oe_title">
                                    <h1>
                                        <div name="name" class="o_field_widget o_required_modifier o_field_char"><input
                                                class="o_input" id="name_0" type="text" autocomplete="off"
                                                placeholder="E.g: Expenses Paris business trip"></div>
                                    </h1>
                                </div>
                                <div class="o_group row align-items-start">
                                    <div class="o_inner_group grid col-lg-6" id="activity-details">

                                    </div>
                                </div>
                                <div class="o_inner_group grid col-lg-6"></div>
                                <div class="o_notebook d-flex w-100 horizontal flex-column">
                                    <div class="o_notebook_headers">
                                        <ul class="nav nav-tabs flex-row flex-nowrap">
                                            <li class="nav-item flex-nowrap cursor-pointer">
                                                <div class="nav-link active" role="tab" tabindex="0"
                                                    name="description">Participants</div>
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
                                                                        data-name="product_template_id"
                                                                        class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                        style="width: 180px;">
                                                                        <div class="d-flex"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1">Acvitity
                                                                                Name</span><i
                                                                                class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="name"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_section_and_note_text_cell opacity-trigger-hover"
                                                                        style="width: 176px;">
                                                                        <div class="d-flex"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1">Name</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="product_uom_qty"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th opacity-trigger-hover"
                                                                        style="min-width: 92px; width: 131px;">
                                                                        <div class="d-flex flex-row-reverse"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1 o_list_number_th">Total
                                                                                Elevation Gain</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="price_unit"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th opacity-trigger-hover"
                                                                        style="min-width: 92px; width: 131px;">
                                                                        <div class="d-flex flex-row-reverse"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1 o_list_number_th">Moving
                                                                                Time</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="tax_id"
                                                                        class="align-middle cursor-default o_many2many_tags_cell opacity-trigger-hover"
                                                                        style="width: 213px;">
                                                                        <div class="d-flex"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1">Elapsed
                                                                                Time</span><i
                                                                                class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                    <th data-tooltip-delay="1000" tabindex="-1"
                                                                        data-name="price_subtotal"
                                                                        class="align-middle o_column_sortable position-relative cursor-pointer o_list_number_th opacity-trigger-hover"
                                                                        style="min-width: 104px; width: 148px;">
                                                                        <div class="d-flex flex-row-reverse"><span
                                                                                class="d-block min-w-0 text-truncate flex-grow-1 o_list_number_th">Distance</span>
                                                                        </div><span
                                                                            class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="ui-sortable" id="data-table">
                                                            </tbody>
                                                            <tfoot class="o_list_footer cursor-default">
                                                                <tr>
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
    </div>
@endsection
