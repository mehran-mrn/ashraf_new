@extends('layouts.panel.panel_layout')

@section('content')
    <?php
    $active_sidbare = ['blog', 'blog_setting', 'menu'];

    $locals = get_all_locals();
    ?>
    <section>
        <div class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-indigo-400 text-center">
                                {{trans('words.top_menu')}}
                            </div>
                            <div class="card-body row">
                                @foreach($locals as $local)
                                    <div class="col-md-6">
                                        <div
                                            class="card bordered  bordered_box border-violet-800 bg-violet-300">
                                            <a class="text-white"
                                               href="{{route('menu.show',['id'=>$local,'type'=>'top'])}}">
                                            <div class="card-body text-center font-size-lg">
                                               <b>( {{$local}} )</b>
                                                    Menu
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-indigo-400 text-center">
                                {{trans('words.side_menu')}}
                            </div>

                            <div class="card-body row">
                                @foreach($locals as $local)
                                    <div class="col-md-6">
                                        <div
                                            class="card bordered  bordered_box border-violet-800 bg-violet-300">
                                            <a class="text-white"
                                               href="{{route('menu.show',['id'=>$local,'type'=>'side' ])}}">
                                                <div class="card-body text-center font-size-lg">
                                                    <b>( {{$local}} )</b>
                                                    Menu
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

@endsection
