@extends('layout.master')
@section('content')
    @include('page.checkinout.header', ['title' => 'Check IN'])
    <div id="wrapwrap" class="">
        <main>
            <div class="container py-5">
                <div style="max-width: 300px;"
                    class="card border-0 mx-auto bg-100 rounded-0 shadow-sm bg-white o_database_list">
                    <div class="card-body">
                        <div class="text-center pb-3 border-bottom mb-4">
                            <img alt="Logo" style="max-height:120px; max-width: 100%; width:auto" src="/image/logo.png">
                        </div>
                        <form class="oe_login_form" role="form" method="post"
                            onsubmit="this.action = '/check-out' + location.hash" action="/check-in">
                            <input type="hidden" name="csrf_token"
                                value="32369da9bc10d7f75a924ea7075b1e8cdd311fb1o1755789092">
                            <div class="flex-grow-1">
                                <button type="submit"
                                    class="o_hr_attendance_sign_in_out_icon btn btn-success align-self-center px-5 py-3 mt-4 mb-2">
                                    <span class="align-middle fs-2 me-3 text-white">Check IN</span>
                                    <i class="fa fa-4x fa-sign-in-alt align-middle"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
