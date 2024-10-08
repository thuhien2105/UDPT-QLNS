@extends('layout.master')
@section('content')
    <div id="wrapwrap" class="">
        <main>
            <div class="container py-5">
                <div style="max-width: 300px;"
                    class="card border-0 mx-auto bg-100 rounded-0 shadow-sm bg-white o_database_list">
                    <div class="card-body">
                        <div class="text-center pb-3 border-bottom mb-4">
                            <img alt="Logo" style="max-height:120px; max-width: 100%; width:auto" src="/image/logo.png">
                        </div>
                        <form id="loginForm" class="oe_login_form" role="form" method="post">
                            <div class="mb-3 field-login">
                                <label for="login" class="form-label">Username</label>
                                <input type="text" placeholder="Username" name="username" id="login" required="required"
                                    autocomplete="username" autofocus="autofocus" autocapitalize="off" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" placeholder="Password" name="password" id="password"
                                    required="required" autocomplete="current-password" maxlength="4096"
                                    class="form-control">
                            </div>
                            <div class="clearfix oe_login_buttons text-center gap-1 d-grid mb-1 pt-3">
                                <button type="submit" class="btn btn-primary">Log in</button>
                                <div class="justify-content-between mt-2 d-flex small">
                                    <a href="/signup">Don't have an account?</a>
                                    <a href="/reset_password">Reset Password</a>
                                </div>
                                <div class="o_login_auth"></div>
                            </div>
                        </form>
                        <div class="text-center small mt-4 pt-3 border-top">
                            <a href="https://www.odoo.com?utm_source=db&amp;utm_medium=auth" target="_blank">Powered by
                                <span>Nhóm 6</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/page.js') }}"></script>
@endsection
