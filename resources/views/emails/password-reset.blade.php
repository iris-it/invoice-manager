@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

    <h4 class="secondary"><strong>{{$name}} votre compte vient d'être crée</strong></h4>

    <p>Vos identifiants de connexion sont : </p>
    <ul>
        <li>Email : {{$email}}</li>
        <li>Mot de passe : {{$password}}</li>
    </ul>

    <a href="{{url()}}">Lien vers l'application</a>

    @include('beautymail::templates.widgets.articleEnd')

@stop

