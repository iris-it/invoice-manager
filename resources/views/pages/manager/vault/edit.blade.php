@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    {!! Form::model($vault, ['method' => 'PUT','action' => ['Manager\VaultController@update', $vault->id], 'class'=> 'form-horizontal', 'files' => true]) !!}

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

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label for="email">{{trans('vault.emails-field')}}<span class="text-danger animated flash"> *</span></label>
                                        {!! Form::email('emails', $emails, ['class' => 'form-control', 'autocomplete' => 'on', 'required', 'multiple']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>{{trans('vault.table-name')}}</th>
                                                <th>{{trans('general.created-at')}}</th>
                                                <th>{{trans('vault.table-actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="animated fadeIn">
                                            @foreach($vault->documents as $document)
                                                <tr>
                                                    <td class="font-w600">{{$document->name}}</td>
                                                    <td>{{$document->created_at->diffForHumans()}}</td>
                                                    <td>
                                                        <a href="{{url('serve/'.$document->uuid)}}" class="btn btn-flat btn-default" type="button" data-toggle="tooltip" title="{{trans('vault.show-action')}}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{action('Manager\DocumentController@destroy',['id' => $document->id])}}" class="btn btn-flat btn-danger" data-method="DELETE" data-toggle="tooltip" title="{{trans('document.delete-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('document.delete-action-warning')}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
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