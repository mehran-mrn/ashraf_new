@extends('layouts.panel.panel_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title">
                <h5 class="text-center">{{__('messages.permissions_team_list_title')}}</h5>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6>{{__('messages.permission_team_list_user')}}</h6>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col">
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

@endsection
