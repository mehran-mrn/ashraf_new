@extends('layouts.app')

@section('content')




        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                    <!-- Form with validation -->

                    <form  role="form" method="POST" action="{{ url('/password/email') }}" class="login-form">
                        @csrf
                        <div class="card mb-0">
                        <div class="card-body ">


                            <div class="text-center mb-3">
                                <i class="icon-spinner11 icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">{{ trans('messages.password_recovery') }}</h5>
                                <span class="d-block text-muted">{{ trans('messages.password_recovery_instructions') }}</span>
                            </div>


                            <div class="form-group has-feedback has-feedback-left {{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control" placeholder="{{ trans('messages.email') }}" name="email" value="{{ old('email') }}" required="required" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>




                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block">{{ trans('messages.send_password_reset_link') }} <i class="icon-arrow-left13 position-right"></i></button>
                            </div>


                            <a href="{{ url('/login') }}" class="btn btn-default btn-block content-group">{{ trans('messages.login') }}</a>
                        </div>
                        </div>
                    </form>
                    <!-- /form with validation -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->





@endsection
