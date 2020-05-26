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
			 	<div class="card-title">
                    <h3>
                        <strong>Post Title:- </strong>{{ $post->title }}
                    </h3>
                    <hr>
                    <h4>
                        <strong>Post Body:- </strong>{!! $post->body !!}
                    </h4>
                    <hr>
                    <h4>
                        <strong>Post Fetured Image:- </strong><br>
                        <img width="400" src="{{ asset('Backend/assets/images/posts/'.$post->image) }}">
                    </h4>
                   <h3>
                        <strong>Post Total View:- </strong>{{ $post->view_count }}
                    </h3>
                    <hr>
                    <h3>
                        <strong>Post Date:- </strong>{{ date('d-m-Y',strtotime($post->date)) }}
                    </h3>
                    <hr>
                    <h3>
                        <strong>Post Categories:- </strong>
                        @foreach($post->categories as $category)
                         <span>{{ $category->name }}</span>
                        @endforeach
                    </h3>
                    <hr>
                    <h3>
                        <strong>Post Tages:- </strong>
                        @foreach($post->tags as $tag)
                         <span>{{ $tag->name }},</span>
                        @endforeach
                    </h3>
                    <hr>
                    @if($post->is_approved == '1')
                    <button class="btn btn-primary" disabled>Approved</button>
                    @else
                    <button class="btn btn-primary" onclick="approved({{ $post->id }})">
                        Approved
                    </button>
                    @endif
                   <form method="post" action="{{ route('admin.post.approve', $post->id) }}" id="post_approved_{{ $post->id }}" style="display: none;">
                      @csrf
                      @method('PUT') 
                   </form>
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
    <!--- Alear Messasge For Approved --->
    <script type="text/javascript">
    function approved(id){
        const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'mr-2 btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You Want to Approved This Post!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                     event.preventDefault();
                     document.getElementById('post_approved_'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Post is Stil Pending :)',
                        'error'
                    )
                }
            })
    }

</script>   
@endpush