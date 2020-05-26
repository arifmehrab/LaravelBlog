@extends('layouts.Backend.Admin.master')
@push('css')
<link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
@endpush
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			 <div class="card-body">
			 	<a class="btn btn-primary my-3" href="{{ route('admin.category.create') }}">
			 		<i class="fa fa-plus-circle"></i>Add category
			 	</a>
                <h4 class="text-right" style="font-size: 25px; font-weight: bold;">Total Categories:- {{ $categories->count() }}
                </h4>
			 	<div class="table-responsive m-t-40">
			 		<table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        	<tr>
                        	   <td>SL.</td>
                        	   <td>category Name</td>
                        	   <td>category Slug</td>
                        	   <td>Action</td>
                        	</tr>
                        </thead>
                        <tbody>
                        	@foreach($categories as $key => $category)
                        	<tr>
                        		<td>{{ $key+1 }}</td>
                        		<td>{{ $category->name }}</td>
                        		<td>{{ $category->slug }}</td>
                        		<td>
                        			<a title="Edit" class="btn btn-success" href="{{ route('admin.category.edit', $category->id) }}">
                        				<i class="fa fa-edit"></i>
                        			</a>
                      	            <button title="Delete" type="button" class="btn btn-danger" onclick="deleteTag({{ $category->id }})">
                      	            	<i class="fa fa-trash"></i>
                      	            </button>
                      	            <form style="display: none;" id="delete_form_{{ $category->id }}" method="post" action="{{ route('admin.category.destroy', $category->id) }}">
                      	            	@csrf
                      	            	@method('DELETE')
                      	            </form>
                        		</td>
                        	</tr>
                        	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
@push('js')
 <!-- This is data table -->
    <script src="{{ asset('Backend/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(function () {
            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        $('#config-table').DataTable({
            responsive: true
        });
    </script>
@endpush