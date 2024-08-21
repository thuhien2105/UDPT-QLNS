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
                        <div class="o_control_panel_navigation d-flex flex-wrap flex-md-nowrap justify-content-end gap-3 gap-lg-1 gap-xl-3 order-1 order-lg-2 flex-grow-1"><div class="o_cp_pager text-nowrap " role="search"><nav class="o_pager d-flex gap-2 h-100" aria-label="Pager"><span class="o_pager_counter align-self-center"><span class="o_pager_value d-inline-block border-bottom border-transparent mb-n1">1-80</span><span> / </span><span class="o_pager_limit">1356</span></span><span class="btn-group d-print-none" aria-atomic="true"><button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous px-2 rounded-start" aria-label="Previous" data-tooltip="Previous" tabindex="-1" data-hotkey="p" title=""></button><button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next px-2 rounded-end" aria-label="Next" data-tooltip="Next" tabindex="-1" data-hotkey="n"></button></span></nav></div></div>
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
                                        type="object"><span>Submit</span></button>
                                    <div class="o_widget o_widget_attach_document"><button
                                            class="btn o_attachment_button btn-primary"><span
                                                class="o_attach_document">Attach Document</span></button></div>
                                </div>
                                <div name="request_status" class="o_field_widget o_readonly_modifier o_field_statusbar">
                                    <div class="o_statusbar_status" role="radiogroup"><button type="button"
                                            class="btn btn-secondary dropdown-toggle o_arrow_button o_first d-none"
                                            aria-expanded="false">
                                            <div class="o-dropdown dropdown o-dropdown--no-caret"></div>...
                                        </button><button type="button" class="btn btn-secondary o_arrow_button o_first"
                                            role="radio" disabled="" aria-label="Not active state"
                                            aria-checked="false" data-value="cancel">Cancel</button><button
                                            type="button" class="btn btn-secondary o_arrow_button" role="radio"
                                            disabled="" aria-label="Not active state" aria-checked="false"
                                            data-value="refused">Refused</button><button type="button"
                                            class="btn btn-secondary o_arrow_button" role="radio" disabled=""
                                            aria-label="Not active state" aria-checked="false"
                                            data-value="approved">Approved</button><button type="button"
                                            class="btn btn-secondary o_arrow_button" role="radio" disabled=""
                                            aria-label="Not active state" aria-checked="false"
                                            data-value="pending">Submitted</button><button type="button"
                                            class="btn btn-secondary o_arrow_button o_arrow_button_current o_last"
                                            role="radio" disabled="" aria-label="Current state" aria-checked="true"
                                            aria-current="step" data-value="new">To Submit</button><button type="button"
                                            class="btn btn-secondary dropdown-toggle o_arrow_button o_last d-none"
                                            aria-expanded="false">
                                            <div class="o-dropdown dropdown o-dropdown--no-caret"></div>...
                                        </button><button type="button" class="btn btn-secondary dropdown-toggle d-none"
                                            aria-expanded="false">
                                            <div class="o-dropdown dropdown o-dropdown--no-caret"></div>To Submit
                                        </button></div>
                                </div>
                            </div>
                            <div class="o_form_sheet position-relative">
                                <div class="oe_avatar">
                                    <div name="category_image"
                                        class="o_field_widget o_readonly_modifier o_field_image bg-view">
                                        <div class="d-inline-block position-relative opacity-trigger-hover">
                                            <div aria-atomic="true"
                                                class="position-absolute d-flex justify-content-between w-100 bottom-0 opacity-0 opacity-100-hover"
                                                style="max-width: 80px;max-height: 80px;"></div><img loading="lazy"
                                                class="img img-fluid" alt="Binary file"
                                                src="http://localhost:8069/web/image?model=approval.request&amp;id=1&amp;field=category_image&amp;unique=1718110009000"
                                                name="category_image" height="80" width="80"
                                                style="max-width: 80px;max-height: 80px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="oe_title"><label class="o_form_label" for="name_0">Approval Subject</label>
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
                                                <label class="o_form_label" for="request_owner_id_0">Request Owner</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="request_owner_id"
                                                    class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
                                                    <div class="d-flex align-items-center gap-1"
                                                        data-tooltip="Mitchell Admin"><span
                                                            class="o_avatar o_m2o_avatar"><img class="rounded"
                                                                src="/web/image/res.users/2/avatar_128"></span>
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
                                                <label class="o_form_label" for="category_id_0">Category</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="category_id"
                                                    class="o_field_widget o_required_modifier o_field_many2one">
                                                    <div class="o_field_many2one_selection">
                                                        <div class="o_input_dropdown">
                                                            <div class="o-autocomplete dropdown"><input type="text"
                                                                    class="o-autocomplete--input o_input"
                                                                    autocomplete="off" id="category_id_0" placeholder="">
                                                            </div><span class="o_dropdown_button"></span>
                                                        </div><button type="button"
                                                            class="btn btn-link text-action fa o_external_button fa-arrow-right"
                                                            tabindex="-1" draggable="false" aria-label="Internal link"
                                                            data-tooltip="Internal link"></button>
                                                    </div>
                                                    <div class="o_field_many2one_extra"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label o_form_label_empty o_form_label_readonly"
                                                    for="date_confirmed_0">Date Confirmed</label>
                                            </div>
                                            <div class="o_cell o_wrap_input flex-grow-1 flex-sm-grow-0 text-break"
                                                style="width: 100%;">
                                                <div name="date_confirmed"
                                                    class="o_field_widget o_readonly_modifier o_field_empty o_field_datetime">
                                                    <div class="d-flex gap-2 align-items-center"><span
                                                            class="text-truncate"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div class="o_cell flex-grow-1 flex-sm-grow-0 o_wrap_label w-100 text-break text-900"
                                                style=""><label class="o_form_label"
                                                    for="date_start_0">Period</label></div>
                                            <div class="o_cell flex-grow-1 flex-sm-grow-0" style="width: 100%;">
                                                <div>
                                                    <div><span>From: </span>
                                                        <div name="date_start"
                                                            class="o_field_widget o_required_modifier o_field_datetime oe_inline">
                                                            <div class="d-flex gap-2 align-items-center"><input
                                                                    type="text" class="o_input cursor-pointer"
                                                                    autocomplete="off" id="date_start_0"
                                                                    data-field="date_start"></div>
                                                        </div>
                                                    </div>
                                                    <div><span>to: </span>
                                                        <div name="date_end"
                                                            class="o_field_widget o_required_modifier o_field_datetime oe_inline ms-4">
                                                            <div class="d-flex gap-2 align-items-center"><input
                                                                    type="text" class="o_input cursor-pointer"
                                                                    autocomplete="off" id="date_end_0"
                                                                    data-field="date_end"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o_wrap_field d-flex d-sm-contents flex-column mb-3 mb-sm-0">
                                            <div
                                                class="o_cell o_wrap_label flex-grow-1 flex-sm-grow-0 w-100 text-break text-900">
                                                <label class="o_form_label" for="location_0">Location</label>
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
                                                <a class="nav-link active" href="#" role="tab" tabindex="0"
                                                    name="description">Description</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="o_notebook_content tab-content">
                                        <div class="tab-pane active">
                                            <div name="reason" class="o_field_widget o_field_html">
                                                <div class="h-100">
                                                    <div class="note-editable odoo-editor-editable odoo-editor-qweb"
                                                        id="reason_0" contenteditable="true" dir="ltr">
                                                        <p>Meeting with a potential customer.</p>
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
    <div class="o_we_crop_widget d-none" contenteditable="false">
        <div class="o_we_cropper_wrapper"><img class="o_we_cropper_img">
            <div class="o_we_crop_buttons text-center mt16 position-fixed o_we_no_overlay" contenteditable="false">
                <div class="btn-group btn-group-toggle" title="Aspect Ratio" data-bs-toggle="buttons"><label
                        data-action="ratio" class="btn" data-value="0/0"><input type="radio">Flexible</label><label
                        data-action="ratio" class="btn" data-value="16/9"><input type="radio">16:9</label><label
                        data-action="ratio" class="btn" data-value="4/3"><input type="radio">4:3</label><label
                        data-action="ratio" class="btn" data-value="1/1"><input type="radio">1:1</label><label
                        data-action="ratio" class="btn" data-value="2/3"><input type="radio">2:3</label></div>
                <div class="btn-group" role="group"><button type="button" title="Zoom In" data-action="zoom"
                        data-value="0.1"><i class="fa fa-fw fa-search-plus"></i></button><button type="button"
                        title="Zoom Out" data-action="zoom" data-value="-0.1"><i
                            class="fa fa-fw fa-search-minus"></i></button></div>
                <div class="btn-group" role="group"><button type="button" title="Rotate Left" data-action="rotate"
                        data-value="-90"><i class="fa fa-fw fa-rotate-left"></i></button><button type="button"
                        title="Rotate Right" data-action="rotate" data-value="90"><i
                            class="fa fa-fw fa-rotate-right"></i></button></div>
                <div class="btn-group" role="group"><button type="button" title="Flip Horizontal" data-action="flip"
                        data-scale-direction="scaleX"><i class="fa fa-fw fa-arrows-h"></i></button><button type="button"
                        title="Flip Vertical" data-action="flip" data-scale-direction="scaleY"><i
                            class="fa fa-fw fa-arrows-v"></i></button></div>
                <div class="btn-group" role="group"><button type="button" title="Reset Image" data-action="reset"><i
                            class="fa fa-refresh"></i> Reset Image</button></div>
                <div class="btn-group" role="group"><button type="button" title="Apply" data-action="apply"
                        class="btn btn-primary"><i class="fa fa-check"></i> Apply</button><button type="button"
                        title="Discard" data-action="discard" class="btn btn-danger"><i class="fa fa-times"></i>
                        Discard</button></div>
            </div>
        </div>
    </div>
    <div class="oe-qweb-select" style="display: none;"></div>
    <div class="oe-tablepicker-wrapper oe-floating" style="position: absolute; display: none;">
        <div class="oe-tablepicker"></div>
        <div class="oe-tablepicker-size"></div>
    </div>
    <div class="oe-powerbox-wrapper position-absolute overflow-hidden" style="display: none;">
        <div class="oe-powerbox-mainWrapper flex-skrink-1 overflow-auto py-2"></div>
    </div>
    <div id="toolbar" class="oe-toolbar oe-floating"
        style="--we-cp-primary: #714B67; --we-cp-secondary: #D8DADD; --we-cp-success: #28A745; --we-cp-info: #17A2B8; --we-cp-warning: #E99D00; --we-cp-danger: #D44C59; --we-cp-o-color-1: #714B67; --we-cp-o-cc1-bg: #FFFFFF; --we-cp-o-cc1-headings: #000; --we-cp-o-cc1-text: #000; --we-cp-o-cc1-btn-primary: #714B67; --we-cp-o-cc1-btn-primary-text: #FFF; --we-cp-o-cc1-btn-secondary: #D8DADD; --we-cp-o-cc1-btn-secondary-text: #000; --we-cp-o-cc1-btn-primary-border: #714B67; --we-cp-o-cc1-btn-secondary-border: #D8DADD; --we-cp-o-color-2: #8595A2; --we-cp-o-cc2-bg: #F3F2F2; --we-cp-o-cc2-headings: #111827; --we-cp-o-cc2-text: #000; --we-cp-o-cc2-btn-primary: #714B67; --we-cp-o-cc2-btn-primary-text: #FFF; --we-cp-o-cc2-btn-secondary: #D8DADD; --we-cp-o-cc2-btn-secondary-text: #000; --we-cp-o-cc2-btn-primary-border: #714B67; --we-cp-o-cc2-btn-secondary-border: #D8DADD; --we-cp-o-color-3: #F3F2F2; --we-cp-o-cc3-bg: #8595A2; --we-cp-o-cc3-headings: #FFF; --we-cp-o-cc3-text: #FFF; --we-cp-o-cc3-btn-primary: #714B67; --we-cp-o-cc3-btn-primary-text: #FFF; --we-cp-o-cc3-btn-secondary: #F3F2F2; --we-cp-o-cc3-btn-secondary-text: #000; --we-cp-o-cc3-btn-primary-border: #714B67; --we-cp-o-cc3-btn-secondary-border: #F3F2F2; --we-cp-o-color-4: #FFFFFF; --we-cp-o-cc4-bg: #714B67; --we-cp-o-cc4-headings: #FFF; --we-cp-o-cc4-text: #FFF; --we-cp-o-cc4-btn-primary: #111827; --we-cp-o-cc4-btn-primary-text: #FFF; --we-cp-o-cc4-btn-secondary: #F3F2F2; --we-cp-o-cc4-btn-secondary-text: #000; --we-cp-o-cc4-btn-primary-border: #111827; --we-cp-o-cc4-btn-secondary-border: #F3F2F2; --we-cp-o-color-5: #111827; --we-cp-o-cc5-bg: #111827; --we-cp-o-cc5-headings: #FFFFFF; --we-cp-o-cc5-text: #FFF; --we-cp-o-cc5-btn-primary: #714B67; --we-cp-o-cc5-btn-primary-text: #FFF; --we-cp-o-cc5-btn-secondary: #F3F2F2; --we-cp-o-cc5-btn-secondary-text: #000; --we-cp-o-cc5-btn-primary-border: #714B67; --we-cp-o-cc5-btn-secondary-border: #F3F2F2; --we-cp-100: #F9FAFB; --we-cp-200: #E7E9ED; --we-cp-300: #D8DADD; --we-cp-400: #9A9CA5; --we-cp-500: #7C7F89; --we-cp-600: #5F636F; --we-cp-700: #374151; --we-cp-800: #1F2937; --we-cp-900: #111827; visibility: hidden;">
        <div id="style" class="btn-group dropdown"><button type="button" class="btn dropdown-toggle"
                data-bs-toggle="dropdown" data-bs-original-title="Text style" tabindex="-1" aria-expanded="false"><span
                    title="Text style">Normal</span></button>
            <ul class="dropdown-menu">
                <li id="display-1-dropdown-item"><a class="dropdown-item" href="#" id="display-1"
                        data-call="setTag" data-arg1="h1,display-1">Header 1 Display 1</a></li>
                <li id="display-2-dropdown-item"><a class="dropdown-item d-none" href="#" id="display-2"
                        data-call="setTag" data-arg1="h1,display-2" data-extended-text-style="">Header 1 Display 2</a>
                </li>
                <li id="display-3-dropdown-item"><a class="dropdown-item d-none" href="#" id="display-3"
                        data-call="setTag" data-arg1="h1,display-3" data-extended-text-style="">Header 1 Display 3</a>
                </li>
                <li id="display-4-dropdown-item"><a class="dropdown-item d-none" href="#" id="display-4"
                        data-call="setTag" data-arg1="h1,display-4" data-extended-text-style="">Header 1 Display 4</a>
                </li>
                <li id="heading1-dropdown-item"><a class="dropdown-item" href="#" id="heading1"
                        data-call="setTag" data-arg1="h1">Header 1</a></li>
                <li id="heading2-dropdown-item"><a class="dropdown-item" href="#" id="heading2"
                        data-call="setTag" data-arg1="h2">Header 2</a></li>
                <li id="heading3-dropdown-item"><a class="dropdown-item" href="#" id="heading3"
                        data-call="setTag" data-arg1="h3">Header 3</a></li>
                <li id="heading4-dropdown-item"><a class="dropdown-item" href="#" id="heading4"
                        data-call="setTag" data-arg1="h4">Header 4</a></li>
                <li id="heading5-dropdown-item"><a class="dropdown-item" href="#" id="heading5"
                        data-call="setTag" data-arg1="h5">Header 5</a></li>
                <li id="heading6-dropdown-item"><a class="dropdown-item" href="#" id="heading6"
                        data-call="setTag" data-arg1="h6">Header 6</a></li>
                <li id="paragraph-dropdown-item"><a class="dropdown-item" href="#" id="paragraph"
                        data-call="setTag" data-arg1="p">Normal</a></li>
                <li id="light-dropdown-item"><a class="dropdown-item d-none" href="#" id="light"
                        data-call="setTag" data-arg1="p,lead" data-extended-text-style="">Light</a></li>
                <li id="small-dropdown-item"><a class="dropdown-item d-none" href="#" id="small"
                        data-call="setTag" data-arg1="p,o_small" data-extended-text-style="">Small</a></li>
                <li id="pre-dropdown-item"><a class="dropdown-item" href="#" id="pre" data-call="setTag"
                        data-arg1="pre">Code</a></li>
                <li id="blockquote-dropdown-item"><a class="dropdown-item" href="#" id="blockquote"
                        data-call="setTag" data-arg1="blockquote">Quote</a></li>
            </ul>
        </div>
        <div id="decoration" class="btn-group">
            <div id="bold" data-call="bold" title="Toggle bold" class="btn fa fa-bold fa-fw"></div>
            <div id="italic" data-call="italic" title="Toggle italic" class="btn fa fa-italic fa-fw"></div>
            <div id="underline" data-call="underline" title="Toggle underline" class="btn fa fa-underline fa-fw"></div>
            <div id="strikethrough" data-call="strikeThrough" title="Toggle strikethrough"
                class="btn fa fa-strikethrough fa-fw"></div>
            <div id="removeFormat" data-call="removeFormat" title="Remove format" class="btn fa fa-eraser fa-fw"></div>
        </div>
        <div id="colorInputButtonGroup" class="btn-group">
            <div class="colorpicker-group note-fore-color-preview" data-name="color" data-color-type="text">
                <div id="oe-text-color" class="btn color-button dropdown-toggle editor-ignore" data-bs-toggle="dropdown"
                    tabindex="-1"><i class="fa fa-font color-indicator fore-color" title="Font Color"></i></div>
                <ul class="dropdown-menu colorpicker-menu">
                    <li>
                        <div class="colorpicker">
                            <div class="o_we_colorpicker_switch_panel d-flex justify-content-end px-2"><button
                                    type="button" tabindex="1" class="o_we_colorpicker_switch_pane_btn active"
                                    data-target="theme-colors" title="Solid"><span>Solid</span></button><button
                                    type="button" tabindex="2" class="o_we_colorpicker_switch_pane_btn"
                                    data-target="custom-colors" title="Custom"><span>Custom</span></button><button
                                    type="button" tabindex="3" class="o_we_colorpicker_switch_pane_btn"
                                    data-target="gradients" title="Gradient"><span>Gradient</span></button><button
                                    type="button"
                                    class="fa fa-trash my-1 ms-5 py-0 o_we_color_btn o_colorpicker_reset o_we_hover_danger"
                                    title="Reset"></button></div>
                            <div class="o_colorpicker_sections pt-2 px-2 pb-3 d-none" data-color-tab="color-combinations">
                                <button type="button" class="o_we_color_btn o_we_color_combination_btn" data-color="1"
                                    title="Preset 1">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc1">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="2" title="Preset 2">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc2">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="3" title="Preset 3">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc3">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="4" title="Preset 4">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc4">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="5" title="Preset 5">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc5">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button>
                            </div>
                            <div class="o_colorpicker_sections py-3 px-2" data-color-tab="theme-colors">
                                <div class="o_colorpicker_section" data-name="theme">
                                    <div></div>
                                    <button data-color="o-color-1" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-1);"></button>
                                    <button data-color="o-color-3" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-3);"></button>
                                    <button data-color="o-color-2" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-2);"></button>
                                    <button data-color="o-color-4" class="ms-2 o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-4);"></button>
                                    <button data-color="o-color-5" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-5);"></button>
                                </div>
                                <div class="o_colorpicker_section" data-name="common">
                                    <div></div>
                                    <button data-color="black" class="o_we_color_btn bg-black"></button>
                                    <button data-color="900" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-900);"></button>
                                    <button data-color="800" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-800);"></button>
                                    <button data-color="700" class="d-none o_we_color_btn"
                                        style="background-color: var(--we-cp-700);"></button>
                                    <button data-color="600" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-600);"></button>
                                    <button data-color="500" class="d-none o_we_color_btn"
                                        style="background-color: var(--we-cp-500);"></button>
                                    <button data-color="400" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-400);"></button>
                                    <button data-color="300" class="d-none o_we_color_btn"
                                        style="background-color: var(--we-cp-300);"></button>
                                    <button data-color="200" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-200);"></button>
                                    <button data-color="100" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-100);"></button>
                                    <button data-color="white" class="o_we_color_btn bg-white"></button>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#FF0000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FF9C00;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFFF00;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#00FF00;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#00FFFF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#0000FF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#9C00FF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FF00FF;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#F7C6CE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFE7CE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFEFC6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#D6EFD6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#CEDEE7;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#CEE7F7;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#D6D6E7;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#E7D6DE;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#E79C9C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFC69C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFE79C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#B5D6A5;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#A5C6CE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#9CC6EF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#B5A5D6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#D6A5BD;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#E76363;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#F7AD6B;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFD663;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#94BD7B;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#73A5AD;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#6BADDE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#8C7BC6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#C67BA5;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#CE0000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#E79439;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#EFC631;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#6BA54A;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#4A7B8C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#3984C6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#634AA5;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#A54A7B;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#9C0000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#B56308;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#BD9400;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#397B21;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#104A5A;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#085294;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#311873;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#731842;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#630000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#7B3900;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#846300;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#295218;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#083139;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#003163;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#21104A;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#4A1031;"></button></div>
                                </div>
                            </div>
                            <div class="o_colorpicker_sections py-3 px-2 d-none" data-color-tab="custom-colors">
                                <div class="o_colorpicker_section_container">
                                    <div class="o_colorpicker_section" data-name="custom">
                                        <div></div><button class="o_we_color_btn o_custom_color selected"
                                            style="background-color:#374151;"></button>
                                    </div>
                                    <div class="o_colorpicker_section d-none" data-name="transparent_grayscale">
                                        <div></div>
                                        <button data-color="black-15" class="o_we_color_btn bg-black-15"></button>
                                        <button data-color="black-25" class="o_we_color_btn bg-black-25"></button>
                                        <button data-color="black-50" class="o_we_color_btn bg-black-50"></button>
                                        <button data-color="black-75" class="o_we_color_btn bg-black-75"></button>
                                        <button data-color="white-25" class="o_we_color_btn bg-white-25"></button>
                                        <button data-color="white-50" class="o_we_color_btn bg-white-50"></button>
                                        <button data-color="white-75" class="o_we_color_btn bg-white-75"></button>
                                        <button data-color="white-85" class="o_we_color_btn bg-white-85"></button>
                                    </div>
                                    <div class="o_colorpicker_section" data-name="common">
                                        <div></div>
                                        <button data-color="black" class="o_we_color_btn bg-black"></button>
                                        <button data-color="900" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-900);"></button>
                                        <button data-color="800" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-800);"></button>
                                        <button data-color="700" class="d-none o_we_color_btn"
                                            style="background-color: var(--we-cp-700);"></button>
                                        <button data-color="600" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-600);"></button>
                                        <button data-color="500" class="d-none o_we_color_btn"
                                            style="background-color: var(--we-cp-500);"></button>
                                        <button data-color="400" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-400);"></button>
                                        <button data-color="300" class="d-none o_we_color_btn"
                                            style="background-color: var(--we-cp-300);"></button>
                                        <button data-color="200" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-200);"></button>
                                        <button data-color="100" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-100);"></button>
                                        <button data-color="white" class="o_we_color_btn bg-white"></button>
                                    </div>
                                </div>
                                <div class="o_colorpicker_widget">
                                    <div class="d-flex justify-content-between align-items-stretch mb-2">
                                        <div class="o_color_pick_area position-relative w-75"
                                            style="background-color: rgb(0, 98, 255);">
                                            <div class="o_picker_pointer rounded-circle p-1 position-absolute"
                                                tabindex="-1" style="top: 86.6667px; left: -5px;"></div>
                                        </div>
                                        <div class="o_color_slider position-relative">
                                            <div class="o_slider_pointer" tabindex="-1" style="top: -2px;"></div>
                                        </div>
                                        <div class="o_opacity_slider position-relative"
                                            style="background: linear-gradient(rgb(55, 65, 81) 0%, transparent 100%);">
                                            <div class="o_opacity_pointer" tabindex="-1" style="top: -2px;"></div>
                                        </div>
                                    </div>
                                    <div class="o_color_picker_inputs d-flex justify-content-between mb-2">
                                        <div class="o_hex_div px-1 d-flex align-items-baseline"><input type="text"
                                                data-color-method="hex" size="1"
                                                class="o_hex_input p-0 border-0 text-center font-monospace bg-transparent"><label
                                                class="flex-grow-0 ms-1 mb-0">hex</label></div>
                                        <div class="o_rgba_div px-1 d-flex align-items-baseline"><input type="text"
                                                data-color-method="rgb" size="1"
                                                class="o_red_input p-0 border-0 text-center font-monospace bg-transparent"><input
                                                type="text" data-color-method="rgb" size="1"
                                                class="o_green_input p-0 border-0 text-center font-monospace bg-transparent"><input
                                                type="text" data-color-method="rgb" size="1"
                                                class="o_blue_input me-0 p-0 border-0 text-center font-monospace bg-transparent"><input
                                                type="text" data-color-method="opacity" size="1"
                                                class="o_opacity_input p-0 border-0 text-center font-monospace bg-transparent"><label
                                                class="flex-grow-0 ms-1 mb-0"> RGBA </label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="o_colorpicker_sections py-3 px-2 d-none" data-color-tab="gradients">
                                <div class="o_colorpicker_section_container">
                                    <div class="o_colorpicker_section" data-name="predefined_gradients">
                                        <div></div>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(255, 204, 51) 0%, rgb(226, 51, 255) 100%);"
                                            data-color="linear-gradient(135deg, rgb(255, 204, 51) 0%, rgb(226, 51, 255) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(102, 153, 255) 0%, rgb(255, 51, 102) 100%);"
                                            data-color="linear-gradient(135deg, rgb(102, 153, 255) 0%, rgb(255, 51, 102) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(47, 128, 237) 0%, rgb(178, 255, 218) 100%);"
                                            data-color="linear-gradient(135deg, rgb(47, 128, 237) 0%, rgb(178, 255, 218) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(203, 94, 238) 0%, rgb(75, 225, 236) 100%);"
                                            data-color="linear-gradient(135deg, rgb(203, 94, 238) 0%, rgb(75, 225, 236) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(214, 255, 127) 0%, rgb(0, 179, 204) 100%);"
                                            data-color="linear-gradient(135deg, rgb(214, 255, 127) 0%, rgb(0, 179, 204) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(255, 222, 69) 0%, rgb(69, 33, 0) 100%);"
                                            data-color="linear-gradient(135deg, rgb(255, 222, 69) 0%, rgb(69, 33, 0) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(222, 222, 222) 0%, rgb(69, 69, 69) 100%);"
                                            data-color="linear-gradient(135deg, rgb(222, 222, 222) 0%, rgb(69, 69, 69) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(255, 222, 202) 0%, rgb(202, 115, 69) 100%);"
                                            data-color="linear-gradient(135deg, rgb(255, 222, 202) 0%, rgb(202, 115, 69) 100%)"></button>
                                    </div>
                                    <div class="o_colorpicker_section o_custom_gradient_editor"
                                        data-name="custom_gradient">
                                        <div></div>
                                        <button class="w-50 o_custom_gradient_btn o_we_color_btn py-1 btn"
                                            title="Define a custom gradient" data-color="false">Custom</button>
                                        <div class="o_color_picker_inputs mx-1 d-none">
                                            <div class="d-flex justify-content-between my-2 o_type_row">
                                                <we-title>Type</we-title>
                                                <span class="d-flex justify-content-between">
                                                    <we-button data-gradient-type="linear-gradient"
                                                        class="d-flex align-items-baseline active">Linear</we-button>
                                                    <we-button data-gradient-type="radial-gradient"
                                                        class="d-flex align-items-baseline">Radial</we-button>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between my-2 o_angle_row">
                                                <we-title>Angle</we-title>
                                                <span
                                                    class="o_custom_gradient_input bg-black-50 px-1 d-flex align-items-baseline">
                                                    <input data-name="angle" type="text" style="width: 5ch;"
                                                        value="90"
                                                        class="p-0 border-0 text-center font-monospace bg-transparent text-white">
                                                    <span class="flex-grow-0 ms-1 text-white-50">deg</span>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between my-2 o_position_row">
                                                <we-title>Position</we-title>
                                                <span class="d-flex">
                                                    <span class="me-2">X</span>
                                                    <span class="o_custom_gradient_input bg-black-50 px-1 d-flex">
                                                        <input data-name="positionX" type="text" style="width: 3ch;"
                                                            value="25"
                                                            class="p-0 border-0 text-center font-monospace bg-transparent text-white">
                                                        <span class="flex-grow-0 ms-1 text-white-50">%</span>
                                                    </span>
                                                    <span class="me-2 ms-3">Y</span>
                                                    <span class="o_custom_gradient_input bg-black-50 px-1 d-flex">
                                                        <input data-name="positionY" type="text" style="width: 3ch;"
                                                            value="25"
                                                            class="p-0 border-0 text-center font-monospace bg-transparent text-white">
                                                        <span class="flex-grow-0 ms-1 text-white-50">%</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between my-2 o_size_row">
                                                <we-title>Size</we-title>
                                                <span class="d-flex justify-content-between">
                                                    <we-button data-gradient-size="closest-side"
                                                        class="d-flex align-items-baseline"
                                                        title="Extend to the closest side">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path
                                                                d="M3 4H9V8C9 8.55228 8.55228 9 8 9H4C3.44772 9 3 8.55228 3 8V4Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="2" y="3" width="12" height="1"
                                                                fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                    <we-button data-gradient-size="closest-corner"
                                                        class="d-flex align-items-baseline"
                                                        title="Extend to the closest corner">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path d="M2 4H9V7C9 9.20914 7.20914 11 5 11H2V4Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="1" y="3" width="8" height="1"
                                                                fill="white"></rect>
                                                            <rect x="1" y="11" width="8" height="1"
                                                                transform="rotate(-90 1 11)" fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                    <we-button data-gradient-size="farthest-side"
                                                        class="d-flex align-items-baseline active"
                                                        title="Extend to the farthest side">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path
                                                                d="M7 12C10.3137 12 14 10.2091 14 8C14 5.79086 10.3137 4 7 4C3.68629 4 2 5.79086 2 8C2 10.2091 3.68629 12 7 12Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="14" y="4" width="1" height="12"
                                                                fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                    <we-button data-gradient-size="farthest-corner"
                                                        class="d-flex align-items-baseline"
                                                        title="Extend to the farthest corner">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path d="M2 4H14V10C14 13.3137 11.3137 16 8 16H2V4Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="15" y="17" width="7" height="0.999999"
                                                                transform="rotate(-180 15 17)" fill="white"></rect>
                                                            <rect x="15" y="10" width="7" height="1"
                                                                transform="rotate(90 15 10)" fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                </span>
                                            </div>
                                            <div class="mx-1 o_custom_gradient_scale">
                                                <div class="w-100"></div>
                                            </div>
                                            <div class="w-100 o_slider_multi" role="group"></div>
                                            <we-button
                                                class="o_remove_color fa fa-fw fa-trash o_we_link o_we_hover_danger d-none"
                                                title="Remove Selected Color"
                                                aria-label="Remove Selected Color"></we-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="colorpicker-group note-back-color-preview" data-name="color" data-color-type="background">
                <button id="oe-fore-color" type="button" class="btn dropdown-toggle editor-ignore"
                    data-bs-toggle="dropdown" tabindex="-1"><i class="fa fa-paint-brush color-indicator hilite-color"
                        title="Background Color"></i></button>
                <ul class="dropdown-menu colorpicker-menu">
                    <li>
                        <div class="colorpicker">
                            <div class="o_we_colorpicker_switch_panel d-flex justify-content-end px-2"><button
                                    type="button" tabindex="1" class="o_we_colorpicker_switch_pane_btn active"
                                    data-target="theme-colors" title="Solid"><span>Solid</span></button><button
                                    type="button" tabindex="2" class="o_we_colorpicker_switch_pane_btn"
                                    data-target="custom-colors" title="Custom"><span>Custom</span></button><button
                                    type="button" tabindex="3" class="o_we_colorpicker_switch_pane_btn"
                                    data-target="gradients" title="Gradient"><span>Gradient</span></button><button
                                    type="button"
                                    class="fa fa-trash my-1 ms-5 py-0 o_we_color_btn o_colorpicker_reset o_we_hover_danger"
                                    title="Reset"></button></div>
                            <div class="o_colorpicker_sections pt-2 px-2 pb-3 d-none"
                                data-color-tab="color-combinations"><button type="button"
                                    class="o_we_color_btn o_we_color_combination_btn" data-color="1" title="Preset 1">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc1">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="2" title="Preset 2">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc2">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="3" title="Preset 3">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc3">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="4" title="Preset 4">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc4">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button><button type="button" class="o_we_color_btn o_we_color_combination_btn"
                                    data-color="5" title="Preset 5">
                                    <div class="o_we_cc_preview_wrapper d-flex justify-content-between o_cc o_cc5">
                                        <h1 class="o_we_color_combination_btn_title">Title</h1>
                                        <p class="o_we_color_combination_btn_text flex-grow-1">Text</p><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-primary o_btn_preview me-1"><small>Button</small></span><span
                                            class="o_we_color_combination_btn_btn btn btn-sm btn-secondary o_btn_preview"><small>Button</small></span>
                                    </div>
                                </button></div>
                            <div class="o_colorpicker_sections py-3 px-2" data-color-tab="theme-colors">
                                <div class="o_colorpicker_section" data-name="theme">
                                    <div></div>
                                    <button data-color="o-color-1" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-1);"></button>
                                    <button data-color="o-color-3" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-3);"></button>
                                    <button data-color="o-color-2" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-2);"></button>
                                    <button data-color="o-color-4" class="ms-2 o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-4);"></button>
                                    <button data-color="o-color-5" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-o-color-5);"></button>
                                </div>
                                <div class="o_colorpicker_section" data-name="common">
                                    <div></div>
                                    <button data-color="black" class="o_we_color_btn bg-black"></button>
                                    <button data-color="900" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-900);"></button>
                                    <button data-color="800" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-800);"></button>
                                    <button data-color="700" class="d-none o_we_color_btn"
                                        style="background-color: var(--we-cp-700);"></button>
                                    <button data-color="600" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-600);"></button>
                                    <button data-color="500" class="d-none o_we_color_btn"
                                        style="background-color: var(--we-cp-500);"></button>
                                    <button data-color="400" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-400);"></button>
                                    <button data-color="300" class="d-none o_we_color_btn"
                                        style="background-color: var(--we-cp-300);"></button>
                                    <button data-color="200" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-200);"></button>
                                    <button data-color="100" class="o_we_color_btn"
                                        style="background-color: var(--we-cp-100);"></button>
                                    <button data-color="white" class="o_we_color_btn bg-white"></button>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#FF0000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FF9C00;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFFF00;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#00FF00;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#00FFFF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#0000FF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#9C00FF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FF00FF;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#F7C6CE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFE7CE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFEFC6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#D6EFD6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#CEDEE7;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#CEE7F7;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#D6D6E7;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#E7D6DE;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#E79C9C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFC69C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFE79C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#B5D6A5;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#A5C6CE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#9CC6EF;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#B5A5D6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#D6A5BD;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#E76363;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#F7AD6B;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#FFD663;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#94BD7B;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#73A5AD;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#6BADDE;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#8C7BC6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#C67BA5;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#CE0000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#E79439;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#EFC631;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#6BA54A;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#4A7B8C;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#3984C6;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#634AA5;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#A54A7B;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#9C0000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#B56308;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#BD9400;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#397B21;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#104A5A;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#085294;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#311873;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#731842;"></button></div>
                                    <div class="clearfix"><button class="o_we_color_btn o_common_color"
                                            style="background-color:#630000;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#7B3900;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#846300;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#295218;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#083139;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#003163;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#21104A;"></button><button
                                            class="o_we_color_btn o_common_color"
                                            style="background-color:#4A1031;"></button></div>
                                </div>
                            </div>
                            <div class="o_colorpicker_sections py-3 px-2 d-none" data-color-tab="custom-colors">
                                <div class="o_colorpicker_section_container">
                                    <div class="o_colorpicker_section" data-name="custom">
                                        <div></div><button class="o_we_color_btn o_custom_color selected"
                                            style="background-color:rgba(0, 0, 0, 0);"></button>
                                    </div>
                                    <div class="o_colorpicker_section d-none" data-name="transparent_grayscale">
                                        <div></div>
                                        <button data-color="black-15" class="o_we_color_btn bg-black-15"></button>
                                        <button data-color="black-25" class="o_we_color_btn bg-black-25"></button>
                                        <button data-color="black-50" class="o_we_color_btn bg-black-50"></button>
                                        <button data-color="black-75" class="o_we_color_btn bg-black-75"></button>
                                        <button data-color="white-25" class="o_we_color_btn bg-white-25"></button>
                                        <button data-color="white-50" class="o_we_color_btn bg-white-50"></button>
                                        <button data-color="white-75" class="o_we_color_btn bg-white-75"></button>
                                        <button data-color="white-85" class="o_we_color_btn bg-white-85"></button>
                                    </div>
                                    <div class="o_colorpicker_section" data-name="common">
                                        <div></div>
                                        <button data-color="black" class="o_we_color_btn bg-black"></button>
                                        <button data-color="900" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-900);"></button>
                                        <button data-color="800" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-800);"></button>
                                        <button data-color="700" class="d-none o_we_color_btn"
                                            style="background-color: var(--we-cp-700);"></button>
                                        <button data-color="600" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-600);"></button>
                                        <button data-color="500" class="d-none o_we_color_btn"
                                            style="background-color: var(--we-cp-500);"></button>
                                        <button data-color="400" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-400);"></button>
                                        <button data-color="300" class="d-none o_we_color_btn"
                                            style="background-color: var(--we-cp-300);"></button>
                                        <button data-color="200" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-200);"></button>
                                        <button data-color="100" class="o_we_color_btn"
                                            style="background-color: var(--we-cp-100);"></button>
                                        <button data-color="white" class="o_we_color_btn bg-white"></button>
                                    </div>
                                </div>
                                <div class="o_colorpicker_widget">
                                    <div class="d-flex justify-content-between align-items-stretch mb-2">
                                        <div class="o_color_pick_area position-relative w-75"
                                            style="background-color: rgb(255, 0, 0);">
                                            <div class="o_picker_pointer rounded-circle p-1 position-absolute"
                                                tabindex="-1" style="top: 120px; left: -5px;"></div>
                                        </div>
                                        <div class="o_color_slider position-relative">
                                            <div class="o_slider_pointer" tabindex="-1" style="top: -2px;"></div>
                                        </div>
                                        <div class="o_opacity_slider position-relative"
                                            style="background: linear-gradient(rgb(0, 0, 0) 0%, transparent 100%);">
                                            <div class="o_opacity_pointer" tabindex="-1" style="top: -2px;"></div>
                                        </div>
                                    </div>
                                    <div class="o_color_picker_inputs d-flex justify-content-between mb-2">
                                        <div class="o_hex_div px-1 d-flex align-items-baseline"><input type="text"
                                                data-color-method="hex" size="1"
                                                class="o_hex_input p-0 border-0 text-center font-monospace bg-transparent"><label
                                                class="flex-grow-0 ms-1 mb-0">hex</label></div>
                                        <div class="o_rgba_div px-1 d-flex align-items-baseline"><input type="text"
                                                data-color-method="rgb" size="1"
                                                class="o_red_input p-0 border-0 text-center font-monospace bg-transparent"><input
                                                type="text" data-color-method="rgb" size="1"
                                                class="o_green_input p-0 border-0 text-center font-monospace bg-transparent"><input
                                                type="text" data-color-method="rgb" size="1"
                                                class="o_blue_input me-0 p-0 border-0 text-center font-monospace bg-transparent"><input
                                                type="text" data-color-method="opacity" size="1"
                                                class="o_opacity_input p-0 border-0 text-center font-monospace bg-transparent"><label
                                                class="flex-grow-0 ms-1 mb-0"> RGBA </label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="o_colorpicker_sections py-3 px-2 d-none" data-color-tab="gradients">
                                <div class="o_colorpicker_section_container">
                                    <div class="o_colorpicker_section" data-name="predefined_gradients">
                                        <div></div>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(255, 204, 51) 0%, rgb(226, 51, 255) 100%);"
                                            data-color="linear-gradient(135deg, rgb(255, 204, 51) 0%, rgb(226, 51, 255) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(102, 153, 255) 0%, rgb(255, 51, 102) 100%);"
                                            data-color="linear-gradient(135deg, rgb(102, 153, 255) 0%, rgb(255, 51, 102) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(47, 128, 237) 0%, rgb(178, 255, 218) 100%);"
                                            data-color="linear-gradient(135deg, rgb(47, 128, 237) 0%, rgb(178, 255, 218) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(203, 94, 238) 0%, rgb(75, 225, 236) 100%);"
                                            data-color="linear-gradient(135deg, rgb(203, 94, 238) 0%, rgb(75, 225, 236) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(214, 255, 127) 0%, rgb(0, 179, 204) 100%);"
                                            data-color="linear-gradient(135deg, rgb(214, 255, 127) 0%, rgb(0, 179, 204) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(255, 222, 69) 0%, rgb(69, 33, 0) 100%);"
                                            data-color="linear-gradient(135deg, rgb(255, 222, 69) 0%, rgb(69, 33, 0) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(222, 222, 222) 0%, rgb(69, 69, 69) 100%);"
                                            data-color="linear-gradient(135deg, rgb(222, 222, 222) 0%, rgb(69, 69, 69) 100%)"></button>
                                        <button class="w-50 o_we_color_btn"
                                            style="background-image: linear-gradient(135deg, rgb(255, 222, 202) 0%, rgb(202, 115, 69) 100%);"
                                            data-color="linear-gradient(135deg, rgb(255, 222, 202) 0%, rgb(202, 115, 69) 100%)"></button>
                                    </div>
                                    <div class="o_colorpicker_section o_custom_gradient_editor"
                                        data-name="custom_gradient">
                                        <div></div>
                                        <button class="w-50 o_custom_gradient_btn o_we_color_btn py-1 btn"
                                            title="Define a custom gradient" data-color="false">Custom</button>
                                        <div class="o_color_picker_inputs mx-1 d-none">
                                            <div class="d-flex justify-content-between my-2 o_type_row">
                                                <we-title>Type</we-title>
                                                <span class="d-flex justify-content-between">
                                                    <we-button data-gradient-type="linear-gradient"
                                                        class="d-flex align-items-baseline active">Linear</we-button>
                                                    <we-button data-gradient-type="radial-gradient"
                                                        class="d-flex align-items-baseline">Radial</we-button>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between my-2 o_angle_row">
                                                <we-title>Angle</we-title>
                                                <span
                                                    class="o_custom_gradient_input bg-black-50 px-1 d-flex align-items-baseline">
                                                    <input data-name="angle" type="text" style="width: 5ch;"
                                                        value="90"
                                                        class="p-0 border-0 text-center font-monospace bg-transparent text-white">
                                                    <span class="flex-grow-0 ms-1 text-white-50">deg</span>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between my-2 o_position_row">
                                                <we-title>Position</we-title>
                                                <span class="d-flex">
                                                    <span class="me-2">X</span>
                                                    <span class="o_custom_gradient_input bg-black-50 px-1 d-flex">
                                                        <input data-name="positionX" type="text"
                                                            style="width: 3ch;" value="25"
                                                            class="p-0 border-0 text-center font-monospace bg-transparent text-white">
                                                        <span class="flex-grow-0 ms-1 text-white-50">%</span>
                                                    </span>
                                                    <span class="me-2 ms-3">Y</span>
                                                    <span class="o_custom_gradient_input bg-black-50 px-1 d-flex">
                                                        <input data-name="positionY" type="text"
                                                            style="width: 3ch;" value="25"
                                                            class="p-0 border-0 text-center font-monospace bg-transparent text-white">
                                                        <span class="flex-grow-0 ms-1 text-white-50">%</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between my-2 o_size_row">
                                                <we-title>Size</we-title>
                                                <span class="d-flex justify-content-between">
                                                    <we-button data-gradient-size="closest-side"
                                                        class="d-flex align-items-baseline"
                                                        title="Extend to the closest side">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path
                                                                d="M3 4H9V8C9 8.55228 8.55228 9 8 9H4C3.44772 9 3 8.55228 3 8V4Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="2" y="3" width="12" height="1"
                                                                fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                    <we-button data-gradient-size="closest-corner"
                                                        class="d-flex align-items-baseline"
                                                        title="Extend to the closest corner">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path d="M2 4H9V7C9 9.20914 7.20914 11 5 11H2V4Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="1" y="3" width="8" height="1"
                                                                fill="white"></rect>
                                                            <rect x="1" y="11" width="8" height="1"
                                                                transform="rotate(-90 1 11)" fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                    <we-button data-gradient-size="farthest-side"
                                                        class="d-flex align-items-baseline active"
                                                        title="Extend to the farthest side">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path
                                                                d="M7 12C10.3137 12 14 10.2091 14 8C14 5.79086 10.3137 4 7 4C3.68629 4 2 5.79086 2 8C2 10.2091 3.68629 12 7 12Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="14" y="4" width="1" height="12"
                                                                fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                    <we-button data-gradient-size="farthest-corner"
                                                        class="d-flex align-items-baseline"
                                                        title="Extend to the farthest corner">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="20" viewBox="0 0 16 20" fill="none">
                                                            <rect x="1.5" y="3.5" width="13" height="13"
                                                                stroke="#AAAAAD"></rect>
                                                            <path d="M2 4H14V10C14 13.3137 11.3137 16 8 16H2V4Z"
                                                                fill="#8C8C92"></path>
                                                            <path
                                                                d="M6 11C7.65685 11 9 9.65685 9 8C9 6.34315 7.65685 5 6 5C4.34315 5 3 6.34315 3 8C3 9.65685 4.34315 11 6 11Z"
                                                                fill="#74747B"></path>
                                                            <path
                                                                d="M6 10C7.10457 10 8 9.10457 8 8C8 6.89543 7.10457 6 6 6C4.89543 6 4 6.89543 4 8C4 9.10457 4.89543 10 6 10Z"
                                                                fill="white"></path>
                                                            <rect x="15" y="17" width="7" height="0.999999"
                                                                transform="rotate(-180 15 17)" fill="white"></rect>
                                                            <rect x="15" y="10" width="7" height="1"
                                                                transform="rotate(90 15 10)" fill="white"></rect>
                                                        </svg>
                                                    </we-button>
                                                </span>
                                            </div>
                                            <div class="mx-1 o_custom_gradient_scale">
                                                <div class="w-100"></div>
                                            </div>
                                            <div class="w-100 o_slider_multi" role="group"></div>
                                            <we-button
                                                class="o_remove_color fa fa-fw fa-trash o_we_link o_we_hover_danger d-none"
                                                title="Remove Selected Color"
                                                aria-label="Remove Selected Color"></we-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div id="font-size" class="btn-group dropdown"><button type="button" class="btn dropdown-toggle"
                data-bs-toggle="dropdown" tabindex="-1" data-bs-original-title="Font Size" aria-expanded="false">
                <div id="font-size-input-container"><input type="text" id="fontSizeCurrentValue"
                        title="Font size" value="13" readonly="" class="cursor-pointer"></div>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="display-1-font-size" data-apply-class="display-1-fs" href="#"
                        data-value="80">80<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Display 1</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="display-2-font-size" data-apply-class="display-2-fs" href="#"
                        data-value="72">72<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Display 2</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="display-3-font-size" data-apply-class="display-3-fs" href="#"
                        data-value="64">64<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Display 3</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="display-4-font-size" data-apply-class="display-4-fs" href="#"
                        data-value="56">56<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Display 4</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="h1-font-size" data-apply-class="h1-fs" href="#"
                        data-value="34">34<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Heading 1</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="h2-font-size" data-apply-class="h2-fs" href="#"
                        data-value="21">21<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Heading 2</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="h3-font-size" data-apply-class="h3-fs" href="#"
                        data-value="18">18<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Heading 3</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="h4-font-size" data-apply-class="h4-fs" href="#"
                        data-value="17">17<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Heading 4</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="h5-font-size" data-apply-class="h5-fs" href="#"
                        data-value="15">15<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Heading 5</span></a>
                </li>
                <li class="d-none"><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="h6-font-size" data-apply-class="h6-fs" href="#"
                        data-value="14">14<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Heading 6</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="font-size-base" data-apply-class="base-fs" href="#"
                        data-value="14">14<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Normal</span></a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                        data-dynamic-value="small-font-size" data-apply-class="o_small-fs" href="#"
                        data-value="13">13<span
                            class="d-none o_we_font_size_badge badge rounded-pill text-bg-dark ms-4">Small</span></a></li>
            </ul>
        </div>
        <div id="list" class="btn-group">
            <div id="unordered" data-call="toggleList" data-arg1="UL" title="Toggle unordered list"
                class="oe-toggle-unordered fa fa-list-ul fa-fw btn"></div>
            <div id="ordered" data-call="toggleList" data-arg1="OL" title="Toggle ordered list"
                class="oe-toggle-ordered fa fa-list-ol fa-fw btn"></div>
            <div id="checklist" data-call="toggleList" data-arg1="CL" title="Toggle checklist"
                class="oe-toggle-checklist btn fa fa-fw">
                <div class="small">
                    <div class="fa fa-square-o d-block small"></div>
                    <div class="fa fa-check-square d-block small"></div>
                </div>
            </div>
        </div>
        <div id="image-preview" class="btn-group d-none">
            <div id="image-fullscreen" title="Full screen" class="fa fa-search-plus btn editor-ignore"></div>
        </div>
        <div id="link" class="btn-group">
            <div id="create-link" title="Insert or edit link" class="fa fa-link fa-fw btn editor-ignore"></div>
            <div id="unlink" data-call="unlink" title="Remove link" class="fa fa-unlink fa-fw btn"></div><a
                id="media-description" href="#" title="Edit media description"
                class="btn editor-ignore d-none">Description</a>
        </div>
        <div id="chatgpt" class="btn-group">
            <div id="open-chatgpt" title="Generate or transform content with AI" class="btn editor-ignore"><span
                    class="fa fa-magic fa-fw"></span></div>
        </div>
        <div id="image-shape" class="btn-group d-none">
            <div id="rounded" title="Shape: Rounded" class="fa fa-square fa-fw btn editor-ignore"></div>
            <div id="rounded-circle" title="Shape: Circle" class="fa fa-circle-o fa-fw btn editor-ignore"></div>
            <div id="shadow" title="Shadow" class="fa fa-sun-o fa-fw btn editor-ignore"></div>
            <div id="img-thumbnail" title="Shape: Thumbnail" class="fa fa-picture-o fa-fw btn editor-ignore"></div>
        </div>
        <div id="image-padding" class="btn-group dropdown d-none"><button type="button" class="btn dropdown-toggle"
                data-bs-toggle="dropdown" tabindex="-1" aria-expanded="false"><span class="fa fa-plus-square-o"
                    title="Image padding"></span></button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item editor-ignore" href="#" data-class="">None</a></li>
                <li><a class="dropdown-item editor-ignore" href="#" data-class="padding-small">Small</a></li>
                <li><a class="dropdown-item editor-ignore" href="#" data-class="padding-medium">Medium</a></li>
                <li><a class="dropdown-item editor-ignore" href="#" data-class="padding-large">Large</a></li>
                <li><a class="dropdown-item editor-ignore" href="#" data-class="padding-xl">XL</a></li>
            </ul>
        </div>
        <div id="image-width" class="btn-group d-none">
            <div title="Resize Default" class="btn editor-ignore">Default</div>
            <div id="100%" title="Resize Full" class="btn editor-ignore">100%</div>
            <div id="50%" title="Resize Half" class="btn editor-ignore">50%</div>
            <div id="25%" title="Resize Quarter" class="btn editor-ignore">25%</div>
        </div>
        <div id="image-edit" class="btn-group d-none">
            <div id="image-crop" title="Crop Image" class="btn fa fa-crop editor-ignore d-none"></div>
            <div id="image-transform" class="btn editor-ignore fa fa-object-ungroup d-none"
                title="Transform the picture (click twice to reset transformation)"></div><span
                class="oe-toolbar-separator d-flex"></span>
            <div id="media-replace" title="Replace media" class="btn o_we_bg_success editor-ignore d-none">Replace
            </div><span class="oe-toolbar-separator d-flex"></span>
            <div id="image-delete" class="btn btn-link text-danger editor-ignore fa fa-trash" title="Remove (DELETE)">
            </div>
        </div>
        <div id="fa-resize" class="btn-group only_fa d-none">
            <div class="editor-ignore btn" title="Icon size 1x" data-value="1">1x</div>
            <div class="editor-ignore btn" title="Icon size 2x" data-value="2">2x</div>
            <div class="editor-ignore btn" title="Icon size 3x" data-value="3">3x</div>
            <div class="editor-ignore btn" title="Icon size 4x" data-value="4">4x</div>
            <div class="editor-ignore btn" title="Icon size 5x" data-value="5">5x</div>
        </div>
        <div class="btn-group only_fa d-none">
            <div id="fa-spin" title="Toggle icon spin" class="editor-ignore btn fa fa-play"></div>
        </div>
    </div>
@endsection
