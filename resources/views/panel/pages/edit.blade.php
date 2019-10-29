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
                <form method="post" action="{{route('pages.update',['page'=>$page['id']])}}">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <div class="col-md-6">

                            <label for="name"
                                   class="font-size-lg text-info-800 label ">{{trans('messages.name')}}</label>
                            <input class="form-control border-info-800 " id="name" name="name" value="{{$page['name']}}" />
                        </div>
                        <div class="col-md-6">

                            <label for="slug" class="font-size-lg text-info-800 label ">
                                {{trans('messages.slug')}}
                            </label>
                            <input class="form-control border-info-800 " id="slug" name="slug" value="{{$page['slug']}}" readonly/>
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
                                    <option {{$page['local'] == $local ?"selected":"" }} class="option" value="{{$local}}">{{$local}}</option>
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
                                    <option {{$page['index'] == $key ?"selected":"" }} class="option" value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="accessible" class="font-size-lg text-info-800 label ">
                                {{trans('words.accessible')}}
                                <input type="checkbox" {{$page['link'] ?"checked":"" }} id="accessible" class="form-control" value="1" name="link"/>

                            </label>


                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="content2" class="font-size-lg text-info-800 label ">
                                {{trans('words.code')}}
                            </label>
                            <textarea class="form-control border-info-800" name="content" id="content2" cols="40"
                                      rows="10">
                                {!! $page['content']  !!}
                            </textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-block" type="submit">{{trans('messages.save')}} <i class="icon-floppy-disk"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="container">
                    <a href="#demo" class="btn btn-warning" data-toggle="collapse">{{trans('trans.for_delete_click_here')}} <i class="icon-circle-down2"></i></a>
                    <div id="demo" class="text-danger collapse p-3">
                        {{trans('messages.delete_item_text',['item'=>trans('words.page')])}}
                        <form method="post" action="{{route('pages.destroy',['page'=>$page['id']])}}">
                            @csrf
                            @method('delete')
                            <div class="form-group">
                            <button type="submit" class="btn btn-danger float-right" >{{trans('messages.yes_delete_id')}} <i class="icon-trash"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
