@extends('layouts.panel.panel_layout')
@section('content')
<?php     $active_sidbare = ['charity', 'charity_payment_titles', 'charity_setting']?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                            data-ajax-link="{{route('charity_payment_title_add')}}" data-toggle="modal"
                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_title')])}}"
                            data-target="#general_modal"><i
                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_title')])}}
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection