@extends('layouts.app')

@section('content')
    <!-- Page content -->
    <div class="page-content login-cover">

        <!-- Main content -->
        <div class="content-wrapper ">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login card -->
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">{{__('messages.login_form_title')}}</h5>
                                <span class="d-block text-muted">{{__('messages.account_information')}}</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="name" type="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="{{__('messages.username')}}"
                                       required autofocus>

                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input name="password" id="password"
                                       type="password"
                                       class="form-control
@error('password') is-invalid @enderror"
                                       placeholder="{{__('messages.password')}}" required autocomplete="current-password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <div class="form-check mb-0">
                                    <label class="form-check-label">
                                        <input id="remember" type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }} data-fouc>
                                        {{__('messages.remember_me')}}
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link ml-auto" href="{{ route('password.request') }}">
                                        {{ __('messages.forgot_password') }}
                                    </a>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">{{__('messages.login')}} <i class="icon-circle-left2 ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login card -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->



@endsection
