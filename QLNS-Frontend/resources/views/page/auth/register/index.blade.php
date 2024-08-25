@extends('layout.master')
@section('content')
    <div id="wrapwrap" class="  ">
        <main>
            <div class="container py-5">
                <div style="max-width: 300px;"
                    class="card border-0 mx-auto bg-100 rounded-0 shadow-sm bg-white o_database_list">
                    <div class="card-body">
                        <div class="text-center pb-3 border-bottom mb-4">
                            <img alt="Logo" style="max-height:120px; max-width: 100%; width:auto" src="/image/logo.png">
                        </div>

                        <form id="signupForm" method="post">
                            @csrf
                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">

                            <div class="mb-3 field-login">
                                <label for="login">Your Email</label>
                                <input type="text" name="login" id="login" class="form-control form-control-sm"
                                       autofocus="autofocus" autocapitalize="off" required="required">
                            </div>

                            <div class="mb-3 field-name">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm"
                                       placeholder="e.g. John Doe" required="required">
                            </div>

                            <div class="mb-3 field-password pt-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-sm"
                                       required="required">
                            </div>

                            <div class="mb-3 field-confirm_password">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                       class="form-control form-control-sm" required="required">
                            </div>

                            <input type="hidden" name="redirect">
                            <input type="hidden" name="token">
                            <div class="text-center oe_login_buttons d-grid pt-3">
                                <button type="submit" class="btn btn-primary">Sign up</button>
                                <a class="btn btn-link btn-sm" role="button" href="/login">Already have an account?</a>
                                <div class="o_login_auth"></div>
                            </div>
                        </form>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="{{ asset('js/signup.js') }}" defer></script>


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
