@extends('admin.layouts.master')

@section('content')

@if ($imagegenre->count())
    @foreach($genres as $genre)
    <p>{!! link_to_route(config('quickadmin.route').'.imagegenre.image',$genre->id, $genre->name, null, array('class' => 'btn btn-success')) !!}</p>
    @endforeach
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>genre</th>
                        <th>image</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($imagegenre as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ isset($row->genre->name) ? $row->genre->name : '' }}</td>
<td>@if($row->image != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->image }}">@endif</td>

                            <td>
                                {!! link_to_route(config('quickadmin.route').'.imagegenre.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.imagegenre.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
         @if ($imagegenre->lastPage() > 1)
            <ul class="pagination">
                <li class="pagination_previous {{ ($imagegenre->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $imagegenre->url(1) }}" title="2"><i class="fa fa-chevron-left"></i></a>
                </li>
                @for ($i = 1; $i <= $imagegenre->lastPage(); $i++)
                    <li class="{{ ($imagegenre->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $imagegenre->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="pagination_next {{ ($imagegenre->currentPage() == $imagegenre->lastPage()) ? ' disabled' : '' }}"><a href="{{ $imagegenre->url($imagegenre->currentPage()+1) }}"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
            @endif
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop