@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

    <h4 class="secondary"><strong>Bonjour {{$owner->name}}</strong></h4>

    @if($status)
        <p>{{$user->name}} à validé le document <b>{{$document->name}}</b> présent dans le porte document : {{$vault->name}}</p>
    @else
        <p>{{$user->name}} demande une annulation de validation pour le document <b>{{$document->name}}</b> présent dans le porte document : {{$vault->name}}</p>
        <a href="{{action('Manager\VaultController@abortUserValidation', ['vault_id' => $vault->id, 'document_id' => $document->id, 'user_id' => $user->id])}}">Lien vers la demande d'annulation</a>
    @endif

    <a href="{{$link}}">Lien vers le porte document</a>

    @include('beautymail::templates.widgets.articleEnd')

@stop

