@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <link href="{{ url('/public/assets/panel/global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet"
          type="text/css">

@endsection
<?php
$active_sidbare = ['blog', 'blog_setting', 'more_blog_setting']
?>
@section('content')
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>

                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{__('messages.more_setting')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('blog_setting_more_setting_store')}}" method="post">
                                @csrf
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.icon')}}</th>
                                        <th>{{__('messages.name')}}</th>
                                        <th>{{__('messages.link')}}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(config('blog_setting.social_media') as $social_media)
                                        <tr class="p-0">
                                            <td class="text-center"><i
                                                        class="font-size-lg {{$social_media['icon']}} fa-3x"></i></td>
                                            <td class="text-center">{{$social_media['name']}}</td>
                                            <td class="text-center">
                                                <input class="form-control" name="{{$social_media['name']}}[link]">
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" value="{{$social_media['name']}}"
                                                       name="{{$social_media['name']}}[name]">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <button type="submit"
                                               class="btn btn-sm btn-success m-0"><i class="icon-floppy-disk"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection