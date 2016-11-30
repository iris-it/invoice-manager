@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

    <h4 class="secondary"><strong>Bonjour {{$owner}}</strong></h4>

    <p>{{$user}} à {{($status)? 'validé' : 'invalidé'}} les documents présents dans le porte document : {{$vault->name}}</p>

    <a href="{{$link}}">Lien vers le porte document</a>

    @include('beautymail::templates.widgets.articleEnd')

@stop

