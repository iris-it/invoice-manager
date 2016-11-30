@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

    <h4 class="secondary"><strong>Bonjour {{$user->name}}</strong></h4>

    <p>Vous avez été invité à valider des documents : {{$vault->name}}</p>

    <a href="{{$link}}">Lien vers le porte document</a>

    @include('beautymail::templates.widgets.articleEnd')

@stop

