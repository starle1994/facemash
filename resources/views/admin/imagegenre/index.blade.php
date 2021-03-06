@extends('admin.layouts.master')

@section('content')
<?php $i =0 ?>
    @foreach($genres as $genre)
        @if($genre->id != 1)
            <?php 
                    $class[$i] = '';
                    if($genre->id == $id){
                        $class[$i] = 'btn btn-primary';
                    }else{
                        $class[$i] = 'btn btn-success';
                    }
             ?>
                <span>{!! link_to_route(config('quickadmin.route').'.imagegenre.image', $genre->name, array($genre->id), array('class' =>$class[$i])) !!}</span>
                <?php $i++ ?>
        @endif
    @endforeach
    <br>
     <br>
@if ($imagegenre->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        
                        <th>image</th>
                        <th>name</th>
                        <th>url</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($imagegenre as $row)
                        <tr>
                        <td>{!! link_to_route(config('quickadmin.route').'.imagegenre.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                        {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.imagegenre.destroy', $row->id))) !!}
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