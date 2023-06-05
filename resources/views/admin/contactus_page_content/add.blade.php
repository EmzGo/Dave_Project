@extends('layouts.app')
@if(isset($page_title) && $page_title!='')
    @section('title', $page_title.' | '.config('app.name'))
@else
    @section('title', config('app.name'))
@endif
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('breadcrumb')
	@include('layouts.includes.breadcrumb')
@endsection
@section('content')
	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
	            	<form action="{{ route('admin.contactus_page_content.store') }}" name="addfrm" id="addfrm" method="POST" class="outer-repeater" enctype="multipart/form-data">
	            	    @csrf
                        <input type="hidden" id="id" name="id" value="{{ isset($contactUsPageContent) ? $contactUsPageContent->id : '' }}" />
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="banner">Banner</label>
                                <input type="file" class="dropify" id="banner" name="banner" data-default-file="{{ isset($contactUsPageContent) ? asset('uploads/contactus_page/'.$contactUsPageContent->banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="desc">Section Two Description (1)</label>
                                <textarea name="desc" id="desc" class="form-control">{{ old('desc', isset($contactUsPageContent) ? $contactUsPageContent->desc : '') }}</textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="image">Section Three Banner</label>
                                <input type="file" class="dropify" id="image" name="image" data-default-file="{{ isset($contactUsPageContent) ? asset('uploads/contactus_page/'.$contactUsPageContent->image) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
	                    <div class="d-flex flex-wrap gap-2 fr-button">
	                        <button type="submit" class="btn btn-primary waves-effect waves-light">
	                            Save
	                        </button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
@section('page-script')
    <script src="{{ asset('assets/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/task-create.init.js') }}"></script>
	<script type="text/javascript">
        $('.edit-remove-attend').on('click', function (e) {
            $(this).parents('.attend-edit-section').remove();
        });
	    $(document).ready(function() {
            $('.dropify').dropify();
	        setTimeout(function(){ $(".invalid-feedback").hide(); }, 7000);
	        $("#addfrm").validate({
	            ignore: [],
	            errorElement: 'span',
                errorPlacement: function (error, element) {
                    if(element.hasClass('dropify')){
                        error.insertAfter(element.closest('div'));
                    } else if(element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter(element.next('span'));
                    } else if (element.attr("type") == "radio") {
                        $(element).parents('.radio-list').append(error)
                    } else if (element.attr("type") == "file") {
                        $(element).parents('.dropify-wrapper').append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
	            rules: {
                    // city_id:{
                    //     required:true
                    // },
                    // title:{
                    //     required:true,
                    //     remote: {
                    //         url: "{!! route('admin.schedule.exists') !!}",
                    //         type: "POST",
                    //         data:{id:$("#id").val()},
                    //         headers: {'X-CSRF-TOKEN': Laravel.csrfToken}
                    //     }
                    // },
                    // banner: {
                    //     required: {
                    //         depends: function () {
                    //             return $('#id').val() == '';
                    //         }
                    //     },
                    // },
                    // detail_banner: {
                    //     required: {
                    //         depends: function () {
                    //             return $('#id').val() == '';
                    //         }
                    //     },
                    // },
                    // date_time:{
                    //     required:true
                    // },
                    // desc:{
                    //     required:true
                    // },
                    // status:{
                    //     required:true
                    // }
                },
                messages:{
                    city_id:{
                        required:"The city field is required."
                    },
                    title:{
                        required:"The title field is required.",
                        remote: "The title has already been taken."
                    },
                    banner: {
                        required: "The banner field is required.",
                    },
                    detail_banner: {
                        required: "The detail banner field is required.",
                    },
                    date_time: {
                        required: "The date time field is required.",
                    },
                    desc: {
                        required: "The description field is required.",
                    },
                    status:{
                        required:"The status field is required."
                    }
                },
                submitHandler: function(e) {
                    e.submit()
                }
	        });
	    });
	</script>
@endsection
