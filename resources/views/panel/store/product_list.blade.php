@extends('layouts.panel.panel_layout')
@section('js')
@endsection
@section('css')
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'product_list']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header bg-light"><span class="card-title">{{__('messages.product_list')}}</span></div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{__('messages.title')}}</th>
                        <th>{{__('messages.category')}}</th>
                        <th>{{__('messages.price')}}</th>
                        <th>{{__('messages.off')}}</th>
                        <th>{{__('messages.ready_for_send')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product['title']}}</td>
                            <td>
                                @php
                                    $cats = $product->store_category;
                                @endphp
                                @if(sizeof($cats)>=1)
                                    @foreach($cats as $cat)
                                        <span class="badge badge-danger">{{$cat->title}}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{number_format($product['price'])}}</td>
                            <td>{{$product['off']}}</td>
                            <td><span>{{$product['ready']." ".__('messages.day')}}</span></td>
                            <td>
                                <a href="{{route('store_product_edit',$product['id'])}}"
                                   class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2">
                                    <i class="icon-database-edit2"></i>
                                </a>
                                <button
                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                        data-ajax-link="{{route('store_product_delete',['pro_id'=>$product['id']])}}"
                                        data-method="get"
                                        data-csrf="{{csrf_token()}}"
                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.product')])}}"
                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.product')])}}"
                                        data-type="warning"
                                        data-cancel="true"
                                        data-confirm-text="{{trans('messages.delete')}}"
                                        data-cancel-text="{{trans('messages.cancel')}}">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
