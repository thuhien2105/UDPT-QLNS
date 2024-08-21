@extends('layout.master')
@section('content')

<body class="o_web_client o_debug o_home_menu_background">
    <header class="o_navbar">
        <nav class="o_main_navbar" data-command-category="disabled">
            <a href="#" class="o_menu_toggle o_hidden hasImage" title="Home menu" aria-label="Home menu"
                data-hotkey="h"><svg xmlns="http://www.w3.org/2000/svg" class="o_menu_toggle_icon pe-none" width="14px"
                    height="14px" viewBox="0 0 14 14">
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
                </svg><img
                    class="o_menu_brand_icon d-none d-lg-inline position-absolute start-0 h-100 ps-1 ms-2 o_hidden"
                    src="data:image/png;base64,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"
                    alt="Approvals" /><span
                    class="o_menu_brand d-none d-md-flex ms-3 pe-0 o_hidden">Approvals</span></a>
            <div class="o_menu_sections d-none d-md-flex flex-grow-1 flex-shrink-1 w-0 o_hidden" role="menu">
                <div class="o-dropdown dropdown o-dropdown--no-caret">
                    <button type="button" class="dropdown-toggle fw-normal" data-hotkey="1" tabindex="0"
                        aria-expanded="false" data-menu-xmlid="approvals.approvals_approval_menu">
                        <span data-section="301">My Approvals</span>
                    </button>
                </div>
                <div class="o-dropdown dropdown o-dropdown--no-caret">
                    <button type="button" class="dropdown-toggle fw-normal" data-hotkey="2" tabindex="0"
                        aria-expanded="false" data-menu-xmlid="approvals.approvals_menu_manager">
                        <span data-section="304">Manager</span>
                    </button>
                </div>
                <div class="o-dropdown dropdown o-dropdown--no-caret">
                    <button type="button" class="dropdown-toggle fw-normal" data-hotkey="3" tabindex="0"
                        aria-expanded="false" data-menu-xmlid="approvals.approvals_menu_config">
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
                        <i class="fa fa-lg fa-comments" role="img" aria-label="Messages"></i><span
                            class="o-mail-MessagingMenu-counter badge rounded-pill">7</span>
                    </button>
                </div>
                <div></div>
                <div class="o-dropdown dropdown o-mail-DiscussSystray-class o-dropdown--no-caret">
                    <button type="button" class="dropdown-toggle" tabindex="0" aria-expanded="false">
                        <i class="fa fa-lg fa-clock-o" role="img" aria-label="Activities"></i><span
                            class="o-mail-ActivityMenu-counter badge rounded-pill">17</span>
                    </button>
                </div>
                <div></div>
                <div></div>
                <div>
                    <button class="o_mobile_menu_toggle o_nav_entry o-no-caret d-md-none border-0 pe-3"
                        title="Toggle menu" aria-label="Toggle menu">
                        <i class="oi oi-panel-right"></i>
                    </button>
                </div>
                <div></div>
                <div class="o-dropdown dropdown o_user_menu d-none d-md-block pe-0 o-dropdown--no-caret">
                    <button type="button" class="dropdown-toggle py-1 py-lg-0" tabindex="0" aria-expanded="false">
                        <img class="o_avatar o_user_avatar rounded" alt="User"
                            src="http://localhost:8069/web/image?model=res.users&amp;field=avatar_128&amp;id=2" /><small
                            class="oe_topbar_name d-none ms-2 text-start smaller lh-1 text-truncate d-lg-inline-block"
                            style="max-width: 200px">Mitchell Admin<mark class="d-block font-monospace text-truncate"><i
                                    class="fa fa-database oi-small me-1"></i>odoo-17</mark></small>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    <div class="o_action_manager">
        <div class="o_home_menu h-100 overflow-auto">
            <div class="container">
                <input type="text" class="o_search_hidden visually-hidden w-auto" data-allow-hotkeys="true"
                    role="combobox" aria-autocomplete="list" aria-haspopup="listbox"
                    aria-activedescendant="result_app_null" aria-expanded="true" />
                <div role="listbox" class="o_apps row user-select-none mt-5 mx-0">
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/employees" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_8" aria-selected="false" data-menu-xmlid="hr.menu_hr_root"><img
                                class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Employees
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/employees" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_9" aria-selected="false"
                            data-menu-xmlid="hr_work_entry_contract_enterprise.menu_hr_payroll_root"><img
                                class="o_app_icon rounded-3"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAO2SURBVHgB7d1LSFRRHMfx37lNGumUMZViD61Ag3IKsiKoSCpqI9amNrWoTQQFbYIgIntAQYuIoFq1qU2LQMk2ESQFQS8qy0ghtJJJJamYJDX1dM44Y6Yzep256p/8fWBGZuaAeL/ee+5LBIiIiIiIiIiIiIiIiP5vavAbv89c2ARH71BKlZmX+aDxpPuD6PKLWb1p3Sc1cAQ0UbQv8twX44GJsRI0oRz7FF0zGEMA9evcxfypursBJIF2pujucpAYzhRgBUgMh3OHLA5IFAYRhkGEYRBhGEQYBhGGQYRhEGHUlWXbNUgKzTVEGAYRhkGEYRBhGEQYBhGGQYRhEGEc+NJBQqRnwKf8AehvIVB86f4MBPfuQO7qYORhtb3/gNc3KlBXeR9eUumZUFe3HdW66Q1oKP+8HJRdP2++Zsf9PNzUjMr9xxAOtcALzqJi7ajpM6Fm5YIGUWrYGJZ/fl8wuxal/O1sg6nT+iZ1FVgY2X7RX4VlW4aNEWOjFJlNWkrMso80QGwvy/HBWVDENSXGrB3BPWWuh88rLkKy7DK3y942sHz9n5g31JzFUFm50G2foDvbAfuYpGYvXeJ6bGyyd83s2dqdKWQEYKeMfz4aMthsx1ROwdA/HJlMRv3DKzgF6+EFHhjGYy7Zhd5+dD38a0MzvMIgCXypdR/k7d1n8AqDJFBT9Qzhlu8jjrNj6h7UwCsMkkBXewfunLyJcGviKDaGHeMldW3nWd7kMILCkiCWl67B7LxsM71ohMzmrLn2M95UPTE7op3wkPaBRmQ3SV5ulobDTZYwDCIMN1kxozkYHMNZl0EsE+PA7eOuh7c1tET2vhqe1qO+usbTQAwSFW79Af/cma7GBhZlRx75awtRvHsjnt96iHqPJn3OIZbu+61Pho1YcrgUq3ZvgBcYJCr0zv2pknjsmrJu31akikGi7HFGpzk6T0XQHDzmrylAKhgkqutnB6ovVyFVJYdKzQXA5O/kYZABGp/WmdMhqZ25TcuchoKSUV6wGoBBBnl8/R5e3HqEVOQuz0OyuNsbh92NtccZq3ZtgD87C6MVyMtBshgkgdgJRXumN88cb9jdW3u2143MuTOQLAYZwXie6bU4hwjDIMIwiDAMIgyDCMMgwjCIMAwiDIMIYq6TvWIQQZTSDCKI1r09pxlEBm1yXDpYUd7Ik4sTz/4Tl5dp6DllX3ANmViRNSNNd2/eV1Eeuc3ehzG9D4/i0qoR6K00C77yYMWJahAREREREREREREREU0ifwC7w/YQFOUJTQAAAABJRU5ErkJggg==" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Gift
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/employees" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_10" aria-selected="false"
                            data-menu-xmlid="hr_attendance.menu_hr_attendance_root"><img class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Attendances
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/employees" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_11" aria-selected="false"
                            data-menu-xmlid="hr_holidays.menu_hr_holidays_root"><img class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Time Off
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/approvals" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_12" aria-selected="false"
                            data-menu-xmlid="approvals.approvals_menu_root"><img class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Approvals
                            </div>
                        </a>
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
</body>
@endsection
@section('title')
Thông tin cá nhân
@endsection