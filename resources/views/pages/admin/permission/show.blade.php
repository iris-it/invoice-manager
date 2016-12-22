@extends('layouts.app')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{$permission->name}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('permission.name-field')}}</label>
                                        {!! Form::text('name', $permission->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('permission.label-field')}}</label>
                                        {!! Form::text('label', $permission->label, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('permission.description-field')}}</label>
                                        {!! Form::text('description', $permission->description, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{action('Admin\PermissionController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('permission.back-action')}}
                        </a>
                        <a href="{{action('Admin\PermissionController@edit', $permission->id)}}" class="btn btn-flat btn-sm btn-success" type="button">
                            <i class="fa fa-pencil"></i> {{trans('permission.edit-action')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{trans('permission.show-role-title')}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach(array_chunk($permission->roles->toArray(), 4) as $block)
                                    <div class="row">
                                        @foreach($block as $role)
                                            <div class="col-md-3">
                                                <a href="{{action('Admin\RoleController@show', $role['id'])}}"><span
                                                            class="animated flash">►</span> {{$role['name']}}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection

