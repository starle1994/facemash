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
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Level</th>
                        <th>image</th>
                        <th>rating</th>


                    </tr>
                </thead>

                <tbody>
                <?php $i = 0;
                    $pre = -1;
                ?>
                    @foreach ($staff as $row)
                    <?php
                            $current = $row->rating;
                            if($current != $pre){
                                $i++;
                            }
                            $pre = $current;
                            ?>
                        <tr>
                            <td >
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td colspan="1">{{ $i }}</td>
                            <td colspan="1">@if($row->image != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->image }}">@endif</td>
                            <td colspan="2">
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
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.staff.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
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