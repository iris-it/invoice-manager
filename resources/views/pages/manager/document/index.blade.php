@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('document.list')}} ({{$documents->count()}})</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{trans('document.table-name')}}</th>
                                <th>{{trans('general.created-at')}}</th>
                                <th>{{trans('document.table-actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="animated fadeIn">
                            @foreach($documents as $document)
                                <tr>
                                    <td class="font-w600">{{$document->name}}</td>
                                    <td>{{$document->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url('serve/'.$document->uuid)}}" target="_blank" class="btn btn-flat btn-default" type="button" data-toggle="tooltip" title="{{trans('document.show-action')}}">
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
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {!! $documents->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection