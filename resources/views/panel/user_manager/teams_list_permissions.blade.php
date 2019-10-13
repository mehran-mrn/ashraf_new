@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css">
@endsection

<?php
$active_sidbare = ['user_manager', 'teams_list']
?>
@section('content')

    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('teams_list')}}" class="btn btn-outline-dark m-2 py-2 px-3">< {{__('messages.back')}}</a>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title text-black">{{$teamInfo['display_name']}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>{{__('messages.permission_team_list_roles')}}</h6>
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                @foreach($teams_roles as $teams_role)
                                                    {{$teams_role[0]->name}}
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>{{__('messages.permission_team_list_roles')}}</h6>
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                @foreach($teams_roles as $teams_role)
                                                    {{$teams_role[0]->name}}
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
