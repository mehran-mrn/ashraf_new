@extends('layouts.panel.panel_layout')
@section('content')
    <?php
    $active_sidbare = ['setting', 'cities_list']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('load_host_form')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.province')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.province')])}}
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($cities as $cite)

                                <div class="card col-md-3">
                                    <div class="card-body ">
                                        {{$cite['name']}}
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        {{$cities->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection