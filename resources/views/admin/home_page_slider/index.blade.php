@extends('layouts.app')
@if (isset($page_title) && $page_title != '')
    @section('title', $page_title . ' | ' . config('app.name'))
@else
    @section('title', config('app.name'))
@endif
@section('page-style')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
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
                    <form action="{{ route('admin.home_page_slider.store') }}" name="addfrm" id="addfrm" method="POST" class="outer-repeater" enctype="multipart/form-data">
	            	    @csrf
                        <div class="mb-3">
	                        <label class="form-label" for="detail_section_four_banner">Image</label>
	                        <input type="file" class="dropify" id="image" name="image"  data-allowed-file-extensions="png svg gif jpg jpeg" data-show-errors="true" />
	                        @error('image')
	                            <span class="invalid-feedback" role="alert">
	                                {{ $message }}
	                            </span>
	                        @enderror
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="DataTable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        var table;
        $(document).ready(function() {
            table = $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                pageLength: 50,
                ajax: {
                    headers: {
                        'X-CSRF-Token': Laravel.csrfToken
                    },
                    url: "{!! route('admin.home_page_slider.data') !!}",
                    type: 'POST',
                    dataType: "json",
                    beforeSend: function() {
                        if (typeof table != 'undefined' && table.hasOwnProperty('settings')) {
                            table.settings()[0].jqXHR.abort();
                        }
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "id"
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: "status",
                        name: "status",
                        "render": function(data, type, row) {
                            if (data == 1) {
                                return '<button type="button" class="btn btn-outline-success btn-sm change-status-btn" data-id="' +
                                    row.id + '" data-status="0">Active</button>';
                            } else {
                                return '<button type="button" class="btn btn-outline-danger btn-sm change-status-btn" data-id="' +
                                    row.id + '" data-status="1">InActive</button>';
                            }
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sortable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
            table.on('click', '.change-status-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var status = $(this).data('status');
                if ((typeof id !== "undefined") && (typeof status !== "undefined")) {
                    swal({
                        title: 'Are You Sure you want to change status?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Do it!',
                        confirmButtonColor: "#3085d6",
                        cancelButtonText: 'No, cancel!',
                        cancelButtonColor: '#d33',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                url: "{!! route('admin.home_page_slider.status.change') !!}",
                                data: {
                                    id: id,
                                    status: status
                                },
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': Laravel.csrfToken
                                }
                            }).done(function(response) {
                                if (response.success == true) {
                                    setTimeout(function() {
                                        redrawDatatable();
                                    }, 1000);
                                    swal({
                                        type: 'success',
                                        text: response.message,
                                        timer: '1500'
                                    });
                                } else {
                                    swal({
                                        type: 'error',
                                        text: response.message,
                                        timer: '500000'
                                    });
                                }
                            }).fail(function(jqXHR, status, exception) {
                                if (jqXHR.status === 0) {
                                    error =
                                        'Not connected.\nPlease verify your network connection.';
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
                                Swal.fire('Error!', error, 'error');
                            });
                        }
                    });
                }
            });
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
                    image: {
                        required: true,
                    },
                    status:{
                        required:true
                    }
                },
                messages:{
                    image: {
                        required: "The image field is required.",
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

        function deleteRecord(ele, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                confirmButtonColor: "#d33",
                confirmButtonClass: 'btn btn-success',
                cancelButtonText: 'No, cancel!',
                cancelButtonColor: '#3085d6',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-Token': Laravel.csrfToken
                        },
                        url: "{!! route('admin.home_page_slider.destroy') !!}",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            setTimeout(function() {
                                redrawDatatable();
                            }, 1000);
                            if (response.success == true) {
                                swal({
                                    type: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    timer: '1500'
                                });
                            } else {
                                swal({
                                    type: 'error',
                                    title: 'Not Deleted!',
                                    text: response.message,
                                    timer: '1500'
                                });
                            }
                        },
                        error: function(jqXHR, status, exception) {
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
                            Swal.fire('Error!', error, 'error');
                        }
                    });
                }
            });
        }

        function redrawDatatable() {
            $('#DataTable').DataTable().ajax.reload();
        }
    </script>
@endsection
