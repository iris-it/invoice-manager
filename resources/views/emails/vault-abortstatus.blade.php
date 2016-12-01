@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

    <h4 class="secondary"><strong>Bonjour {{$user->name}}</strong></h4>

    @if($status)
        <p>{{$owner->name}} à validé votre annulation pour le document <b>{{$document->name}}</b> présent dans le porte document : {{$vault->name}}</p>
    @else
        <p>{{$owner->name}} à refusé votre annulation pour le document <b>{{$document->name}}</b> présent dans le porte document : {{$vault->name}}</p>
    @endif

    <a href="{{$link}}">Lien vers le porte document</a>

    @include('beautymail::templates.widgets.articleEnd')

@stop

