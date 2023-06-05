@extends('layouts.app')
@if(isset($page_title) && $page_title!='')
    @section('title', $page_title.' | '.config('app.name'))
@else
    @section('title', config('app.name'))
@endif
@section('page-style')
	<!-- DataTables -->
	<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- Responsive datatable examples -->
	<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
	@include('layouts.includes.breadcrumb')
@endsection
@section('content')
	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
	                <table id="DataTable" class="table table-bordered dt-responsive nowrap w-100">
	                    <thead>
		                    <tr>
		                    	<th>#</th>
	                        	<th>Name</th>
	                        	<th>Description</th>
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
		    table=$('#DataTable').DataTable({
		        processing: true,
		        serverSide: true,
		        searching: true,
		        pageLength: 50,
		        ajax:{
		            headers: {'X-CSRF-Token': Laravel.csrfToken},
		            url:"{!! route('admin.role.data') !!}",
		            type:'POST',
		            dataType: "json",
		            beforeSend: function () {
		                if (typeof table != 'undefined' && table.hasOwnProperty('settings')) {
		                    table.settings()[0].jqXHR.abort();
		                }
		            }
		        },
		        columns: [
		            {data: "DT_RowIndex", name: "id"},
		            {data: 'display_name', name: 'display_name'},
		            {data: 'description', name: 'description'},
		            {data: 'created_at', name: 'created_at'},
		            {data: 'action',name: 'action', sortable:false}
		        ],
		        order: [[0, 'desc']]
		    });
	    });
	    function deleteRecord(ele,id){
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
	    	            headers: {'X-CSRF-Token': Laravel.csrfToken},
	    	            url: "{!! route('admin.role.destroy') !!}",
	    	            dataType : 'json',
	    	            data: {id:id},
	    	            success: function(response) {
	    	                setTimeout( function () {
	    	                    redrawDatatable();
	    	                }, 1000 );
	    	                if(response.success == true){
	    	                	swal({
	    	                	    type : 'success',
	    	                	    title: 'Deleted!',
	    	                	    text : response.message,
	    	                	    timer: '1500'
	    	                	});
	    	                }else{
	    	                	swal({
	    	                	    type : 'error',
	    	                	    title: 'Not Deleted!',
	    	                	    text : response.message,
	    	                	    timer: '1500'
	    	                	});
	    	                }
	    	            },
	    	            error: function (jqXHR, status, exception) {
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
	    	                Swal.fire('Error!',error,'error');
	    	            }
	    	        });
	    	    }
	    	});
	    }
	    function redrawDatatable(){
	        $('#DataTable').DataTable().ajax.reload();
	    }
	</script>
@endsection
