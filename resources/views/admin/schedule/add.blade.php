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
	            	<form action="{{ route('admin.schedule.store') }}" name="addfrm" id="addfrm" method="POST" class="outer-repeater" enctype="multipart/form-data">
	            	    @csrf
                        <input type="hidden" id="id" name="id" value="{{ isset($schedule) ? $schedule->id : '' }}" />
                        <h3>List Section</h3>
                        <hr />
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old( 'title',isset($schedule) ? $schedule->title : '') }}" maxlength="150">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label" for="metting_point">Meeting Point</label>
                                <input type="text" class="form-control" name="metting_point" id="metting_point" value="{{ old( 'metting_point', isset($schedule) ? $schedule->metting_point : '') }}" maxlength="150">
                                @error('metting_point')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label" for="title">City</label>
                                <select class="form-control" name="city_id" id="city_id">
                                    <option value="">select city</option>
                                    @foreach ($cities as $key => $city)
                                        <option {{ isset($schedule) && $schedule->city_id == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
	                        <label class="form-label" for="banner">Banner</label>
	                        <input type="file" class="dropify" id="banner" name="banner" data-default-file="{{ isset($schedule) ? asset('uploads/schedule/'.$schedule->banner) : '' }}"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
	                        @error('banner')
	                            <span class="invalid-feedback" role="alert">
	                                {{ $message }}
	                            </span>
	                        @enderror
	                    </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="date_time">Date Time</label>
                                <input type="datetime-local" class="form-control" value="{{ old('date_time', isset($schedule) ? $schedule->date_time : '') }}"  id="input-file-now" name="date_time" />
                                @error('date_time')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="desc">Description</label>
                                <textarea name="desc" id="desc" class="form-control">{{ old('desc', isset($schedule) ? $schedule->desc : '') }}</textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <h3>Details Section</h3>
                        <hr />
                        <div class="mb-3">
	                        <label class="form-label" for="detail_banner">Details Banner</label>
	                        <input type="file" class="dropify" id="detail_banner" data-default-file="{{ isset($schedule) ? asset('uploads/schedule/'.$schedule->detail_banner) : '' }}" name="detail_banner"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
	                        @error('detail_banner')
	                            <span class="invalid-feedback" role="alert">
	                                {{ $message }}
	                            </span>
	                        @enderror
	                    </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_one_desc_one">Details Section 1 Description (1)</label>
                                <textarea name="detail_section_one_desc_one" id="detail_section_one_desc_one" class="form-control">{{ old('detail_section_one_desc_one', isset($schedule) ? $schedule->detail_section_one_desc_one : '') }}</textarea>
                                @error('detail_section_one_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_one_desc_two">Details Section 1 Description (2)</label>
                                <textarea name="detail_section_one_desc_two" id="detail_section_one_desc_two" class="form-control">{{ old('detail_section_one_desc_two', isset($schedule) ? $schedule->detail_section_one_desc_two : '') }}</textarea>
                                @error('detail_section_one_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
	                        <label class="form-label" for="detail_section_two_banner">Details Section 2 Banner</label>
	                        <input type="file" class="dropify" data-default-file="{{ isset($schedule) ? asset('uploads/schedule/'.$schedule->detail_section_two_banner) : '' }}" id="detail_section_two_banner" name="detail_section_two_banner"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
	                        @error('detail_section_two_banner')
	                            <span class="invalid-feedback" role="alert">
	                                {{ $message }}
	                            </span>
	                        @enderror
	                    </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_two_desc_one">Details Section 2 Description (1)</label>
                                <textarea name="detail_section_two_desc_one" id="detail_section_two_desc_one" class="form-control">{{ old('detail_section_two_desc_one', isset($schedule) ? $schedule->detail_section_two_desc_one : '') }}</textarea>
                                @error('detail_section_two_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_two_desc_two">Details Section 2 Description (2)</label>
                                <textarea name="detail_section_two_desc_two" id="detail_section_two_desc_two" class="form-control">{{ old('detail_section_two_desc_two', isset($schedule) ? $schedule->detail_section_two_desc_two : '') }}</textarea>
                                @error('detail_section_two_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_three_desc_one">Details Section 3 Description (1)</label>
                                <textarea name="detail_section_three_desc_one" id="detail_section_three_desc_one" class="form-control">{{ old('detail_section_three_desc_one', isset($schedule) ? $schedule->detail_section_three_desc_one : '') }}</textarea>
                                @error('detail_section_three_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_three_desc_two">Details Section 3 Description (2)</label>
                                <textarea name="detail_section_three_desc_two" id="detail_section_three_desc_two" class="form-control">{{ old('detail_section_three_desc_two', isset($schedule) ? $schedule->detail_section_three_desc_two : '') }}</textarea>
                                @error('detail_section_three_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
	                        <label class="form-label" for="detail_section_four_banner">Details Section 4 Banner</label>
	                        <input type="file" class="dropify" data-default-file="{{ isset($schedule) ? asset('uploads/schedule/'.$schedule->detail_section_four_banner) : '' }}" id="detail_section_four_banner" name="detail_section_four_banner"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
	                        @error('detail_section_four_banner')
	                            <span class="invalid-feedback" role="alert">
	                                {{ $message }}
	                            </span>
	                        @enderror
	                    </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_four_desc_one">Details Section 4 Description (1)</label>
                                <textarea name="detail_section_four_desc_one" id="detail_section_four_desc_one" class="form-control">{{ old('detail_section_four_desc_one', isset($schedule) ? $schedule->detail_section_four_desc_one : '') }}</textarea>
                                @error('detail_section_four_desc_one')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="detail_section_four_desc_two">Details Section 4 Description (2)</label>
                                <textarea name="detail_section_four_desc_two" id="detail_section_four_desc_two" class="form-control">{{ old('detail_section_four_desc_two', isset($schedule) ? $schedule->detail_section_four_desc_two : '') }}</textarea>
                                @error('detail_section_four_desc_two')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="detail_section_five_banner">Details Section 5 Banner</label>
                            <input type="file" class="dropify" id="detail_section_five_banner" name="detail_section_five_banner"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" data-default-file="{{ isset($schedule) ? asset('uploads/schedule/'.$schedule->detail_section_five_banner) : '' }}" />
                            @error('detail_section_five_banner')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label class="form-label" for="detail_face_book_url">Facebook URL</label>
                                <input type="text" id="detail_face_book_url" value="{{ old('detail_face_book_url', isset($schedule) ? $schedule->detail_face_book_url : '') }}" class="form-control" name="detail_face_book_url" />
                                @error('detail_face_book_url')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label" for="detail_twitter_url">Twitter URL</label>
                                <input type="text" id="detail_twitter_url" value="{{ old('detail_twitter_url', isset($schedule) ? $schedule->detail_twitter_url : '') }}" class="form-control" name="detail_twitter_url" />
                                @error('detail_twitter_url')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label" for="detail_google_plus_url">Google Plus URL</label>
                                <input type="text" id="detail_google_plus_url" value="{{ old('detail_google_plus_url', isset($schedule) ? $schedule->detail_google_plus_url : '') }}" class="form-control" name="detail_google_plus_url" />
                                @error('detail_google_plus_url')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label class="form-label" for="detail_whatsapp_url">Whatsapp URL</label>
                                <input type="text" id="detail_whatsapp_url" value="{{ old('detail_whatsapp_url', isset($schedule) ? $schedule->detail_whatsapp_url : '') }}" class="form-control" name="detail_whatsapp_url" />
                                @error('detail_whatsapp_url')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label" for="detail_plus_url">Plus URL</label>
                                <input type="text" id="detail_plus_url" value="{{ old('detail_plus_url', isset($schedule) ? $schedule->detail_plus_url : '') }}" class="form-control" name="detail_plus_url" />
                                @error('detail_plus_url')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div data-repeater-list="outer-group" class="outer">

                            <div data-repeater-item class="outer">
                                <div class="inner-repeater mb-4">
                                    <div data-repeater-list="inner-group" class="inner form-group mb-0 row">
                                        <label class="col-form-label col-lg-2">Add Who can attend</label>
                                        @if (isset($schedule))
                                            @php
                                                $attendArr = json_decode($schedule->detail_who_can_attend, true);
                                            @endphp
                                            @if (!empty($attendArr))
                                                @foreach ($attendArr as $key => $attend)
                                                <div class="inner col-lg-10 ms-md-auto attend-edit-section">
                                                    <div class="mb-3 row align-items-center">
                                                        <div class="col-md-10">
                                                            <div class="mt-4 mt-md-0">
                                                                <input type="text" name="detail_who_can_attend_edit[]" class="inner form-control" placeholder="Enter Rule..." value="{{ $attend }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mt-2 mt-md-0 d-grid">
                                                                <input type="button" class="btn btn-primary inner edit-remove-attend" value="Delete"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        @endif
                                        <div data-repeater-item class="inner col-lg-10 ms-md-auto">
                                            <div class="mb-3 row align-items-center">
                                                <div class="col-md-10">
                                                    <div class="mt-4 mt-md-0">
                                                        <input type="text" name="detail_who_can_attend" class="inner form-control" placeholder="Enter Rule..."/>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-2 mt-md-0 d-grid">
                                                        <input data-repeater-delete type="button" class="btn btn-primary inner" value="Delete"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-lg-10">
                                            <input data-repeater-create type="button" class="btn btn-success inner" value="Add"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group @error('status') is-invalid @enderror">
                                <label class="control-label">Status <span style="color: red">*</span></label>
                                <div class="radio-list">
                                    <label class="radio-inline me-2">
                                        <div class="form-check form-radio-primary mb-3">
                                            <input type="radio" class="form-check-input" name="status" id="active-radio" value="1" checked>
                                            <label class="form-check-label" for="active-radio">Active</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="form-check form-radio-primary mb-3">
                                            <input type="radio" class="form-check-input" name="status" id="inactive-radio" value="0">
                                            <label class="form-check-label" for="inactive-radio">InActive</label>
                                        </div>
                                    </label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
	                    <div class="d-flex flex-wrap gap-2 fr-button">
	                        <button type="submit" class="btn btn-primary waves-effect waves-light">
	                            Save
	                        </button>
	                        <a href="{{ route('admin.schedule.index')}}" class="btn btn-secondary waves-effect">
	                        	Cancel
	                        </a>
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
                    city_id:{
                        required:true
                    },
                    title:{
                        required:true,
                        remote: {
                            url: "{!! route('admin.schedule.exists') !!}",
                            type: "POST",
                            data:{id:$("#id").val()},
                            headers: {'X-CSRF-TOKEN': Laravel.csrfToken}
                        }
                    },
                    banner: {
                        required: {
                            depends: function () {
                                return $('#id').val() == '';
                            }
                        },
                    },
                    detail_banner: {
                        required: {
                            depends: function () {
                                return $('#id').val() == '';
                            }
                        },
                    },
                    date_time:{
                        required:true
                    },
                    desc:{
                        required:true
                    },
                    status:{
                        required:true
                    }
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
