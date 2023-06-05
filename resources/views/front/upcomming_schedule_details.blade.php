@extends('layouts.front_app')
@section('content')
    <section class="p-top-banner-location"></section>
    {{-- style="background: url({{ asset('uploads/schedule/' . $schedule_details->detail_banner) }})" --}}


    <section class="p-padding-40-0 p-banner-content text-center">
        <div class="container">
            <h3 class="p-00c7e9">{{ $schedule_details->title }}</h3>
            <p>{{ $schedule_details->detail_section_one_desc_one }}</p>
            <p>{{ $schedule_details->detail_section_one_desc_two }}</p>
        </div>
    </section>

    <section class="p-left-right-se">
        <div class="container-fluid p-md-0">
            <div class="row align-items-center p-tablet-r">
                <div class="col-md-5 text-start">
                    @if ($schedule_details->detail_section_two_banner != '')
                        <img src="{{ asset('uploads/schedule/' . $schedule_details->detail_section_two_banner) }}">
                    @else
                        <img src="{{ asset('assets/front/images/image00002.png') }}">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="p-left-right-title-content p-padding-r-50">
                        <p>{{ $schedule_details->detail_section_two_desc_one }}</p>
                        <p>{{ $schedule_details->detail_section_two_desc_two }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <p>{{ $schedule_details->detail_section_three_desc_one }}</p>
            <p>{{ $schedule_details->detail_section_three_desc_two }}</p>
        </div>
    </section>

    <section>
        @if ($schedule_details->detail_section_four_banner != '')
            <img class="w-100" src="{{ asset('uploads/schedule/' . $schedule_details->detail_section_four_banner) }}">
        @else
            <img class="w-100" src="{{ asset('assets/front/images/sctp0062-shalu-dhobi-ghat-and-dharavi00083.png') }}">
        @endif
    </section>

    <section>
        <div class="container-fluid">
            <div class="row gx-5">
                <div class="col-md-6">
                    <p>{{ $schedule_details->detail_section_four_desc_one }}</p>
                </div>
                <div class="col-md-6">
                    <p>{{ $schedule_details->detail_section_four_desc_two }}</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        @if ($schedule_details->detail_section_five_banner != '')
            <img class="w-100" src="{{ asset('uploads/schedule/' . $schedule_details->detail_section_five_banner) }}">
        @else
            <img class="w-100" src="{{ asset('assets/front/images/dhobi-client.png') }}">
        @endif
    </section>
    <section class="p-padding-40-0 p-socails-se">
        <div class="container text-center">
            <p><b>Date / Day</b> : {{ date('dS F Y, l', strtotime($schedule_details->date_time)) }}</p>
            <p><b>Time</b> : {{ date('g.i A', strtotime($schedule_details->date_time)) }}</p>
            <p class="mb-0"><b>Meeting Point</b> : {{ $schedule_details->metting_point }}</p>
        </div>
        <div class="p-padding-t-50 container text-center">
            <p class="p-00c7e9">Our Workshops are free of cost </p>
            <ul>
                <li><a target="_blank"
                        href="{{ $schedule_details->detail_face_book_url != '' ? $schedule_details->detail_face_book_url : '#' }}"><img
                            src="{{ asset('assets/front/images/facebook-dhobi.png') }}"></a></li>
                <li><a target="_blank"
                        href="{{ $schedule_details->detail_twitter_url != '' ? $schedule_details->detail_twitter_url : '#' }}"><img
                            src="{{ asset('assets/front/images/twiter-dhobi.png') }}"></a></li>
                <li><a target="_blank"
                        href="{{ $schedule_details->detail_google_plus_url != '' ? $schedule_details->detail_google_plus_url : '#' }}"><img
                            src="{{ asset('assets/front/images/google-plus-dhobi.png') }}"></a></li>
                <li><a target="_blank"
                        href="{{ $schedule_details->detail_whatsapp_url != '' ? $schedule_details->detail_whatsapp_url : '#' }}"><img
                            src="{{ asset('assets/front/images/whatup-dhobi.png') }}"></a></li>
                <li><a target="_blank"
                        href="{{ $schedule_details->detail_plus_url != '' ? $schedule_details->detail_plus_url : '#' }}"><img
                            src="{{ asset('assets/front/images/plus-dhobi.png') }}"></a></li>
            </ul>
        </div>
    </section>

    <section>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.1598443311295!2d72.86369651442686!3d19.231864252053334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b0cfa225cb21%3A0x5f9ce11d15c65bb8!2sDhobi%20Ghat%20Borivali%20E!5e0!3m2!1sen!2sin!4v1668230755798!5m2!1sen!2sin"
            width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>


    <section class="black-bg">
        <div class="container-fluid">
            <div class="row gx-5">
                <div class="col-md-6">
                    <h4 class="p-white">Register</h4>
                    <form id="register_form" action="{{ route('front.schedule.register.post') }}">
                        @csrf
                        <input type="hidden" value="{{ $schedule_details->id }}" id="schedule_id" name="schedule_id" />
                        <div class="form-group">
                            <input type="text" placeholder="Full Name" name="full_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" maxlength="10" placeholder="Mobile" name="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Personal Mail ID" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="City" name="city" class="form-control">
                        </div>
                        <div class="form-group p-white">
                            <label class="text-white">
                                <input type="checkbox" name="is_confirm" value="1"> Yes, I wish to attend the PhotoWalk
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="text-danger prompt-msg error-label"></label>
                            <label class="text-success prompt-msg success-label"></label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary register-btn">Register</button>
                        </div>
                        <p class="p-white">No Cost Included</p>
                    </form>
                </div>
                <div class="col-md-6">
                    <h4 class="p-white">Who can attend</h4>
                    @php
                        $attentArr = $schedule_details->detail_who_can_attend != '' ? json_decode($schedule_details->detail_who_can_attend, true) : [];
                    @endphp
                    @if (!empty($attentArr))
                        @foreach ($attentArr as $atd)
                            <p class="p-white">{{ $atd }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="faq-se">
        <div class="container-fluid">
            <h3>FAQ’s</h3>
            @if ($faqs->isNotEmpty())
                @foreach ($faqs as $faq)
                    <p class="mb-0"><b>{{ $faq->question }}</b></p>
                    <p>{{ $faq->answer }}</p>
                @endforeach
            @endif
        </div>
    </section>
@endsection
@section('page-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#register_form").validate({
                ignore: [],
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    if (element.attr("type") == "checkbox") {
                        $(element).parents('.form-group').append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    full_name: {
                        required: true
                    },
                    mobile: {
                        required: true
                    },
                    email: {
                        email: true,
                        required: true
                    },
                    city: {
                        required: true
                    },
                    is_confirm: {
                        required: true
                    }
                },
                messages: {
                    full_name: {
                        required: "Please enter your full name."
                    },
                    mobile: {
                        required: "Please enter your mobile numbwe.",
                    },
                    email: {
                        required: "Please enter your email-ID.",
                    },
                    city: {
                        required: "Please enter your city.",
                    },
                    is_confirm: {
                        required: "Please comfirm.",
                    },
                },
                submitHandler: function(form) {
                    $('.register-btn').prop('disabled', true).html(
                        'Register <i class="fa fa-spinner fa-spin"></i>');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('front.schedule.register.post') }}",
                        data: $(form).serialize(),
                        dataType: 'json',
                    }).done(function(data) {
                        $('.register-btn').prop('disabled', false).html('Register');
                        if (data.status == false) {
                            $('.error-label').text(data.message);
                            setTimeout(() => {
                                $('.error-label').text('');
                            }, 4000);
                        } else {
                            $('.success-label').text(data.message);
                            $('#register_form')[0].reset();
                            setTimeout(() => {
                                $('.success-label').text('');
                            }, 4000);
                        }
                    }).fail(function(jqXHR, status, exception) {
                        if (jqXHR.status === 0) {
                            error = 'Not connected.\nPlease verify your network connection.';
                        } else if (jqXHR.status == 404) {
                            error = 'The requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            error = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            error = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            error = 'Time out error.';
                        } else if (exception === 'abort') {
                            error = 'Ajax request aborted.';
                        } else {
                            error = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        $('.register-btn').prop('disabled', false).html('Register');
                        $('.error-label').text(data.message);
                        setTimeout(() => {
                            $('.error-label').text('');
                        }, 4000);
                    });
                }
            });
        });
    </script>
@endsection
