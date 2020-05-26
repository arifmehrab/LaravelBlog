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
			 	<a class="btn btn-primary my-3" href="{{ route('admin.post.create') }}">
			 		<i class="fa fa-plus-circle"></i>Add Post
			 	</a>
                <h4 class="text-right" style="font-size: 25px; font-weight: bold;">Total Post:- {{ $posts->count() }}
                </h4>
			 	<div class="table-responsive m-t-40">
			 		<table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        	<tr>
                        	   <td>Comment Info.</td>
                        	   <td>Post Info.</td>
                        	   <td>Action</td>
                        	</tr>
                        </thead>
                        <tbody>
                            @php 
                            use Illuminate\Support\str;
                            @endphp
                        	@foreach($posts as $key=> $post)
                           @foreach($post->comments as $comment)
                        	<tr>
                        		<td>
                                  <div class="media">
                                      <div class="media-right">
                                        <a class="avatar" href="#">
                                        @if(isset($comment->user->profile))
                                        <img class="img-rounded" width="80" height="80" src="{{ asset('Backend/assets/images/profile/'. $comment->user->profile ) }}" alt="Profile Image">
                                        @else
                                        <img width="80" height="70" src="{{ asset('Backend/assets/images/profile/defoult.jpg')}}" alt="avator">
                                        @endif
                                       </a>
                                      </div>

                                      <div class="media-body">
                                          <a href="#">{{ $comment->user->name }}</a>
                                          <span>{{ $comment->created_at->diffForHumans() }}</span>
                                          <br>
                                          <strong>
                                              {{ $comment->comment }}
                                          </strong>
                                      </div>
                                  </div>      
                                </td>
                        		<td>
                                  <div class="media">
                                      <div class="media-right">
                                          <img class="img-rounded" width="80" height="80" src="{{ asset('Backend/assets/images/posts/'. $comment->post->image ) }}" alt="Profile Image">
                                      </div>

                                      <div class="media-body">
                                          <h4>
                                              {{ str::limit($comment->post->title, 40) }}
                                          </h4>
                                        
                                          <strong>
                                              {{ $comment->post->user->name }}
                                          </strong>
                                      </div>
                                  </div>      
                                </td>
                        		<td>
                      	            <button title="Delete" type="button" class="btn btn-danger" onclick="commentDelete({{ $comment->id }})">
                      	            	<i class="fa fa-trash"></i>
                      	            </button>
                      	            <form style="display: none;" id="delete_form_{{ $comment->id }}" method="post" action="{{ route('author.comment.destroy', $comment->id) }}">
                                        @csrf
                                        @method('DELETE')
                      	            </form>
                        		</td>
                        	</tr>
                           @endforeach
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
<!-- Alert Message -->
<script type="text/javascript">
    function commentDelete(id){
        const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'mr-2 btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You Want to Delete This Item!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                     event.preventDefault();
                     document.getElementById('delete_form_'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })
    }

</script> 
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