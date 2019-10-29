@extends('layouts.global.global_layout')
@section('title',__('messages.home'). " |")

@section('content')

    <!-- Start main-content -->
    <div class="main-content">

        <?php $page =  App\page::index_page(app()->getLocale()) ?>
        {!! DbView::make($page)->render() !!}

    </div>
    <!-- end main-content -->
@endsection
