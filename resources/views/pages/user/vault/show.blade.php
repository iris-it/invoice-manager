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
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>{{trans('vault.table-description')}}</th>
                                                <th>{{trans('vault.table-actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="animated fadeIn">
                                            @foreach($vault->documents as $document)
                                                <tr>
                                                    <td class="font-w600">{{$document->name}} (<a href="{{url('serve/'.$document->uuid)}}"> Telecharger </a>)</td>
                                                    <td>

                                                        @if($document->validated_by_users()->where('user_id', auth()->user()->id)->first()->pivot->is_valid)

                                                        @else
                                                            <a href="{{action('VaultController@validateToggle',['id' => $vault->id,'document' => $document->id])}}" class="btn btn-flat btn-danger" data-method="POST" data-toggle="tooltip" title="{{trans('vault.validate-action')}}" data-token="{{csrf_token()}}" data-confirm="{{trans('vault.validate-action-warning')}}">
                                                                <i class="fa fa-check"></i>
                                                            </a>
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
                                    <button class="btn btn-flat btn-sm btn-primary" type="submit">
                                        <i class="fa fa-check push-5-r"></i> {{trans('vault.validate-action')}}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection