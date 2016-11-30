@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$vault->name}}</h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 form-horizontal">

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('vault.name-field')}}</label>
                                        {!! Form::text('name', $vault->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('vault.description-field')}}</label>
                                        {!! Form::text('description', $vault->description, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label>{{trans('vault.documents-field')}}</label>
                                        <ul>
                                            @foreach($vault->documents as $document)
                                                <li>{{$document->name}} (<a href="{{url('serve/'.$document->uuid)}}"> Telecharger </a>)</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                {!! Form::open(['method' => 'POST','action' => ['VaultController@validateToggle',$vault->id]]) !!}

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('status', true ,$status) !!} {{trans('vault.validate-field')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <a href="{{action('VaultController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                                        <i class="fa fa-arrow-left"></i> {{trans('vault.back-action')}}
                                    </a>
                                    <button class="btn btn-flat btn-sm btn-primary" type="submit">
                                        <i class="fa fa-check push-5-r"></i> {{trans('vault.validate-action')}}
                                    </button>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection