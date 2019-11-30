@extends('layouts.global.global_layout')
@section('title',__('messages.donate'). " |")

@section('js')
    <script>
        $(document).ready(function () {

        })
    </script>
@stop
@section('css')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@stop
@section('content')
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <h3 class="mt-0 line-bottom">{{$sform['title']}}<span class="font-weight-300"></span></h3>
                        <form action="{{route('sform_store')}}" method="post" id="frm_add_charity">
                            @csrf
                            <input type="hidden" name="sform_id" value="{{$sform['id']}}">
                            <input type="hidden" name="title" value="{{$sform['title']}}">
                            <div class="row">
                                @foreach($sform->fields->sortBy('order') as $field)
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>{{$field['title']}}<span class="text-danger">{{$field['required'] ?"*":""}}</span> </label>
                                        @switch($field['type'])
                                            @case(0)
                                            <input type="text" class="form-control" {{$field['required'] ?"required":""}} name="{{$field['title']}}">
                                            @break
                                            @case(1)
                                            <textarea name="{{$field['title']}}" {{$field['required'] ?"required":""}} class="form-control"
                                                      id="field[{{$field['id']}}]" cols="30" rows="3"></textarea>
                                            @break
                                            @case(2)
                                            <input type="number" {{$field['required'] ?"required":""}} class="form-control"
                                                   name="{{$field['title']}}">
                                            @break
                                            @case(3)
                                            <input type="date" {{$field['required'] ?"required":""}} class="form-control" name="{{$field['title']}}">
                                            @break
                                            @case(4)
                                            <input type="time" {{$field['required'] ?"required":""}} class="form-control" name="{{$field['title']}}">
                                            @break
                                        @endswitch
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pt-20">
                                    <button type="submit"
                                            class="btn btn-success pull-left">{{__("messages.save")}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        @if($sform['img'])
                        <img src="{{$sform['img']}}">
                        @endif
                        <h3 class="mt-0 line-bottom">{{__('messages.cooperation')}}</h3>
                        <div class="testimonial style1 owl-carousel-1col owl-nav-top">
                            <div class="item">
                                <div class="comment bg-theme-colored">
                                    {!! $sform['description'] !!}
                                </div>
                                <div class="content mt-20">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
