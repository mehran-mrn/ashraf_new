@extends('layouts.global.global_layout')
@section('title',__('messages.home'). " |")

@section('content')

    <!-- Start main-content -->
    <div class="main-content">

        {!! DbView::make($page)->render() !!}

    </div>
    <!-- end main-content -->
@endsection
