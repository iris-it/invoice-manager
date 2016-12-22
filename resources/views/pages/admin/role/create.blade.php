@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    {!! Form::open(['method' => 'POST','action' => ['Admin\RoleController@store'], 'class'=> 'form-horizontal']) !!}

                    <div class="box-header">
                        <h3 class="box-title">{{trans('role.new-title')}}</h3>
                    </div>

                    <div class="box-body">

                        @include('errors.list')

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label for="name">{{trans('role.name-field')}} <span class="text-danger animated flash"> *</span></label>
                                        * {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label for="label">{{trans('role.label-field')}} <span class="text-danger animated flash"> *</span></label>
                                        {!! Form::text('label', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="description">{{trans('role.description-field')}} <span class="text-danger animated flash"> *</span></label>
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{action('Admin\RoleController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('role.back-action')}}
                        </a>
                        <button class="btn btn-flat btn-sm btn-primary" type="submit">
                            <i class="fa fa-check push-5-r"></i> {{trans('role.create-action')}}
                        </button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>

@endsection