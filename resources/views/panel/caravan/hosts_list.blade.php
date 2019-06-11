@extends('layouts.panel.panel_layout')

@section('content')
    <?php
    $active_sidbare = ['caravans', 'hosts_list']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('load_host_form')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.host')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.host')])}}
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            @foreach($hosts as $host)
                            <div class="col-md-4">
                                <div class="card card-body bg-blue text-center" style="background-image: url({{asset('public/assets/panel/images/person.png')}}); background-size: contain;">
                                    <div class="mb-3">
                                        <h5 class="font-weight-semibold mb-0 mt-1">
                                            {{$host['name']}}
                                        </h5>

                                    </div>

                                    <a href="#" class="d-inline-block mb-3">
                                        <i class="icon-home2 icon-3x mb-10" ></i>
                                        <br>
                                        <span class="badge rounded-round border-3 text-light">{{$host['city_name']}}</span>

                                    </a>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><a href="#" class="btn btn-outline btn-icon text-white btn-lg border-white rounded-round">
                                                <i class="icon-phone"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#" class="btn btn-outline btn-icon text-white btn-lg border-white rounded-round">
                                                <i class="icon-bubbles4"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#" class="btn btn-outline btn-icon text-white btn-lg border-white rounded-round">
                                                <i class="icon-envelop4"></i></a>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection