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

                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>{{$user->name}}</b> {{trans('vault.ask-for-unvalidate')}} <b>{{$document->name}}</b></p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{action('Manager\VaultController@processAbortUserValidation', ['vault_id' => $vault->id, 'document_id' => $document->id, 'user_id' => $user->id, 'status' => 1])}}" class="btn btn-flat btn-success btn-block" data-method="POST" data-toggle="tooltip" title="{{trans('general.accept-request')}}" data-token="{{csrf_token()}}">
                                            <i class="fa fa-check"></i> {{trans('general.accept')}}
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{action('Manager\VaultController@processAbortUserValidation', ['vault_id' => $vault->id, 'document_id' => $document->id, 'user_id' => $user->id, 'status' => 0])}}" class="btn btn-flat btn-danger btn-block" data-method="POST" data-toggle="tooltip" title="{{trans('general.refuse-request')}}" data-token="{{csrf_token()}}">
                                            <i class="fa fa-trash"></i> {{trans('general.refuse')}}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection