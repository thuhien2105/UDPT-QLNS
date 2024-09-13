@extends('layout.master')
@section('content')
    @include('page.gifts.header')

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
                                            data-tooltip="Back to &quot;User&quot;">Brand</a></li>
                                </ol>
                                <div class="d-flex gap-1 text-truncate">
                                    <div
                                        class="o_last_breadcrumb_item active d-flex gap-2 align-items-center min-w-0 lh-sm">
                                        <span class="min-w-0 text-truncate" id="title_0">Business trip to London</span>
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
                        </div>
                        <div
                            class="o_control_panel_actions d-empty-none d-flex align-items-center justify-content-start justify-content-lg-around order-2 order-lg-1 w-100 w-lg-auto">
                            <div class="o-form-buttonbox position-relative d-flex w-md-auto o_not_full"></div>
                        </div>
                    </div>
                </div>
                <div class="o_content">
                    <div class="o_form_renderer o_form_editable d-flex flex-column o_form_saved">
                        <div class="o_form_sheet_bg">
                            <div class="o_form_sheet position-relative">
                                <div class="row justify-content-between position-relative w-100 m-0 mb-2">
                                    <div class="oe_title mw-75 ps-0 pe-2">
                                        <h1 class="d-flex flex-row align-items-center">
                                            <div name="name" class="o_field_widget o_required_modifier o_field_char"
                                                style="font-size: min(4vw, 2.6rem);"><input class="o_input" id="name_0"
                                                    type="text" autocomplete="off" placeholder="Gift's Name"></div>
                                        </h1>
                                    </div>
                                    <div class="o_employee_avatar m-0 p-0" style="width:auto">
                                        <div name="image_1920" class="o_field_widget o_field_image oe_avatar m-0">
                                            <div class="d-inline-block position-relative opacity-trigger-hover">
                                                <img loading="lazy" class="img img-fluid" alt="Binary file"
                                                    src="" id="image_1920"
                                                    name="image_1920" style="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="o_group row align-items-start">
                                    <div class="o_inner_group grid col-lg-6">

                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="link_0">Brand</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="link"
                                                    class="o_field_widget o_required_modifier o_field_char">
                                                    <p id="link_0" href=""></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="o_inner_group grid col-lg-6"></div>
                                    <div class="o_notebook d-flex w-100 horizontal flex-column">
                                        <div class="o_notebook_headers">
                                            <ul class="nav nav-tabs flex-row flex-nowrap">
                                                <li class="nav-item flex-nowrap cursor-pointer">
                                                    <div class="nav-link active" role="tab" tabindex="0"
                                                        name="description">Details</div>
                                                </li>
                                                <li class="nav-item flex-nowrap cursor-pointer">
                                                    <div class="nav-link" role="tab" tabindex="0"
                                                        name="description">Address</div>
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
                                                                        <th data-tooltip-delay="1000" tabindex="-1"
                                                                            data-name="product_template_id"
                                                                            class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                            style="width: 10px;">
                                                                            <div class="d-flex"><span
                                                                                    class="d-block min-w-0 text-truncate flex-grow-1">No.</span><i
                                                                                    class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                            </div><span
                                                                                class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                        </th>
                                                                        <th data-tooltip-delay="1000" tabindex="-1"
                                                                            data-name="product_template_id"
                                                                            class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                            style="width: 180px;">
                                                                            <div class="d-flex"><span
                                                                                    class="d-block min-w-0 text-truncate flex-grow-1">Name</span><i
                                                                                    class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                            </div><span
                                                                                class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                        </th>
                                                                        <th data-tooltip-delay="1000" tabindex="-1"
                                                                            data-name="product_template_id"
                                                                            class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                            style="width: 180px;">
                                                                            <div class="d-flex"><span
                                                                                    class="d-block min-w-0 text-truncate flex-grow-1">Price</span><i
                                                                                    class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                            </div><span
                                                                                class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                        </th>
                                                                </thead>
                                                                <tbody class="ui-sortable" id="details">
                                                                </tbody>
                                                                <tfoot class="o_list_footer cursor-default">
                                                                    <tr>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane">
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
                                                                        <th data-tooltip-delay="1000" tabindex="-1"
                                                                            data-name="product_template_id"
                                                                            class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                            style="width: 10px;">
                                                                            <div class="d-flex"><span
                                                                                    class="d-block min-w-0 text-truncate flex-grow-1">No.</span><i
                                                                                    class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                            </div><span
                                                                                class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                        </th>
                                                                        <th data-tooltip-delay="1000" tabindex="-1"
                                                                            data-name="product_template_id"
                                                                            class="align-middle cursor-default o_sol_product_many2one_cell opacity-trigger-hover"
                                                                            style="width: 180px;">
                                                                            <div class="d-flex"><span
                                                                                    class="d-block min-w-0 text-truncate flex-grow-1">Address</span><i
                                                                                    class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
                                                                            </div><span
                                                                                class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
                                                                        </th>
                                                                </thead>
                                                                <tbody class="ui-sortable" id="address">
                                                                </tbody>
                                                                <tfoot class="o_list_footer cursor-default">
                                                                    <tr>
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
    <div class="o-main-components-container">
        <div class="o-discuss-CallInvitations position-absolute top-0 end-0 d-flex flex-column p-2"></div>
        <div class="o-mail-ChatWindowContainer"></div>
        <div class="o-overlay-container"></div>
        <div></div>
        <div class="o_notification_manager o_upload_progress_toast"></div>
        <div class="o_notification_manager"></div>
    </div>
@endsection
