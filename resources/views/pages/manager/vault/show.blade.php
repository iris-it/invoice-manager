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
                                        <label>{{trans('vault.users-field')}}</label>
                                        <ul>
                                            @foreach($vault->users as $user)
                                                <li><b>{{$user->name}}</b> ({{$user->email}})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>{{trans('vault.documents-field')}}</th>
                                                <th>{{trans('vault.table-download')}}</th>
                                                <th>{{trans('vault.table-download-validated')}}</th>
                                                <th>{{trans('vault.table-validated')}}</th>
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
                                                            <b class="text-green">{{trans('general.yes')}}</b>
                                                        @else
                                                            <b class="text-red">{{trans('general.no')}}</b>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{action('Manager\VaultController@index')}}" class="btn btn-flat btn-sm btn-info" type="button">
                            <i class="fa fa-arrow-left"></i> {{trans('vault.back-action')}}
                        </a>
                        <a href="{{action('Manager\VaultController@edit', $vault->id)}}" class="btn btn-flat btn-sm btn-success" type="button">
                            <i class="fa fa-pencil"></i> {{trans('vault.edit-action')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection