@extends('layouts.global.global_layout')
@section('title',__('messages.my_profile'). " |".__('messages.projects'))

@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
@endsection

@section('content')
    <div class="main-content">
        <section>
            <div class="container pb-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="owl-carousel-1col" data-nav="true">
                                <div class="item">
                                    <img src="images/bg/bg3.jpg" alt="">
                                    <h4 class="mt-15">Title Placed Here / <span class="font-13">Sub title</span></h4>
                                </div>
                                <div class="item">
                                    <img src="images/bg/bg4.jpg" alt="">
                                    <h4 class="mt-15">Title Placed Here / <span class="font-13">Sub title</span></h4>
                                </div>
                                <div class="item">
                                    <img src="images/bg/bg9.jpg" alt="">
                                    <h4 class="mt-15">Title Placed Here / <span class="font-13">Sub title</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h3>Our progress</h3>
                            <div class="progressbar-container">
                                <div class="progress-item">
                                    <div class="progress-title">
                                        <h6>children improved</h6>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-theme-colored" data-percent="85"></div>
                                    </div>
                                </div>
                                <div class="progress-item">
                                    <div class="progress-title">
                                        <h6>children education</h6>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-theme-colored" data-percent="73"></div>
                                    </div>
                                </div>
                                <div class="progress-item">
                                    <div class="progress-title">
                                        <h6>complex health</h6>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-theme-colored" data-percent="81"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30 mb-20 pt-10 pb-20 pl-10 pr-10 bg-lighter">
                        <div class="col-md-4">
                            <h3 class="">Our previous Impact Reports</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum quia placeat hic blanditiis.</p>
                            <a class="btn btn-gray mt-10" href="#"><i class="fa fa-file-pdf-o pr-5"></i> Download Annual Impact Report 2015</a>
                            <a class="btn btn-gray mt-10" href="#"><i class="fa fa-file-pdf-o pr-5"></i> Download Annual Impact Report 2014</a>
                            <a class="btn btn-gray mt-10" href="#"><i class="fa fa-file-pdf-o pr-5"></i> Download Annual Impact Report 2013</a>
                            <a class="btn btn-gray mt-10" href="#"><i class="fa fa-file-pdf-o pr-5"></i> Download Annual Impact Report 2012</a>
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-theme-colored">Our impact this year</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum quia placeat hic blanditiis itaque voluptas repellat, at ad accusantium nihil.</p>
                            <ul class="list theme-colored check ml-30 pt-10">
                                <li>Enjoy growing up and are more able to deal with difficult times</li>
                                <li>Develop positive relationships with friends and family</li>
                                <li>Develop their understanding of right and wrong</li>
                                <li>Enjoy learning and start doing better at school</li>
                                <li>Have a positive identity and self-worth</li>
                                <li>Enjoy new experiences</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Divider: testimonials -->
        <section class="">
            <div class="container pb-0">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="font-weight-300 m-0">Happy Donators</h5>
                            <h2 class="mt-0 text-uppercase text-theme-colored font-28">Testimonials <span class="font-30">.</h2>
                            <div class="icon">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="owl-carousel-3col boxed" data-dots="true">
                            <div class="item">
                                <div class="testimonial pt-10">
                                    <div class="thumb pull-left mb-0 mr-0 pr-20">
                                        <img width="75" class="img-circle" alt="" src="images/testimonials/1.jpg">
                                    </div>
                                    <div class="ml-100 ">
                                        <h4 class="mt-0 font-weight-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</h4>
                                        <p class="author mt-20">- <span class="text-black-333">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial pt-10">
                                    <div class="thumb pull-left mb-0 mr-0 pr-20">
                                        <img width="75" class="img-circle" alt="" src="images/testimonials/2.jpg">
                                    </div>
                                    <div class="ml-100 ">
                                        <h4 class="mt-0 font-weight-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</h4>
                                        <p class="author mt-20">- <span class="text-black-333">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial pt-10">
                                    <div class="thumb pull-left mb-0 mr-0 pr-20">
                                        <img width="75" class="img-circle" alt="" src="images/testimonials/3.jpg">
                                    </div>
                                    <div class="ml-100 ">
                                        <h4 class="mt-0 font-weight-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</h4>
                                        <p class="author mt-20">- <span class="text-black-333">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial pt-10">
                                    <div class="thumb pull-left mb-0 mr-0 pr-20">
                                        <img width="75" class="img-circle" alt="" src="images/testimonials/1.jpg">
                                    </div>
                                    <div class="ml-100 ">
                                        <h4 class="mt-0 font-weight-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</h4>
                                        <p class="author mt-20">- <span class="text-black-333">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->
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




















