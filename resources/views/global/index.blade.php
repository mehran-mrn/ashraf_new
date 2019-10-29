@extends('layouts.global.global_layout')
@section('title',__('messages.home'). " |")

@section('content')

    <!-- Start main-content -->
    <div class="main-content">

        <?php $page =  App\page::index_page(app()->getLocale()) ?>
        @if($page)
        {!! DbView::make($page)->render() !!}
        @endif

    </div>
    <!-- end main-content -->
@endsection
