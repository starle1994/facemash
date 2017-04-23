@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.content.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($content->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        
                        <th>name</th>
                        <th>image</th>
                         <th>url</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($content as $row)
                        <tr>
                            
                            <td>{{ $row->name }}</td>
                            <td>@if($row->image != '')<img width="50px" height="50px" src="{{ asset('uploads') . '/'.  $row->image }}">@endif</td>
                            <td>
                            <td>{{ $row->url }}</td>
                            <td>
                                {!! link_to_route(config('quickadmin.route').'.content.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                               
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.content.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                               
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.content.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
    </div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection