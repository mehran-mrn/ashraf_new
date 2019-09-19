@extends('layouts.global.global_layout')
@section('title',__('messages.my_profile'). " |")

@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        $(document).on("click", '.hidden-form', function () {
            //alert($( this ).css( "transform" ));

            if (  $(this).children( 'i').css( "transform" ) == 'none' ){

                $(this).children( 'i').css("transform","rotate(-90deg)");
            } else {
                $(this).children( 'i').css("transform","" );
            }
        });
    </script>

@endsection
@section('content')
    <div class="main-content">
        @if($active_caravans->count() > 0)

        <section>
            <div class="container pt-0">
                <div class="section-content">
                    @if(session()->get('excel_response'))
                        <?php $excel_response = session()->get('excel_response') ?>
                        <div class="panel bordered border-danger bordered_box">
                            <ul class="">
                                @foreach($excel_response as $key => $value)
                                    <li class="list-feed-item">{!! nl2br(e($value)) !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel">
                        <div class="panel-body bg-white-fe">
                            <ul id="myTab" class="nav nav-tabs boot-tabs">
                                @foreach($active_caravans as $caravan)
                                    <div style="display: none" id="print_{{$caravan['id']}}">
                                        @include('global.profile.caravan_print')
                                    </div>
                                    <li class="active">
                                        <a href="#tab_{{$caravan['id']}}"
                                           data-toggle="tab"><div class="text-info inline-block">{{get_cites($caravan['dep_city'])['name']}} </div> | <div class="text-info inline-block">{{miladi_to_shamsi_date($caravan['start'])}}</div>
                                        @switch($caravan['status'])
                                                @case("0")<span class="badge bg-theme-colored-darker2 font-size ">
                                {{trans('messages.canceled')}}</span>
                                                @break
                                                @case("1")<span class="badge bg-theme-colored-darker2 font-size ">
                                {{trans('messages.registering')}}</span>
                                                @break
                                                @case("2")<span class="badge bg-theme-colored-darker2 font-size ">
                                {{trans('messages.ready')}}</span>
                                                @break
                                                @case("3")<span class="badge bg-theme-colored-darker2 font-size ">
                                {{trans('messages.arrived')}}</span>
                                                @break
                                                @case("4")<span class="badge bg-theme-colored-darker2 font-size ">
                                {{trans('messages.exited')}}</span>
                                                @break
                                                @case("5")<span class="badge bg-theme-colored-darker2 font-size ">
                                {{trans('messages.archived')}}</span>
                                                @break
                                            @endswitch
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div id="myTabContent" class="tab-content">
                                @foreach($active_caravans as $caravan)

                                    <div class="tab-pane fade in active" id="tab_{{$caravan['id']}}">
                                        <div class="panel">
                                            <div class="panel-body bg-white-f9">
                                                <div class="row">
                                                    <div class="col-md-12 mb-sm-40">
                                                            <div class="col-md-4 border-1px p-20">
                                                                <span class="text-gray">{{__('messages.title')}}:</span>
                                                                <span class="text-black">{{$caravan['title']}}</span>
                                                            </div>
                                                            <div class="col-md-4 border-1px p-20">
                                                                <span class="text-gray">{{__('words.executer')}}: </span>
                                                                <span class="text-black">{{$caravan['executer']}}</span>
                                                            </div>
                                                            <div class="col-md-4 border-1px p-20">
                                                                <span class="text-gray">{{__('messages.capacity')}}: </span>
                                                                <span class="text-black">{{$caravan['capacity']}}</span>
                                                            </div>
                                                            <div class="col-md-4 border-1px p-20">
                                                                <span class="text-gray">{{trans('messages.departure')}} </span>
                                                                <span class="text-black">{{get_provinces($caravan['dep_province'])['name']}} - {{get_cites($caravan['dep_city'])['name']}}</span>
                                                            </div>

                                                            <div class="col-md-4 border-1px p-20">
                                                                <span class="text-gray">{{trans('messages.transport_type')}}</span>
                                                                <span class="text-black">{{$caravan['transport']}}</span>
                                                            </div>
                                                            <div class="col-md-4 border-1px p-20">
                                                <span class="text-gray">{{trans('messages.date')}}
                                                    {{trans('messages.depart')}}</span>
                                                                <span class="text-black">{{jdate('j F Y',strtotime($caravan['start']))}}</span>
                                                            </div>



                                                            <div class="col-md-12 border-1px p-20">
                                                                <div class="row">
                                                                    <div class="col-md-2 col-xs-6 pt-xs-10">
                                                                        <a  onclick="printDiv('print_{{$caravan['id']}}')"
                                                                           class="btn btn-warning btn-block ajaxload-popup">{{__('words.print')}} <i class="fa fa-print"></i> </a>
                                                                    </div>
                                                                    <div class="col-md-2 col-xs-6 pt-xs-10 ">
                                                                        <a href="#collapse_add_to_team"
                                                                           class="btn btn-info btn-block hidden-form" data-toggle="collapse" >{{__('messages.new_register')}}

                                                                        <i class="fa fa-arrow-circle-left"></i>
                                                                    </span>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>














                                            <div class="panel-body bg-white-f9">

                                                    <div id="collapse_add_to_team" class="collapse ">

                                                        @include('panel.caravan.materials.register_to_caravan_subform')
                                                        <hr>
                                                        <p class="text-small">
                                                            {{trans('long_msg.mass_register_caravan')}}
                                                        </p>
                                                        <form action="{{route('add_person_to_caravan_excel')}}" method="post" enctype="multipart/form-data">

                                                        <div class="col-md-3">
                                                        <a class="text-theme-colored" href="{{url('public/files/sample_file.xlsx')}}" ><i class="fa fa-file-excel-o"></i>  {{trans('messages.download_sample_file')}} </a>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="control-group">
                                                                <div class="form-actions">
                                                                    <div class="span4">
                                                                        <input type="file"  name="import_file">
                                                                        <input type="hidden"  name="caravan_id" value="{{$caravan['id']}}">
                                                                        <br>
                                                                        @csrf
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div class="span4">
                                                                <button class="btn btn-success">{{trans('messages.upload')}}</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                            </div>






                                            <div class="panel-body bg-white-f9">
                                                <div class="table-responsive">
                                                    <table class="table table-striped text-center table-bordered">

                                                        <thead class="text-center">
                                                        <tr>
                                                            <th class="text-center">{{trans('words.supervisor')}}</th>
                                                            <th class="text-center">{{trans('messages.name')}}</th>
                                                            <th class="text-center">{{trans('messages.national_code')}}</th>
                                                            <th class="text-center">{{trans('messages.birth_date')}}</th>
                                                            <th class="text-center">{{trans('messages.status')}}</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                        @foreach($caravan['persons'] as $person_caravan)
                                                            <tr>
                                                                <td class="p-2">{{$person_caravan['parent_id']}}</td>
                                                                <td class="p-2">{{$person_caravan['person']['name'] ." - ". $person_caravan['person']['family']}}</td>
                                                                <td class="p-2">{{$person_caravan['person']['national_code']}}</td>
                                                                <td class="p-2">{{miladi_to_shamsi_date($person_caravan['person']['birth_date'])}} </td>

                                                                <td class="p-2">
                                                                    @if($person_caravan['accepted'] >='1')
                                                                        <span class="btn p-1 btn-success">{{trans('messages.accepted')}}</span>
                                                                    @elseif($person_caravan['accepted'] =='0')
                                                                        <span class="btn p-1 btn-danger">{{trans('messages.rejected')}}</span>
                                                                    @else
                                                                        <span class="btn p-1 btn-warning">{{trans('messages.pending')}}</span>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>
@endsection
@section('js')
    <script src="{{ URL::asset('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: '{{__('messages.change_status')}}',
                    text: "{{__('messages.are_you_sure')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{__('messages.yes_i_sure')}}',
                    cancelButtonText: '{{__('messages.cancel')}}'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{route('global_profile_delete_period')}}",
                            type: "post",
                            data: {id: id},
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            success: function (response) {
                                console.log(response);
                                $.each(response, function (index, value) {
                                    PNotify.success({
                                        text: value.message,
                                        delay: 3000,
                                    });
                                })
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            }, error: function (response) {
                                var errors = response.responseJSON.errors;
                                $.each(errors, function (index, value) {
                                    PNotify.error({
                                        delay: 3000,
                                        title: index,
                                        text: value,
                                    });
                                });
                            }
                        });
                    }
                })
            })
        })
    </script>
@stop




















