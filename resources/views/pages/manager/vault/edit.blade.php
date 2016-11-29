@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    {!! Form::model($vault, ['method' => 'PUT','action' => ['Manager\VaultController@update', $vault->id], 'class'=> 'form-horizontal']) !!}

                    <div class="box-header">
                        <h3 class="box-title">{{trans('general.edit')}} {{$vault->name}}</h3>
                    </div>

                    <div class="box-body">

                        @include('errors.list')

                        <div class="row">
                            <div class="col-md-8 col-sm-offset-2 form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! Form::label('name', trans('vault.name-field')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! Form::label('description', trans('vault.description-field')) !!}
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{action('Manager\VaultController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('vault.back-action')}}
                        </a>
                        <button class="btn btn-flat btn-sm btn-success" type="submit">
                            <i class="fa fa-check push-5-r"></i> {{trans('vault.save-action')}}
                        </button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>

@endsection