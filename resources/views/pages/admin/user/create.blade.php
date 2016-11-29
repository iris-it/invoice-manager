@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    {!! Form::open(['method' => 'POST','action' => ['Admin\UserController@store']]) !!}

                    <div class="box-header">
                        <h3 class="box-title">{{trans('users.new-title')}}</h3>
                    </div>

                    <div class="box-body">

                        @include('errors.list')

                        <label class="text-danger font-w500 header-title animated flash"> (*) {{trans('general.needed-fields')}}</label>

                        <div class="row">
                            <div class="col-md-12 form-horizontal">

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="preferred_username">{{trans('users.username-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">{{trans('users.email-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label for="role_id">{{ trans('users.role-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::select('role_id', $roles, null,['class' => 'form-control']) !!}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{action('Admin\UserController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('users.back-action')}}
                        </a>
                        <button class="btn btn-flat btn-sm btn-primary" type="submit">
                            <i class="fa fa-check push-5-r"></i> {{trans('users.create-action')}}
                        </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

@endsection