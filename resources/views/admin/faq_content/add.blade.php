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
	            	<form action="{{ route('admin.faq_content.store') }}" name="addfrm" id="addfrm" method="POST" class="outer-repeater" enctype="multipart/form-data">
	            	    @csrf
                        <input type="hidden" id="id" name="id" value="{{ isset($faq) ? $faq->id : '' }}" />
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="question">Question</label>
                                <textarea name="question" id="question" class="form-control">{{ old('question', isset($faq) ? $faq->question : '') }}</textarea>
                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label" for="answer">Answer</label>
                                <textarea name="answer" id="answer" class="form-control">{{ old('answer', isset($faq) ? $faq->answer : '') }}</textarea>
                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
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
                    question:{
                        required:true
                    },
                    answer:{
                        required:true
                    },
                    status:{
                        required:true
                    },
                },
                messages:{
                    question:{
                        required:"The question field is required."
                    },
                    answer:{
                        required:"The answer field is required.",
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
