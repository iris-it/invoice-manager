@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('vault.list')}} ({{$vaults->count()}})</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{trans('vault.table-name')}}</th>
                                <th>{{trans('vault.table-description')}}</th>
                                <th>{{trans('vault.table-documents')}}</th>
                                <th>{{trans('vault.table-validated')}}</th>
                                <th>{{trans('general.created-at')}}</th>
                                <th>{{trans('vault.table-actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="animated fadeIn">
                            @foreach($vaults as $vault)
                                <tr>
                                    <td class="font-w600">{{$vault->name}}</td>
                                    <td>{{$vault->description}}</td>
                                    <td>{{$vault->documents->count()}}</td>
                                    <td>{{($vault->users()->where('user_id', auth()->user()->id)->first()->pivot->is_valid)? trans('general.yes'): trans('general.no')}}</td>
                                    <td>{{$vault->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{action('VaultController@show', $vault->id)}}" class="btn btn-flat btn-default" type="button" data-toggle="tooltip" title="{{trans('vault.show-action')}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {!! $vaults->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection