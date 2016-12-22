@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
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
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>{{trans('vault.table-description')}}</th>
                                                <th>{{trans('vault.table-download')}}</th>
                                                <th>{{trans('vault.table-download-validated')}}</th>
                                                <th>{{trans('vault.table-actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="animated fadeIn">
                                            @foreach($vault->documents as $document)
                                                <tr>
                                                    <td class="font-w600">{{$document->name}}</td>
                                                    <td><a href="{{url('serve/'.$document->uuid)}}" target="_blank"> {{trans('general.show')}} </a></td>
                                                    <td>
                                                        @if($document->validation_document)
                                                            <a href="{{url('serve/'.$document->validation_document->uuid)}}" target="_blank"> {{trans('general.show')}} </a>
                                                        @else
                                                            {{trans('general.not-available')}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($document->validation_document)
                                                            <a href="{{action('VaultController@unvalidateDocument',['id' => $vault->id,'document' => $document->id])}}" class="btn btn-flat btn-danger btn-block" data-method="POST" data-toggle="tooltip" title="{{trans('vault.validate-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('vault.validate-action-warning')}}">
                                                                <i class="fa fa-refresh"></i> {{trans('general.abort')}}
                                                            </a>
                                                        @else
                                                            {!! Form::open(['method' => 'POST','action' => ['VaultController@validateDocument', 'id' => $vault->id,'document' => $document->id], 'files' => true]) !!}
                                                            <div class="input-group">
                                                                {!! Form::file('file',['class' => 'form-control']) !!}
                                                                <span class="input-group-btn">
                                                                   <button class="btn btn-flat btn-success btn-block" type="submit">
                                                                       <i class="fa fa-check"></i> {{trans('general.validate')}}
                                                                   </button>
                                                                </span>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <a href="{{action('VaultController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                                        <i class="fa fa-arrow-left"></i> {{trans('vault.back-action')}}
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection