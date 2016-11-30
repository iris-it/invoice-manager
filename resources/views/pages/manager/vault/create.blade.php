@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    {!! Form::open(['method' => 'POST','action' => ['Manager\VaultController@store'], 'files' => true]) !!}

                    <div class="box-header">
                        <h3 class="box-title">{{trans('vault.new-title')}}</h3>
                    </div>

                    <div class="box-body">

                        @include('errors.list')

                        <label class="text-danger font-w500 header-title animated flash"> (*) {{trans('general.needed-fields')}}</label>

                        <div class="row">
                            <div class="col-md-12 form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="preferred_username">{{trans('vault.name-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">{{trans('vault.description-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">{{trans('vault.emails-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::email('emails', null, ['class' => 'form-control', 'autocomplete' => 'on', 'required', 'multiple']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">{{trans('vault.files-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::file('files[]',['class' => 'form-control', 'multiple' => 'true']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{action('Manager\VaultController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('vault.back-action')}}
                        </a>
                        <button class="btn btn-flat btn-sm btn-primary" type="submit">
                            <i class="fa fa-check push-5-r"></i> {{trans('vault.create-action')}}
                        </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @parent

@endsection