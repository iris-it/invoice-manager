@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('permission.list')}} ({{$permissions->count()}})</h3>
                        <div class="box-tools">
                            <div class="btn-group pull-right">
                                <a href="{{action('Admin\PermissionController@triggerScanPermission')}}" class="btn btn-flat btn-success" data-method="POST" data-token="{{csrf_token()}}" data-confirm="{{trans('permission.scan-action-warning')}}">
                                    {{trans('permission.scan-action')}} <i class="fa fa-refresh"></i>
                                </a>
                                <a href="{{action('Admin\PermissionController@create')}}" class="btn btn-flat btn-default">
                                    {{trans('permission.create-action')}} <i class="fa fa-lock"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{trans('permission.table-name')}}</th>
                                <th>{{trans('permission.table-label')}}</th>
                                <th>{{trans('permission.table-description')}}</th>
                                <th>{{trans('permission.table-role')}}</th>
                                <th>{{trans('permission.table-actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->label}}</td>
                                    <td>{{$permission->description}}</td>
                                    <td>
                                        @foreach($permission->roles as $role)
                                            @include('partials.roles_pills',['role' => $role])
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{action('Admin\PermissionController@show', $permission->id)}}" class="btn btn-flat btn-default" type="button" data-toggle="tooltip" title="{{trans('permission.show-action')}}"><i class="fa fa-eye"></i></a>
                                        <a href="{{action('Admin\PermissionController@edit', $permission->id)}}" class="btn btn-flat btn-info" type="button" data-toggle="tooltip" title="{{trans('permission.edit-action')}}"><i class="fa fa-pencil"></i></a>
                                        <a href="{{action('Admin\PermissionController@destroy',['id' => $permission->id])}}" class="btn btn-flat btn-danger" data-method="DELETE" data-toggle="tooltip" title="{{trans('permission.delete-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('permission.delete-action-warning')}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {!! $permissions->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection