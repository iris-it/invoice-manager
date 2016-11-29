@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('users.list')}} ({{$users->count()}})</h3>
                        <div class="box-tools">
                            <a href="{{action('Admin\UserController@create')}}" class="btn btn-default btn-flat pull-right">
                                <i class="fa fa-user-plus"></i> {{trans('users.create-action')}}
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{trans('users.table-name')}}</th>
                                <th>{{trans('users.table-email')}}</th>
                                <th>{{trans('users.table-role')}}</th>
                                <th>{{trans('general.updated-at')}}</th>
                                <th>{{trans('users.table-actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="animated fadeIn">
                            @foreach($users as $user)
                                <tr>
                                    <td class="font-w600">{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="animated flash">
                                        @include('partials.roles_pills',['role' => $user->role])
                                    </td>
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{action('Admin\UserController@show', $user->id)}}" class="btn btn-flat btn-default" type="button" data-toggle="tooltip" title="{{trans('users.show-action')}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{action('Admin\UserController@edit', $user->id)}}" class="btn btn-flat btn-info" type="button" data-toggle="tooltip" title="{{trans('users.edit-action')}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{action('Admin\UserController@resendPasswordEmail', $user->id)}}" class="btn btn-flat btn-warning" data-method="POST" data-toggle="tooltip" title="{{trans('users.reset-password-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('users.reset-password-action-warning')}}">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                        <a href="{{action('Admin\UserController@destroy', $user->id)}}" class="btn btn-flat btn-danger" data-method="DELETE" data-toggle="tooltip" title="{{trans('users.delete-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('users.delete-action-warning')}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection