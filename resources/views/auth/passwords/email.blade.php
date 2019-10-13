@extends('layouts.app')

@section('content')
        <div class="page-content">
            <div class="content-wrapper">
                <div class="content d-flex justify-content-center align-items-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                    <form  role="form" method="POST" action="{{ route('global_password_reset') }}" class="login-form">
                        @csrf
                        <div class="card mb-0">
                        <div class="card-body ">
                            <div class="text-center mb-3">
                                <i class="icon-spinner11 icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">{{ trans('passwords.password_recovery') }}</h5>
                                <span class="d-block text-muted">{{ trans('passwords.password_recovery_instructions') }}</span>
                            </div>

                            <div class="form-group has-feedback has-feedback-left {{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="text" class="form-control" placeholder="{{ trans('messages.email_or_mobile') }}" name="phone_email" value="{{ old('email') }}" required="required" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>




                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block">{{ trans('passwords.send_password_reset_link') }} <i class="icon-arrow-left13 position-right"></i></button>
                            </div>


                            <a href="{{ url('/login') }}" class="btn btn-default btn-block content-group">{{ trans('messages.login') }}</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
