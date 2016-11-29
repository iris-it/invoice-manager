@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('role.list')}} ({{$roles->count()}})</h3>
                        <div class="box-tools">
                            <a href="{{action('Admin\RoleController@create')}}" class="btn btn-flat btn-default pull-right">
                                <i class="fa fa-graduation-cap"></i> {{trans('role.create-action')}}
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{trans('role.table-name')}}</th>
                                <th>{{trans('role.table-label')}}</th>
                                <th>{{trans('role.table-description')}}</th>
                                <th>{{trans('role.table-count-user')}}</th>
                                <th>{{trans('role.table-count-permission')}}</th>
                                <th>{{trans('role.table-actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td class="font-w600 animated flash">
                                        @include('partials.roles_pills',['role' => $role])
                                    </td>
                                    <td>{{$role->label}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>{{$role->users->count()}}</td>
                                    <td>{{$role->permissions->count()}}</td>
                                    <td>
                                        <a href="{{action('Admin\RoleController@show', $role->id)}}" class="btn btn-flat btn-default" type="button" data-toggle="tooltip" title="{{trans('role.show-action')}}"><i class="fa fa-eye"></i></a>
                                        <a href="{{action('Admin\RoleController@edit', $role->id)}}" class="btn btn-flat btn-info" type="button" data-toggle="tooltip" title="{{trans('role.edit-action')}}"><i class="fa fa-pencil"></i></a>
                                        <a href="{{action('Admin\RoleController@destroy',['id' => $role->id])}}" class="btn btn-flat btn-danger" data-method="DELETE" data-toggle="tooltip" title="{{trans('role.delete-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('role.delete-action-warning')}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {!! $roles->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection