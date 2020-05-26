@extends('layouts.Backend.Admin.master')
@section('content')
@push('css')
<link href="{{ asset('Backend/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('Backend/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('Backend/}assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('Backend/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<!-- summernotes CSS -->
<link href="{{ asset('Backend/assets/plugins/summernote/dist/summernote-bs4.css') }}" rel="stylesheet" />
@endpush
<form method="post" action="{{ route('author.post.store') }}" enctype="multipart/form-data">
	@csrf
    <div class="form-row">
    	<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="card-title">
						<h3>Add New Post!</h3>
					</div>
                    <!--- Form Field Start --->
                    <div class="form-group m-b-40">
                        <input type="text" class="form-control" placeholder="Write Title" name="title">
                        <!--- Error Message --->
                        @error('title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group m-b-40">
                    	<label>Fetured Image</label>
                        <input type="file" class="form-control" name="image">
                        <!--- Error Message --->
                        @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group m-b-40">
                    		<input type="checkbox" class="custom-control-input" name="publish" value="1" id="defaultUnchecked">
                    		<label class="custom-control-label" for="defaultUnchecked">Publish</label>
                    </div>

                    <!--- Form Fild End --->
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="card-title">
						<h3>Tages & Categories</h3>
					</div>

					<div class="form-group">
					 	<strong>Select Categories</strong>
					 	<select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Select Categories" name="categories[]">
                            <optgroup label="Select Multiple Category">
                            	@foreach($categories as $category)
                               <option value="{{ $category->id }}">{{ $category->name }}</option>
                               @endforeach
                            </optgroup>
                        </select>
                        <!--- Error Message --->
                        @error('categories')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
					</div>

					<div class="form-group">
					 	<strong>Select Tages</strong>
					 	<select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Select Tages" name="tages[]">
                            <optgroup label="Select Multiple Tages">
                            	@foreach($tags as $tag )
                               <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                               @endforeach
                            </optgroup>
                        </select>
                        <!--- Error Message --->
                        @error('tages')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
					</div>

					<div class="form-group">
			  		<input type="submit" name="submit" value="Publish" class="btn btn-primary">
			  	   </div>

				</div>
			</div>
		</div>
	</div>
	<!---- Editor Section Start ---->
	<div class="form-row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<textarea class="summernote" name="body">Write Post Details Hear...</textarea>
				</div>
			</div>
		</div>
	</div>
	<!---- Editor section end ---->
</form>
@endsection
@push('js')
<script src="{{ asset('Backend/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('Backend/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('Backend/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('Backend/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>

<script type="text/javascript">
  	 $(function() {
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>
<!-- Editor -->
<script src="{{ asset('Backend/assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }
    </script>

@endpush