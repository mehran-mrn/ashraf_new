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
                    @foreach($locals as $local)
                        <div class="col-md-3">
                            <div class="card bordered border-3 bordered_box border-violet-800 bg-violet-300">
                                <div class="card-body text-center font-size-lg">
                                    <a class="text-white" href="{{route('menu.show',['id'=>$local])}}"><b>( {{$local}} )</b> Menu</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection