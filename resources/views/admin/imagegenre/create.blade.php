@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('files' => true, 'route' => config('quickadmin.route').'.imagegenre.store', 'id' => 'form-with-validation', 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload')) !!}

<div class="form-group">
    <div class="col-sm-2 control-label"><h2>{{ $genre->name}}</h2></div>
    {!! Form::hidden('genre_id', $genre->id) !!}
</div>
<div style="clear: both;"></div>
<div class="form-group">
    {!! Form::label('name', 'name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('url', 'url', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('url', old('url'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('image', 'image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
       <div>
                <h3>Upload Multiple Image By Click On Box</h3>
            </div>
        
    </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize         :       10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>
@endsection