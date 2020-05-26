<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets -->

	<link href="{{ asset('Frontend/assets/common-css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('Frontend/assets/common-css/swiper.css') }}" rel="stylesheet">

	<link href="{{ asset('Frontend/assets/common-css/ionicons.css') }}" rel="stylesheet">


	<link href="{{ asset('Frontend/assets/front-page-category/css/styles.css') }}" rel="stylesheet">

	<link href="{{ asset('Frontend/assets/front-page-category/css/responsive.css') }}" rel="stylesheet">
  <style type="text/css">
    .pavourite{
      color: red;
    }
  </style>
	@stack('css')

</head>
<body >

@include('layouts.Frontend.partials.header')

@yield('subHeading')

@yield('blogArea')

@include('layouts.Frontend.partials.footer')


	<!-- SCIPTS -->

	<script src="{{ asset('Frontend/assets/common-js/jquery-3.1.1.min.js') }}"></script>

	<script src="{{ asset('Frontend/assets/common-js/tether.min.js') }}"></script>

	<script src="{{ asset('Frontend/assets/common-js/bootstrap.js') }}"></script>

	<script src="{{ asset('Frontend/assets/common-js/swiper.js') }}"></script>

	<script src="{{ asset('Frontend/assets/common-js/scripts.js') }}"></script>
	<!--- Notify js Start --->
   <script src="{{ asset('Backend/assets/notify-js/notify.js') }}"></script>
	@stack('js')
<!---- Success Message -->
  @if(session()->has('success'))
    <script type="text/javascript">
      $(function(){
        $.notify("{{ session()->get('success') }}",{globalPosition:'top right',className:'success'});
      });
    </script>
  @endif
<!---- Error Message -->
  @if(session()->has('error'))
    <script type="text/javascript">
      $(function(){
        $.notify("{{ session()->get('error') }}",{globalPosition:'top right',className:'error'});
      });
    </script>
  @endif
  <!--- Notify js End --->
<script type="text/javascript">
    function deleteTag(id){
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
</body>
</html>
