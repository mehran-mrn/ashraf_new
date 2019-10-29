@extends('layouts.panel.panel_layout')

@section('content')
    <?php
    $active_sidbare = ['blog', 'blog_Specific_page', 'pages']

    ?>


    <!-- Content area -->
    <div class="content">

        <!-- Task manager table -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title">{{trans('messages.add_new',['item'=>trans('words.page')])}}
                </h6>
                <a class="float-left btn border-info-400 text-info-800 btn-icon btn alpha-info"
                   href="{{route('pages.index')}}">
                    <i class="icon-circle-left2"></i>
                    {{trans('messages.back')}}</a>

            </div>
            <div class="card-body bg-transparent">
                <form method="post" action="{{route('pages.store')}}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">

                            <label for="name"
                                   class="font-size-lg text-info-800 label ">{{trans('messages.name')}}</label>
                            <input class="form-control border-info-800 " id="name" name="name"/>
                        </div>
                        <div class="col-md-6">

                            <label for="slug" class="font-size-lg text-info-800 label ">
                                {{trans('messages.slug')}}
                            </label>
                            <input class="form-control border-info-800 " id="slug" name="slug"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="locals" class="font-size-lg text-info-800 label ">
                                {{trans('messages.language')}}
                            </label>

                            <select id="locals" class="form-control  border-info-800" name="local">
                                <option class="option" disabled selected> {{trans('trans.supported_locales')}}</option>
                                @foreach(get_all_locals() as $local)
                                    <option class="option" value="{{$local}}">{{$local}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="locals" class="font-size-lg text-info-800 label ">
                                {{trans('messages.type')}}
                            </label>

                            <select id="locals" class="form-control  border-info-800" name="page_type">
                                <option class="option" disabled selected> {{trans('messages.type')}}</option>
                                @foreach(config('pages.types') as $key=>$type)
                                    <option class="option" value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="accessible" class="font-size-lg text-info-800 label ">
                                {{trans('words.accessible')}}
                                <input type="checkbox" id="accessible" class="form-control" value="1" name="link"/>

                            </label>


                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="locals" class="font-size-lg text-info-800 label ">
                                {{trans('words.code')}}
                            </label>
                            <textarea class="form-control border-info-800" dir="ltr" name="content" id="content" cols="40"
                                      rows="10"></textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-block" type="submit">{{trans('messages.save')}} <i class="icon-floppy-disk"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
