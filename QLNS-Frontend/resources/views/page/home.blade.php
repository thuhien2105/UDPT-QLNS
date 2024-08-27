@extends('layout.master')
@section('content')
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
                </svg><img class="o_menu_brand_icon d-none d-lg-inline position-absolute start-0 h-100 ps-1 ms-2 o_hidden"
                    src="data:image/png;base64,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"
                    alt="Approvals" /><span class="o_menu_brand d-none d-md-flex ms-3 pe-0 o_hidden">Approvals</span></a>
            @include('page.header')
        </nav>
    </header>
    <div class="o_action_manager">
        <div class="o_home_menu h-100 overflow-auto">
            <div class="container">
                <input type="text" class="o_search_hidden visually-hidden w-auto" data-allow-hotkeys="true"
                    role="combobox" aria-autocomplete="list" aria-haspopup="listbox" aria-activedescendant="result_app_null"
                    aria-expanded="true" />
                <div role="listbox" class="o_apps row user-select-none mt-5 mx-0">
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_4" aria-selected="false" data-menu-xmlid="contacts.menu_contacts"
                            href="/user"><img class="o_app_icon rounded-3"
                                src="data:image/png;base64,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">
                            <div class="o_caption w-100 text-center text-truncate mt-2">Personal</div>
                        </a>
                    </div>
                    @if (session('role') === 'manager')
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/employees?type=employee" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_8" aria-selected="false" data-menu-xmlid="hr.menu_hr_root"><img
                                class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Employees
                            </div>
                        </a>
                    </div>
                    @endif
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/gifts" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_9" aria-selected="false"
                            data-menu-xmlid="hr_work_entry_contract_enterprise.menu_hr_payroll_root"><img
                                class="o_app_icon rounded-3"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAO2SURBVHgB7d1LSFRRHMfx37lNGumUMZViD61Ag3IKsiKoSCpqI9amNrWoTQQFbYIgIntAQYuIoFq1qU2LQMk2ESQFQS8qy0ghtJJJJamYJDX1dM44Y6Yzep256p/8fWBGZuaAeL/ee+5LBIiIiIiIiIiIiIiIiP5vavAbv89c2ARH71BKlZmX+aDxpPuD6PKLWb1p3Sc1cAQ0UbQv8twX44GJsRI0oRz7FF0zGEMA9evcxfypursBJIF2pujucpAYzhRgBUgMh3OHLA5IFAYRhkGEYRBhGEQYBhGGQYRhEGHUlWXbNUgKzTVEGAYRhkGEYRBhGEQYBhGGQYRhEGEc+NJBQqRnwKf8AehvIVB86f4MBPfuQO7qYORhtb3/gNc3KlBXeR9eUumZUFe3HdW66Q1oKP+8HJRdP2++Zsf9PNzUjMr9xxAOtcALzqJi7ajpM6Fm5YIGUWrYGJZ/fl8wuxal/O1sg6nT+iZ1FVgY2X7RX4VlW4aNEWOjFJlNWkrMso80QGwvy/HBWVDENSXGrB3BPWWuh88rLkKy7DK3y942sHz9n5g31JzFUFm50G2foDvbAfuYpGYvXeJ6bGyyd83s2dqdKWQEYKeMfz4aMthsx1ROwdA/HJlMRv3DKzgF6+EFHhjGYy7Zhd5+dD38a0MzvMIgCXypdR/k7d1n8AqDJFBT9Qzhlu8jjrNj6h7UwCsMkkBXewfunLyJcGviKDaGHeMldW3nWd7kMILCkiCWl67B7LxsM71ohMzmrLn2M95UPTE7op3wkPaBRmQ3SV5ulobDTZYwDCIMN1kxozkYHMNZl0EsE+PA7eOuh7c1tET2vhqe1qO+usbTQAwSFW79Af/cma7GBhZlRx75awtRvHsjnt96iHqPJn3OIZbu+61Pho1YcrgUq3ZvgBcYJCr0zv2pknjsmrJu31akikGi7HFGpzk6T0XQHDzmrylAKhgkqutnB6ovVyFVJYdKzQXA5O/kYZABGp/WmdMhqZ25TcuchoKSUV6wGoBBBnl8/R5e3HqEVOQuz0OyuNsbh92NtccZq3ZtgD87C6MVyMtBshgkgdgJRXumN88cb9jdW3u2143MuTOQLAYZwXie6bU4hwjDIMIwiDAMIgyDCMMgwjCIMAwiDIMIYq6TvWIQQZTSDCKI1r09pxlEBm1yXDpYUd7Ik4sTz/4Tl5dp6DllX3ANmViRNSNNd2/eV1Eeuc3ehzG9D4/i0qoR6K00C77yYMWJahAREREREREREREREU0ifwC7w/YQFOUJTQAAAABJRU5ErkJggg==" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Gifts
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/check-in-out?type=check-in-out" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_10" aria-selected="false"
                            data-menu-xmlid="hr_attendance.menu_hr_attendance_root"><img class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Check IN / OUT
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a href="/approvals" role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_12" aria-selected="false" data-menu-xmlid="approvals.approvals_menu_root"><img
                                class="o_app_icon rounded-3"
                                src="data:image/png;base64,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" />
                            <div class="o_caption w-100 text-center text-truncate mt-2">
                                Approvals
                            </div>
                        </a>
                    </div>
                    <div class="col-3 col-md-2 o_draggable mb-3 px-0">
                        <a role="option"
                            class="o_app o_menuitem d-flex flex-column rounded-3 justify-content-start align-items-center w-100 p-1 p-md-2"
                            id="result_app_6" aria-selected="false"
                            data-menu-xmlid="spreadsheet_dashboard.spreadsheet_dashboard_menu_root"
                            href="/campaign"><img class="o_app_icon rounded-3"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAATESURBVHgB7Z3BThtXFIbPuR7sOLSSs+vSfYAo4Q2cpkWpGhVQX4DumhWwSCukJgyJ1C6QSlhlWfUJaktddFFhvwG8QWdVZYelKhjweE7PBaqqFercMXOda/x/4soCXfvY83Fmxsd3jokAAAAAAAAAYLIwFeT18ssWMy0TmSUiaVIgfPXzt86vJf1ux87NyBMsdEiGDs1ptM3xRlLkvpHrxB+X48aZibZEaP3iL0LgaoTpvm6e+6Nqujr6fmdXxbxQMX2X+xqXSecyOOr+IwO4ottsI5tL9yXebbjMdxJynhmk1sFYaMYsZLX0ucvcXCGvl+MmMuP62G04fLnTypuXnyEcxQTKgMnIUt4kl13WPQKlwMzXF8I4dpRJM2+C00EdTI5ZFpJQgMykENFTHh0dCpDZzJBMixsZQ0gozD17qq+ceyK8R4Exs8eQaFgRHdt6FnlIATGzQrTYZ2+OzFn0IKRMmenTXivFVmFTM1wfcvqh1uN/etcZ41x+v8nUNzftTaJjld4xeGMYGBASGBASGBASGBASGBASGBASGBASGBASGDP5Tv108bHflYu2/CJyOKrMbdd/bSdF7osM8YBdwybMqyZLfz9b/OwHabWcFslZIMQzQrwxrL637yoFQiaAZszCsDpfzspFUA6aKeuDjx+38uZByORg5qyUlYugJJgrEBIW+Rc4QUhg3AghUvhzcHv1lyQUIDdCCLMUEiLCdmChnC8kG20Xmn++kpQgxAsie0/acVLkLvXfftGsop5KwcrFMrFFvBqNYhqD2jASHdskWLlYDpoZVUkffNmOnS43/i/ca9ubo+rQrlwMJ1Omq/wunGjVvKPnSO0n7Wc9uiaXUvqDR4/W9TFfURbFRugeMa4aAwAAAAAAAAAAAAiQwk0wb+38SSxsf8gnJ0/nx27q2Ox26aSREkf6SZTWT9mhP+Qfdz8pHq+7pZWwWxRlzJlhp405Wvnmf+M4Fxcbu0c0SGsac9TSX5cuR5P8Udy4lm0bhz06MylTRi39y7KOzyn/edqN5F75juPzLmLcr9seHa0y4zgJsTKUOzqe6+Oti9/kGBsrQ5/aHU3eLRPR2oXTkrunXsogG4c0Dpk1MeP891yNa4Y0TtPqvqZ+0GVpK6NuO4CKx/L5pYyI6vs+GoPmpumti11V8F1JPzjo0u1KukU+ZXRjlV5nQ3Vv28Nlv9nUzJiGrqRN3ZWukU/6NfWd6fbwFyd/l5XOxTQFcGUYl7cnv5qKGBtgy2eY3AyRKelKyoa9P097pq/Da5zcDNGz6+n4fFn8H+Muz9e8xsHa3sCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMCAkMAIUohM/hsKJhJPiHPjBClk4l8ZwTyReEzZdAqh1BTqzHBNJBsOX5B/ZESSGyc4ISzy6mSzntBksF029t4sfJqQX4Qz2aOVzSRvYlBCWOigdjw/qezQQ5UcDNK3vuOpdDpIzYlTnFCEiM2M2vHtj/oxj9WZoWg8mxnH6duH/YUVn/HOMyOjwUNaces44bKUtOTFsf8iUREdtdEZfP1+b0DXQvIn/N0Jgjtv7i72aDwc4lBiMumQkU76xWaPAAAAAAAAACBg/gLTpIaetHokFQAAAABJRU5ErkJggg==">
                            <div class="o_caption w-100 text-center text-truncate mt-2">Campaign</div>
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
@endsection
@section('title')
    Home
@endsection
