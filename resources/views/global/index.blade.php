@extends('layouts.global.global_layout')
@section('content')

<!-- Start main-content -->
<div class="main-content">

    @include('global.materials.slider')

    @include('global.materials.upcoming_events')
    @include('global.materials.counter')
    @include('global.materials.home_boxes')

{{--    @include('global.materials.our_mission')--}}
{{--    @include('global.materials.wide_banner')--}}
    @include('global.materials.cards')
    @include('global.materials.gallery')
    @include('global.materials.video_gallery')

    @include('global.materials.blog_cards')
    @include('global.materials.clients')

</div>
<!-- end main-content -->
@endsection
