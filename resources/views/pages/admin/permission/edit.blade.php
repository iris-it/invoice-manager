@extends('layouts.app')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    {!! Form::model($permission, ['method' => 'PUT','action' => ['Admin\PermissionController@update', $permission->id], 'class'=> 'form-horizontal']) !!}

                    <div class="box-header">
                        <h3 class="box-title">{{trans('general.edit')}} {{$permission->name}}</h3>
                    </div>
                    <div class="box-body">

                        @include('errors.list')

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 form-horizontal">

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! Form::label('name', trans('permission.name-field')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! Form::label('label', trans('permission.label-field')) !!}
                                        {!! Form::text('label', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! Form::label('description', trans('permission.description-field')) !!}
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{action('Admin\PermissionController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('permission.back-action')}}
                        </a>
                        <button class="btn btn-flat btn-sm btn-success" type="submit">
                            <i class="fa fa-check push-5-r"></i> {{trans('permission.save-action')}}
                        </button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    {!! Form::open(['method' => 'PUT','action' => ['Admin\PermissionController@syncRoles', $permission->id], 'class'=> 'form-horizontal']) !!}

                    <div class="box-header">
                        <h3 class="box-title">{{trans('permission.show-role-title')}}</h3>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::select('roles[]',$roles, array_pluck($permission->roles, 'id'), ['multiple', 'id'=> 'role_list'] ) !!}
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{action('Admin\PermissionController@index')}}" class="btn btn-flat btn-sm btn-info" type="button"><i class="fa fa-arrow-left"></i> {{trans('permission.back-action')}}</a>
                        <button class="btn btn-flat btn-sm btn-success" type="submit"><i class="fa fa-check push-5-r"></i> {{trans('permission.save-action')}}</button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </section>

@endsection
