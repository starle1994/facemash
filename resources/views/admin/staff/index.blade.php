@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.staff.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($staff->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>image</th>
                        <th>name</th>

                    </tr>
                </thead>

                <tbody> 
                    @foreach ($staff as $row)
                    
                        <tr>
                            <td>{!! link_to_route(config('quickadmin.route').'.staff.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                        {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.staff.destroy', $row->id))) !!}
                            {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}

                        {!! Form::close() !!}    
                        </td>
                            <td colspan="1">@if($row->image != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->image }}">@endif</td>
                            <td colspan="1">{{ $row->name }}</td>
                            <td colspan="1"><a href="{{$row->url}}">{{ mb_substr($row->url,0,25) }}...</a></td>
                            <td colspan="2">
                            {{ $row->rating }}
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                  aria-valuemin="0" aria-valuemax="100" style="width:{{ $row->rating }}px" >
                                    <span class="sr-only">70% Complete</span>
                                  </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
        
        </div>

	</div>
    @if ($staff->lastPage() > 1)
    <ul class="pagination">
        <li class="pagination_previous {{ ($staff->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $staff->url(1) }}" title="2"><i class="fa fa-chevron-left"></i></a>
        </li>
        @for ($i = 1; $i <= $staff->lastPage(); $i++)
            <li class="{{ ($staff->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $staff->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="pagination_next {{ ($staff->currentPage() == $staff->lastPage()) ? ' disabled' : '' }}"><a href="{{ $staff->url($staff->currentPage()+1) }}"><i class="fa fa-chevron-right"></i></a></li>
    </ul>
    @endif
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection
