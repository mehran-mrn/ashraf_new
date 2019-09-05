@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <link href="{{ url('/public/assets/panel/global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <?php
    $active_sidbare = ['blog','blog_setting' , 'more_blog_setting' ]
    ?>
    <div class="content">
        <div class="row">
            <div class="card col-sm-12">
            <div class="card-body">
            <table class="table table-bordered">
                <tr class=" title">
                    <th>icon</th>
                    <th>name</th>
                    <th>link</th>
                    <th></th>
                </tr>
                @foreach(config('blog_setting.social_media') as $social_media)
                    <tr class="p-0">
                        <td class="p-1"><i class="font-size-lg {{$social_media['icon']}}"></i> </td>
                        <td class="p-1">{{$social_media['name']}}</td>
                        <td class="p-1"><input class="form-control m-0"></td>
                        <td class="p-1"><button class="btn btn-success m-0"><i class="icon-floppy-disk"></i> </button> </td>

                    </tr>

                @endforeach
            </table>
            </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="card col-sm-12">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>



@endsection