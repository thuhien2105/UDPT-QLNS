@extends('layout.master')
@section('content')

<body class="o_web_client o_debug">
	<header class="o_navbar">
		<nav class="o_main_navbar" data-command-category="disabled">
			<a href="/" class="o_menu_toggle hasImage" title="Home menu" aria-label="Home menu" data-hotkey="h" style="position: relative"><svg xmlns="http://www.w3.org/2000/svg" class="o_menu_toggle_icon pe-none" width="14px" height="14px" viewBox="0 0 14 14">
					<g xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="o_menu_toggle_row_0">
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="0" y="0"></rect>
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="5" y="0"></rect>
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="10" y="0"></rect>
					</g>
					<g xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="o_menu_toggle_row_1">
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="0" y="5"></rect>
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="5" y="5"></rect>
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="10" y="5"></rect>
					</g>
					<g xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="o_menu_toggle_row_2">
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="0" y="10"></rect>
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="5" y="10"></rect>
						<rect xmlns="http://www.w3.org/2000/svg" width="3" height="3" x="10" y="10"></rect>
					</g>
				</svg><img class="o_menu_brand_icon d-none d-lg-inline position-absolute start-0 h-100 ps-1 ms-2" src="data:image/png;base64,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" /><span class="o_menu_brand d-none d-md-flex ms-3 pe-0">Employees</span></a>
			<div class="o_menu_sections d-none d-md-flex flex-grow-1 flex-shrink-1 w-0" role="menu">
				<div class="o-dropdown dropdown o-dropdown--no-caret">
					<a href="/approvals/list" type="button" class="dropdown-toggle fw-normal" data-hotkey="1" tabindex="0" aria-expanded="false" data-menu-xmlid="approvals.approvals_approval_menu">
						<span data-section="301">My Approvals</span>
                    </a>
				</div>
				<div class="o-dropdown dropdown o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle fw-normal" data-hotkey="2" tabindex="0" aria-expanded="false" data-menu-xmlid="approvals.approvals_menu_manager">
						<span data-section="304">Manager</span>
					</button>
				</div>
				<div class="o-dropdown dropdown o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle fw-normal" data-hotkey="3" tabindex="0" aria-expanded="false" data-menu-xmlid="approvals.approvals_menu_config">
						<span data-section="307">Configuration</span>
					</button>
				</div>
			</div>
			<div class="o_menu_systray d-flex flex-shrink-0 ms-auto" role="menu">
				<div></div>
				<div class="o-dropdown dropdown o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle" tabindex="0" aria-expanded="false">
						<i class="fa fa-circle text-danger" role="img" aria-label="Attendance"></i>
					</button>
				</div>
				<div></div>
				<div class="o-dropdown dropdown o_debug_manager o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle o-dropdown--narrow" tabindex="0" aria-expanded="false">
						<i class="fa fa-bug" role="img" aria-label="Open developer tools"></i>
					</button>
				</div>
				<div></div>
				<div class="dropdown"></div>
				<div></div>
				<div class="o-dropdown dropdown o-mail-DiscussSystray-class o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle" tabindex="0" aria-expanded="false">
						<i class="fa fa-lg fa-comments" role="img" aria-label="Messages"></i><span class="o-mail-MessagingMenu-counter badge rounded-pill">7</span>
					</button>
				</div>
				<div></div>
				<div class="o-dropdown dropdown o-mail-DiscussSystray-class o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle" tabindex="0" aria-expanded="false">
						<i class="fa fa-lg fa-clock-o" role="img" aria-label="Activities"></i><span class="o-mail-ActivityMenu-counter badge rounded-pill">17</span>
					</button>
				</div>
				<div></div>
				<div></div>
				<div>
					<button class="o_mobile_menu_toggle o_nav_entry o-no-caret d-md-none border-0 pe-3" title="Toggle menu" aria-label="Toggle menu">
						<i class="fa fa-panel-right"></i>
					</button>
				</div>
				<div></div>
				<div class="o-dropdown dropdown o_user_menu d-none d-md-block pe-0 o-dropdown--no-caret">
					<button type="button" class="dropdown-toggle py-1 py-lg-0" tabindex="0" aria-expanded="false">
						<img class="o_avatar o_user_avatar rounded" alt="User" src="http://localhost:8069/web/image?model=res.users&amp;field=avatar_128&amp;id=2" /><small class="oe_topbar_name d-none ms-2 text-start smaller lh-1 text-truncate d-lg-inline-block" style="max-width: 200px">Mitchell Admin<mark class="d-block font-monospace text-truncate"><i class="fa fa-database fa-small me-1"></i>odoo-17</mark></small>
					</button>
				</div>
			</div>
		</nav>
	</header>
	<div class="o_action_manager">
		<div class="o_list_view o_view_controller o_action">
			<div class="o_control_panel d-flex flex-column gap-3 gap-lg-1 px-3 pt-2 pb-3" data-command-category="actions">
				<div class="o_control_panel_main d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-lg-start gap-3 flex-grow-1">
					<div class="o_control_panel_breadcrumbs d-flex align-items-center gap-1 order-0 h-lg-100">
						<div class="o_control_panel_main_buttons d-flex gap-1 d-empty-none d-print-none">
							<div class="d-xl-none o_control_panel_collapsed_create">
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split o_control_panel_collapsed_create d-none" data-bs-toggle="dropdown" aria-expanded="false">
									<span class="visually-hidden">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu o_control_panel_collapsed_create d-none">
									<div class="o_list_buttons d-flex gap-1 d-empty-none align-items-baseline" role="toolbar" aria-label="Main actions"></div>
								</ul>
							</div>
							<div class="d-none d-xl-inline-flex gap-1">
								<div class="o_list_buttons d-flex gap-1 d-empty-none align-items-baseline" role="toolbar" aria-label="Main actions"></div>
							</div>
						</div>
						<div class="o_breadcrumb d-flex gap-1 text-truncate">
							<div class="o_last_breadcrumb_item active d-flex fs-4 min-w-0 align-items-center">
								<span class="min-w-0 text-truncate">My Requests</span>
							</div>
							<div class="o_control_panel_breadcrumbs_actions d-inline-flex">
								<div class="o_cp_action_menus d-flex align-items-center pe-2 gap-1">
									<div class="o-dropdown dropdown lh-1 o-dropdown--no-caret">
										<button type="button" class="dropdown-toggle d-print-none btn p-0 ms-1 lh-sm border-0" tabindex="0" aria-expanded="false">
											<i class="fa fa-cog" data-hotkey="u" data-tooltip="Actions"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<span class="d-none d-xl-block me-auto"></span>
					</div>
					<div class="o_control_panel_actions d-empty-none d-flex align-items-center justify-content-start justify-content-lg-around order-2 order-lg-1 w-100 w-lg-auto">
						<div class="o_cp_searchview d-flex input-group" role="search">
							<div class="o_searchview form-control d-print-contents d-flex align-items-center py-1" role="search" aria-autocomplete="list">
								<i class="o_searchview_icon d-print-none fa fa-search me-2" role="img" aria-label="Search..." title="Search..."></i>
								<div class="o_searchview_input_container d-flex flex-grow-1 flex-wrap gap-1">
									<input type="text" class="o_searchview_input o_input d-print-none flex-grow-1 w-auto border-0" placeholder="Search..." role="searchbox" data-hotkey="Q" />
								</div>
							</div>
							<div class="o-dropdown dropdown o-dropdown--no-caret">
								<button type="button" class="dropdown-toggle o_searchview_dropdown_toggler d-print-none btn btn-outline-secondary o-no-caret rounded-start-0 h-100" tabindex="0" aria-expanded="false">
									<i class="fa fa-caret-down" aria-hidden="true" data-hotkey="shift+q" title="Toggle Search Panel"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="o_control_panel_navigation d-flex flex-wrap flex-md-nowrap justify-content-end gap-3 gap-lg-1 gap-xl-3 order-1 order-lg-2 flex-grow-1">
						<div class="o_cp_pager text-nowrap" role="search">
							<nav class="o_pager d-flex gap-2 h-100" aria-label="Pager">
								<span class="o_pager_counter align-self-center"><span class="o_pager_value d-inline-block border-bottom border-transparent mb-n1">1-1</span><span> / </span><span class="o_pager_limit">1</span></span><span class="btn-group d-print-none" aria-atomic="true"><button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous px-2 rounded-start" aria-label="Previous" data-tooltip="Previous" tabindex="-1" data-hotkey="p" disabled=""></button><button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next px-2 rounded-end" aria-label="Next" data-tooltip="Next" tabindex="-1" data-hotkey="n" disabled=""></button></span>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<div class="o_content">
				<div class="o_list_renderer o_renderer table-responsive o_list_renderer_1" tabindex="-1">
					<table class="o_list_table table table-sm table-hover position-relative mb-0 o_list_table_ungrouped table-striped" style="table-layout: fixed">
						<thead>
							<tr>
								<th class="o_list_record_selector o_list_controller align-middle pe-1 cursor-pointer" tabindex="-1" style="width: 41px">
									<div class="o-checkbox form-check d-flex m-0">
										<input type="checkbox" class="form-check-input" id="checkbox-comp-1" /><label class="form-check-label" for="checkbox-comp-1"></label>
									</div>
								</th>
								<th data-tooltip-delay="1000" tabindex="-1" data-name="name" class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover" data-tooltip-template="web.FieldTooltip" data-tooltip-info='{"viewMode":"list","resModel":"approval.request","debug":true,"field":{"name":"name","type":"char","widget":null,"context":"{}","invisible":null,"column_invisible":null,"readonly":null,"required":null,"changeDefault":false}}' style="width: 356px">
									<div class="d-flex">
										<span class="d-block min-w-0 text-truncate flex-grow-1">Approval Subject</span><i class="fa fa-lg fa-angle-down opacity-0 opacity-75-hover"></i>
									</div>
									<span class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
								</th>
								<th data-tooltip-delay="1000" tabindex="-1" data-name="request_owner_id" class="align-middle o_column_sortable position-relative cursor-pointer o_many2one_avatar_user_cell opacity-trigger-hover" data-tooltip-template="web.FieldTooltip" data-tooltip-info='{"viewMode":"list","resModel":"approval.request","debug":true,"field":{"name":"request_owner_id","type":"many2one","widget":"many2one_avatar_user","widgetDescription":"Many2one","context":"{}","domain":"(company_id and [(&apos;company_ids&apos;, &apos;in&apos;, [company_id])] or []) + ([(&apos;company_ids&apos;, &apos;in&apos;, company_id)])","invisible":null,"column_invisible":null,"readonly":null,"required":null,"changeDefault":false,"relation":"res.users"}}' style="width: 302px">
									<div class="d-flex">
										<span class="d-block min-w-0 text-truncate flex-grow-1">Request Owner</span><i class="fa fa-lg fa-angle-down opacity-0 opacity-75-hover"></i>
									</div>
									<span class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
								</th>
								<th data-tooltip-delay="1000" tabindex="-1" data-name="category_id" class="align-middle o_column_sortable position-relative cursor-pointer opacity-trigger-hover" data-tooltip-template="web.FieldTooltip" data-tooltip-info='{"viewMode":"list","resModel":"approval.request","debug":true,"field":{"name":"category_id","type":"many2one","widget":null,"context":"{}","domain":[],"invisible":null,"column_invisible":null,"readonly":null,"required":"True","changeDefault":false,"relation":"approval.category"}}' style="width: 203px">
									<div class="d-flex">
										<span class="d-block min-w-0 text-truncate flex-grow-1">Category</span><i class="fa fa-lg fa-angle-down opacity-0 opacity-75-hover"></i>
									</div>
									<span class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
								</th>
								<th data-tooltip-delay="1000" tabindex="-1" data-name="activity_ids" class="align-middle cursor-default o_list_activity_cell opacity-trigger-hover" data-tooltip-template="web.FieldTooltip" data-tooltip-info='{"viewMode":"list","resModel":"approval.request","debug":true,"field":{"name":"activity_ids","type":"one2many","widget":"list_activity","context":"{}","domain":[],"invisible":null,"column_invisible":null,"readonly":null,"required":null,"changeDefault":false,"relation":"mail.activity"}}' style="width: 155px">
									<div class="d-flex">
										<span class="d-block min-w-0 text-truncate flex-grow-1">Activities</span><i class="d-none fa-angle-down opacity-0 opacity-75-hover"></i>
									</div>
									<span class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
								</th>
								<th data-tooltip-delay="1000" tabindex="-1" data-name="request_status" class="align-middle o_column_sortable position-relative cursor-pointer o_badge_cell opacity-trigger-hover" data-tooltip-template="web.FieldTooltip" data-tooltip-info='{"viewMode":"list","resModel":"approval.request","debug":true,"field":{"name":"request_status","type":"selection","widget":"badge","widgetDescription":"Badge","context":"{}","invisible":null,"column_invisible":null,"readonly":"True","required":null,"changeDefault":false,"selection":[["new","To Submit"],["pending","Submitted"],["approved","Approved"],["refused","Refused"],["cancel","Cancel"]]}}' style="width: 265px">
									<div class="d-flex">
										<span class="d-block min-w-0 text-truncate flex-grow-1">Request Status</span><i class="fa fa-lg fa-angle-down opacity-0 opacity-75-hover"></i>
									</div>
									<span class="o_resize position-absolute top-0 end-0 bottom-0 ps-1 bg-black-25 opacity-0 opacity-50-hover z-index-1"></span>
								</th>
								<th class="o_list_controller o_list_actions_header position-sticky end-0">
									<div class="o-dropdown dropdown o_optional_columns_dropdown text-center border-top-0 o-dropdown--no-caret">
										<button type="button" class="dropdown-toggle btn p-0" tabindex="-1" aria-expanded="false">
											<i class="o_optional_columns_dropdown_toggle fa fa-fw fa-settings-adjust"></i>
										</button>
									</div>
								</th>
							</tr>
						</thead>
						<tbody class="ui-sortable">
							<tr onclick="window.location.href = '/employees /form';" class="o_data_row text-info" data-id="datapoint_35">
								<td class="o_list_record_selector user-select-none" tabindex="-1">
									<div class="o-checkbox form-check">
										<input type="checkbox" class="form-check-input" id="checkbox-comp-2" /><label class="form-check-label" for="checkbox-comp-2"></label>
									</div>
								</td>
								<td class="o_data_cell cursor-pointer o_field_cell o_list_char" data-tooltip-delay="1000" tabindex="-1" name="name" data-tooltip="Business trip to London">
									Business trip to London
								</td>
								<td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_many2one_avatar_user_cell" data-tooltip-delay="1000" tabindex="-1" name="request_owner_id" data-tooltip="Mitchell Admin">
									<div name="request_owner_id" class="o_field_widget o_field_many2one_avatar_user o_field_many2one_avatar">
										<div class="d-flex align-items-center gap-1" data-tooltip="Mitchell Admin">
											<span class="o_avatar o_m2o_avatar"><img class="rounded" src="/web/image/res.users/2/avatar_128" /></span><span><span>Mitchell Admin</span></span>
										</div>
									</div>
								</td>
								<td class="o_data_cell cursor-pointer o_field_cell o_list_many2one o_required_modifier" data-tooltip-delay="1000" tabindex="-1" name="category_id" data-tooltip="Business Trip">
									Business Trip
								</td>
								<td class="o_data_cell cursor-pointer o_field_cell o_list_activity_cell" data-tooltip-delay="1000" tabindex="-1" name="activity_ids">
									<div name="activity_ids" class="o_field_widget o_field_list_activity">
										<a class="o-mail-ActivityButton" role="button" aria-label="Show activities" title="Show activities"><i class="fa fa-fw fa-lg text-muted fa-clock-o btn-link text-dark" role="img"></i></a><span class="o-mail-ListActivity-summary"></span>
									</div>
								</td>
								<td class="o_data_cell cursor-pointer o_field_cell o_badge_cell o_readonly_modifier" data-tooltip-delay="1000" tabindex="-1" name="request_status" data-tooltip="To Submit">
									<div name="request_status" class="o_field_widget o_readonly_modifier o_field_badge text-info">
										<span class="badge rounded-pill text-bg-info">To Submit</span>
									</div>
								</td>
								<td tabindex="-1"></td>
							</tr>
							<tr>
								<td colspan="7">​</td>
							</tr>
							<tr>
								<td colspan="7">​</td>
							</tr>
							<tr>
								<td colspan="7">​</td>
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
</body>

@endsection
@section('title')
	Thông tin cá nhân
@endsection
