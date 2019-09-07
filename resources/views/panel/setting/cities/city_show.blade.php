@extends('layouts.panel.panel_layout')
@section('content')
    <?php
    $active_sidbare = ['setting', 'collapse'];
    $parent = $city['all_provinces'];
    $parents=[]
    ?>
    @while($parent )
        <?php
        $parents[]=$parent;
        $parent = $parent['all_provinces']
        ?>
    @endwhile
    <div class="page-header page-header-light ">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">

                    @for($i= count($parents) -1 ;$i >=0 ; $i--)
                        <a href="{{route('cities.show',[$parents[$i]['id']])}}" class="breadcrumb-item">{{$parents[$i]['name']}}</a>
                    @endfor
                        <span class="breadcrumb-item active">{{$city['name']}}</span>

                </div>

            </div>
        </div>
    </div>
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    <h1 class="title">{{$city['name']}}
                        <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                data-ajax-link="{{route('cities.edit',[$city['id']])}}"
                                data-toggle="modal"
                                data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.city')])}}"
                                data-target="#general_modal">
                            <i class="icon-pencil"></i>
                        </button>
                        <button type="button"
                                class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                data-ajax-link="{{route('cities.destroy',[$city['id']])}}"
                                data-method="DELETE"
                                data-csrf="{{csrf_token()}}"
                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.city')])}}"
                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.city')])}}"
                                data-type="warning"
                                data-redirect="{{route('cities.index')}}"
                                data-cancel="true"
                                data-confirm-text="{{trans('messages.delete')}}"
                                data-cancel-text="{{trans('messages.cancel')}}">
                            <i class="icon-trash"></i>
                        </button>
                    </h1>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">

                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('cities.create')}}?parent={{$city['id']}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.province')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.city')])}}
                        </button>

                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($city['city'] as $cite)

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body alpha-blue border-1 border-blue border-radius-5px">
                                            <span class="icon-tree7 text-blue-600 "> </span>
                                            <span class="text-black"><a
                                                        href="{{route('cities.show',[$cite['id']])}}"><b>{{$cite['name']}}</b></a></span>
                                        </div>
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