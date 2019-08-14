@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('node_modules/pnotify/dist/iife/PNotify.js') }}"></script>
@endsection
@section('content')
    <?php $active_sidbare = ['gallery', 'gallery_add']?>
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <button
                            class="btn btn-primary m-2 py-2 px-3 modal-ajax-load"
                            data-ajax-link="{{route('gallery_add_modal')}}" data-toggle="modal"
                            data-modal-title="{{trans('messages.add_category',['item'=>trans('messages.category')])}}"
                            data-target="#general_modal">{{__('messages.add_gallery_category')}}
                    </button>
                </section>
            </div>

            <section>
                <div class="card">
                    <div class="card-header">
                        <span class="card-title"></span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($categories as $cat)
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-img-actions mx-1 mt-1">
                                            <img class="card-img img-fluid"
                                                 src="{{asset('/public/assets/panel/images/3.png')}}" alt="">
                                            <div class="card-img-actions-overlay card-img">
                                                {{$cat['title']}}
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="d-flex align-items-start flex-nowrap">
                                                <div>
                                                    <div class="font-weight-semibold mr-2">{{$cat['title']}} </div>
                                                    <span class="font-size-sm text-muted">{{count($cat['media'])}} {{__('messages.file')}}</span>
                                                </div>
                                                <div class="list-icons list-icons-extended ml-auto">
                                                    <a class="list-icons-item"
                                                       href="{{route('gallery_category_view',['id'=>$cat['id']])}}">
                                                        <i class="icon-image2 top-0"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="list-icons-item swal-alert "
                                                       data-ajax-link="{{route('gallery_category_remove',['id'=>$cat['id']])}}"
                                                       data-method="DELETE"
                                                       data-csrf="{{csrf_token()}}"
                                                       data-title="{{trans('messages.delete_item',['item'=>trans('messages.category')])}}"
                                                       data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.category')])}}"
                                                       data-type="warning"
                                                       data-cancel="true"
                                                       data-confirm-text="{{trans('messages.delete')}}"
                                                       data-cancel-text="{{trans('messages.cancel')}}">
                                                    <i class="icon-bin top-0"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>



@endsection