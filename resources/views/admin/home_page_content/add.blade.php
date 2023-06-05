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
	            	<form action="{{ route('admin.home_page_content.store') }}" name="addfrm" id="addfrm" method="POST" class="outer-repeater" enctype="multipart/form-data">
	            	    @csrf
                        <input type="hidden" id="id" name="id" value="{{ isset($homePageContent) ? $homePageContent->id : '' }}" />
                        <h4>Section 1</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="banner">Section One Banner</label>
                                <input type="file" class="dropify" id="banner" name="banner" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_one_banner_desc_one">Section One Description (1)</label>
                                <textarea name="section_one_banner_desc_one" id="section_one_banner_desc_one" class="form-control">{{ old('section_one_banner_desc_one', isset($homePageContent) ? $homePageContent->section_one_banner_desc_one : '') }}</textarea>
                                @error('section_one_banner_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_one_banner_desc_two">Section One Description (2)</label>
                                <textarea name="section_one_banner_desc_two" id="section_one_banner_desc_two" class="form-control">{{ old('section_one_banner_desc_two', isset($homePageContent) ? $homePageContent->section_one_banner_desc_two : '') }}</textarea>
                                @error('section_one_banner_desc_two')
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
                                <label class="form-label" for="section_two_title">Section Two Title</label>
                                <input type="text" class="form-control" id="section_two_title" name="section_two_title" value="{{ old('section_two_title', isset($homePageContent) ? $homePageContent->section_two_title : '') }}" />
                                @error('section_two_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_two_banner">Section Two Banner</label>
                                <input type="file" class="dropify" id="section_two_banner" name="section_two_banner" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->section_two_banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_two_banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_two_banner_desc_one">Section Two Description (1)</label>
                                <textarea name="section_two_banner_desc_one" id="section_two_banner_desc_one" class="form-control">{{ old('section_two_banner_desc_one', isset($homePageContent) ? $homePageContent->section_two_banner_desc_one : '') }}</textarea>
                                @error('section_two_banner_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_two_banner_desc_two">Section Two Description (2)</label>
                                <textarea name="section_two_banner_desc_two" id="section_two_banner_desc_two" class="form-control">{{ old('section_two_banner_desc_two', isset($homePageContent) ? $homePageContent->section_two_banner_desc_two : '') }}</textarea>
                                @error('section_two_banner_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 3</h4>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_three_title">Section Three Title</label>
                                <input type="text" class="form-control" id="section_three_title" name="section_three_title" value="{{ old('section_three_title', isset($homePageContent) ? $homePageContent->section_three_title : '') }}" />
                                @error('section_three_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_three_banner">Section Three Banner</label>
                                <input type="file" class="dropify" id="section_three_banner" name="section_three_banner" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->section_three_banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_three_banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_three_desc_one">Section Three Description (1)</label>
                                <textarea name="section_three_desc_one" id="section_three_desc_one" class="form-control">{{ old('section_three_desc_one', isset($homePageContent) ? $homePageContent->section_three_desc_one : '') }}</textarea>
                                @error('section_three_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_three_desc_two">Section Three Description (2)</label>
                                <textarea name="section_three_desc_two" id="section_three_desc_two" class="form-control">{{ old('section_three_desc_two', isset($homePageContent) ? $homePageContent->section_three_desc_two : '') }}</textarea>
                                @error('section_three_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 4</h4>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_four_title">Section Four Title</label>
                                <input type="text" class="form-control" id="section_four_title" name="section_four_title" value="{{ old('section_four_title', isset($homePageContent) ? $homePageContent->section_four_title : '') }}" />
                                @error('section_four_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_four_banner">Section Four Banner</label>
                                <input type="file" class="dropify" id="section_four_banner" name="section_four_banner" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->section_four_banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_four_banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_four_desc_one">Section Four Description (1)</label>
                                <textarea name="section_four_desc_one" id="section_four_desc_one" class="form-control">{{ old('section_four_desc_one', isset($homePageContent) ? $homePageContent->section_four_desc_one : '') }}</textarea>
                                @error('section_four_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_four_desc_two">Section Four Description (2)</label>
                                <textarea name="section_four_desc_two" id="section_four_desc_two" class="form-control">{{ old('section_four_desc_two', isset($homePageContent) ? $homePageContent->section_four_desc_two : '') }}</textarea>
                                @error('section_four_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 5</h4>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_contest_title">Section Five Contest Title</label>
                                <input type="text" class="form-control" id="section_five_contest_title" name="section_five_contest_title" value="{{ old('section_five_contest_title', isset($homePageContent) ? $homePageContent->section_five_contest_title : '') }}" />
                                @error('section_five_contest_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_contest_image">Section Five Contect Banner</label>
                                <input type="file" class="dropify" id="section_five_contest_image" name="section_five_contest_image" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->section_five_contest_image) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_five_contest_image')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_contest_sub_title">Section Five Contest Sub Title</label>
                                <input type="text" id="section_five_contest_sub_title" value="{{ old('section_five_contest_sub_title', isset($homePageContent) ? $homePageContent->section_five_contest_sub_title : '') }}" class="form-control" name="section_five_contest_sub_title" />
                                @error('section_five_contest_sub_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_contest_desc">Section Five Contest Description</label>
                                <textarea name="section_five_contest_desc" id="section_five_contest_desc" class="form-control">{{ old('section_five_contest_desc', isset($homePageContent) ? $homePageContent->section_five_contest_desc : '') }}</textarea>
                                @error('section_five_contest_desc')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_contest_winning_text">Section Five Winning Text</label>
                                <input type="text" id="section_five_contest_winning_text" value="{{ old('section_five_contest_winning_text', isset($homePageContent) ? $homePageContent->section_five_contest_winning_text : '') }}" class="form-control" name="section_five_contest_winning_text" />
                                @error('section_five_contest_winning_text')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_five_contest_end_text">Section Five End Text</label>
                                <input type="text" id="section_five_contest_end_text" value="{{ old('section_five_contest_end_text', isset($homePageContent) ? $homePageContent->section_five_contest_end_text : '') }}" class="form-control" name="section_five_contest_end_text" />
                                @error('section_five_contest_end_text')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 6</h4>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_six_community_desc_one">Section Six Communitiy Description (1)</label>
                                <textarea name="section_six_community_desc_one" id="section_six_community_desc_one" class="form-control">{{ old('section_six_community_desc_one', isset($homePageContent) ? $homePageContent->section_six_community_desc_one : '') }}</textarea>
                                @error('section_six_community_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="section_six_community_desc_two">Section Six Communitiy Description (2)</label>
                                <textarea name="section_six_community_desc_two" id="section_six_community_desc_two" class="form-control">{{ old('section_six_community_desc_two', isset($homePageContent) ? $homePageContent->section_six_community_desc_two : '') }}</textarea>
                                @error('section_six_community_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 7</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="section_seven_banner">Section Seven Banner</label>
                                <input type="file" class="dropify" id="section_seven_banner" name="section_seven_banner" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->section_seven_banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_seven_banner')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <h4>Section 8</h4>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="section_eight_banner">Section Eight Banner</label>
                                <input type="file" class="dropify" id="section_eight_banner" name="section_eight_banner" data-default-file="{{ isset($homePageContent) ? asset('uploads/home_page/'.$homePageContent->section_eight_banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
                                @error('section_eight_banner')
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
