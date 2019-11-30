@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php
    $active_sidbare = ['charity', 'support_form']
@endphp
@section('content')
    <section>
        <div class="content">
            <section>
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="card-title text-black">{{__('messages.form')}} | {{__('messages.reports')}}</h6>
                        <hr>
                    </div>
                    <div class="card-body table-responsive">
                        {{$sforms->links()}}
                        <table class="table ">
                            <tr>
                                <th>{{__('messages.title')}}</th>
                                <th>{{__('messages.date')}}</th>
                                <th>{{__('messages.status')}}</th>
                                <th></th>
                            </tr>
                            @foreach($sforms as $sform)
                                <tr>
                                    <td class="{{$sform['status'] == 0 ? "font-weight-bolder" :""}}">{{$sform['title']}}</td>
                                    <td >{{miladi_to_shamsi_date($sform['created_at'])}}</td>
                                    <td><span class="badge badge-danger">
                                        @switch($sform['status'])
                                            @case(0)
                                            {{trans('words.new')}}
                                            @break
                                            @case(1)
                                            {{trans('words.inProgress')}}
                                            @break
                                            @case(2)
                                            {{trans('words.closed')}}
                                            @break
                                            @default
                                        @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                data-ajax-link="{{route('sform_file_view',[$sform['id']])}}"
                                                data-toggle="modal"
                                                data-modal-size="modal-full"
                                                data-modal-title="{{$sform['title']}}"
                                                data-target="#general_modal">
                                            <i class="icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$sforms->links()}}

                    </div>
                </div>
            </section>
        </div>
    </section>
@stop
