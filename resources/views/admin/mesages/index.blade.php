@extends('admin.layouts.master')

@section('content')
    <?php $i =0 ?>
   @foreach($genres as $genre)
        <?php 
                $class[$i] = '';
                if($genre->id == $id){
                    $class[$i] = 'btn btn-primary';
                }else{
                    $class[$i] = 'btn btn-success';
                }
         ?>
            <span>{!! link_to_route(config('quickadmin.route').'.mesages.list', $genre->name, array($genre->id), array('class' =>$class[$i])) !!}</span>
            <?php $i++ ?>
    @endforeach
    <br>
     <br>

    @if($mesages->count() > 0)
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">{{ trans('quickadmin::admin.users-index-users_list') }}</div>
            </div>
            <div class="portlet-body">
                <table id="datatable" class="table table-striped table-hover table-responsive datatable">
                    <thead>
                    <tr>
                        <th>{{ trans('quickadmin::admin.users-index-name') }}</th>
                        <th>message</th>
                        <th>created_at</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($mesages as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->msg }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                {!! Form::open(['style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => 'return confirm(\'' . trans('quickadmin::admin.users-index-are_you_sure') . '\');',  'route' => array('admin.mesages.delete', $user->id)]) !!}
                                {!! Form::submit(trans('quickadmin::admin.users-index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @else
        {{ trans('quickadmin::admin.users-index-no_entries_found') }}
    @endif

@endsection