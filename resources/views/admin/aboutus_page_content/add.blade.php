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
	            	<form action="{{ route('admin.aboutus_page_content.store') }}" name="addfrm" id="addfrm" method="POST" class="outer-repeater" enctype="multipart/form-data">
	            	    @csrf
                        <input type="hidden" id="id" name="id" value="{{ isset($aboutUsPageContent) ? $aboutUsPageContent->id : '' }}" />
                        <h4>Section 1</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="banner">Banner</label>
                                <input type="file" class="dropify" id="banner" name="banner" data-default-file="{{ isset($aboutUsPageContent) ? asset('uploads/aboutus_page/'.$aboutUsPageContent->banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 2</h4>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_one_community_title">Section Two Title</label>
                                <input type="text" class="form-control" id="section_one_community_title" name="section_one_community_title" value="{{ old('section_one_community_title', isset($aboutUsPageContent) ? $aboutUsPageContent->section_one_community_title : '') }}" />
                                @error('section_one_community_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_two_image">Section Two Banner</label>
                                <input type="file" class="dropify" id="section_two_image" name="section_two_image" data-default-file="{{ isset($aboutUsPageContent) ? asset('uploads/aboutus_page/'.$aboutUsPageContent->section_two_image) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_two_image')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_one_community_desc_one">Section Two Description (1)</label>
                                <textarea name="section_one_community_desc_one" id="section_one_community_desc_one" class="form-control">{{ old('section_one_community_desc_one', isset($aboutUsPageContent) ? $aboutUsPageContent->section_one_community_desc_one : '') }}</textarea>
                                @error('section_one_community_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_one_community_desc_two">Section Two Description (2)</label>
                                <textarea name="section_one_community_desc_two" id="section_one_community_desc_two" class="form-control">{{ old('section_one_community_desc_two', isset($aboutUsPageContent) ? $aboutUsPageContent->section_one_community_desc_two : '') }}</textarea>
                                @error('section_one_community_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 3</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="section_three_travel_title">Section Three Title</label>
                                <input type="text" class="form-control" id="section_three_travel_title" name="section_three_travel_title" value="{{ old('section_three_travel_title', isset($aboutUsPageContent) ? $aboutUsPageContent->section_three_travel_title : '') }}" />
                                @error('section_three_travel_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_three_travel_desc_one">Section Three Description (1)</label>
                                <textarea name="section_three_travel_desc_one" id="section_three_travel_desc_one" class="form-control">{{ old('section_three_travel_desc_one', isset($aboutUsPageContent) ? $aboutUsPageContent->section_three_travel_desc_one : '') }}</textarea>
                                @error('section_three_travel_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_three_travel_desc_two">Section Three Description (2)</label>
                                <textarea name="section_three_travel_desc_two" id="section_three_travel_desc_two" class="form-control">{{ old('section_three_travel_desc_two', isset($aboutUsPageContent) ? $aboutUsPageContent->section_three_travel_desc_two : '') }}</textarea>
                                @error('section_three_travel_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 4</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="section_four_image">Section Four Banner</label>
                                <input type="file" class="dropify" id="section_four_image" name="section_four_image" data-default-file="{{ isset($aboutUsPageContent) ? asset('uploads/aboutus_page/'.$aboutUsPageContent->section_four_image) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_four_image')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 5</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="section_five_learn_title">Section Three Title</label>
                                <input type="text" class="form-control" id="section_five_learn_title" name="section_five_learn_title" value="{{ old('section_five_learn_title', isset($aboutUsPageContent) ? $aboutUsPageContent->section_five_learn_title : '') }}" />
                                @error('section_five_learn_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_learn_desc_one">Section Three Description (1)</label>
                                <textarea name="section_five_learn_desc_one" id="section_five_learn_desc_one" class="form-control">{{ old('section_five_learn_desc_one', isset($aboutUsPageContent) ? $aboutUsPageContent->section_five_learn_desc_one : '') }}</textarea>
                                @error('section_five_learn_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_learn_desc_two">Section Three Description (2)</label>
                                <textarea name="section_five_learn_desc_two" id="section_five_learn_desc_two" class="form-control">{{ old('section_five_learn_desc_two', isset($aboutUsPageContent) ? $aboutUsPageContent->section_five_learn_desc_two : '') }}</textarea>
                                @error('section_five_learn_desc_two')
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
