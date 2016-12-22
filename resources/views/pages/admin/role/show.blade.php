@extends('layouts.app')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{$role->name}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('role.name-field')}}</label>
                                        {!! Form::text('name', $role->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('role.label-field')}}</label>
                                        {!! Form::text('label', $role->label, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('role.description-field')}}</label>
                                        {!! Form::text('description', $role->description, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{action('Admin\RoleController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('role.back-action')}}
                        </a>
                        <a href="{{action('Admin\RoleController@edit', $role->id)}}" class="btn btn-flat btn-sm btn-success" type="button">
                            <i class="fa fa-pencil"></i> {{trans('role.edit-action')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{trans('role.show-permission-title')}}</h3>
                    </div>
                    <div class="box-body">
                        @foreach(array_chunk($role->permissions->toArray(), 4) as $block)
                            <div class="row">
                                @foreach($block as $permission)
                                    <div class="col-md-3">
                                        <a href="{{action('Admin\PermissionController@show', $permission['id'])}}"><span
                                                    class="animated flash">►</span> {{$permission['name']}}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
