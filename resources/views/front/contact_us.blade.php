@extends('layouts.front_app')
@section('content')
    <section class="p-contact-se" style="background: url({{ asset('uploads/contactus_page/' . $contact_us->banner) }});background-size: cover;background-position: center;">
        {{-- @if ($contact_us->banner != '')
            <img src="{{ asset('uploads/contactus_page/' . $contact_us->banner) }}">
        @else
            <img src="{{ asset('assets/front/images/gif-text-box.png') }}">
        @endif --}}
    </section>

    <section class="p-contact-form-se">
        <div class="container-fluid">
            <div class="row gx-5">
                <div class="col-md-6">
                    <h3 class="p-white">Contact Us</h3>
                    <form id="contactus_form">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder="Name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Mail ID" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" maxlength="10" placeholder="Mobile" name="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="City" name="city" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message" name="message" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-danger prompt-msg error-label"></label>
                            <label class="text-white prompt-msg success-label"></label>
                        </div>
                        <p><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div></p>
                        <div class="text-end">
                            <button class="btn btn-primary register-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    @if ($contact_us->desc != '')
                        <p class="p-white">{{ $contact_us->desc }}</p>
                    @endif
                    <div class="text-center">
                        <h4 class="p-white">#photowalksindia</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-instagram-se">
        <div class="container-fluid p-0">
            @if ($contact_us->image != '')
                <img src="{{ asset('uploads/contactus_page/' . $contact_us->image) }}">
            @else
                <img src="'{{ asset('assets/front/images/instagram-se.png') }}">
            @endif
        </div>
    </section>
@endsection
@section('page-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#contactus_form").validate({
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
                    name: {
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
                    message: {
                        required: true
                    }
                },
                messages: {
                    name: {
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
                    message: {
                        required: "Please enter your message.",
                    },
                },
                submitHandler: function(form) {
                    $('.register-btn').prop('disabled', true).html(
                        'Send <i class="fa fa-spinner fa-spin"></i>');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('front.contact_us_post') }}",
                        data: $(form).serialize(),
                        dataType: 'json',
                    }).done(function(data) {
                        $('.register-btn').prop('disabled', false).html('Send');
                        if (data.status == false) {
                            $('.error-label').text(data.message);
                            setTimeout(() => {
                                $('.error-label').text('');
                            }, 4000);
                        } else {
                            $('.success-label').text(data.message);
                            $('#contactus_form')[0].reset();
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
                        $('.register-btn').prop('disabled', false).html('Send');
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
