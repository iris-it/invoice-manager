<!DOCTYPE html>
<html lang="en">
<head>
    @include('elements.head')
</head>

<body class="hold-transition login-page">

<div style="margin-top:8%">

    <div class="login-logo">
        <p style="font-size:2em"><b>{{config('app.name')}}</b></p>
        <p>{{trans('auth.login')}}</p>
    </div>

    @yield('content')

</div>

@include('elements.scripts')

</body>
</html>
